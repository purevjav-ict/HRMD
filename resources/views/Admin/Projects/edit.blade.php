@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                   {{ trans_choice('lang.project',1)}} :: {{ $projects[0]['proj_title'] }}
                  
                </h3>
                                    <p class="title-description"> 
    
    
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ URL('admin/projects') }}"><i class="fa fa-th-large"></i> {{ trans_choice('lang.project',2)}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.edit')}} </li>
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
                                    
                                   
@if(count($projects) > 0)
@foreach($projects as $project)
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/projects/update') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $project->id }} ">
<legend>{{ trans_choice('lang.project',1)}} {{ trans('lang.spec')}}</legend>
						<div class="form-group">
							<label class="control-label">{{ trans_choice('lang.project',1)}} {{ trans('lang.title')}}*</label>
							
								<input type="text" class="form-control underlined" name="title" value="{{ $project->proj_title }}">
							</div>
						

						<div class="form-group">
							<label class="control-label">{{ trans('lang.spec')}}*</label>
							
								<input type="text" class="form-control underlined" required name="description" value="{{ $project->proj_desc }}" >
							
						</div>
<legend>{{ trans_choice('lang.project',1)}} {{ trans('lang.schedule')}}</legend>
						<div class="form-group">
							<label class="control-label">{{ trans('lang.start date')}}*</label>
							
                            <div class='input-group date'>
<input type='text' class="form-control underlined" id="date-start" name="start_date" required ata-provide="datepicker" value="{{ $project->start_date }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							
						</div>
						<div class="form-group">
							<label class="control-label">{{ trans('lang.deadline')}}*</label>
							
                            <div class='input-group date'>
<input type='text' class="form-control underlined" id="date-end" name="deadline" required data-provide="datepicker" value="{{ $project->deadline }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

							
						</div>
						<div class="form-group">	
							<label class="control-label">{{ trans('lang.status')}}*</label>
							
								<select class="form-control underlined" name="status" id="status">
<?PHP if($project->status=='0') echo 'selected'; ?>
									<option value="0" <?PHP if($project->status=='0') echo 'selected'; ?>>{{ trans('lang.ongoing')}}</option>
									<option value="1" <?PHP if($project->status=='1') echo 'selected'; ?>>{{ trans('lang.finished')}}</option>
									<option value="2" <?PHP if($project->status=='2') echo 'selected'; ?>>{{ trans('lang.stopped')}}</option>
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
