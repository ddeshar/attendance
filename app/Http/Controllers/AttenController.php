<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Members;
use App\Attendance;
use App\Positions;
use App\Wat;


use DB;

class AttenController extends Controller{
    
    public function index(Request $request){

        //get data from input
        $atten = $request->input('userid');
            // Query for present staff
            $date = date('Y-m-d');
            $attenda = Attendance::where('date', '=', $date)->pluck('members_id')->toArray();;
            $attendence = Members::whereIn('id', $attenda)->get();

            // $month = Attendance::where('MONTH(date) = ?', date('m'))->get();

            $currentMonth = date('m');
            $singlemonth = DB::table("attendance")
                ->whereRaw('members_id = ?', 111166)
                ->whereRaw('MONTH(date) = ?',[date('m')])
                ->get();

            $allmonth = DB::table("attendance")
                // ->whereRaw('members_id = ?', 111166)
                ->whereRaw('MONTH(date) = ?',[date('m')])
                ->get();

        if($atten > 0){
            $profile = Members::findOrFail($atten);
                $name       = $profile->name;
                $position   = $profile->position;
                $time       = date('Y-m-d H:i:s');
            try {
                $data = new Attendance();
                $data->members_id = $atten;
                $data->date = date('Y-m-d');
                $data->time = date('H:i:s');
                $data->save();
            } catch(\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == '1062'){
                    $msg = "Sorry you already have checked";
                }
            }

        }else{
            // dump('not invisible');
            $name = '';
            $position = '';
            $time = '';
            $msg = '';
        }

        // return view('welcome');
        return view('welcome', compact('name','position','time','msg','attendence','singlemonth','allmonth'));
    }

}