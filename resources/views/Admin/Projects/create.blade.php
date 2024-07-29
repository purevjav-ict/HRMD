@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('lang.new')}}</div>
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
							{{ Session('message') }} 
        				</div>
					@endif



					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/projects/docreate') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
<legend>{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Project Specs</legend>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Project Title*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="title" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Project Specification*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="description" value="" >
							</div>
						</div>
<legend>Schedule</legend>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Project Date*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="start_date" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Deadline Date*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="deadline" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>
                        	
                        	


						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								   {{ trans('lang.dashboard')}}Save Project
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
