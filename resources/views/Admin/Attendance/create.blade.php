@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Attendance Entry</div>
				<div class="panel-body">
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
							<strong>{{ trans('lang.dashboard')}}tatus!</strong>  {{ Session('message') }} 
        				</div>
					@endif



					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/attendance/docreate') }}">
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
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Work In*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="work_in" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>
	<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}} Work Out*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="work_out" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>											
<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Purpose*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="purpose" value="" >
							</div>
						</div>	
<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Contact*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="contact" value="" >
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
