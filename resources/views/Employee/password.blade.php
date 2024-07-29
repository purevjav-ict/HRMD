@extends('Employee/app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('lang.password')}}</h1>
    <ol class='breadcrumb'>
        <li><a href="{{ URL('employee/dashboard') }}">{{ trans('lang.dashboard')}}</a></li>
                <li>{{ trans('lang.password')}}</li>

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


                     

<div class="panel panel-default">
                <div class="panel-body">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/employee/passupd') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.old')}} {{ trans('lang.password')}}*</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="old_pass" value="" required>
                            </div>
                        </div>
    <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.new')}} {{ trans('lang.password')}}*</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_pass" value="" required>
                            </div>
                        </div>
    <div class="form-group">
                            <label class="col-md-4 control-label">{{ trans('lang.retype')}}*</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="new_pass2" value="" required>
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
        </div>
    </div>
</div>
@endsection
