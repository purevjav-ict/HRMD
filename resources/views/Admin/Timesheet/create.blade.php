@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Timesheet Entry</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> {{ trans('lang.dashboard')}}There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

				 @if (Session::has('message'))
						<div class="alert alert-success">
							<strong>{{ trans('lang.dashboard')}}Status!</strong>  {{ Session('message') }} 
        				</div>
					@endif



					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/timesheet/docreate') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
					
                        	<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Employee*</label>
							<div class="col-md-6">
                            <select class="form-control" name="emp_id">
  @foreach ($posts as $post)
  <option value="{{ $post->id }} ">{{ $post->name }}</option>
  @endforeach
</select>


							</div>
						</div>
							<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Project*</label>
							<div class="col-md-6">
                            <select class="form-control" name="proj_id">
  @foreach ($projects as $project)
  <option value="{{ $project->id }} ">{{ $project->proj_title }}</option>
  @endforeach
</select>


							</div>
						</div>
	<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Start Time*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="start_time" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>
	<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}End Time*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="end_time" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>											
<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Task*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="task" value="" >
							</div>
						</div>	
<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Notes*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="notes" value="" >
							</div>
						</div>						
                        	


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								   {{ trans('lang.dashboard')}}Save
								</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
