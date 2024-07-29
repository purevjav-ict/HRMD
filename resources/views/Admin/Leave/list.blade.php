@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.vacation')}} {{ trans_choice('lang.request',2)}}
                    <button type="button" class="btn btn-primary btn-sm rounded-s btn-pill-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-location-arrow"></i> {{ trans('lang.new')}} {{ trans_choice('lang.request',1)}}</button>
                </h3>
      <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.vacation')}} {{ trans_choice('lang.request',2)}}</li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                            <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/leave/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="input-group"> <input type="text" name="query" class="form-control boxed rounded-s" placeholder="Employee ID"> <span class="input-group-btn">
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
                            <div class="col-xl-12">
                                <div class="card sameheight-item">
                                    <div class="card-block">

                       @if(count($employees) > 0)

<div class="table-responsive">
                                          <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            <th>#</th>
                            <th>{{ trans_choice('lang.employee',1)}}</th>
                            <th>{{ trans('lang.period')}}</th>
                            <th>{{ trans('lang.reason')}}</th>
                            <th>{{ trans('lang.status')}}</th>
                           
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($employees as $emp)
                     
                            <td>{{ $emp->id }}</td>
                            <td>{{ $emp->emp->name }} </td>
                            <td>{{ $emp->start_date }} to {{ $emp->end_date }}  - <strong>{{ $emp->duration+1}} {{ trans_choice('lang.day', $emp->duration+1)}}</strong></td>
                            
                            <td>{{ $emp->reason }}</td>
                            <td>
                            @if($emp->status==0)  
                            <span class="label label-info">{{ trans('lang.pending')}}</span>
                            @elseif($emp->status==2)  
                            <span class="label label-danger">{{ trans('lang.rejected')}}</span>
                            @else
                            <span class="label label-success">{{ trans('lang.approved')}}</span>
                            @endif
                            &nbsp;  <a href="{{ URL::to('admin/leave/edit/' . $emp->id) }}"><i class="fa fa-edit"></i></a>
                            &nbsp;  <a <?php if(env('APP_DEMO')=='1'){ echo 'class="btn disabled"'; } ?> href="{{ URL::to('admin/leave/delete/' . $emp->id) }}"><i class="fa fa-remove"></i></a>
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

        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-location-arrow"></i> {{ trans('lang.vacation')}} {{ trans_choice('lang.request',1)}}</h4>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
 <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/leave/docreate') }}">
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
                            <label class="control-label">{{ trans('lang.start date')}}*</label>
                            
                            <div class='input-group date'>
<input type='text' class="form-control underlined" required id="date-start" name="start_date" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            
                        </div>
    <div class="form-group">
                            <label class="control-label">{{ trans('lang.end date')}}*</label>
                            
                            <div class='input-group date'>
<input type='text' class="form-control underlined" id="date-end" name="end_date" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            
                        </div>                                          
<div class="form-group">    
                            <label class="control-label">{{ trans('lang.reason')}}*</label>
                            
                                <input type="text" class="form-control underlined" name="reason" value="" >
                            
                        </div>          
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i>{{ trans('lang.cancel')}}</button>
        <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary"><i class="fa fa-check"></i> {{ trans('lang.save')}}</button>
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
