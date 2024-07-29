@extends('Employee/app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('lang.appointment')}} {{ trans('lang.letter')}}</h1>
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li>{{ trans('lang.appointment')}} {{ trans('lang.letter')}}</li>

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


                     
@if(count($emps) > 0)
@foreach ($emps as $emp)  
<div class="panel panel-default">
                <div class="panel-body">
                  
<div class="panel panel-default">
<div class="panel-body">
<!-- statement layout -->
<div class="table-responsive" style="align:center">


<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="text-center text-uppercase">{{ $brand }}</h1>
<p class="text-center">
    {{ $add1 }}, {{ $add2 }}, {{ $city }} - {{ $zip}}.
</p>
</div></div>
<hr />
<h2 class="text-center text-uppercase">
    <strong>{{ trans('lang.appointment')}} {{ trans('lang.letter')}}</strong>
</h2>
<br /><br /><br />
<hr />
<br />
<p style="line-height:30px">
<strong>Subject:</strong> Job offer for the position of <mark>{{ $emp->post->post }}</mark> <br /><br /><br />
Respected <strong>{{ $emp->name }}</strong>, <br /><br />
This letter is in regards to the interview that you appeared for the position of {{ $emp->post->post }}. We would like to bring to your notice that you have been selected for the particular position and we are pleased to offer the job to you. <br /><br />
We were looking for a candidate who was responsible and hard working and has the ability to take challenges. We found these qualities in you and so decided to give you the job. Your <mark><strong>date of joining will be : {{ $emp->doj }}</strong></mark>. You will have to report to HR Admin who will be the manager of personnel operations. For the first three months you will be undergoing training and you will be on probation for the first six months during which you are not allowed to take any paid leave.  The company will be paying a <mark><strong>monthly salary of ${{ $emp->salary }}</strong></mark>. <br /><br />

I hope you agree all the terms and conditions and hope to see you on the date of joining.
<br /><br />

Regards,<br />
HR Manager</p>
<h3>{{ $brand }}</h3>
<div class='break'></div>
<br />
 @endforeach
 @endif

        </div>
    </div>
</div>
@endsection
