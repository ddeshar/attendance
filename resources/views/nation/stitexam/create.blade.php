@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>สร้างข้อมูลสถิติการสอบต่างประเทศ
                            <small>Gongtham-nation</small>
                        </h2>
                        <div class="clearfix">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('stitexam.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="x_content">


                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        @if(session()->has('message'))
                            <div class="alert alert-danger">
                                <h2>
                                    {{ session()->get('message') }}
                                </h2>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>Form Basic Elements
                                            <small>different form elements</small>
                                        </h2>
                                        <ul class="nav navbar-right panel_toolbox">
                                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                            </li>
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                                        <p id="demo"></p>
                                        {!! Form::open(array('route' => 'stitexam.store','method'=>'POST', 'class'=>'form-horizontal form-label-left input_mask', 'id'=>'testcheck')) !!}

                                            
                                    
                                            
                                            

                                        <table class="table table-bordered ">

                                            <tbody>
                                            <tr>
                                                <th scope="row">สนามสอบ</th>
                                                <th width="80%">  {!! Form::select('explace',[''=>'--- เลือกสนามสอบ ---']+$explace->toArray() , null,array('class'=>'select2_single2 form-control' , 'tabindex' => '-1')) !!}</th>
                                            </tr>
                                            <tr>
                                                <th scope="row"> ปีการศึกษา</th>
                                                <th>       {!! Form::selectYear('edu_year',  date("Y")+543, 2500 , null,array('class'=>' form-control')) !!}</th>
                                            </tr>
                                            <tr>
                                                <th> บันทึก</th>
                                                <th><input type="text" class="form-control " id="input_disabled_id2"
                                                           placeholder="หมายเหตุ" name="note"></th>

                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-bordered " id="dynamic_field">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ส่งสอบ</th>
                                                <th>ขาดสอบ</th>
                                                <th>คงสอบ</th>
                                                <th>สอบได้</th>
                                                <th>สอบตก</th>
                                                <th>ระดับชั้น</th>

                                                <th>
                                                    {{-- <button type="button" name="add" id="add" class="btn btn-success">เพิ่ม</button> --}}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <?php $w = 0; ?>
                                                <th scope="row">1</th>
                                                <td>{!! Form::text('stit1[]', null ,array('class'=>' form-control inputDisabled stit1s', 'placeholder' => 'ส่งสอบ' , 'disabled', 'id' => 'exam1')) !!}</td>
                                                <td>{!! Form::text('stit2[]', null ,array('class'=>' form-control inputDisabled stit2s', 'placeholder' => 'ขาดสอบ' , 'disabled', 'id' => 'exam2')) !!}</td>
                                                <td>
                                                    <div class="form-group  exam3">
                                                        {!! Form::text('stit3[]', null ,array('class'=>' form-control inputDisabled stit3s', 'placeholder' => 'คงสอบ' , 'readonly' ,'id' => 'exam3' )) !!}

                                                    </div>
                                                </td>
                                                <td>{!! Form::text('stit4[]', null ,array('class'=>' form-control inputDisabled stit4s', 'placeholder' => 'สอบได้' , 'disabled' ,'id' => 'exam4' )) !!}</td>
                                                <td>
                                                    <div class="form-group  exam5">
                                                        {!! Form::text('stit5[]', null ,array('class'=>' form-control inputDisabled stit5s', 'placeholder' => 'สอบตก' , 'readonly' ,'id' => 'exam5')) !!}
                                                    </div>
                                                </td>

                                                <td>      {!! Form::select('level[]',['4'=>'ธรรมศึกษาชั้นตรี'],null ,array('class'=>' form-control inputDisabled' , 'tabindex' => '-1' , 'disabled')) !!}</td>
                                                <td>
                                                    <button type="button" name="remove" id="stit1"
                                                            class="btn btn-danger btn_remove stit1">คลิกเพื่อกรอกข้อมูล
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>{!! Form::text('stit1[]', null ,array('class'=>' form-control inputDisabled2 stit1s', 'placeholder' => 'ส่งสอบ' , 'disabled', 'id' => 'exam1')) !!}</td>
                                                <td>{!! Form::text('stit2[]', null ,array('class'=>' form-control inputDisabled2 stit2s', 'placeholder' => 'ขาดสอบ' , 'disabled', 'id' => 'exam2')) !!}</td>
                                                <td>
                                                    <div class="form-group  exam3">
                                                        {!! Form::text('stit3[]', null ,array('class'=>' form-control inputDisabled2 stit3s', 'placeholder' => 'คงสอบ' , 'readonly' ,'id' => 'exam3' )) !!}

                                                    </div>
                                                </td>
                                                <td>{!! Form::text('stit4[]', null ,array('class'=>' form-control inputDisabled2 stit4s', 'placeholder' => 'สอบได้' , 'disabled' ,'id' => 'exam4' )) !!}</td>
                                                <td>
                                                    <div class="form-group  exam5">
                                                        {!! Form::text('stit5[]', null ,array('class'=>' form-control inputDisabled2 stit5s', 'placeholder' => 'สอบตก' , 'readonly' ,'id' => 'exam5')) !!}
                                                    </div>
                                                </td>
                                                <td>      {!! Form::select('level[]',['5'=>'ธรรมศึกษาชั้นโท'], null ,array('class'=>' form-control inputDisabled2' , 'tabindex' => '-1' , 'disabled')) !!}</td>
                                                <td>
                                                    <button type="button" name="remove" id="stit2"
                                                            class="btn btn-danger btn_remove stit2">คลิกเพื่อกรอกข้อมูล
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>{!! Form::text('stit1[]', null ,array('class'=>' form-control inputDisabled3 stit1s', 'placeholder' => 'ส่งสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit2[]', null ,array('class'=>' form-control inputDisabled3 stit2s', 'placeholder' => 'ขาดสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit3[]', null ,array('class'=>' form-control inputDisabled3 stit3s', 'placeholder' => 'คงสอบ' , 'readonly')) !!}</td>
                                                <td>{!! Form::text('stit4[]', null ,array('class'=>' form-control inputDisabled3 stit4s', 'placeholder' => 'สอบได้' , 'disabled')) !!}</td>
                                                <td> {!! Form::text('stit5[]', null ,array('class'=>' form-control inputDisabled3 stit5s', 'placeholder' => 'สอบตก' , 'readonly')) !!}</td>
                                                <td>      {!! Form::select('level[]',['6'=>'ธรรมศึกษาชั้นเอก'], null ,array('class'=>' form-control inputDisabled3' , 'tabindex' => '-1' , 'disabled')) !!}</td>
                                                <td>
                                                    <button type="button" name="remove" id="stit3"
                                                            class="btn btn-danger btn_remove stit3">คลิกเพื่อกรอกข้อมูล
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>{!! Form::text('stit1[]', null ,array('class'=>' form-control inputDisabled4 stit1s', 'placeholder' => 'ส่งสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit2[]', null ,array('class'=>' form-control inputDisabled4 stit2s', 'placeholder' => 'ขาดสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit3[]', null ,array('class'=>' form-control inputDisabled4 stit3s', 'placeholder' => 'คงสอบ' , 'readonly')) !!}</td>
                                                <td>{!! Form::text('stit4[]', null ,array('class'=>' form-control inputDisabled4 stit4s', 'placeholder' => 'สอบได้' , 'disabled')) !!}</td>
                                                <td> {!! Form::text('stit5[]', null ,array('class'=>' form-control inputDisabled4 stit5s', 'placeholder' => 'สอบตก' , 'readonly')) !!}</td>
                                                <td>      {!! Form::select('level[]',['7'=>'นักธรรมชั้นตรี'], null ,array('class'=>' form-control inputDisabled4' , 'tabindex' => '-1' , 'disabled')) !!}</td>
                                                <td>
                                                    <button type="button" name="remove" id="stit4"
                                                            class="btn btn-danger btn_remove stit4">คลิกเพื่อกรอกข้อมูล
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">5</th>
                                                <td>{!! Form::text('stit1[]', null ,array('class'=>' form-control inputDisabled5 stit1s', 'placeholder' => 'ส่งสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit2[]', null ,array('class'=>' form-control inputDisabled5 stit2s', 'placeholder' => 'ขาดสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit3[]', null ,array('class'=>' form-control inputDisabled5 stit3s', 'placeholder' => 'คงสอบ' , 'readonly')) !!}</td>
                                                <td>{!! Form::text('stit4[]', null ,array('class'=>' form-control inputDisabled5 stit4s', 'placeholder' => 'สอบได้' , 'disabled')) !!}</td>
                                                <td> {!! Form::text('stit5[]', null ,array('class'=>' form-control inputDisabled5 stit5s', 'placeholder' => 'สอบตก' , 'readonly')) !!}</td>
                                                <td>      {!! Form::select('level[]',['8'=>'นักธรรมชั้นโท'], null ,array('class'=>' form-control inputDisabled5' , 'tabindex' => '-1' , 'disabled')) !!}</td>
                                                <td>
                                                    <button type="button" name="remove" id="stit5"
                                                            class="btn btn-danger btn_remove stit5">คลิกเพื่อกรอกข้อมูล
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">6</th>
                                                <td>{!! Form::text('stit1[]', null ,array('class'=>' form-control inputDisabled6 stit1s', 'placeholder' => 'ส่งสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit2[]', null ,array('class'=>' form-control inputDisabled6 stit2s', 'placeholder' => 'ขาดสอบ' , 'disabled')) !!}</td>
                                                <td>{!! Form::text('stit3[]', null ,array('class'=>' form-control inputDisabled6 stit3s', 'placeholder' => 'คงสอบ' , 'readonly')) !!}</td>
                                                <td>{!! Form::text('stit4[]', null ,array('class'=>' form-control inputDisabled6 stit4s', 'placeholder' => 'สอบได้' , 'disabled')) !!}</td>
                                                <td> {!! Form::text('stit5[]', null ,array('class'=>' form-control inputDisabled6 stit5s', 'placeholder' => 'สอบตก' , 'readonly')) !!}</td>
                                                <td>      {!! Form::select('level[]',['9'=>'นักธรรมชั้นเอก'], null ,array('class'=>' form-control inputDisabled6' , 'tabindex' => '-1' , 'disabled')) !!}</td>
                                                <td>
                                                    <button type="button" name="remove" id="stit6"
                                                            class="btn btn-danger btn_remove stit6">คลิกเพื่อกรอกข้อมูล
                                                    </button>
                                                </td>
                                            </tr>


                                            </tbody>
                                        </table>


                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-7 col-sm-8 col-xs-12 col-md-offset-4">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                                <button type="reset" class="btn btn-primary">Cancel</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <script type="text/javascript">

                    (function () {
$('table tbody tr td ').find("#taptest").each(function(index) {
    $(this).attr('tabindex', index)
})
// $('td').click(function() {
//     var col = $(this).index(),
//     row = $(this).parent().index();
//     row[1];
//   console.log("row index:" + row + ", col index :" + col);
// })$(":input").each(function (i) { $(this).attr('tabindex', i + 1); });
$("td:eq(0)").each(function (i) { $(this).find(".stit1s").attr('tabindex', i + 1); })
                        $("table").on("change", "input", function () {
                            var row = $(this).closest("tr");
                            var a = parseFloat(row.find(".stit1s").val());
                            var b = parseFloat(row.find(".stit2s").val());
                            
                            var total = a - b;
                            var c = parseFloat(row.find(".stit4s").val());
                            var total2 = total - c;
                   
                            
                        
                            if (total < 0) {
                                alert("จำนวนขาดสอบ มากกว่าจำนวนส่งสอบ กรุณาใส่ข้อมูลใหม่");
                  
                                row.find(".stit3s").val(isNaN(total) ? "" : total);
                           
                                $(this).closest('tr').find('td:eq(2)').addClass('has-error');
                                $(this).closest('tr').find('td:eq(2)').removeClass('has-success');
                                $(this).closest('tr').find('td:eq(1)').find(".stit2s").focus();
                                // this.rowIndex.removeClass('has-success');
                            
                            
                                // $('.exam3').addClass('has-error');
                                // $('.exam3').removeClass('has-success');
                            } else {
                                row.find(".stit3s").val(isNaN(total) ? "" : total);
                                $(this).closest('tr').find('td:eq(2)').addClass('has-success');
                                $(this).closest('tr').find('td:eq(2)').removeClass('has-error');
                                // row.addClass('has-success');
                                // row.removeClass('has-error');
                            }
                            if (total2 < 0) {
                                alert("จำนวนสอบได้ มากกว่าจำนวนคงสอบ กรุณาใส่ข้อมูลใหม่");
                                row.find(".stit5s").val(isNaN(total2) ? "" : total2);
                                $(this).closest('tr').find('td:eq(4)').addClass('has-error');
                                $(this).closest('tr').find('td:eq(4)').removeClass('has-success');
                                // row.addClass('has-error');
                                // row.removeClass('has-success');
                              

                            } else {
                                row.find(".stit5s").val(isNaN(total2) ? "" : total2);
                                $(this).closest('tr').find('td:eq(4)').addClass('has-success');
                                $(this).closest('tr').find('td:eq(4)').removeClass('has-error');
                            //   row.addClass('has-success');
                            //   row.removeClass('has-error');

                            }
                            if(total == 0){
                                {{-- alert("ขาดสอบทั้งหมด"); --}}
                                row.find(".stit4s").val(isNaN(total) ? "" : total);
                                row.find(".stit5s").val(isNaN(total) ? "" : total);
                            }
                        }
                        
                    );

                    })();

                    $('#stit1').click(function () {
                        $('.inputDisabled').attr('disabled', !$(".inputDisabled").attr('disabled'));
                    });

                    $('#stit2').click(function () {
                        $('.inputDisabled2').attr('disabled', !$(".inputDisabled2").attr('disabled'));
                    });
                    $('#stit3').click(function () {
                        $('.inputDisabled3').attr('disabled', !$(".inputDisabled3").attr('disabled'));
                    });
                    $('#stit4').click(function () {
                        $('.inputDisabled4').attr('disabled', !$(".inputDisabled4").attr('disabled'));
                    });
                    $('#stit5').click(function () {
                        $('.inputDisabled5').attr('disabled', !$(".inputDisabled5").attr('disabled'));
                    });
                    $('#stit6').click(function () {
                        $('.inputDisabled6').attr('disabled', !$(".inputDisabled6").attr('disabled'));
                    });


                    $(document).ready(function () {
                        var i = 1;
                        $('#add').click(function () {
                            i++;
                            $('#dynamic_field').append('<tr id="row' + i + '">' +
                                '<th scope="row">' + i + '</th>' +
                                '<td>{!! Form::text('stit1[]', null ,array('class'=>' form-control', 'placeholder' => 'ส่งสอบ')) !!}</td>' +
                                '<td>{!! Form::text('stit2[]', null ,array('class'=>' form-control', 'placeholder' => 'ขาดสอบ')) !!}</td>' +
                                '<td>{!! Form::text('stit3[]', null ,array('class'=>' form-control', 'placeholder' => 'คงสอบ' , 'disabled' )) !!}</td>' +
                                '<td>{!! Form::text('stit4[]', null ,array('class'=>' form-control', 'placeholder' => 'สอบได้')) !!}</td>' +
                                '<td>{!! Form::text('stit5[]', null ,array('class'=>' form-control', 'placeholder' => 'สอบตก', 'disabled')) !!}</td>' +
                                '<td> {!! Form::select('level[]',[''=>'--- เลือกระดับการศึกษา ---']+$level->toArray(), null ,array('class'=>' form-control' , 'tabindex' => '-1')) !!}</td>' +
                                '<td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

                        });
                        $(document).on('click', '.btn_remove', function () {
                            var button_id = $(this).attr("id");
                            $('#row' + button_id + '').remove();
                            i--;
                        });
                        $('#submit').click(function () {
                            $.ajax({
                                url: "name.php",
                                method: "POST",
                                data: $('#add_name').serialize(),
                                success: function (data) {
                                    alert(data);
                                    $('#add_name')[0].reset();
                                }
                            });
                        });
                    });


                </script>


            @endsection
            @section('content_script')
                <!-- bootstrap-progressbar -->
                    <script src="{{ URL::to('shantu/js/bootstrap-progressbar.min.js') }}"></script>
                    <!-- iCheck -->
                    <script src="{{ URL::to('shantu/js/icheck.min.js') }}"></script>
                    <!-- bootstrap-daterangepicker -->
                    <script src="{{ URL::to('shantu/js/moment.min.js') }}"></script>
                    <script src="{{ URL::to('shantu/js/daterangepicker.js') }}"></script>
                    <!-- bootstrap-wysiwyg -->
                    <script src="{{ URL::to('shantu/js/bootstrap-wysiwyg.min.js') }}"></script>
                    <script src="{{ URL::to('shantu/js/jquery.hotkeys.js') }}"></script>
                    <script src="{{ URL::to('shantu/js/prettify.js') }}"></script>
                    <!-- jQuery Tags Input -->
                    <script src="{{ URL::to('shantu/js/jquery.tagsinput.js') }}"></script>
                    <!-- Switchery -->
                    <script src="{{ URL::to('shantu/js/switchery.min.js') }}"></script>
                    <!-- Select2 -->
                    <script src="{{ URL::to('shantu/js/select2.full.min.js') }}"></script>
                    <!-- Parsley -->
                {{-- <script src="{{ URL::to('shantu/js/parsley.min.js') }}"></script> --}}
                <!-- Autosize -->
                    <script src="{{ URL::to('shantu/js/autosize.min.js') }}"></script>
                    <!-- jQuery autocomplete -->
                    <script src="{{ URL::to('shantu/js/jquery.autocomplete.min.js') }}"></script>
                    <!-- starrr -->
                    <script src="{{ URL::to('shantu/js/starrr.js') }}"></script>

                    <!-- bootstrap-daterangepicker -->
                    <script>
                        $(document).ready(function () {
                            $('#birthday').daterangepicker({
                                singleDatePicker: true,
                                calender_style: "picker_4"
                            }, function (start, end, label) {
                                console.log(start.toISOString(), end.toISOString(), label);
                            });
                        });
                    </script>
                    <!-- /bootstrap-daterangepicker -->

                    <!-- bootstrap-wysiwyg -->
                    <script>
                        $(document).ready(function () {
                            function initToolbarBootstrapBindings() {
                                var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                                        'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                                        'Times New Roman', 'Verdana'
                                    ],
                                    fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                                $.each(fonts, function (idx, fontName) {
                                    fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                                });
                                $('a[title]').tooltip({
                                    container: 'body'
                                });
                                $('.dropdown-menu input').click(function () {
                                    return false;
                                })
                                    .change(function () {
                                        $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                                    })
                                    .keydown('esc', function () {
                                        this.value = '';
                                        $(this).change();
                                    });

                                $('[data-role=magic-overlay]').each(function () {
                                    var overlay = $(this),
                                        target = $(overlay.data('target'));
                                    overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                                });

                                if ("onwebkitspeechchange" in document.createElement("input")) {
                                    var editorOffset = $('#editor').offset();

                                    $('.voiceBtn').css('position', 'absolute').offset({
                                        top: editorOffset.top,
                                        left: editorOffset.left + $('#editor').innerWidth() - 35
                                    });
                                } else {
                                    $('.voiceBtn').hide();
                                }
                            }

                            function showErrorAlert(reason, detail) {
                                var msg = '';
                                if (reason === 'unsupported-file-type') {
                                    msg = "Unsupported format " + detail;
                                } else {
                                    console.log("error uploading file", reason, detail);
                                }
                                $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
                            }

                            initToolbarBootstrapBindings();

                            $('#editor').wysiwyg({
                                fileUploadError: showErrorAlert
                            });

                            window.prettyPrint;
                            prettyPrint();
                        });
                    </script>
                    <!-- /bootstrap-wysiwyg -->

                    <!-- Select2 -->
                    <script>
                        $(document).ready(function () {
                            $(".select2_single").select2({
                                placeholder: "เลือกประเทศ",
                                allowClear: true
                            });
                            $(".select2_single2").select2({
                                placeholder: "เลือกสนามสอบ",
                                allowClear: true
                            });
                            $(".select2_group").select2({});
                            $(".select2_multiple").select2({
                                maximumSelectionLength: 4,
                                placeholder: "With Max Selection limit 4",
                                allowClear: true
                            });
                        });
                    </script>
                    <!-- /Select2 -->

                    <!-- jQuery Tags Input -->
                    <script>
                        function onAddTag(tag) {
                            alert("Added a tag: " + tag);
                        }

                        function onRemoveTag(tag) {
                            alert("Removed a tag: " + tag);
                        }

                        function onChangeTag(input, tag) {
                            alert("Changed a tag: " + tag);
                        }

                        $(document).ready(function () {
                            $('#tags_1').tagsInput({
                                width: 'auto'
                            });
                        });
                    </script>
                    <!-- /jQuery Tags Input -->

                {{-- <!-- Parsley -->
                <script>
                  $(document).ready(function() {
                    $.listen('parsley:field:validate', function() {
                      validateFront();
                    });
                    $('#demo-form .btn').on('click', function() {
                      $('#demo-form').parsley().validate();
                      validateFront();
                    });
                    var validateFront = function() {
                      if (true === $('#demo-form').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                      } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                      }
                    };
                  });

                  $(document).ready(function() {
                    $.listen('parsley:field:validate', function() {
                      validateFront();
                    });
                    $('#demo-form2 .btn').on('click', function() {
                      $('#demo-form2').parsley().validate();
                      validateFront();
                    });
                    var validateFront = function() {
                      if (true === $('#demo-form2').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                      } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                      }
                    };
                  });
                  try {
                    hljs.initHighlightingOnLoad();
                  } catch (err) {}
                </script>
                <!-- /Parsley -->

                <!-- Autosize -->
                <script>
                  $(document).ready(function() {
                    autosize($('.resizable_textarea'));
                  });
                </script>
                <!-- /Autosize --> --}}

                <!-- jQuery autocomplete -->
                    <script>
                        $(document).ready(function () {
                            var countries = {
                                AD: "Andorra",
                                A2: "Andorra Test",
                                AE: "United Arab Emirates",
                                AF: "Afghanistan",
                                AG: "Antigua and Barbuda",
                                AI: "Anguilla",
                                AL: "Albania",
                                AM: "Armenia",
                                AN: "Netherlands Antilles",
                                AO: "Angola",
                                AQ: "Antarctica",
                                AR: "Argentina",
                                AS: "American Samoa",
                                AT: "Austria",
                                AU: "Australia",
                                AW: "Aruba",
                                AX: "Åland Islands",
                                AZ: "Azerbaijan",
                                BA: "Bosnia and Herzegovina",
                                BB: "Barbados",
                                BD: "Bangladesh",
                                BE: "Belgium",
                                BF: "Burkina Faso",
                                BG: "Bulgaria",
                                BH: "Bahrain",
                                BI: "Burundi",
                                BJ: "Benin",
                                BL: "Saint Barthélemy",
                                BM: "Bermuda",
                                BN: "Brunei",
                                BO: "Bolivia",
                                BQ: "British Antarctic Territory",
                                BR: "Brazil",
                                BS: "Bahamas",
                                BT: "Bhutan",
                                BV: "Bouvet Island",
                                BW: "Botswana",
                                BY: "Belarus",
                                BZ: "Belize",
                                CA: "Canada",
                                CC: "Cocos [Keeling] Islands",
                                CD: "Congo - Kinshasa",
                                CF: "Central African Republic",
                                CG: "Congo - Brazzaville",
                                CH: "Switzerland",
                                CI: "Côte d’Ivoire",
                                CK: "Cook Islands",
                                CL: "Chile",
                                CM: "Cameroon",
                                CN: "China",
                                CO: "Colombia",
                                CR: "Costa Rica",
                                CS: "Serbia and Montenegro",
                                CT: "Canton and Enderbury Islands",
                                CU: "Cuba",
                                CV: "Cape Verde",
                                CX: "Christmas Island",
                                CY: "Cyprus",
                                CZ: "Czech Republic",
                                DD: "East Germany",
                                DE: "Germany",
                                DJ: "Djibouti",
                                DK: "Denmark",
                                DM: "Dominica",
                                DO: "Dominican Republic",
                                DZ: "Algeria",
                                EC: "Ecuador",
                                EE: "Estonia",
                                EG: "Egypt",
                                EH: "Western Sahara",
                                ER: "Eritrea",
                                ES: "Spain",
                                ET: "Ethiopia",
                                FI: "Finland",
                                FJ: "Fiji",
                                FK: "Falkland Islands",
                                FM: "Micronesia",
                                FO: "Faroe Islands",
                                FQ: "French Southern and Antarctic Territories",
                                FR: "France",
                                FX: "Metropolitan France",
                                GA: "Gabon",
                                GB: "United Kingdom",
                                GD: "Grenada",
                                GE: "Georgia",
                                GF: "French Guiana",
                                GG: "Guernsey",
                                GH: "Ghana",
                                GI: "Gibraltar",
                                GL: "Greenland",
                                GM: "Gambia",
                                GN: "Guinea",
                                GP: "Guadeloupe",
                                GQ: "Equatorial Guinea",
                                GR: "Greece",
                                GS: "South Georgia and the South Sandwich Islands",
                                GT: "Guatemala",
                                GU: "Guam",
                                GW: "Guinea-Bissau",
                                GY: "Guyana",
                                HK: "Hong Kong SAR China",
                                HM: "Heard Island and McDonald Islands",
                                HN: "Honduras",
                                HR: "Croatia",
                                HT: "Haiti",
                                HU: "Hungary",
                                ID: "Indonesia",
                                IE: "Ireland",
                                IL: "Israel",
                                IM: "Isle of Man",
                                IN: "India",
                                IO: "British Indian Ocean Territory",
                                IQ: "Iraq",
                                IR: "Iran",
                                IS: "Iceland",
                                IT: "Italy",
                                JE: "Jersey",
                                JM: "Jamaica",
                                JO: "Jordan",
                                JP: "Japan",
                                JT: "Johnston Island",
                                KE: "Kenya",
                                KG: "Kyrgyzstan",
                                KH: "Cambodia",
                                KI: "Kiribati",
                                KM: "Comoros",
                                KN: "Saint Kitts and Nevis",
                                KP: "North Korea",
                                KR: "South Korea",
                                KW: "Kuwait",
                                KY: "Cayman Islands",
                                KZ: "Kazakhstan",
                                LA: "Laos",
                                LB: "Lebanon",
                                LC: "Saint Lucia",
                                LI: "Liechtenstein",
                                LK: "Sri Lanka",
                                LR: "Liberia",
                                LS: "Lesotho",
                                LT: "Lithuania",
                                LU: "Luxembourg",
                                LV: "Latvia",
                                LY: "Libya",
                                MA: "Morocco",
                                MC: "Monaco",
                                MD: "Moldova",
                                ME: "Montenegro",
                                MF: "Saint Martin",
                                MG: "Madagascar",
                                MH: "Marshall Islands",
                                MI: "Midway Islands",
                                MK: "Macedonia",
                                ML: "Mali",
                                MM: "Myanmar [Burma]",
                                MN: "Mongolia",
                                MO: "Macau SAR China",
                                MP: "Northern Mariana Islands",
                                MQ: "Martinique",
                                MR: "Mauritania",
                                MS: "Montserrat",
                                MT: "Malta",
                                MU: "Mauritius",
                                MV: "Maldives",
                                MW: "Malawi",
                                MX: "Mexico",
                                MY: "Malaysia",
                                MZ: "Mozambique",
                                NA: "Namibia",
                                NC: "New Caledonia",
                                NE: "Niger",
                                NF: "Norfolk Island",
                                NG: "Nigeria",
                                NI: "Nicaragua",
                                NL: "Netherlands",
                                NO: "Norway",
                                NP: "Nepal",
                                NQ: "Dronning Maud Land",
                                NR: "Nauru",
                                NT: "Neutral Zone",
                                NU: "Niue",
                                NZ: "New Zealand",
                                OM: "Oman",
                                PA: "Panama",
                                PC: "Pacific Islands Trust Territory",
                                PE: "Peru",
                                PF: "French Polynesia",
                                PG: "Papua New Guinea",
                                PH: "Philippines",
                                PK: "Pakistan",
                                PL: "Poland",
                                PM: "Saint Pierre and Miquelon",
                                PN: "Pitcairn Islands",
                                PR: "Puerto Rico",
                                PS: "Palestinian Territories",
                                PT: "Portugal",
                                PU: "U.S. Miscellaneous Pacific Islands",
                                PW: "Palau",
                                PY: "Paraguay",
                                PZ: "Panama Canal Zone",
                                QA: "Qatar",
                                RE: "Réunion",
                                RO: "Romania",
                                RS: "Serbia",
                                RU: "Russia",
                                RW: "Rwanda",
                                SA: "Saudi Arabia",
                                SB: "Solomon Islands",
                                SC: "Seychelles",
                                SD: "Sudan",
                                SE: "Sweden",
                                SG: "Singapore",
                                SH: "Saint Helena",
                                SI: "Slovenia",
                                SJ: "Svalbard and Jan Mayen",
                                SK: "Slovakia",
                                SL: "Sierra Leone",
                                SM: "San Marino",
                                SN: "Senegal",
                                SO: "Somalia",
                                SR: "Suriname",
                                ST: "São Tomé and Príncipe",
                                SU: "Union of Soviet Socialist Republics",
                                SV: "El Salvador",
                                SY: "Syria",
                                SZ: "Swaziland",
                                TC: "Turks and Caicos Islands",
                                TD: "Chad",
                                TF: "French Southern Territories",
                                TG: "Togo",
                                TH: "Thailand",
                                TJ: "Tajikistan",
                                TK: "Tokelau",
                                TL: "Timor-Leste",
                                TM: "Turkmenistan",
                                TN: "Tunisia",
                                TO: "Tonga",
                                TR: "Turkey",
                                TT: "Trinidad and Tobago",
                                TV: "Tuvalu",
                                TW: "Taiwan",
                                TZ: "Tanzania",
                                UA: "Ukraine",
                                UG: "Uganda",
                                UM: "U.S. Minor Outlying Islands",
                                US: "United States",
                                UY: "Uruguay",
                                UZ: "Uzbekistan",
                                VA: "Vatican City",
                                VC: "Saint Vincent and the Grenadines",
                                VD: "North Vietnam",
                                VE: "Venezuela",
                                VG: "British Virgin Islands",
                                VI: "U.S. Virgin Islands",
                                VN: "Vietnam",
                                VU: "Vanuatu",
                                WF: "Wallis and Futuna",
                                WK: "Wake Island",
                                WS: "Samoa",
                                YD: "People's Democratic Republic of Yemen",
                                YE: "Yemen",
                                YT: "Mayotte",
                                ZA: "South Africa",
                                ZM: "Zambia",
                                ZW: "Zimbabwe",
                                ZZ: "Unknown or Invalid Region"
                            };

                            var countriesArray = $.map(countries, function (value, key) {
                                return {
                                    value: value,
                                    data: key
                                };
                            });

                            // initialize autocomplete with custom appendTo
                            $('#autocomplete-custom-append').autocomplete({
                                lookup: countriesArray
                            });
                        });
                    </script>
                    <!-- /jQuery autocomplete -->

                    <!-- Starrr -->
                    <script>
                        $(document).ready(function () {
                            $(".stars").starrr();

                            $('.stars-existing').starrr({
                                rating: 4
                            });

                            $('.stars').on('starrr:change', function (e, value) {
                                $('.stars-count').html(value);
                            });

                            $('.stars-existing').on('starrr:change', function (e, value) {
                                $('.stars-count-existing').html(value);
                            });
                        });
                    </script>
                    <!-- /Starrr -->
@endsection
