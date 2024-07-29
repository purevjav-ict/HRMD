@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                   {{ trans('lang.edit')}} | {{ $departments[0]['department'] }}
                  
                </h3>
                                    <p class="title-description"> 
    
    
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i>{{ trans('lang.dashboard')}}</a></li>
         <li class="breadcrumb-item"><a href="{{ URL('admin/dept') }}"><i class="fa fa-sitemap"></i> {{ trans_choice('lang.department',2)}}</a></li>
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
@if(count($departments) > 0)
@foreach($departments as $department)
<br /><br />

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/dept/update') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $department->id }} ">
						<div class="form-group">
							<label class="control-label">{{ trans_choice('lang.department',1)}}*</label>
							
								<input type="text" required class="form-control underlined" name="department" value="{{ $department->department }}">

							
						</div>

						<div class="form-group">
							<label class="control-label">{{ trans('lang.functionality')}}*</label>
							
								<input type="text" required class="form-control underlined" name="function" value="{{ $department->function }}" >
							
						</div>

						<div class="form-group">
							
								<button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary">
								   {{ trans('lang.save')}}
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

