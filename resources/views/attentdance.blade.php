@extends('layouts.app')

@section('content')


<div class="container-fluid">
    <div class="row">

        <div class="col-md-4">
            <div class="card ">
             
              <div class="card-body">
                <h4 class="card-title">จำนวนที่เข้าทำงาน เดือนมีนาคม ๒๕๖๒</h4>
               <table class="table table-hover table-bordered">
                   <thead>
                       <tr>
                           <th>ชื่อ</th>
                           <th>ตำแหน่ง</th>
                           <th>จำนวนครั้ง/เดือน</th>
                           <th>view</th>
                       </tr>
                   </thead>
                   <tbody>
                        @if($singlemonth->isEmpty())
                        <tr>
                                <td colspan="3" class="text-center">ไม่พบข้อมูลของเดือนนี้</td>
                               
                           </tr>
                   
                       @else
                       @foreach ($singlemonth as $items)
                       <tr>
                           <td scope="row">{{$items->name }}</td>
                           <td>{{$items->position }}{{$items->department }}</td>
                           <td>{{$items->total_come }} ครั้ง</td>
                       <td><a href="{{ route('comein', [$items->id, 3] )}}" class="badge badge-primary">ตรวจสอบ</a> </td>
                       </tr>
                       @endforeach
                       @endif
                   </tbody>
               </table>
              </div>
            </div>
          

      

          
  
                <div class="card " style=" margin-top :15px;">
                 
                  <div class="card-body">
                    <h4 class="card-title">จำนวนที่เข้าทำงาน เดือนเมษายน ๒๕๖๒</h4>
                   <table class="table table-hover table-bordered">
                       <thead>
                           <tr>
                               <th>ชื่อ</th>
                               <th>ตำแหน่ง</th>
                               <th>จำนวนครั้ง/เดือน</th>
                               <th>view</th>
                           </tr>
                       </thead>
                       <tbody>
                            @if($singlemonth2->isEmpty())
                            <tr>
                                    <td colspan="3" class="text-center">ไม่พบข้อมูลของเดือนนี้</td>
                                    
                                </tr>
                           @else
                        
                           @foreach ($singlemonth2 as $items)
                           <tr>
                               <td scope="row">{{$items->name }}</td>
                               <td>{{$items->position }}{{$items->department }}</td>
                               <td>{{$items->total_come }} ครั้ง</td>
                               <td><a href="{{ route('comein', [$items->id, 4] )}}" class="badge badge-primary">ตรวจสอบ</a> </td>
                           </tr>
                           @endforeach
                           @endif
                           
                       </tbody>
                   </table>
                  </div>
                </div>
              
    
          
    
              
            </div>


        <div class="col-md-8">
            <h1>

                <div class="alert alert-primary" role="alert">
                    <strong>บันทึกเข้าทำงาน</strong> <br>
                    <div id="clock" class="clock">loading ...</div> <a href="#" class="alert-link"></a>
                </div>
            </h1>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId"
                style="margin-bottom: 15px;">
                ค้นหารหัสประจำตัว
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">รายนามเจ้าหน้าที่ประจำสำนักงาน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12"></div>

                                    <table class="table table-striped table-inverse ">
                                        <thead class="thead-inverse">
                                            <tr>
                                                    <th class="text-left">เลขที่</th>
                                                <th class="text-left">ชื่อ</th>
                                                <th class="text-left">วัด</th>
                                                <th class="text-left">ตำแหน่ง</th>
                                                
                                              
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($member as $item)


                                            <tr>
                                                    <td class="text-left" style="color:red;"><strong>{{$item->id}}</strong></td>
                                                <td class="text-left">{{$item->name}} </td>
                                                {{-- <td class="text-left">{{$item->wat->name}}</td> --}}
                                                <td class="text-left">
                                                        {{$item->wat->name}}</td>
                                                <td class="text-left">
                                                    {{$item->position->name}}{{$item->department->name}}</td>
                                                   
                                               
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>

                        </div>
                    </div>
                </div>
            </div>
            @if(session()->get('success'))
            <div class="alert alert-success" id="success">
                {{ session()->get('success') }}
            </div>
            @elseif(session()->get('error'))
            <div class="alert alert-danger" id="error">
                {{ session()->get('error') }}
            </div>
            @endif
            {!! Form::open([ 'route' => 'atten', 'method' => 'get']) !!}


            <div class="form-group">
                {!! Form::text('userid', null, ['placeholder' => 'กรอกรหัสประจำตัว และกดEnter','class' =>
                'form-control','autofocus']) !!}
            </div>



            {!! Form::close() !!}

      
        
        <h2 class="text-center">
            <?php 
                                                   $yearold = Date::now()->format('Y') 
 ?> <div class="alert alert-info" role="alert">
                <strong>

                    เจ้าหน้าที่เข้าทำงาน<Br>ประจำวัน{{  Date::now()->format('lที่ j F พ.ศ.') }}{{ $yearold+543 }}
                    <br>(ทั้งหมด {{count($attendence)}} รูป/คน)
                </strong> <a href="#" class="alert-link"></a>
            </div>

        </h2>

        <table class="table  table-hover table-bordered">
            <thead class="thead">
                <tr>
                    <th class="text-left">ชื่อ</th>
                    <th class="text-left">ตำแหน่ง</th>
                    <th class="text-left">เวลา</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $date = new Date('today');
                $ss = $date->format('Y-m-d');
       ?>
                @if (count($attendence) > 0)
                @foreach($attendence as $atten)
                <tr>

                    <td class="">{{ $atten->name }}</td>
                    <td class="">{{ $atten->position }}{{ $atten->department }}</td>
                    <td class=""> {{ $atten->time_in }}
                    
                    </td>

                </tr>
                @endforeach
                @elseif (count($attendence) == 0)

                <tr>
                    <td colspan="3" class="text-center">ไม่มีข้อมูลสำหรับวันนี้</td>
                </tr>
                @endif

            </tbody>
        </table>



        
    </div>


</div>
</div>
</div>
</div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/FitText.js/1.1/jquery.fittext.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/th.js"> </script>

<script type="text/javascript">

setTimeout(function() {
            $('#error').hide('fast');
        }, 5000);
        setTimeout(function() {
            $('#success').hide('fast');
        }, 5000);
    $('#tt').fitText(1.5);
    $('#clock').fitText(1.5);

    function update() {

        var m = moment();
        m.locale('th');
        var o = m.utcOffset(); // returns the current offset
        m.utcOffset(420);
        $('#clock').html(m.format('LTS'));
    }

    setInterval(update, 1000);

</script>



@endsection
