<?php

namespace App\Http\Controllers\nation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use auth;
use App\modelgongtham\level;
use App\modelgongtham\stitexam;
use App\modelgongtham\country;
use App\modelgongtham\explace;
use DB;
use Redirect;
use PDF;


class StitexamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $stats = stitexam::where('edu_year', 2560)->where('id_level', 2)->get();
        // $stitexam = stitexam::with('explace')->get();

        $stitexam = DB::table('stitexam') ->select(
            'stitexam.*',
            
            'level.th_level as level',
            'explace.th_explace as th_explace',
            'country.en_abbrev as th_country',
         )->join('explace', 'stitexam.id_explace', '=', 'explace.id')
         ->join('country', 'explace.id_country', '=', 'country.id')
         ->join('level', 'stitexam.id_level', '=', 'level.id')
        //  ->groupBy('stitexam.id_explace')
         ->get();
        // $stateself = stitexam::where('user_id', auth::user()->id)->get();


        // dd($stateself);
        $level = level::pluck('th_level', 'id');
        $stall = stitexam::where('edu_year');
        if($stitexam->count() > 0){
        $st1 = $stitexam->sum('stit1');
        $st2 = $stitexam->sum('stit2');
        $st3 = $stitexam->sum('stit3');
        $st4 = $stitexam->sum('stit4');
        $st5 = $stitexam->sum('stit5');

        $anvt = ($st4 * 100) / $st3;
      }
