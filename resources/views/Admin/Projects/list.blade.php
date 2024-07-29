@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                          
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans_choice('lang.project',2)}}
                    <button type="button" class="btn btn-primary btn-sm rounded-s btn-pill-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-location-arrow"></i> {{ trans('lang.new')}} </button>
                </h3>
<p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans_choice('lang.project',2)}}</a></li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                            <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/projects/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!--<form class="form-inline"> -->
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
                            <strong> {{ Session('message') }} </strong>
                        </div>
                    @endif
<section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-12">
                                <div class="card sameheight-item">
                                    <div class="card-block">

                     @if(count($projects) > 0)


        <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            <th>#</th>
                            <th>{{ trans_choice('lang.project',2)}}</th>
                            <th>{{ trans('lang.start date')}}</th>
                            <th>{{ trans('lang.deadline')}}Deadline</th>
                            <th>{{ trans('lang.duration')}}<br /><small>(in days)</small></th>
                            <th>{{ trans('lang.status')}}</th>
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($projects as $project)
                     <tr>
                            <td> {{ $project->id }}</td>
                            <td><a class=""  href="{{ URL::to('admin/projects/edit/' . $project->id) }}"><strong>{{ $project->proj_title }}</strong><i class="fa fa-external-link"></i></a><br />
                            {{ $project->proj_desc }}
                            </td>
<td>{{ $project->start_date }}</td>
<td>{{ $project->deadline }}</td>
<td>{{ $project->duration }} &nbsp;
    @if($project->status==0)
    @if($project->duration2<0)
    <span class="text-danger">{{ $project->duration2 }} {{ trans('lang.days_due')}} </span>
    @elseif($project->duration2<6)
    <span class="text-warning">{{ $project->duration2 }}{{ trans('lang.days_due')}} </span>
    @elseif($project->duration2<10)
    <span class="text-info">{{ $project->duration2 }} {{ trans('lang.days_due')}} </span>
    @else
    <span class="text-success">{{ $project->duration2 }} {{ trans('lang.days_due')}} </span>
    @endif
    @endif
</td>
<td> 
    @if($project->status==1)
    <span class="btn btn-success-outline btn-sm">{{ trans('lang.finished')}}</span>
    @elseif($project->status==2)
    <span class="btn btn-danger-outline btn-sm">{{ trans('lang.stopped')}}</span>
    @else
    <span class="btn btn-primary-outline btn-sm">{{ trans('lang.ongoing')}}</span>
    @endif


                            </td>
                        </tr>
                         @endforeach
                     </tbody>

                     </table>
                        <nav class="text-xs-right">
                       {!! str_replace('/?', '?', $projects->render()) !!}
</nav>
                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif
                    </div>
  </div>
                                    <!-- /.card-block -->
                                </div>
                                <!-- /.card -->
                            </div>
                           
                        </div>
                    </section>      
                   
                </article>



<!-- new creation -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-location-arrow"></i> {{ trans('lang.new')}} {{ trans_choice('lang.project',1)}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
 <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/projects/docreate') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="control-label">{{ trans_choice('lang.project',1)}} {{ trans('lang.title')}}*</label>
                            
                                <input type="text" class="form-control underlined" name="title" value="">
                            
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{ trans_choice('lang.project',1)}} {{ trans('lang.spec')}}*</label>
                            
                                <input type="text" class="form-control underlined" name="description" value="" >
                            
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{ trans('lang.start date')}}*</label>
                            
                            <div class='input-group date'>
<input type='text' required class="form-control underlined" id="date-start" name="start_date" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{ trans('lang.deadline')}}*</label>
                            
                            <div class='input-group date'>
<input type='text' required class="form-control underlined" id="date-end" name="deadline" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            
                        </div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('lang.cancel')}}</button>
        <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary"><i class="fa fa-check"></i>{{ trans('lang.save')}}</button>
        </form>
      </div>
      </div>

    </div>
  </div>
</div>
        
    </div>
  </div>
</div>
</div></div></div>
@endsection
