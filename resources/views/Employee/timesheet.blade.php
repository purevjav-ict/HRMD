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
  
  .blink {
    background: #D9534F;
    color:white;
    padding:3px;
  animation: blinker 1s linear infinite;
}

@keyframes blinker {  
  50% { opacity: 0.0; }
}

#stopwatch{
  font-size: 26px;
  font-family: 'Roboto';
}

</style>

@endsection
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
                  <h1>{{ trans('lang.timesheet')}} <small>{{ date('H:i', strtotime($tot)) }} {{ trans('lang.hours')}} </small></h1>
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li>{{ trans('lang.timesheet')}}</li>

    </ul>
<p class="text-right">

</p>
<div class="row">
  <form class="form-horizontal" role="form" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="col-md-3">              
                            
                            <div class="form-group">
                            <div class="col-md-10">
                            <select class="form-control" name="proj_id">
  @foreach ($projects as $project)
  <option value="{{ $project->id }} ">{{ $project->proj_title }}</option>
  @endforeach
</select>


                            </div>
                        </div>
</div>                        

<div class="col-md-3">                          
      
                                                    
    
<div class="form-group">    
                            
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="task" value="" placeholder="{{ trans('lang.task')}}" required >
                            </div>
                        </div> 
                         </div>
                            
<div class="col-md-3">                                                      

<div class="form-group">    
                            
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="notes" value="" placeholder="{{ trans('lang.notes')}}" required >
                            </div>
                        </div>  
</div>
                            <div class="col-md-3">              


                        

                   
      
        <div id="txt"><button type="button" class="btn btn-success" id="plan"><span class="glyphicon glyphicon-play" aria-hidden="true"></span> {{ trans('lang.start')}}</button></div>
        
         <div id="txt2">
          <span id="stopwatch">00:00:00</span>
          <button type="button" class="btn btn-danger" id="plan2"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span> {{ trans('lang.stop')}}</button></div>
        </form>
</div>
</div>

@section('script')

<script src="{{ asset('/js/jquery.timer.js') }}"></script>
<script src="{{ asset('/js/timerdemo.js?ver=2') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
    "use strict";
    //window.localStorage.clear(); //Use this when timer runs in loop
    //if timer already running
    if(localStorage.getItem("globalvar2")){
    console.log(localStorage.getItem("globalvar2"));
    $("#txt").hide();
    $("#txt2").show();
    $("input[name=notes]").prop('disabled', true);
    $("input[name=task]").prop('disabled', true);
    }

$('#plan').click(function(){ 
    "use strict";
$.ajax({
      url: 'timesheetupd',
      type: "POST",
      dataType: 'json',
      data: {'proj_id':$('select[name=proj_id]').val(), 'notes':$('input[name=notes]').val(), 'task':$('input[name=task]').val(), '_token': $('input[name=_token]').val()},
      success: function(data){  
        $("#txt").hide();
        $("#txt2").show();
        $("input[name=notes]").prop('disabled', true);
        $("input[name=task]").prop('disabled', true);
        $('#thisdiv').load(document.URL +  ' #thisdiv');
        Example1.resetStopwatch();
        Example1.Timer.toggle();
       window.globalVar = data;
       localStorage.setItem('globalvar2', data);
      }
    });      
  }); 
});


$('#plan2').click(function(){ 
"use strict";
var globalVar=localStorage.getItem("globalvar2");
$.ajax({
      url: 'timesheetupd2',
      type: "GET",
      dataType: 'json',
      data: { 'id': globalVar},
      success: function(data){
       $("#txt2").hide();
       $("#txt").show();
       $('#thisdiv').load(document.URL +  ' #thisdiv');
       $("input[name=notes]").prop('disabled', false);
        $("input[name=task]").prop('disabled', false);
       console.log(data);
      localStorage.setItem('startTime', 1);
      localStorage.removeItem('globalvar2');
      location.reload(); 
      }
    });      
  }); 

</script>
@stop
            
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

                 @if (Session::has('message'))
                        <div class="alert alert-success">
                            <strong>  {{ Session('message') }} </strong>
                        </div>
                    @endif


                     @if(count($employees) > 0)
<div id="thisdiv">
<div class="table-responsive">
                      <table class="table table-striped sortable">
                     <thead>
                         <tr>
                          <th>#</th>
                            <th>{{ trans_choice('lang.project',1)}}</th>
                            <th>{{ trans('lang.start')}}</th>
                            <th>{{ trans('lang.end')}}</th>
                            <th>{{ trans('lang.duration')}}</th>
                            <th>{{ trans('lang.task')}}</th>
                            <th>{{ trans('lang.notes')}}</th>
                                               
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($employees as $emp)
                     <tr>
                            <td>{{ $emp->id }}</td>
                            <td>{{ $emp->project->proj_title }}</td>
                            <td>{{ $emp->start_time }}</td>
                            <td>
                              @if($emp->start_time==$emp->end_time)
                                <span class="blink">{{ trans('lang.current_working')}}</span>
                              @else
                              {{ $emp->end_time }}
                              @endif
                            </td>
                            <td>{{ $emp->duration }}</td>
                            <td>{{ $emp->task }}</td>
                            <td>{{ $emp->notes }}</td>
                            
                        </tr>
                         @endforeach
                     </tbody>

                     </table>

                 </div>
               </div>
                       
                       {!! str_replace('/?', '?', $employees->render()) !!}

                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif
        </div>
    </div>
</div>
@endsection
