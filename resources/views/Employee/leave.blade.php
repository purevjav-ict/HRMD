@extends('Employee/app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('lang.vacation')}} <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
  <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> {{ trans('lang.new')}} {{ trans_choice('lang.request',1)}}
</button></h1>
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li>{{ trans('lang.vacation')}} {{ trans_choice('lang.request',2)}}</li>

    </ul>
<p class="text-right">

</p>

            
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

<div class="table-responsive">
                                          <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            <th>#</th>
                            <th>{{ trans('lang.period')}}</th>
                            <th>{{ trans('lang.no_of')}} {{ trans_choice('lang.day',2)}}</th>
                            <th>{{ trans('lang.reason')}}</th>
                            <th>{{ trans('lang.status')}}</th>
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($employees as $emp)
                     
                            <td>{{ $emp->id }}</td>
                            <td>{{ $emp->start_date }} to {{ $emp->end_date }} </td>
                            <td>{{ $emp->duration }}</td>
                            <td>{{ $emp->reason }}</td>
                            <td>
                            @if($emp->status==0)  
                            <span class="label label-info">{{ trans('lang.pending')}}</span>
                            @elseif($emp->status==2)  
                            <span class="label label-danger">{{ trans('lang.rejected')}}</span>
                            @else
                            <span class="label label-success">{{ trans('lang.approved')}}</span>
                            @endif                            </td>

                        </tr>
                         @endforeach
                     </tbody>

                     </table>
                 </div>
                       
                       {!! str_replace('/?', '?', $employees->render()) !!}

                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif


<!-- new creation -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('lang.new')}} {{ trans_choice('lang.request',1)}}</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/employee/leave/docreate') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.start date')}}*</label>
                            <div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" id="date-start" name="start_date" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            </div>
                        </div>
    <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.end date')}}*</label>
                            <div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" id="date-end" name="end_date" data-provide="datepicker" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            </div>
                        </div>                                          
<div class="form-group">    
                            <label class="col-md-4 control-label">{{ trans('lang.reason')}}*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="reason" value="" >
                            </div>
                        </div>          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('lang.cancel')}}</button>
        <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary">{{ trans('lang.save')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>
                
        </div>
    </div>
</div>

@endsection
