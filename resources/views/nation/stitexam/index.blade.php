@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>จัดการบทบาท <small>Roles</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix">   <div class="pull-right">
                 	        	@can('role-create')
                 	       <a class="btn btn-primary" href="{{ route('stitexam.create') }}"> สร้างข้อมูลสถิติสนามสอบใหม่</a>
                 	            @endcan
                 	        </div></div>
                    </div>
                    <div class="x_content">

                      @if ($message = Session::get('msg'))
                    		<div class="alert alert-danger">
                    			<h3>{{ $message }}</h3>
                    		</div>
                    	@elseif($message = Session::get('success'))
                        <div class="alert alert-success">
                            <h3>{{ $message }}</h3>
                        </div>
                        @endif


<h2>
				<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
		<tr>
			<th>ลำดับ</th>
			<th>ส่ง</th>
			<th>ขาด</th>
      <th>คง</th>
			<th>ได้</th>
      <th>ตก</th>
        <th>อัตราร้อยละ</th>
			<th>ปีการศึกษา</th>
      	<th>สนามสอบ</th>
        	<th>ชั้นการศึกษา</th>
			<th width="280px">จัดการ</th>
		</tr>
  </thead>
  <?php $i = 0; ?>
<tbody>
	@foreach ($stitexam as $key => $stitexams)
	<tr>
		<td>{{ ++$i }}</td>
    <?php



        if(empty($stitexams->stit4 && $stitexams->stit3)){
          

        }
        
        else{
        $test = ($stitexams->stit4 * 100 / $stitexams->stit3) ;
        if ($test == 100) {
            $test = number_format($test);
          }else{
          $test = number_format($test,2, '.', ',');
          }
        }


    ?>


		<td>{{ $stitexams->stit1 }}</td>
		<td>{{ $stitexams->stit2 }}</td>
    <td>{{ $stitexams->stit3 }}</td>
    <td>{{ $stitexams->stit4 }}</td>
    <td>{{ $stitexams->stit5 }} </td>
    <td>
      @if($stitexams->stit4 == 0)
        0%
      @else
        {{ +number_format($stitexams->stit4 * 100 / $stitexams->stit3,2) }}%
@endif
    </td>
    <td>{{ $stitexams->edu_year ?? 'ไม่พบข้อมูล' }}</td>

      <td>
        @if(($stitexams->explace()->count()))

          <?php $countryss =  DB::table('country')->where('id',$stitexams->explace->id_country)->pluck("th_country")->first()

          ?>
          {{ $stitexams->explace->th_explace ?? 'ไม่พบข้อมูลสนามสอบ' }}


                  ประเทศ{{  isset($countryss) ? $countryss : '' }}


      @else
          <a style="color:red;" href="{{ route('explace.index') }}">กรุณาเช็คข้อมูลสนามสอบ</a>
      @endif
      </td>
       <td>{{ $stitexams->level->th_level ?? 'ไม่พบข้อมูล' }}</td>
		<td>
			{{-- <a class="btn btn-info" href="{{ route('stitexam.show',$stitexams->id) }}">Show</a> --}}
			@can('role-edit')
			<a class="btn btn-primary" href="{{ route('stitexam.edit',$stitexams->id) }}">Edit</a>
			@endcan

			@can('role-delete')
			{!! Form::open(['method' => 'DELETE','route' => ['stitexam.destroy', $stitexams->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
        	@endcan

		</td>
	</tr>
	@endforeach
</tbody>
	</table>
  </h2>

</div>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">


      <h2>สถิติข้อมูลรวม</h2>  {!! Form::selectYear('year',  (date('Y')) + 543, 2460, null  ,array('class'=>' form-control', 'id' => 'stats',  'placeholder' => '--- เลือกปีการศึกษา ---')) !!}
      {!! Form::select('level',[''=>'--- เลือกระดับการศึกษา ---']+$level->toArray(), null,array('class'=>' form-control' , 'tabindex' => '-1','id' => 'level')) !!}


      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <div class="row">

        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="count" style="color:black;"><i id="st1"> {{ $st1 ?? 'ไม่พบข้อมูล' }}</i></div>

            <h3>ส่งสอบรวม</h3>
            <p></p>
          </div>
        </div>

        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="count" style="color:red;"><i id="st2"> {{ $st2 ?? 'ไม่พบข้อมูล' }}</i></div>

            <h3>ขาดสอบรวม</h3>
            <p></p>
          </div>
        </div>
        <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="count"><i id="st3"> {{ $st3 ?? 'ไม่พบข้อมูล' }}</i></div>

            <h3>คงสอบรวม</h3>
            <p></p>
          </div>
        </div>

        <div class="animated flipInY col-lg-5 col-md-4 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="count" style="color:blue;"><i id="st4"> {{ $st4 ?? 'ไม่พบข้อมูล' }}</i></div>

            <h3>สอบได้รวม</h3>
            <p></p>
          </div>
        </div>

        <div class="animated flipInY col-lg-5 col-md-4 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="glyphicon glyphicon-user"></i>
            </div>

            <div class="count" style="color:red;"><i id="st5">   {{ $st5 ?? 'ไม่พบข้อมูล' }}</i></div>

            <h3>สอบตกรวม</h3>
            <p></p>
          </div>
        </div>

        <div class="animated flipInY col-lg-2 col-md-4 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="glyphicon glyphicon-user"></i>
            </div>
            <div class="count"><i id="anvt">

          
             @isset($anvt)
 {{ number_format($anvt,2,  '.', ','  )  }}
@endisset


             </i>%</div>

            <h3>อัตราร้อยละ</h3>
            <p></p>
          </div>
        </div>

      </div>


    </div>
  </div>
</div>

</div>
</div>
</div>    </div>
@prepend('scripts')
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
@endprepend
<script type="text/javascript">
  $("#level").prop('disabled', true);

$("select[name='year']").change(function(){
   alert("กรุณาเลือกระดับการศึกษา");
   $("#level").val("");
   $("#level").prop('disabled', false);
    });
$("select[name='level']").change(function(){


    var year = $('#stats').val();
    var level = $('#level').val();
    var token = $("input[name='_token']").val();
    $.ajax({
        url: "<?php echo route('stats-ajax') ?>",
        method: 'POST',
        data: {year:year, _token:token, level:level},
        success: function(data) {
// console.log(data.st1);
// console.log(data.st2);

document.getElementById("st1").innerHTML = data.st1;
document.getElementById("st2").innerHTML = data.st2;
document.getElementById("st3").innerHTML = data.st3;
document.getElementById("st4").innerHTML = data.st4;
document.getElementById("st5").innerHTML = data.st5;
document.getElementById("anvt").innerHTML = data.aws;
        }
    });
});





</script>

@endsection

@section('content_script')
    <!-- iCheck -->


    <script src="{{ URL::to('js/icheck.min.js') }}"></script>
    <!-- Datatables -->
    <script src="{{ URL::to('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::to('js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('js/buttons.flash.min.js') }}"></script>
    <script src="{{ URL::to('js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::to('js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::to('js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ URL::to('js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ URL::to('js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::to('js/responsive.bootstrap.js') }}"></script>
    <script src="{{ URL::to('js/datatables.scroller.min.js') }}"></script>
    <script src="{{ URL::to('js/jszip.min.js') }}"></script>
    <script src="{{ URL::to('js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::to('js/vfs_fonts.js') }}"></script>

    <!-- Datatables -->
    <script>




      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: 'lBfrtip',

              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
@endsection
