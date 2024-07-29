@extends('app')

@section('styles')
<link href="{{ asset('/datetime/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@stop

@section('script')
    <script src="{{ asset('/moment.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
    <script src="{{ asset('/datetime/js/bootstrap-material-datetimepicker.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function()
        {
            "use strict";
            $('#date').bootstrapMaterialDatePicker
            ({
                time: false,
                clearButton: true
            });

            $('#time').bootstrapMaterialDatePicker
            ({
                date: false,
                shortTime: false,
                format: 'HH:mm'
            });

            $('#date-format').bootstrapMaterialDatePicker
            ({
                format: 'dddd DD MMMM YYYY - HH:mm'
            });
            $('#date-fr').bootstrapMaterialDatePicker
            ({
                format: 'DD/MM/YYYY HH:mm',
                lang: 'fr',
                weekStart: 1, 
                cancelText : 'ANNULER',
                nowButton : true,
                switchOnClick : true
            });

            $('#date-end').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'DD/MM/YYYY HH:mm'
            });
            $('#date-start').bootstrapMaterialDatePicker
            ({
                weekStart: 0, format: 'DD/MM/YYYY HH:mm', shortTime : true
            }).on('change', function(e, date)
            {
                $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
            });

            $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });

            //new methods
            $("#time-end").bootstrapMaterialDatePicker({
                weekStart: 0,
                format: "YYYY-MM-D HH:mm"
            });
            
            $("#time-start").bootstrapMaterialDatePicker({
                weekStart: 0,
                format: "YYYY-MM-D HH:mm",
                shortTime: true
            })
            .on("change", function (e, date) {
                $("#time-end").bootstrapMaterialDatePicker("setMinTime", date);
            });

            $("#min-time").bootstrapMaterialDatePicker({
                format: "YYYY-m-d HH:mm",
                minDate: new Date()
            });

            $.material.init()
        });
        </script>

@stop

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                                      {{ trans('lang.update')}} {{ trans('lang.entry')}}
                                    </h3>
        
        <p class="title-description"> 
    
    
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ URL('admin/timesheet') }}"><i class="fa fa-clock-o"></i> {{ trans('lang.timesheet')}} {{ trans_choice('lang.log',2)}}</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                      
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
                    </div>


					
						
  <section class="section">
                        <div class="row sameheight-container">
                           
                            <div class="col-md-12">
                                <div class="card card-block sameheight-item">
                                    
                                   
@if(count($employees) > 0)
@foreach($employees as $emp)

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/timesheet/update') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $emp->id }}">
					
                        	<div class="form-group">
							<label class="control-label">{{ trans_choice('lang.employee',1)}}*</label>
                            <select class="form-control" name="emp_id">
<option value="{{ $emp->emp_id }}" selected>{{ $emp->emp->name }}</option>                            	
  @foreach ($posts as $post)
  <option value="{{ $post->id }} ">{{ $post->name }}</option>
  @endforeach
</select>


							
						</div>
							<div class="form-group">
							<label class="control-label">{{ trans_choice('lang.project',1)}}*</label>
                            <select class="form-control underlined" name="proj_id">
<option value="{{ $emp->proj_id }}" selected>{{ $emp->project->proj_title }}</option>                            	                            	
  @foreach ($projects as $project)
  <option value="{{ $project->id }} ">{{ $project->proj_title }}</option>
  @endforeach
</select>

						</div>
	<div class="form-group">
							<label class="control-label">{{ trans('lang.start')}} {{ trans('lang.time')}}*</label>
                            <div class='input-group date'>
<input type='text' class="form-control underlined" name="start_time" id="time-start" value="{{ $emp->start_time }}" required />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

						</div>
	<div class="form-group">
							<label class="control-label">{{ trans('lang.end')}} {{ trans('lang.time')}}*</label>
                            <div class='input-group date'>
<input type='text' class="form-control underlined" name="end_time" id="time-end" value="{{ $emp->end_time }}" required />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>											
<div class="form-group">	
							<label class="control-label">{{ trans('lang.task')}}*</label>
								<input type="text" class="form-control underlined" name="task" value="{{ $emp->task }}" >
							
						</div>	
<div class="form-group">	
							<label class="control-label">{{ trans('lang.notes')}}**</label>
								<input type="text" class="form-control underlined" name="notes" value="{{ $emp->notes }}" >
							
						</div>						
                        	


						<div class="form-group">
							
								<button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary">
								   {{ trans('lang.update')}}
								</button>
							
						</div>
					</form>

@endforeach
@endif														                          
                                </div>
                            </div>
                        </div>
                    </section>

			
                        
                    </div>
                  
                   
                </article>
		</div>			
		</div>
		</div>
		</div>
</div></div></div>
@endsection
