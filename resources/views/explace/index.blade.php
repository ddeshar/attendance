@extends('template.master')

@section('content')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
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
                 	        	@permission('role-create')
                 	       <a class="btn btn-primary" href="{{ route('explace.create') }}"> สร้างข้อมูลสนามสอบ</a>
                 	            @endpermission
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

				<table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>
		<tr>
			<th>No</th>
			<th>หน</th>
			<th>ภาค</th>
        <th>ประเภทสนาม</th>
      <th>นิกาย</th>

      <th>สำนักเรียน</th>
      		<th>รหัสสนาม</th>
      <th>ชื่อสนาม</th>
      <th>ตำบล</th>
           <th>อำเภอ</th>
      <th>จังหวัด</th>
			<th width="280px">Action</th>
		</tr>
  </thead>
<tbody>
  <?php $i = 0; ?>
	@foreach ($ex_all as $key => $explaces)
	<tr>
		<td>{{ ++$i }}</td>
	
		<td>{{ $explaces->hons->hon_name or 'ไม่พบข้อมูล' }}</td>
    	<td>{{ $explaces->paks->pak_name or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->explace_type or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->nikay_type or 'ไม่พบข้อมูล' }}</td>
        <td>{{ $explaces->ex_school or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->explace_code or 'ไม่พบข้อมูล' }}</td>
        <td>{{ $explaces->explace_name or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->tambon_ex or 'ไม่พบข้อมูล' }}</td>
        <td>{{ $explaces->amphor_ex or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->jangwat_ex or 'ไม่พบข้อมูล' }}</td>
		<td>
			<a class="btn btn-info" href="{{ route('explace.show',$explaces->id) }}">Show</a>
			@permission('role-edit')
			<a class="btn btn-primary" href="{{ route('explace.edit',$explaces->id) }}">Edit</a>
			@endpermission

			@permission('role-delete')
			{!! Form::open(['method' => 'DELETE','route' => ['explace.destroy', $explaces->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
        	{!! Form::close() !!}
        	@endpermission

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
              dom: "Bfrtip",

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
