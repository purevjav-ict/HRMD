@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('lang.dashboard')}} {{ trans('lang.dashboard')}}New Posting</div>
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
							<strong>Status!</strong>  {{ Session('message') }} 
        				</div>
					@endif



				<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/posting/docreate') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Posting*</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="post" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('lang.dashboard')}}Department*</label>
							<div class="col-md-6">
 <select class="form-control" name="dept_id">								
@foreach ($dept as $dep)
  <option value="{{ $dep->id }} ">{{ $dep->department }}</option>
  @endforeach
</select>
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
