@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.profile')}}
                    
                    
               
                </h3>
         <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.profile')}}</li>

    </ol>

                                </div>
                            </div>
                        </div>
                    </div>
 					@if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>{{ trans('lang.error')}}.<br><br>
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
<section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-12">
                                <div class="card sameheight-item">
                                    <div class="card-block">
                                        <!-- Nav tabs -->
         @foreach ($users as $user)
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/settings/profileUpdate') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="control-label">{{ trans('lang.name')}}</label>
							
								<input type="text" class="form-control underlined" name="name" value="{{ $user->name }}">
							
						</div>

						<div class="form-group">
							<label class="control-label">{{ trans('lang.email')}}</label>
							
								<input type="email" class="form-control underlined" name="email" value="{{ $user->email }}">
							
						</div>

						<div class="form-group">
							<label class="control-label">{{ trans('lang.reset')}} {{ trans('lang.password')}}</label>
							
								<input type="password" class="form-control underlined" name="password">
							
						</div>

						<div class="form-group">
							<label class="control-label">{{ trans('lang.confirm')}} {{ trans('lang.password')}}</label>
								<input type="password" class="form-control underlined" name="password_confirmation">
							
						</div>

						<div class="form-group">
							
								<button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary">
									{{ trans('lang.update')}}
								</button>
							
						</div>
					</form>
                        @endforeach                                
                                       
    
                                    </div>
                                    <!-- /.card-block -->
                                </div>
                                <!-- /.card -->
                            </div>
                           
                        </div>
                    </section>
                       <!-- Nav tabs -->
                </article>
@endsection

