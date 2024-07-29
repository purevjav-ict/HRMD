@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                   @if(count($employees) > 0)
				   @foreach($employees as $emp)
					{{ $emp->name }}
					@endforeach
					@endif
					's Profile
                  
                </h3>

<p class="title-description">   
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ URL('admin/emp') }}"><i class="fa fa-user"></i> {{ trans_choice('lang.employee',2)}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.edit')}}/{{ trans('lang.view')}} {{ trans('lang.profile')}}</li>
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

@if(count($employees) > 0)
@foreach($employees as $emp)

					<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/emp/update') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $emp->id }}">
						
  <section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-3">
                                <div class="card card-block sameheight-item">
                                    
                                   
                                    	<div class="alert alert-default">
<img src="{{ asset('../uploads/photo/'.$emp->photo.'') }}?ver={{ rand(1, 100) }}"  class="rounded rounded-circle" />
<br />
{{ trans('lang.change')}} <input type="file" class="form-control" name="photo" value="">
</div>

<h5>Resume</h5>
<a class="btn btn-oval btn-primary" href="{{ URL::to('../uploads/resume/' . $emp->resume) }}" target="_blank">
<i class="fa fa-cloud-download"></i> {{ trans('lang.download')}}</a> <br />
{{ trans('lang.change')}} <input type="file" class="form-control" name="resume" value="" >


<div class="alert alert-default">
<select class="form-control underlined" name="status">
  <option value="1" @if($emp->status==1) selected @endif>{{ trans('lang.active')}}</option>
  <option value="0" @if($emp->status==0) selected @endif>{{ trans('lang.inactive')}}</option>
</select>
</div>

                                 
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title">
						{{ trans('lang.personal')}} {{ trans('lang.detail')}}
					</h3> </div>
                                   
	
		 <div class="form-group"> <label class="control-label">{{ trans_choice('lang.employee',1)}} {{ trans('lang.name')}}*</label>
		 	
			
							
								<input type="text" required class="form-control underlined" name="name" value="{{ $emp->name }}">
							
						</div>
						<div class="form-group">
							<label class="control-label">{{ trans('lang.dob')}}*</label>
							
                            <div class='input-group date'>
<input type='text' required class="form-control underlined" name="dob" id="date" data-provide="datepicker" value="{{ $emp->dob }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						

						<div class="form-group">	
							<label class="control-label">{{ trans('lang.father')}} / {{ trans('lang.husband')}}*</label>
							
								<input type="text" required class="form-control underlined" name="father" value="{{ $emp->father }}" >
							
						</div>
						<div class="form-group">	
							<label class="control-label">{{ trans('lang.mobile')}}*</label>
							
								<input type="text" required class="form-control underlined" name="mobile" value="{{ $emp->mobile }}" >
							</div>
						
						<div class="form-group">	
							<label class="control-label">{{ trans('lang.email')}}*</label>
							
								<input type="text" class="form-control underlined" name="email" value="{{ $emp->email }}" >
							</div>
						
<div class="form-group">	
							<label class="control-label">{{ trans('lang.address')}}*</label>
							
								<textarea name="address" required class="form-control underlined">{{ $emp->address }}</textarea>
								
							</div>
						
											


<legend>{{ trans('lang.social')}} {{ trans_choice('lang.profile',2)}}</legend>						
						<div class="form-group">	
							<label class="control-label"><i class="fa fa-facebook"></i> Facebook</label>
							
								<input type="text" class="form-control underlined" name="facebook" value="{{ $emp->facebook }}" >
							</div>
						
						<div class="form-group">	
							<label class="control-label"><i class="fa fa-twitter"></i> Twitter</label>
							
								<input type="text" class="form-control underlined" name="twitter" value="{{ $emp->twitter }}" >
							</div>
						
						<div class="form-group">	
							<label class="control-label"><i class="fa fa-linkedin"></i> Linkedin</label>
							
								<input type="text" class="form-control underlined" name="linkedin" value="{{ $emp->linkedin }}" >
							</div>
						
						<div class="form-group">	
							<label class="control-label"><i class="fa fa-github"></i> Github</label>
							
								<input type="text" class="form-control underlined" name="github" value="{{ $emp->github }}" >
							</div>
						


						
<legend>{{ trans('lang.job')}} {{ trans('lang.detail')}}</legend>

						<div class="form-group">
							<label class="control-label">{{ trans('lang.join_date')}}*</label>
							
                            <div class='input-group date'>
<input type='text' required class="form-control underlined" name="doj" id="date2" data-provide="datepicker" value="{{ $emp->doj }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							</div>
						
                        	<div class="form-group">
							<label class="control-label">{{ trans('lang.posting')}}*</label>
							
                            <select class="form-control underlined" name="posting">
                            	<option value="{{ $emp->post_id }}" selected>{{ $emp->post->post }}</option>
  @foreach ($posts as $post)
  <option value="{{ $post->id }} ">{{ $post->post }}</option>
  @endforeach
</select>


							</div>
						
<div class="form-group">	
							<label class="control-label">{{ trans('lang.salary')}}*</label>
							
								<input type="text" required class="form-control underlined" name="salary" value="{{ $emp->salary }}" >
							</div>
							
<div class="form-group">	
							<label class="control-label">{{ trans('lang.notes')}}*</label>
							
								<input type="text" required class="form-control underlined" name="notes" value="{{ $emp->notes }}" >
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