@extends('layouts.app')

@section('content')

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>ข้อมูลสนามสอบ
                            <small>Explaces</small>
                        </h2>
                        <div class="clearfix">
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('explace2.index') }}"> กลับ</a>
                            </div>
                        </div>

                    </div>
                    <div class="x_content">


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    {{-- <h2>Daily active users <small>Sessions</small></h2> --}}
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

                                    <div class="bs-example" data-example-id="simple-jumbotron">
                                        <div class="jumbotron">
                                            <?php $last = date('Y') + 543 ?>
                                            <?php $now = (date('Y') + 543) - 5 ?>

                                            <h1>{{ $explaces->th_explace }}
                                                <small>ประเทศ{{ $explaces->countrys->th_country }}</small> 
                                                {{-- {{ $last }} --}}
                                            </h1>
                                            <p>{{ $explaces->en_explace }}
                                                <small>{{ $explaces->countrys->en_country }}.
                                            </p>


                                            {{-- {!! Form::selectYear('year',  2560, 2555 ,  null ,array('class'=>' form-control')) !!} --}}


                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        @if($ee->count())


                            @foreach ($ee as $key => $value)
                                {{-- @for ($i = $last; $i > $now; $i--) --}}


                                <div class="col-md-12">
                                    <div class="x_panel">
                                        <div class="x_title">


                                            <h2>สถิติประจำปี {{ $key }}
                                                <small> Stats at Year</small>
                                            </h2>
                                            <ul class="nav navbar-right panel_toolbox">
                                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                </li>
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                       role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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


                                            {{-- @for ($x=0; $x<=5; $x++) --}}


                                            @foreach ($value->sortBy('id_level') as $tt => $vas)

                                                <div class="col-md-4">
                                                    <div class="x_panel">
                                                        <div class="x_title">

                                                            <h2 class="text-center">สถิติประจำปี
                                                                {{-- @if($x == 0)
                                                               ธรรมศึกษาชั้นตรี
                                                             @elseif($x == 1)
                                                               ธรรมศึกษาชั้นโท
                                                             @elseif($x == 2)
                                                               ธรรมศึกษาชั้นเอก
                                                             @elseif($x == 3)
                                                               นักธรรมชั้นตรี
                                                             @elseif($x == 4)
                                                               นักธรรมชั้นโท
                                                             @elseif($x == 5)
                                                               นักธรรมชั้นเอก
                                                             @endif  --}}
                                                             {{ $vas->edu_year }}
                                                                {{ $vas->level->th_level }}

                                                            </h2>
                                                            <ul class="nav navbar-right panel_toolbox">
                                                                <li><a class="collapse-link"><i
                                                                                class="fa fa-chevron-up"></i></a>
                                                                </li>
                                                                {{-- <li class="dropdown">
                                                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                                                  <ul class="dropdown-menu" role="menu">
                                                                    <li><a href="#">Settings 1</a>
                                                                    </li>
                                                                    <li><a href="#">Settings 2</a>
                                                                    </li>
                                                                  </ul>
                                                                </li> --}}
                                                                <li><a class="close-link"><i
                                                                                class="fa fa-close"></i></a>
                                                                </li>
                                                            </ul>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                        <div class="x_content">
                                                         

                                                          
                                                          <div class="table-responsive">
                                                              <table class="table table-hover table-bordered text-center">
                                                                  <thead>
                                                                      <tr >
                                                                          <th class="text-center">ส่งสอบ</th>
                                                                          <th class="text-center">ขาดสอบ</th>
                                                                          <th class="text-center">คงเหลือ</th>
                                                                          <th class="text-center">สอบได้</th>
                                                                          <th class="text-center">สอบตก</th>
                                                                      </tr>
                                                                  </thead>
                                                                  <tbody>
                                                                      <tr>
                                                                          <td>{{ $vas->stit1 }}</td>
                                                                          <td>{{ $vas->stit2 }}</td>
                                                                          <td>{{ $vas->stit3 }}</td>
                                                                          <td>{{ $vas->stit4 }}</td>
                                                                          <td>{{ $vas->stit5 }}</td>
                                                                      </tr>
                                                                  </tbody>
                                                              </table>
                                                          </div>
                                                          
                                                          {{--   
                                                          <a class="btn btn-large btn-block btn-primary" href="{{ route('stitexam.edit',$vas->id) }}" role="button">แก้ไข</a>
                                                          
                                                          
                                                          
                                                  {{ $vas->stitexam->stit1 }}  --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{-- @endfor --}}


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">
                                <h1>ยังไม่มีข้อมูลสถิติ</h1>
                            </div>
                        @endif
                        {{-- @endfor --}}

                    </div>
                </div>
            </div>
        </div>
    </div></div>
@endsection
