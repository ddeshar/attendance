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
                                {{-- <ul class="nav navbar-right panel_toolbox">
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
                                </ul> --}}
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="bs-example" data-example-id="simple-jumbotron">
                                    <div class="jumbotron">
                                        <div align="center">
                                            <img class="img-responsive img-rounded" width="250" src="{{ asset("png250px/{$explaces->countrys->en_abbrev}") }}"></div>
                                        <?php $last = date('Y') + 543 ?>
                                        <?php $now = (date('Y') + 543) - 5 ?>

                                        <h2 class="text-center">{{ $explaces->th_explace }}
                                            ประเทศ{{ $explaces->countrys->th_country }}
                                            {{-- {{ $last }} --}}

                                        </h2>

                                        <h2 class="text-center">{{ $explaces->en_explace }}
                                            {{ $explaces->countrys->en_country }}
                                        </h2>


                                        {{-- {!! Form::selectYear('year', 2560, 2555 , null ,array('class'=>'
                                        form-control')) !!} --}}


                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    @if($ee->count() >0)


                    @foreach ($ee as $key => $value)



                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">


                                <h2>สถิติประจำปี {{ $key }}
                                    <small> Stats at Year</small>
                                </h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    {{-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li> --}}
                                    {{-- <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    {{-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li> --}}
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">




                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <h2 class="text-center">ธรรมศึกษา</h2>
                                        <div class="x_title">


                                            <div class="x_content">
                                                <div class="table-responsive">
                                                    <h4>
                                                        <table class="table table-hover table-bordered text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">ระดับชั้น</th>
                                                                    <th class="text-center">ส่งสอบ</th>
                                                                    <th class="text-center">ขาดสอบ</th>
                                                                    <th class="text-center">คงเหลือ</th>
                                                                    <th class="text-center">สอบได้</th>
                                                                    <th class="text-center">
                                                                        <is class="danger text-center">สอบตก</is>
                                                                    </th>
                                                                    <th class="text-center">สอบได้
                                                                            %</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-center">ตรี</td>
                                                                        @if(count($value->whereIn('id_level', [4])) >
                                                                        0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level', [4])->sum('stit4')
                                                                    == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else

                                                                    <td> <storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [4])->sum('stit4')*100 /
                                                                            $value->whereIn('id_level',
                                                                            [4])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif

                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">โท</th>
                                                                    @if(count($value->whereIn('id_level', [5])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [5])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [5])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [5])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [5])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [5])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level', [5])->sum('stit4')
                                                                    == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td> <storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [5])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [5])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">เอก</th>
                                                                    @if(count($value->whereIn('id_level', [6])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [6])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [6])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [6])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [6])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [6])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level', [6])->sum('stit4')
                                                                    == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td> <storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [6])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [6])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">รวมทั้งสิ้น</th>
                                                                    @if(count($value->whereIn('id_level', [4,5,6])) >
                                                                    0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,5,6])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,5,6])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,5,6])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4,5,6])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4,5,6])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level',
                                                                    [4,5,6])->sum('stit4') == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td> <storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [4,5,6])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [4,5,6])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <h2 class="text-center">นักธรรม</h2>
                                        <div class="x_title">

                                            <div class="x_content">
                                                <div class="table-responsive">
                                                    <h4>
                                                        <table class="table table-hover table-bordered text-center">
                                                            <thead>

                                                                <tr>
                                                                    <th class="text-center">ระดับชั้น</th>
                                                                    <th class="text-center">ส่งสอบ</th>
                                                                    <th class="text-center">ขาดสอบ</th>
                                                                    <th class="text-center">คงเหลือ</th>
                                                                    <th class="text-center">สอบได้</th>
                                                                    <th class="text-center">สอบตก</th>
                                                                    <th class="text-center">สอบได้
                                                                            %</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-center">ตรี</th>
                                                                    @if(count($value->whereIn('id_level', [7])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [7])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [7])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [7])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [7])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [7])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level', [7])->sum('stit4')
                                                                    == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [7])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [7])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">โท</th>
                                                                    @if(count($value->whereIn('id_level', [8])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [8])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [8])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [8])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [8])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [8])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level', [8])->sum('stit4')
                                                                    == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [8])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [8])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">เอก</th>
                                                                    @if(count($value->whereIn('id_level', [9])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [9])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [9])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [9])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [9])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [9])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level', [9])->sum('stit4')
                                                                    == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [9])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [9])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">รวมทั้งสิ้น</th>
                                                                    @if(count($value->whereIn('id_level', [7,8,9])) >
                                                                    0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [7,8,9])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [7,8,9])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [7,8,9])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [7,8,9])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [7,8,9])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level',
                                                                    [7,8,9])->sum('stit4') == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [7,8,9])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [7,8,9])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <h2 class="text-center">นักธรรม-ธรรมศึกษา </h2>
                                        <div class="x_title">

                                            <div class="x_content">
                                                <div class="table-responsive">
                                                    <h4>
                                                        <table class="table table-hover table-bordered text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">ระดับชั้น</th>
                                                                    <th class="text-center">ส่งสอบ</th>
                                                                    <th class="text-center">ขาดสอบ</th>
                                                                    <th class="text-center">คงเหลือ</th>
                                                                    <th class="text-center">สอบได้</th>
                                                                    <th class="text-center">สอบตก</th>
                                                                    <th class="text-center">สอบได้
                                                                            %</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th class="text-center">ตรี</th>
                                                                    @if(count($value->whereIn('id_level', [4,7])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,7])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,7])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,7])->sum('stit3') }}</td>
                                                                    <td class=""><storngs class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4,7])->sum('stit4') }}</storngs></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4,7])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level',
                                                                    [4,7])->sum('stit4') == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [4,7])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [4,7])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">โท</th>
                                                                    @if(count($value->whereIn('id_level', [5,8])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [5,8])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [5,8])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [5,8])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [5,8])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [5,8])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level',
                                                                    [5,8])->sum('stit4') == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [5,8])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [5,8])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">เอก</th>
                                                                    @if(count($value->whereIn('id_level', [6,9])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [6,9])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [6,9])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [6,9])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [6,9])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [6,9])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level',
                                                                    [6,9])->sum('stit4') == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [6,9])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [6,9])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูลส่งสอบ</td>
                                                                    @endif
                                                                </tr>
                                                                <tr>
                                                                    <th class="text-center">รวมทั้งสิ้น</th>
                                                                    @if(count($value->whereIn('id_level',
                                                                    [4,5,6,7,8,9])) > 0)
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,5,6,7,8,9])->sum('stit1') }} </td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,5,6,7,8,9])->sum('stit2') }}</td>
                                                                    <td class="">{{ $value->whereIn('id_level',
                                                                        [4,5,6,7,8,9])->sum('stit3') }}</td>
                                                                    <td class=""><storng class="success text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4,5,6,7,8,9])->sum('stit4') }}</storng></td>
                                                                    <td class=""><storng class="danger text-center">{{
                                                                            $value->whereIn('id_level',
                                                                            [4,5,6,7,8,9])->sum('stit5') }}</storng></td>
                                                                    @if($value->whereIn('id_level',
                                                                    [4,5,6,7,8,9])->sum('stit4') == 0)
                                                                    <td><storng class="danger">0%</storng>
                                                                    </td>
                                                                    @else
                                                                    <td><storng class="success text-center"> {{
                                                                            +number_format($value->whereIn('id_level',
                                                                            [4,5,6,7,8,9])->sum('stit4')*100/$value->whereIn('id_level',
                                                                            [4,5,6,7,8,9])->sum('stit3'),2) }}%</storng></td>
                                                                    @endif
                                                                    @else
                                                                    <td colspan="6">ไม่มีข้อมูล</td>
                                                                    @endif
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        </p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
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
    </div>
</div>
@endsection