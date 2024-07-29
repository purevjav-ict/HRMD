@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                   {{ trans('lang.vacation')}} {{ trans_choice('lang.request',1)}}
                  
                </h3>
                                    <p class="title-description"> 
    
    
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ URL('admin/leave') }}"><i class="fa fa-plane"></i> {{ trans('lang.vacation')}} {{ trans_choice('lang.request',2)}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.edit')}}</li>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/leave/update') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $emp->id }}">
					
                        	<div class="form-group">
							<label class="control-label">{{ trans_choice('lang.employee',1)}}*</label>
                          <h5>{{ $emp->emp->name }}</h5>
						</div>
	<div class="form-group">
							<label class="control-label">{{ trans('lang.start date')}}*</label>
							
                            <div class='input-group date'>
<input type='text' class="form-control underlined" id="date-start" name="start_date" data-provide="datepicker" value="{{ $emp->start_date }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							
						</div>
	<div class="form-group">
							<label class="control-label">{{ trans('lang.end date')}}*</label>
							
                            <div class='input-group date'>
<input type='text' class="form-control underlined" id="date-end" name="end_date" data-provide="datepicker" value="{{ $emp->end_date }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							
						</div>											
<div class="form-group">	
							<label class="control-label">{{ trans('lang.reason')}}*</label>
							
								<input type="text" class="form-control underlined" required name="reason" value="{{ $emp->reason }}" >
							
						</div>	
<div class="form-group">	
							<label class="control-label">{{ trans('lang.status')}}*</label>
							
								<select class="form-control underlined" name="status">
									<option value="0" <?php if($emp->status==0) echo 'SELECTED'; ?> >{{ trans('lang.pending')}}</option>
									<option value="1" <?php if($emp->status==1) echo 'SELECTED'; ?>>{{ trans('lang.approved')}}</option>
									<option value="2" <?php if($emp->status==2) echo 'SELECTED'; ?>>{{ trans('lang.rejected')}}</option>
								</select>
							
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