// dd($stats);
return response()->json([
    "stitexam" => $stitexam
], 200);
        // return view('nation.stitexam.index', compact('stitexam', 'st1', 'st2', 'st3', 'st4', 'st5', 'anvt', 'level'));

    }


    public function statsAjax(Request $request)
    {
        if ($request->ajax()) {
            $stats = stitexam::where('edu_year', $request->year)->where('id_level', $request->level)->get();
            $st1 = $stats->sum('stit1');
            $st2 = $stats->sum('stit2');
            $st3 = $stats->sum('stit3');
            $st4 = $stats->sum('stit4');
            $st5 = $stats->sum('stit5');

            if (empty($st3)) {

            } else {
                $tea = ($st4 / $st3) * 100;
            }

            $awsc = (isset($tea)) ? $tea : 0;
            if ($awsc == 100) {
                $aws = number_format($awsc);
            } elseif ($awsc == 0) {
                $aws = '00.00';
            } else {
                $aws = number_format($awsc, 2, '.', ',');
            }


            return response()->json(['st1' => $st1, 'st2' => $st2, 'st3' => $st3, 'st4' => $st4, 'st5' => $st5, 'aws' => $aws]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $explace = explace::pluck('th_explace', 'id');
        $level = level::pluck('th_level', 'id');
        // dd($countrys);
        return view('nation.stitexam.create', compact('explace', 'level'));
    }
    // public function selectcountry(Request $request)
    // {
    //   if($request->ajax()){
    //    $country = DB::table('explace')->where('id_country',$request->id_country)->pluck('th_explace','id')->all();
    //    $data = view('ajax-selectcountry',compact('country'))->render();
    //    dd($request->id_country);
    //    return response()->json(['options'=>$data]);
    //  }
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
// dd($request->all());
        $this->validate($request, [

            'stit1*' => 'required|numeric|digits_between:1,4',
            'stit2*' => 'required|numeric|digits_between:1,4',
            'stit4*' => 'required|numeric|digits_between:1,4',
            'edu_year.*' => 'required|unique:stitexam,edu_year,id_level',
            'level.*' => 'required|unique:stitexam,edu_year,id_level',
            'explace.*' => 'required|unique:stitexam,edu_year,id_level',
                // เหลือ เปรียบเทียบ ระดับชั้น 1 ต่อ 1 ปี 

        ]);



        foreach($request->stit1 as $stit1){
          $fieldsId1[]   = $stit1;
        }
        foreach($request->stit2 as $stit2){
          $fieldsValue2[] = $stit2;
        }
        foreach($request->stit4 as $stit4){
          $fieldsValue3[] = $stit4;
        }
        foreach($request->level as $level){
          $fieldslevel[] = $level;
        }
        
        $check = stitexam::where('edu_year', $request->get('edu_year'))->whereIn('id_level', $request->level)->where('id_explace', $request->get('explace'))->count();
        if ($check > 0) {
            return Redirect::back()->with('message', 'มีข้อมูลในปีการศึกษานี้แล้ว' );
    } else {
      $j = 0;
      while($j < count($fieldsId1)) {
        $stita                 = $fieldsId1[$j];
        $stitb                = $fieldsValue2[$j];
        $stitc                 = $fieldsValue3[$j];
        $levels                = $fieldslevel[$j];
        $static                = new stitexam();
        $static->stit1 = $stita;
        $static->stit2 = $stitb;
        $static->stit3 = ($stita - $stitb);
        $static->stit4 = $stitc;
        $static->stit5 = ($static->stit3 - $stitc);
        $static->edu_year = $request->get('edu_year');
        $static->id_explace = $request->get('explace');
        $static->id_level = $levels;
        $static->note = $request->get('note');
        if ($stita < $stitb) {

            return Redirect::back()->with('message', '!! จำนวนขาดสอบ มากกว่าจำนวนผู้สอบ กรุณาตรวจสอบข้อมูลใหม่ จำนวณผู้เข้าสอบ  ' . $stita . ' คน' . 'จำนวนผู้ขาดสอบ  ' . $stitb . ' คน');
        } elseif ($stitc > $static->stit3) {
            return Redirect::back()->with('message', '!! จำนวนผู้สอบได้มีมากกว่า จำนวนคงสอบ | จำนวนผู้สอบได้  ' . $stitc . ' คน' . ' จำนวนคงสอบ  ' . $static->stit3 . ' คน');
        } else {

            $static->save();
        }
      $j++;
      }
            // $static = new stitexam();
            // $static->stit1 = $request->get('stit1');
            // $static->stit2 = $request->get('stit2');
            // $static->stit3 = ($request->get('stit1') - $request->get('stit2'));
            // $static->stit4 = $request->get('stit4');
            // $static->stit5 = ($static->stit3 - $request->get('stit4'));
            // $static->edu_year = $request->get('edu_year');
            // $static->id_explace = $request->get('explace');
            // $static->id_level = $request->get('level');
            // $static->note = $request->get('note');
            //

        }
        $request->session()->flash('success', 'บันทึกข้อมูลข้อมูลเรียบร้อยแล้ว');
        return redirect()->route('stitexam.index');

// dd($static->stit4);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($edu_year,$id_explace,$id_level)
    {
        PDF::SetTitle('Hello World');
        PDF::AddPage();
        PDF::Write(0, 'Hello World');
        // PDF::Output(public_path('/public/hello_world' . '.pdf'), 'F');
        // $stitexam = stitexam::findOrFail($id);
        $stitexam = DB::table('stitexam') ->select(
            'stitexam.*',
            
            'level.th_level as level',
            'explace.th_explace as th_explace',
            'country.en_abbrev as th_country',
         )->join('explace', 'stitexam.id_explace', '=', 'explace.id')
         ->join('country', 'explace.id_country', '=', 'country.id')
         ->join('level', 'stitexam.id_level', '=', 'level.id')
        //  ->groupBy('stitexam.id_explace')
        ->where('stitexam.edu_year','=' , $edu_year)
        ->where('stitexam.id_level','=' , $id_level)
        ->where('stitexam.id_explace','=' , $id_explace)
        ->first();
         return response()->json([
            // 'pdf' => base64_encode(PDF::Output(('public' . '/hello_world' . '.pdf'), 'F')),
            "stitexam" => $stitexam
        ], 200);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function pdfgennerate(){
      

  
    }


    public function edit($id)
    {
        $stats = stitexam::findOrFail($id);

        $explace = explace::pluck('th_explace', 'id');
        $level = level::pluck('th_level', 'id');
        // dd($stats->stit1);
        return view('nation.stitexam.edit', compact('explace', 'level', 'stats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'stit1' => 'required|numeric|digits_between:1,4',
            'stit2' => 'required|numeric|digits_between:1,4',
            'stit4' => 'required|numeric|digits_between:1,4',
            'year' => 'required',
            'level' => 'required',
            'explace' => 'required',

        ]);

        $stat = stitexam::findOrFail($id);
        $stat->stit1 = $request->get('stit1');
        $stat->stit2 = $request->get('stit2');
        $stat->stit3 = ($request->get('stit1') - $request->get('stit2'));
        $stat->stit4 = $request->get('stit4');
        $stat->stit5 = ($stat->stit3 - $request->get('stit4'));
        $stat->edu_year = $request->get('year');
        $stat->id_explace = $request->get('explace');
        $stat->id_level = $request->get('level');
        $stat->note = $request->get('note');
        if ($request->get('stit1') < $request->get('stit2')) {

            return Redirect::back()->with('message', '!! จำนวนขาดสอบ มากกว่าจำนวนผู้สอบ กรุณาตรวจสอบข้อมูลใหม่ จำนวณผู้เข้าสอบ  ' . $request->get('stit1') . ' คน' . 'จำนวนผู้ขาดสอบ  ' . $request->get('stit2') . ' คน');
        } elseif ($request->get('stit4') > $stat->stit3) {
            return Redirect::back()->with('message', '!! จำนวนผู้สอบได้มีมากกว่า จำนวนคงสอบ | จำนวนผู้สอบได้  ' . $request->get('stit4') . ' คน' . ' จำนวนคงสอบ  ' . $stat->stit3 . ' คน');
        } else {

            $stat->update();
        }
        $request->session()->flash('success', 'อัพเดทข้อมูลข้อมูลเรียบร้อยแล้ว');
        return redirect()->route('stitexam.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $statd = stitexam::findOrFail($id);
        $statd->delete();
        return Redirect::back()->with('msg', 'ลบข้อมูลสถิติสนามสอบ ' . $statd->explace->th_explace . ' ' . $statd->level->th_level . ' สำเร็จ!!');

    }
}
