@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.guest')}} {{ trans_choice('lang.log',2)}} <button type="button" class="btn btn-primary btn-sm rounded-s btn-pill-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-location-arrow"></i> {{ trans('lang.new')}} {{ trans('lang.entry')}}</button>
                   
                </h3>
                                    <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.guest')}} {{ trans_choice('lang.log',2)}}</li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                            <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/guest/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <!--<form class="form-inline"> -->
                                <div class="input-group"> <input type="text" name="query" class="form-control boxed rounded-s" placeholder="Search by guest Name"> <span class="input-group-btn">
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
                       @if(count($employees) > 0)
<?php
$tot=0;
?>
<div class="table-responsive">
                     <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            <th>{{ trans('lang.date')}}</th>
                            <th>{{ trans('lang.name')}}</th>
                            <th>{{ trans('lang.in')}}<i class="fa fa-arrows-h"></i> {{ trans('lang.out')}}</th>
                            <th>{{ trans('lang.hours')}}</th>
                            <th>{{ trans('lang.purpose')}}</th>
                            <th>{{ trans('lang.contact')}}</th>
                            <th></th>
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($employees as $emp)
                    
                            <td>{{ date('d-m-y', strtotime($emp->work_in)) }}</td>

                            <td> {{ $emp->guest }}</td>
                            <td>
                            {{ date('H:i:s', strtotime($emp->work_in)) }} <i class="fa fa-arrows-h"></i> {{ date('H:i:s', strtotime($emp->work_out)) }}</td>
                            <td>{{ $emp->duration }} </td>                     
                            <td>{{ $emp->purpose }}</td>
                            <td>{{ $emp->contact }}</td>   


                             <td class="hidden-print" align="right">                          
                              <a href="{{ URL::to('admin/attendance/guest/edit/' . $emp->id) }}"><i class="fa fa-edit"></i></a>
                            &nbsp;  <a <?php if(env('APP_DEMO')=='1'){ echo 'class="btn disabled"'; } ?> href="{{ URL::to('admin/attendance/delete/' . $emp->id) }}"><i class="fa fa-remove"></i></a>
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
                       <h3>{{ trans('lang.no_data')}}!</h3>
                    @endif
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
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-location-arrow"></i>Guest Log</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/attendance/guest/docreate') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
        

                        
                            <div class="form-group">
                            <label class="control-label">Guest Name*</label>
                            
                            <input type="text" class="form-control underlined" name="guest" required>
                            
                        </div>
                        <div class="form-group">
                            <label class="control-label">Purpose*</label>
                            
                                                        <input type="text" class="form-control underlined" name="purpose" required>
                              
                        </div>
<div class="form-group">
                            <label class="control-label">Contact*</label>
                            
                            <input type="text" class="form-control underlined" name="contact" required>
                              
                        </div>

    <div class="form-group">
                 
          
              <div class="col-md-6">
              
                <input type="text" id="time-start" name="work_in" class="form-control underlined floating-label" placeholder="Start Time">
              </div>
          
               <div class="col-md-6">
                <input type="text" id="time-end" name="work_out" class="form-control underlined floating-label" placeholder="End Time">
              </div>
            </div>
                                     

                        </div> 
                        <br />
                        <br />       
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary"><i class="fa fa-check"></i> Save changes</button>
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
