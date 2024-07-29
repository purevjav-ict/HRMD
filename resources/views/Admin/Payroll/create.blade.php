@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.generate')}} {{ trans('lang.payroll')}}
                   
                </h3>
                                    <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.generate')}} {{ trans('lang.payroll')}}</li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                            <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/emp/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="input-group"> <input type="text" name="query" class="form-control boxed rounded-s" placeholder="{{ trans('lang.search')}}"> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span> </div>
                            </form>
                        </div>
                    </div>
 @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> {{ trans('lang.error')}}.<br><br>
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
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title">
            {{ trans('lang.generate')}} {{ trans('lang.payroll')}}
          </h3> </div>
                                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/payroll/generate') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            

            
                          <div class="form-group">
                  
          
               
              <div class="col-md-6">
              
                <input type="text" id="date-start" name="work_in" class="form-control underlined floating-label" placeholder="{{ trans('lang.start date')}}">
              </div>
          
               <div class="col-md-6">
                <input type="text" id="date-end" name="work_out" class="form-control underlined floating-label" placeholder="{{ trans('lang.end date')}}">
              </div>
            </div>
                        
<br /><br />
            <div class="form-group">
              
                <button type="submit" class="btn btn-primary btn-lg">
                   {{ trans('lang.generate')}}
                </button>
              
            </div>
          </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title">
           {{ trans('lang.recent')}} {{ trans_choice('lang.log',2)}}
          </h3> </div>
          @if(count($logs) > 0)
                                    <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            <th>{{ trans_choice('lang.log',1)}} {{ trans('lang.time')}}</th>
                            <th>{{ trans('lang.period')}}</th>
                            </tr>
                     </thead>
                     <tbody>
                      @foreach ($logs as $log)
                     <tr>
                           <td>{{ $log->log_time }} </td> 
                           <td>{{ $log->info}} </td> 
                        </tr>
                         @endforeach
                     </tbody>

                     </table> 
@else
<h4>{{ trans('lang.no_data')}}</h4>

@endif
                    
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
@endsection
