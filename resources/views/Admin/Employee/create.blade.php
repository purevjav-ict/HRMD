@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}New Appointment</div>
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



					<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/emp/docreate') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
<legend>{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Personal Details</legend>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Employee Name*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Date of Birth*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="dob" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>

						<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} / {{ trans('lang.dashboard')}}Father/Husband*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="father" value="" >
							</div>
						</div>
						<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Mobile*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="mobile" value="" >
							</div>
						</div>
						<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Email*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="email" value="" >
							</div>
						</div>
<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Address*</label>
							<div class="col-md-6">
								<textarea name="address" class="form-control">
								</textarea>
								
							</div>
						</div>
												<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Upload Photo*</label>
							<div class="col-md-6">
								<input type="file"  name="photo" value="" >
							</div>
						</div>
						<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}Upload Resume*</label>
							<div class="col-md-6">
								<input type="file" name="resume" value="" >
							</div>
						</div>
						
<legend>Social Profiles</legend>						
						<div class="form-group">	
							<label class="col-md-4 control-label">Facebook*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="facebook" value="" >
							</div>
						</div>
						<div class="form-group">	
							<label class="col-md-4 control-label">Twitter*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="twitter" value="" >
							</div>
						</div>
						<div class="form-group">	
							<label class="col-md-4 control-label">Linkedin*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="linkedin" value="" >
							</div>
						</div>
						<div class="form-group">	
							<label class="col-md-4 control-label">Github*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="github" value="" >
							</div>
						</div>

						
						
<legend>Job Details</legend>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Date of Join*</label>
							<div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="doj" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						</div>
                        	<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Posting*</label>
							<div class="col-md-6">
                            <select class="form-control" name="posting">
  @foreach ($posts as $post)
  <option value="{{ $post->id }} ">{{ $post->post }}</option>
  @endforeach
</select>
<p class="text-right">
<a href="{{ URL::to('admin/posting/create') }}">+ {{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}New Position</a>
</p>

							</div>
						</div>
<div class="form-group">	
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Salary*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="salary" value="" >
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
								   {{ trans('lang.dashboard')}}Save Appointment
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
