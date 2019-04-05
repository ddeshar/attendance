<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Members;
use App\Attendance;
use App\Positions;
use App\Wat;
use Jenssegers\Date\Date;
use DB;

class AttenController extends Controller{
    
    public function index(Request $request){
       
        Date::setLocale('th');
        //get data from input
        $atten = $request->input('userid');
            // Query for present staff
          
            $date = new Date('today');
            $ss = $date->format('Y-m-d');
            // dd($ss);
     
            $attendence = DB::table('members') ->select(
                'members.id AS id',
                'members.name AS name',
                'positions.name AS position',
                'departments.name AS department',
                'attendance.time AS time_in'
             )->join('attendance', 'members.id', '=', 'attendance.members_id')
             ->join('positions', 'members.position_id', '=', 'positions.id')
            ->join('departments', 'members.department_id', '=', 'departments.id')
             ->where('date', '=', $ss)->orderBy('attendance.time','desc') ->get();
            //  dd($atent);
           
            $member = Members::all();
            // $month = Attendance::where('MONTH(date) = ?', date('m'))->get();
            
// dd(date::now()->endofMonth());
            $singlemonth = DB::table('members')
            ->select(
                'members.id AS id',
                'members.name AS name',
                'positions.name AS position',
                'departments.name AS department',
                DB::raw("count(attendance.members_id) AS total_come"))
            ->join('attendance', 'members.id', '=', 'attendance.members_id')
            ->join('positions', 'members.position_id', '=', 'positions.id')
            ->join('departments', 'members.department_id', '=', 'departments.id')
        ->groupBy('attendance.members_id')  ->whereRaw('MONTH(date) = ?',3)  ->whereNotIn('members.position_id', [1, 2])
        ->orderBy('total_come','desc')
        ->get();

        $singlemonth2 = DB::table('members')
            ->select(
                'members.id AS id',
                'members.name AS name',
                'positions.name AS position',
                'departments.name AS department',
                DB::raw("count(attendance.members_id) AS total_come"))
            ->join('attendance', 'members.id', '=', 'attendance.members_id')
            ->join('positions', 'members.position_id', '=', 'positions.id')
            ->join('departments', 'members.department_id', '=', 'departments.id')
        ->groupBy('attendance.members_id')  ->whereRaw('MONTH(date) = ?',4)->whereNotIn('members.position_id', [1, 2])
        ->orderBy('total_come','desc')
        ->get();
       
            $allmonth = DB::table("attendance")
                // ->whereRaw('members_id = ?', 111166)
                ->whereRaw('MONTH(date) = ?',[date('m')])
                ->get();
              
              
        if($atten > 0){
            $profile = Members::find($atten);
          if($profile == null){
            return redirect('/')->with('error', 'ไม่พบเลขที่ประจำตัวนี้!');
          }
          
                $name       = $profile->name;
                $position   = $profile->position;
                $time       = date('Y-m-d H:i:s');
            try {
                
                $data = new Attendance();
                $data->members_id = $atten;
                $data->date = date('Y-m-d');
                $data->time = date('H:i:s');
                $data->save();
                return back()->with('success','บันทึกข้อมูลเรียบร้อย!')->with('name');
            } catch(\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == '1062'){
            
                    return redirect('/')->with('error', 'บันทึกของวันนี้ไปแล้ว!');
                }
            }

        }else{
          
            // dump('not invisible');
            if($atten < 1){
               
            }
            $name = '';
            $position = '';
            $time = '';
          
        }

        // return view('welcome');
        return view('/attentdance', compact('name','position','time','attendence','singlemonth','allmonth','member','singlemonth2'));
    }


    public function comein($id,$month){

        // $members = Members::findorfail($id);
        

        $members = DB::table('members')
        ->select(
            'members.id AS id',
            'members.name AS name',
            'positions.name AS position',
            'departments.name AS department',
            'attendance.date AS date',
            'attendance.time AS time'
            )
        ->join('attendance', 'members.id', '=', 'attendance.members_id')
        ->join('positions', 'members.position_id', '=', 'positions.id')
        ->join('departments', 'members.department_id', '=', 'departments.id')
        ->where('members.id', '=' ,$id)
     ->whereRaw('MONTH(date) = ?',$month)
    ->orderBy('date','asc')
    ->get();

    $month = Attendance::where('members_id',$id)->whereRaw('MONTH(date) = ?',$month)->first();
    // dd($month);
    return view('comein', compact('members','month'));
}

}