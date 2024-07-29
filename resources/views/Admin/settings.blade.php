@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.settings')}}
                    
               
                </h3>
  <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.settings')}}</li>
    </ol>

                                </div>
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
<section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-12">
                                <div class="card sameheight-item">
                                    <div class="card-block">
                                        <!-- Nav tabs -->
                                        <div class="card-title-block">
                                            <h3 class="title">
                            {{ trans('lang.settings')}}
                        </h3> </div>
                                        <ul class="nav nav-tabs nav-tabs-bordered">
                                            <li class="nav-item"> <a href="#home" class="nav-link active" data-target="#home" data-toggle="tab" aria-controls="home" role="tab">{{ trans('lang.general')}}</a> </li>
                                            <li class="nav-item"> <a href="#profile" class="nav-link" data-target="#profile" aria-controls="profile" data-toggle="tab" role="tab">{{ trans('lang.tax')}}</a> </li>
                                        </ul>
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/settings/update') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">                                                   
                                        <!-- Tab panes -->
                                        <div class="tab-content tabs-bordered">
                                            <div class="tab-pane active fade show" id="home">
                                               <br /><br />
                                                @foreach ($companys as $company)

                    <div class="form-group">

                            <label class="control-label text-uppercase">{{ $company->field }}</label>
                            
                            @if($company->field=='localization')   
                            @else
                        <input type="text" class="form-control underlined" name="{{ $company->field }}" value="{{ $company->value }}">
                        @endif
<p class="text-right"><code>${{ $company->field }}</code></p>
                        
                                
                            
                        </div>
                          @endforeach
                                            </div>
                                            <div class="tab-pane fade" id="profile">
                                                <br /><br />
                                                  @foreach ($taxs as $tax)
            
                    <div class="form-group">
                            <label class="control-label">{{ $tax->field }}</label>
                            
                                <input type="text" class="form-control underlined" name="{{ $tax->field }}" value="{{ $tax->value }}">

                                <p class="text-right"><code>${{ $tax->field }}</code></p>

                            
                        </div>
                          @endforeach
                                            </div>
                                            
                                              
                        <div class="form-group">
                         
                                <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary btn-lg">
                                    {{ trans('lang.update')}}
                                </button>
                            </div>
                         
                        
                    </form>
                                        </div>
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
