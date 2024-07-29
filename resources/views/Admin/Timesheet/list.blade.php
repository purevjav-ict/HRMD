@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.timesheet')}} <small>{{ date('H:i', strtotime($tot)) }} {{ trans('lang.hours')}} </small>
                    <button type="button" class="btn btn-primary btn-sm rounded-s btn-pill-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-location-arrow"></i> {{ trans('lang.new')}} {{ trans('lang.entry')}} </button>
                </h3>
                                    <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.timesheet')}}</li>
        </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                            <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/timesheet/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input-group"> <input type="text" name="query" class="form-control boxed rounded-s" placeholder="Emp/Project ID"> <span class="input-group-btn">
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


                       @if(count($employees) > 0)
<section class="section">
                        <div class="row sameheight-container">
                            <div class="col-xl-12">
                                <div class="card sameheight-item">
                                    <div class="card-block">                       
<section class="example">
<div class="table-responsive">
                      <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            <th>#</th>
                            <th>{{ trans_choice('lang.employee',1)}}</th>
                            <th>{{ trans('lang.task')}}</th>
                            <th>{{ trans('lang.start')}}<i class="fa fa-arrows-h"></i> {{ trans('lang.end')}}</th>
                            <th>{{ trans('lang.duration')}}</th>
                            <th>{{ trans('lang.notes')}}</th>
                            <th></th>
                            
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($employees as $emp)
                     <tr>
                            <td> {{ $emp->id }}</td>
                            <td>{{ $emp->emp->name }} </td>
                            <td>{{ $emp->task }} <br />
                              <span class="label label-default"><strong>{{ $emp->proj_id }}#</strong> {{ $emp->project->proj_title }}</label></td>
                            <td>{{ date('d-m-y', strtotime($emp->end_time)) }}<br />
                            {{ date('H:i:s', strtotime($emp->start_time)) }} <i class="fa fa-arrows-h"></i> {{ date('H:i:s', strtotime($emp->end_time)) }}</td>
                            <td>{{ $emp->duration }}</td>
                            
                            <td>{{ $emp->notes }}</td>
                            <td class="hidden-print" align="right">
                              <a href="{{ URL::to('admin/timesheet/edit/' . $emp->id) }}"><i class="fa fa-edit"></i></a>
                            &nbsp;  <a href="{{ URL::to('admin/timesheet/delete/' . $emp->id) }}"><i class="fa fa-remove"></i></a>
                                <a class="btn btn-link2 btn-xs <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?>" href="{{ URL::to('admin/timesheet/delete/' . $emp->id) }}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>


                            </td>
                        </tr>
                         @endforeach
                     </tbody>

                     </table>

                 </div>
                        <nav class="text-xs-right">
                       {!! str_replace('/?', '?', $employees->render()) !!}
</nav>
                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif

                
                    
                    </div>
  </section>
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-location-arrow"></i> New Entry</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
 <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/timesheet/docreate') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                    
                            <div class="form-group">
                            <label class="control-label">{{ trans_choice('lang.employee',1)}}*</label>
                            
                            <select class="form-control underlined" name="emp_id">
  @foreach ($posts as $post)
  <option value="{{ $post->id }} ">{{ $post->name }}</option>
  @endforeach
</select>


                            
                        </div>
                            <div class="form-group">
                            <label class="control-label">{{ trans_choice('lang.project',1)}}*</label>
                            
                            <select class="form-control underlined" name="proj_id">
  @foreach ($projects as $project)
  <option value="{{ $project->id }} ">{{ $project->proj_title }}</option>
  @endforeach
</select>


                            
                        </div>
                <div class="form-group">
                 
          <div class="col-md-4">
               <label class="control-label">{{ trans_choice('lang.time',1)}}*</label>
             </div>
              <div class="col-md-4">
              
                <input type="text" id="time-start" name="start_time" class="form-control underlined floating-label" placeholder="{{ trans('lang.start')}}">
              </div>
          
               <div class="col-md-4">
                <input type="text" id="time-end" name="end_time" class="form-control underlined floating-label" placeholder="{{ trans('lang.end')}}">
              
            </div></div>
          
                                                    
    
<div class="form-group">    
                            <label class="control-label">{{ trans('lang.task')}}*</label>
                            
                                <input type="text" class="form-control underlined" name="task" value="" required>
                            
                        </div>  
<div class="form-group">    
                            <label class="control-label">{{ trans('lang.notes')}}*</label>
                            
                                <input type="text" class="form-control underlined" name="notes" value="" required>
                            </div>
                        
                        
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('lang.cancel')}}</button>
        <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary"><i class="fa fa-check"></i> {{ trans('lang.save')}}</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>

        
    </div>
  </div>
</div>
</div></div></div>
@endsection
