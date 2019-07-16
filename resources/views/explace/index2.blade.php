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
			<th>2</th>
			<th>3</th>
      <th>4</th>
      <th>5</th>
      <th>6</th>
      <th>7</th>
      <th>8</th>
      <th>9</th>
      <th>10</th>
      <th>11</th>
       <th>12</th>
       <th>13</th>
        <th>14</th>
			<th width="280px">Action</th>
		</tr>
  </thead>
<tbody>
  <?php $i = 0; ?>
	@foreach ($ex_all as $key => $explaces)
	<tr>
		<td>{{ ++$i }}</td>
		<td>{{ $explaces->hon or 'ไม่พบข้อมูล' }}</td>
		<td>{{ $explaces->pak or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->nikay or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->ex_type or 'ไม่พบข้อมูล' }}</td>
    	<td>{{ $explaces->ex_name or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->ex_code or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->ex_name1 or 'ไม่พบข้อมูล' }}</td>
    	<td>{{ $explaces->ex_tambon or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->ex_amphor or 'ไม่พบข้อมูล' }}</td>
    <td>{{ $explaces->ex_jangwad or 'ไม่พบข้อมูล' }}</td>
       {{--  <td>{{ $explaces->ex_pak_id or 'ไม่พบข้อมูล' }}</td>  --}}
      

        <td>
         @if($explaces->hon == "ส่วนกลาง")
        1
        @elseif($explaces->hon == "หนกลาง")
2
  @elseif($explaces->hon == "หนเหนือ")
3
  @elseif($explaces->hon == "หนตะวันออก")
4
  @elseif($explaces->hon == "หนใต้")
5
  @elseif($explaces->hon == "ธรรมยุต")
6
        @endif
        </td>
        <td>
          
             
        @if($explaces->pak == "ภาค ๑")
        1
        @elseif($explaces->pak == "ภาค ๒")
        2
        @elseif($explaces->pak == "ภาค ๓")
        3
        @elseif($explaces->pak == "ภาค ๔")
        4
        @elseif($explaces->pak == "ภาค ๕")
        5
        @elseif($explaces->pak == "ภาค ๖")
        6
        @elseif($explaces->pak == "ภาค ๗")
        7
        @elseif($explaces->pak == "ภาค ๘")
        8
        @elseif($explaces->pak == "ภาค ๙")
        9
        @elseif($explaces->pak == "ภาค ๑๐")
        10
        @elseif($explaces->pak == "ภาค ๑๑")
        11
        @elseif($explaces->pak == "ภาค ๑๒")
        12
        @elseif($explaces->pak == "ภาค ๑๓")
        13
        @elseif($explaces->pak == "ภาค ๑๔")
        14
        @elseif($explaces->pak == "ภาค ๑๕")
        15
        @elseif($explaces->pak == "ภาค ๑๖")
        16
        @elseif($explaces->pak == "ภาค ๑๗")
        17
        @elseif($explaces->pak == "ภาค ๑๘")
        18
        @elseif($explaces->pak == "ภาค ๑-๒-๓, ๑๒-๑๓")
        19
        @elseif($explaces->pak == "ภาค ๔-๕-๖-๗")
        20
        @elseif($explaces->pak == "ภาค ๑๔-๑๕")
        21
        @elseif($explaces->pak == "ภาค ๑๖-๑๗-๑๘")
        22
        @elseif($explaces->pak == "ส่วนกลาง (กรุงเทพมหานคร)")
        23
        @endif
        
        
        </td>
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
