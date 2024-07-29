
@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.system')}} {{ trans_choice('lang.log',2)}} 
                </h3>
    <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.system')}} {{ trans_choice('lang.log',2)}}</li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                            <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/logs/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input-group"> <input type="text" name="query" class="form-control boxed rounded-s" placeholder="Search by log"> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </span> </div>
                            </form>
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
                         @if(count($logs) > 0)


    <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            <th>{{ trans_choice('lang.log',1)}} {{ trans('lang.time')}}</th>
                            <th>{{ trans_choice('lang.log',1)}}</th>
                            <th>{{ trans('lang.track')}} #</th>
                            <th>{{ trans('lang.category')}}</th>
                        </tr>
                     </thead>
                     <tbody>
                      @foreach ($logs as $log)
                     <tr>
                           <td>{{ $log->log_time }} </td> 
                           <td>{{ $log->log }} </td> 
                           <td>{{ $log->info}} </td> 
                           <td>{{ $log->cat }} </td>                           
                        </tr>
                         @endforeach
                     </tbody>

                     </table>
                        <nav class="text-xs-right">
                       {!! str_replace('/?', '?', $logs->render()) !!}
                        </nav>
                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif
 </div>
                                    <!-- /.card-block -->
                                </div>
                                <!-- /.card -->
                            </div>
                           
                        </div>
                    </section>                    
                       
                    </div></div>
  
                   
                </article>

@endsection
