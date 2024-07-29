@extends('Employee/app')

@section('styles')
<style type="text/css">
  #txt2{
    display: none;
  }
  .timer-on{
    background:green;
  }
  .timer-off{
    background:red;
  }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
                  <h1>{{ trans('lang.attendance')}}</h1>
    <ol class='breadcrumb'>
        <li><a href="{{ URL('employee/dashboard') }}">{{ trans('lang.dashboard')}}</a></li>
        <li>{{ trans('lang.attendance')}}</li>
    </ul>

   @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> {{ trans('lang.error')}}<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                 @if (Session::has('message'))
                        <div class="alert alert-success">
                            <strong>  {{ Session('message') }} </strong>
                        </div>
                    @endif

<div class="row">
<div class="col-md-12">   
<form class="form-horizontal" role="form" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div id="thisdiv">
<div class="panel">
      <div class="panel-heading panel-primary">{{ trans('lang.today')}} {{ trans_choice('lang.log',1)}}</div>
            <div class="panel-body">
         @if(count($chks)>0)
          @foreach($chks as $chk)
          <?php
          $work_out='<button type="button" class="btn btn-danger" id="plan"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>'.trans('lang.check_out').'</button>';
              if($chk->work_in!=$chk->work_out){
                $work_out=date('H:i', strtotime($chk->work_out));
              }
          ?>
           
               <div class="row">

                <div class="col-md-12">
                <div class="col-md-6">
              <p class="lead">{{ trans('lang.check_in')}} {{ trans('lang.time')}}</p>
              <h2>{{ date('H:i', strtotime($chk->work_in)) }}</h2>
                </div>
                <div class="col-md-6">
              <p class="lead">{{ trans('lang.check_out')}} {{ trans('lang.time')}}</p>
              <h2><?php echo $work_out; ?></h2>
            </div>
          </div>

        </div>
            
          @endforeach
        @else
        <button type="button" class="btn btn-success btn-lg" id="plan"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> {{ trans('lang.check_in')}}</button>  
         @endif 
             </div>
                
         </div>
      </div>
        </form>
    </div>
</div>      


@section('script')

<link href="{{ asset('calendar/fullcalendar.css') }}" rel='stylesheet' />
<link href="{{ asset('calendar/fullcalendar.print.css') }}" rel='stylesheet' media='print' />
<script src='//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js'></script>
<script>
var jq311 = jQuery.noConflict();
</script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src='https://fullcalendar.io/js/fullcalendar-3.1.0/fullcalendar.min.js'></script>
  
<script type="text/javascript">
$(document).ready(function(){
"use strict";
$('#plan').click(function(){ 
$.ajax({
      url: 'attendanceupd',
      type: "GET",
      success: function(data){
        console.log(data);
        location.reload(true);
      }
    });      
  }); 
});
</script>
@stop
            
<hr />
<div class="row">
<div class="col-md-12">   
<div class="panel">
<div class="panel-heading panel-primary">{{ trans('lang.calendar')}}</div>
<div class="panel-body">  
<div id="thisdiv2">
<div class="col-md-10 col-md-offset-1">
<div id="calendar"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div id="thisdiv3">
@section('scripts')
<!-- calendar -->

<script>
  $(document).ready(function() {
    "use strict";
    $('#calendar').fullCalendar({
      defaultDate: Date(),
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
      <?php
      foreach ($employees as $emp) {
        echo "{
        title: '".date('h:i', strtotime($emp->work_out))."',
        start: '".date('Y-m-d H:i:s', strtotime($emp->work_in))."',
        end: '".date('Y-m-d H:i:s', strtotime($emp->work_out))."'
        },";
      }
      ?>
      ]
    });
    
  });
</script>
@stop
</div>
</div>
</div>

@endsection
