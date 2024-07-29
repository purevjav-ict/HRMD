@extends('Employee/app')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('lang.salary')}} {{ trans('lang.statement')}}</h1>
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li>{{ trans('lang.salary')}} {{ trans('lang.statement')}}</li>

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
                  <?php
$count=0;
$count=sizeof($payout);
?>
<div class="panel panel-default">
<div class="panel-body">
<!-- statement layout -->
<div class="table-responsive" style="align:center">
@for ($i = 0; $i < $count ; $i++)

<div class="panel panel-primary">
<div class="panel-heading">
<h1 class="text-center text-uppercase">{{ $brand }}</h1>
<p class="text-center">
    {{ $add1 }}, {{ $add2 }}, {{ $city }} - {{ $zip}}.
</p>
</div></div>
<hr />

<h3 class="text-center text-uppercase"><strong>{{ trans('lang.salary')}} {{ trans('lang.statement')}}</strong></h3>
<p>
<strong>E{{ trans_choice('lang.employee',1)}} {{ trans('lang.name')}}: </strong><span class="text-uppercase"> {{ $payout[$i][0]->emp->name }} </span> <br />
<strong>{{ trans_choice('lang.designation',1)}}</strong> {{ $payout[$i][0]->emp->post->post }}  <br />
<strong>{{ trans('lang.month')}} &amp; {{ trans('lang.year')}}: </strong> {{ date('M, Y', strtotime($payout[$i][0]->period_frm)) }}  <br />
</p>
<br />
<table class="table table-bordered">
<thead>
<tr class="active">
<th>{{ trans('lang.earning')}}</th>
<th></th>
<th>{{ trans('lang.deduction')}}</th>
<th></th>
</tr>
</thead>
<tbody>
<tr>
<td><strong>{{ trans('lang.basic')}} &amp; {{ trans('lang.pay')}}</strong></td>
<td> {{ $payout[$i][0]->pay }} </td>
<td><strong>{{ trans('lang.tax')}}</strong></td>
<td> {{ $payout[$i][0]->tax }} </td></tr>
<tr>
<td><strong>{{ trans('lang.incentive')}}</strong></td>
<td> {{ $payout[$i][0]->incentive }} </td>
<td><strong>{{ trans('lang.other')}}Other {{ trans('lang.deduction')}}</strong></td>
<td> {{ $payout[$i][0]->ded }} </td></tr>
<tr class="cap"><td></td><td></td><td></td><td></td></tr>
<tr>
<td><strong>{{ trans('lang.total')}} </strong></td><td>{{ ($payout[$i][0]->pay+$payout[$i][0]->incentive) }}</td>
<td><strong>{{ trans('lang.total')}} {{ trans('lang.deduction')}}</strong></td><td>{{ ($payout[$i][0]->tax+$payout[$i][0]->ded) }}</td>
</tr>
<tr><td colspan='2'></td>
<td class="active"><strong>{{ trans('lang.net')}} {{ trans('lang.salary')}}</strong></td><td class="active"><strong>{{ round($payout[$i][0]->net) }} </strong></td></tr>
</table>
<br />
<p class="text-capitalize">
Rupees
{{ $words[$i] }} only
<p>
<strong>{{ trans('lang.trans')}} {{ trans('lang.mode')}}:</strong> {{ $payout[$i][0]->trans_mode }} <br />
<strong>{{ trans('lang.trans')}} #:</strong> {{ $payout[$i][0]->trans_id }} <br />
</p>
<br />
<p><i>{{ trans('lang.thanks')}}, {{ trans('lang.happy_spending')}}</i><p>
<p class="text-left">
<strong>HR Manager</strong>
<h3>{{ $brand }} </h3>
</p>
<p align='right'><small>{{ trans('lang.computer_gen')}}</small></p>
<br />
<div class='break'></div>
<br />
 @endfor

</div></div></div>
@endsection
