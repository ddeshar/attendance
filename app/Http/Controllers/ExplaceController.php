<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use auth;
use App\modelgongtham\level;
use App\modelgongtham\stitexam;
use App\modelgongtham\country;
use App\modelgongtham\explace;
use Redirect;
use Carbon\Carbon;
use DB;

class ExplaceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
   
    $explace = explace::with('countrys');
    return response()->json([
      "explace" => $explace
  ], 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $country = Country::pluck('th_country', 'id');
      return view('nation.explace.create', compact('country'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [

        'th_explace' => 'required' ,
        'en_explace' => 'required',
        'id_country' => 'required',

             ]);


    $exp = new explace();
    $exp->th_explace = $request->get('th_explace');
      $exp->en_explace = $request->get('en_explace');
        $exp->id_country = $request->get('id_country');
        $exp->save();

        $request->session()->flash('success', 'บันทึกข้อมูลข้อมูลเรียบร้อยแล้ว');
      return redirect()->route('explace.index');
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      $explaces = explace::findOrFail($id);

        $level = level::pluck('th_level', 'id');

      $now = date('Y')+543;
      // $ts = $explaces->stitexamss->edu_year;

      $tt = stitexam::where('id_explace', $explaces->id)->orderBy('edu_year', 'desc')->get();
        $ee =  $tt->groupBy('edu_year');
         
      
          
      // $indy = stitexam::with('explace')->where('id_explace', $explaces->id )->groupBy('edu_year');

    // dd($ee);
      return view('nation.explace.show2' , compact('explaces','level','ee'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      $explaces = explace::findOrFail($id);
      $country = Country::pluck('th_country', 'id');
        return view('nation.explace.create' , compact('explaces','country'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->validate($request, [

        'th_explace' => 'required' ,
        'en_explace' => 'required',
        'id_country' => 'required',

             ]);

    $exp = explace::findOrFail($id);
    $exp->th_explace = $request->get('th_explace');
      $exp->en_explace = $request->get('en_explace');
        $exp->id_country = $request->get('id_country');
        $exp->update();

        $request->session()->flash('success', 'อัพเดทข้อมูลข้อมูลเรียบร้อยแล้ว');
      return redirect()->route('explace.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $expd = explace::findOrFail($id);
    $expd->delete();
     return redirect::back()->with('msg', 'ลบข้อมูลสนามสอบ '. $expd->th_explace .' ประเทศ '. $expd->countrys->th_country.' สำเร็จ!!');
  }
}
