@extends('layout')
@section('admin_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> Liệt kê lịch đặt bàn</h6>
        </div>
      
        <div class="card-body">
            <div id="calendar"> </div>

        </div>
        <div class="row">
            <a href="{{ url('/all-reservation') }}" class="btn btn-success mr-5 mb-4" style="margin-left: auto ">Trở lại</a>
        </div>
    </div>
    </div>
    </div>

    <script src="{{ asset('/backend/vendor/jquery/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // var calendar = $('#calendar').fullCalendar({
            //     header: {
            //         left: 'prev,next today',
            //         center: 'title',
            //         right: 'month,basicWeek,basicDay'
            //     },
            //     navLinks: true,
            //     editable: true,
            //     events: "getevent",
            //     displayEventTime: false,
            //     eventRender: function(event,element,view){
            //         if(event.allDay == 'true'){
            //             event.allDay = true;
            //         }else{
            //             event.allDay = false;

            //         }
            //     }

            // });


            var reservation = @json($events);
            // alert(events1);
            //console.log(events1);
            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: reservation
            });
        });
    </script>
@endsection
