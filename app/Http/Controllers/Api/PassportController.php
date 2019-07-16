<?php

namespace App\Http\Controllers\Api;


use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class PassportController extends Controller
{
    /**
     * Handles Registration Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ])->assignRole('Users');
 
        $token = $user->createToken('gongtham')->accessToken;
 
        // return response()->json(['token' => $token], 200);
        // $user = auth()->user();
        return (new UserResource($user))->additional([
            'data' => [
                'token' => $token
            ]
            ],200)->response();
    }
 
    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

    
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('gongtham');
            $tokens = $token->token;
            $tokens->expires_at = Carbon::now()->addMinutes(30);
            
            // $expires_at = auth()->user()->createToken('gongtham')->expires_at;
            // return response()->json(['token' => $token], 200);
            $user = auth()->user();
            
            

            $roles = DB::table('model_has_roles') ->select(
                'roles.name as role_name',
             )->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            //  ->groupBy('stitexam.id_explace')
            ->where('model_has_roles.model_id','=' , $user->id )
            ->get();
    //get permissions
            $permissions = DB::table('model_has_roles') ->select(
               'permissions.name as permission_name')->distinct('permissions.name')
            ->join('role_has_permissions', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
             ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
            //  ->groupBy('stitexam.id_explace')
            ->where('model_has_roles.model_id','=' , $user->id )
            ->get();
    // $user = $request->user();
    // $tokenResult = $user->createToken('Personal Access Token');
    // $token = $tokenResult->token;
    $tokens->save();
    //     $token->expires_at = Carbon::now()->addMinutes(5);

    // return response()->json([
    //     'access_token' => $tokenResult->accessToken,
    //     'token_type' => 'Bearer',
    //     'expires_at' => Carbon::parse(
    //         $tokenResult->token->expires_at
    //     )->toDateTimeString()
    // ]);
            return response()->json([
                'data' => [
                    'token' => $token->accessToken,
                    'roles' => $roles,
                    'permissions' => $permissions,
                    // 'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $token->token->expires_at
            )->toDateTimeString()
                    // 'expires_at' => $expires_at
                ]
                ],200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }


       
        // $http = new \GuzzleHttp\Client;
        // try {
        //   $response = $http->post('http://localhost:8000/oauth/token', [
        //     'form_params' => [
        //         'grant_type' => 'password',
        //         'client_id' => '2',
        //         'client_secret' => '7e89i9GqKS0vWuzofEJS2zaS9PrGPmYBTV3ScHwc',
        //         'username' => $request->email,
        //         'password' => $request->password,
        //         'scope' => '',
        //     ],
        // ]);
        //     return $response->getBody();
        // } catch (\GuzzleHttp\Exception\BadResponseException $e) {
        //     if ($e->getCode() === 400) {
        //         return response()->json('Invalid Request. Please enter a username or a password.', $e->getCode());
        //     } else if ($e->getCode() === 401) {
        //         return response()->json('Your credentials are incorrect. Please try again', $e->getCode());
        //     }
        //     return response()->json('Something went wrong on the server.', $e->getCode());
        // }
    }


    public function getUser()
    {
     
        $user = auth()->user();
      $tokentimeout = DB::table('oauth_access_tokens')->where('user_id','=' , $user->id )->orderBy('created_at','desc')->first();
        $now = carbon::now();
        if ($tokentimeout->expires_at < $now) {
            return response()->json(['error' => 'token หมดอายุ'], 401);
        }
// dd($now);
//get roles
        $roles = DB::table('model_has_roles') ->select(
            'roles.name as role_name',
         )->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        //  ->groupBy('stitexam.id_explace')
        ->where('model_has_roles.model_id','=' , $user->id )
        ->get();
//get permissions
        $permissions = DB::table('model_has_roles') ->select(
           'permissions.name as permission_name')->distinct('permissions.name')
        ->join('role_has_permissions', 'role_has_permissions.role_id', '=', 'model_has_roles.role_id')
         ->join('permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
        //  ->groupBy('stitexam.id_explace')
        ->where('model_has_roles.model_id','=' , $user->id )
        ->get();

        // $token = auth()->user()->createToken('gongtham')->accessToken;
        // $token = auth()->user()->createToken('gongtham');
        // $tokens = $token->token;
        // $tokens->expires_at = Carbon::now()->addMinutes(5);
        // $tokens->save();
        
        return (new UserResource($user))->additional([
            'data' => [
                // 'token' => $token->accessToken,
                'roles' => $roles,
                'permissions' => $permissions,
                'token_type' => 'Bearer',
        // 'expires_at' => Carbon::parse(
        //     $token->token->expires_at
        // )->toDateTimeString()
            ], 
        ])->response();
    }
 
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
 
}
