@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="panel-heading">
                        <h1 class="text-center">สถิติสนามสอบ(ต่างประเทศ) <small></small></h1>
                    </div>
                </div>
              </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h4>เลือกปีการศึกษา <span class="label label-default"></span></h4>
                        {!! Form::selectYear('year',  (date('Y')) + 543, 2460, null  ,array('class'=>' form-control', 'id' => 'stats',  'placeholder' => '--- เลือกปีการศึกษา ---')) !!}
                    {{-- 
                        <h2>สนามสอบ <small>Explace</small></h2>
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
                 	       <a class="btn btn-primary" href="{{ route('explace.create') }}"> สร้างข้อมูลสนามสอบ</a>
                 	            @endcan
                 	        </div></div>
                   --}}
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

				<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
		<tr>
			<th>No</th>
			<th>ชื่อสนามสอบไทย</th>
			<th>ชื่อสนามสอบอังกฤษ</th>
      <th>ประเทศสนามสอบ ไทย</th>
      <th>ประเทศสนามสอบ อังกฤษ</th>
			<th width="280px">จัดการ</th>
		</tr>
  </thead>
<tbody>
  <?php $i = 0; ?>
	@foreach ($explace as $key => $explaces)
	<tr>
		<td>{{ ++$i }}</td>
		<td><a href="{{ route('explace2.show',$explaces->id) }}"> {{ $explaces->th_explace ?? 'ไม่พบข้อมูล' }}</a></td>
		<td>{{ $explaces->en_explace ?? 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->countrys->th_country ?? 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->countrys->en_country ?? 'ไม่พบข้อมูล' }}</td>
		<td>
			<a class="btn btn-primary" href="{{ route('explace2.show',$explaces->id) }}">ดูสถิติสนามสอบนี้</a>
			@can('role-edit')
			<a class="btn btn-warning" href="{{ route('explace.edit',$explaces->id) }}">Edit</a>
			@endcan

			@can('role-delete')
			{!! Form::open(['method' => 'DELETE','route' => ['explace.destroy', $explaces->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
        	@endcan

		</td>
	</tr>
	@endforeach
</tbody>
	</table>
</div>
</div>
</div>
</div>    </div>



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
               { extend: 'copy',
                text: 'คัดลอกข้อมูล'},    { extend: 'csv',
                text: 'FileExcel'}, { extend: 'excel',
                text: 'FileExcel'}, { extend: 'pdf',
                text: 'FilePDF'}, { extend: 'print',
                text: 'พิมพ์ข้อมูล'}
              ],
              "pageLength": 50,
              
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

   

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
@endsection
