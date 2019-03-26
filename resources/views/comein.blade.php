@extends('layouts.app')

@section('content')



{{-- {{ dump($members) }} --}}
ิ<div class="container">
<h2 class="text-center"> 
        @foreach($members->take(1) as $item){{ $item->name }}
    @endforeach
    มาทำงานทั้งหมด {{ count($members)}} วัน</h2>
<div id='calendar'></div>
</div>

<link href='{{ asset('packages/core/main.css') }}' rel='stylesheet' />
<link href='{{ asset('packages/daygrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('packages/timegrid/main.css') }}' rel='stylesheet' />
<link href='{{ asset('packages/list/main.css') }}' rel='stylesheet' />
<script src='{{ asset('packages/core/main.js') }}'></script>
<script src='{{ asset('packages/core/locales-all.js') }}'></script>
<script src='{{ asset('packages/interaction/main.js') }}'></script>
<script src='{{ asset('packages/daygrid/main.js') }}'></script>
<script src='{{ asset('packages/timegrid/main.js') }}'></script>
<script src='{{ asset('packages/list/main.js') }}'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


<script>
        
        
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,listMonth '
      },
    //   defaultDate: (1, "months"),
      defaultDate: '{{$month->date}}',
      navLinks: false, // can click day/week names to navigate views
      businessHours: true, // display business hours
      editable: false,
     
      events: [
                    @foreach($members as $item)
                    {
                        title : 'มา {{ $item->time }}',
                        start : '{{ $item->date }}',
                        allday: true,
                    },
                    @endforeach
                    
                ],
                eventColor: '#48dbfb'
            });   
           

    calendar.render();
    calendar.setOption('locale', 'th');
  });
       
    </script>
@endsection