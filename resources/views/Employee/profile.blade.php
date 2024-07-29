@extends('Employee/app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('lang.profile')}}</h1>
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li>{{ trans('lang.profile')}}</li>
    </ul>


            
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


                     

<div class="panel panel-default">
                <div class="panel-body">
                  @if(count($employees) > 0)
@foreach($employees as $emp)

                    <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/employee/profileupd') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $emp->id }}">
<legend>{{ trans('lang.personal')}} {{ trans('lang.detail')}}</legend>
<div class="col-md-12">
<div class="col-md-3" id="photo">
   
<div class="alert alert-default">
<?php $rand=rand(1,1000);
?>
<img src="{{ asset('../uploads/photo/'.$emp->photo.'') }}?ver={{ $rand }}"  class="img-circle" />
<br /><br />
<input type="file" name="photo" value="" >
</div>
<div class="alert alert-default">
@if($emp->resume!="")
<a class="btn btn-danger btn-xs" href="{{ URL::to('../uploads/resume/' . $emp->resume) }}" target="_blank"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span> {{ trans('lang.resume')}} {{ trans('lang.download')}} </a>
@else
{{ trans('lang.no_data')}}
@endif
<br /><br />
<input type="file" name="resume" value="" >
</div>
</div>

    <div class="col-md-9">
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.name')}}*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ $emp->name }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.dob')}}*</label>
                            <div class="col-md-6">
                            <div class='input-group date'>
<input type='text' class="form-control" name="dob" id="date" data-provide="datepicker" value="{{ $emp->dob }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            </div>
                        </div>

                        <div class="form-group">    
                            <label class="col-md-4 control-label">{{ trans('lang.father') }} / {{ trans('lang.husband')}}*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="father" value="{{ $emp->father }}" >
                            </div>
                        </div>
                        <div class="form-group">    
                            <label class="col-md-4 control-label">{{ trans('lang.mobile')}}*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="mobile" value="{{ $emp->mobile }}" >
                            </div>
                        </div>
                        <div class="form-group">    
                            <label class="col-md-4 control-label">{{ trans('lang.email')}}*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" value="{{ $emp->email }}" >
                            </div>
                        </div>
<div class="form-group">    
                            <label class="col-md-4 control-label">{{ trans('lang.address')}}*</label>
                            <div class="col-md-6">
                                <textarea name="address" class="form-control">{{ $emp->address }}</textarea>
                                
                            </div>
                        </div>
                                            
</div>    
</div>   

<hr />               
<legend>{{ trans('lang.social')}} {{ trans('lang.profile')}}</legend> 

                        <div class="form-group">    
                            <label class="col-md-4 control-label">Facebook*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="facebook" value="{{ $emp->facebook }}" >
                            </div>
                        </div>
                        <div class="form-group">    
                            <label class="col-md-4 control-label">Twitter*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="twitter" value="{{ $emp->twitter }}" >
                            </div>
                        </div>
                        <div class="form-group">    
                            <label class="col-md-4 control-label">Linkedin*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="linkedin" value="{{ $emp->linkedin }}" >
                            </div>
                        </div>
                        <div class="form-group">    
                            <label class="col-md-4 control-label">Github*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="github" value="{{ $emp->github }}" >
                            </div>
                        </div>

                        
                        
<legend>{{ trans('lang.job')}} {{ trans('lang.detail')}}</legend>

                        <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.join_date')}}*</label>
                            <div class="col-md-6">
                            <div class='input-group date'>
<input type='text'  readonly class="form-control" name="doj2" id="date2" data-provide="datepicker" value="{{ $emp->doj }}" />
  <span class="input-group-addon">
<span class="glyphicon glyphicon-calendar"></span>
</span></div>

                            </div>
                        </div>
                            
<div class="form-group">    
                            <label class="col-md-4 control-label">{{ trans('lang.salary')}}*</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="salary2" value="{{ $emp->salary }}" 
                                readonly >
                                <input type="hidden" class="form-control" name="salary" value="{{ $emp->salary }}" >
 <input type="hidden" class="form-control" name="doj" value="{{ $emp->doj }}" >
 <input type="hidden" class="form-control" name="notes" value="{{ $emp->notes }}" >
 <input type="hidden" class="form-control" name="posting" value="{{ $emp->post_id }}" >
                            </div>
                        </div>  
                            


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?>  class="btn btn-primary">
                                   {{ trans('lang.update')}}
                                </button>
                            </div>
                        </div>
                    </form>
@endforeach
@endif                  
        </div>
    </div>
</div>


@endsection


