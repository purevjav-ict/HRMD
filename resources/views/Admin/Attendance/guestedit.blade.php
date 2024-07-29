@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                  {{ trans('lang.edit')}} {{ trans('lang.entry')}}
                  
                </h3>
                                    <p class="title-description"> 
    
    
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
         <li class="breadcrumb-item"><a href="{{ URL('admin/attendance/guests') }}"><i class="fa fa-calendar"></i>  {{ trans('lang.guest')}} {{ trans_choice('lang.log',2)}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.edit')}}</li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                      
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>{{ trans('lang.error')}}<br><br>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/attendance/guest/update') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $emp->id }}">
<div class="form-group">	
							<label class="control-label">{{ trans('lang.name')}}*</label>
								<input type="text" class="form-control underlined" name="guest" value="{{ $emp->guest }}" >
							
						</div>	
                        	
	<div class="form-group">
							<label class="control-label">{{ trans('lang.in')}}*</label>
                            <div class='input-group date'>
<input type='text' class="form-control underlined" id="time-start" name="work_in" data-provide="datepicker" value="{{ $emp->work_in }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							
						</div>
	<div class="form-group">
							<label class="control-label">{{ trans('lang.out')}}*</label>
                            <div class='input-group date'>
<input type='text' class="form-control underlined" id="time-end" name="work_out" data-provide="datepicker" value="{{ $emp->work_out }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							
						</div>											
<div class="form-group">	
							<label class="control-label">{{ trans('lang.purpose')}}*</label>
								<input type="text" class="form-control underlined" name="purpose" value="{{ $emp->purpose }}" >
							
						</div>	
<div class="form-group">	
							<label class="control-label">{{ trans('lang.contact')}}*</label>
								<input type="text" class="form-control underlined" name="contact" value="{{ $emp->contact }}" >
							
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

