@extends('Employee/app')

@section('script')
<script>
$('#chk1').click(function(event) {
    if(this.checked) {
        $(':checkbox').prop('checked', true);
    } else {
        $(':checkbox').prop('checked', false);
    }
});
</script>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('lang.payroll')}}</h1>
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li>{{ trans('lang.payroll')}} {{ trans('lang.statement')}}</li>

    </ul>
<p class="text-right">

</p>

            
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> {{ trans('lang.manage')}}<br><br>
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
    @if(count($payouts) > 0)

<form role="form" method="POST" action="{{ url('/employee/payroll/salaryslip') }}">
<div class="table-responsive">
                     <table class="table table-hover table-striped sortable">
                     <thead>
                         <tr>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <th></th>
                         <th>{{ trans('lang.paid')}} {{ trans('lang.date')}}</th>
                            <th>{{ trans('lang.basic')}} {{ trans('lang.pay')}}</th>
                            <th>{{ trans('lang.incentive')}}</th>
                            <th>{{ trans('lang.tax')}}(-)</th>
                            <th>{{ trans('lang.deduction')}}(-)</th>
                            <th>{{ trans('lang.net')}}{{ trans('lang.pay')}}</th>
                            <th colspan='2' class="text-center">{{ trans('lang.period')}}</th>
                            <th>{{ trans('lang.trans')}}</th>
                            <th>{{ trans('lang.trans')}} {{ trans('lang.mode')}}</th>
            
                         </tr>
                         <tr class="info">
                          <td colspan="7"></td>
                            <td class="text-center">{{ trans('lang.from')}}</td>
                          <td class="text-center">{{ trans('lang.to')}}</td>
                          <td colspan="2"></td>                         
                         </tr>
                     </thead>
                     <tbody>
<?php
$tot=$tot_inc=$tot_tax=$tot_ded=$tot_net=0;
?>
@foreach ($payouts as $payout)
<?php

$tot=$tot+($payout->pay);
$tot_inc=$tot_inc+($payout->incentive);
$tot_tax=$tot_tax+$payout->tax;
$tot_ded=$tot_ded+$payout->ded;
$tot_net=$tot_net+$payout->net;

?>

                     <tr>
                          <td><input type='checkbox' name='foo[]' id='foo[]' class='foo' value='{{ $payout->id }} '  /></td>
                            <td>{{ $payout->dop }}</td>
                            <td>{{ $payout->pay }}</td>
                            <td>{{ $payout->incentive }}</td>
                            <td>{{ $payout->tax }}</td>
                            <td>{{ $payout->ded }}</td>
                            <td>{{ round($payout->net) }}</td>
                            <td>{{ $payout->period_frm }}</td>
                            <td>{{ $payout->period_to }}</td>
                            <td>{{ $payout->trans_id }}</td>
                            <td>{{ $payout->trans_mode }}</td>
                        </tr>
                         @endforeach
                         </tbody>
                        <thead>
                       <tr class="active">
                          <td colspan="2"><h4>{{ trans('lang.total')}}</h4></td>
                          <td><h4>{{ $tot }}</h4></td>
                          <td><h4>{{ $tot_inc }}</h4></td>
                          <td><h4>{{ $tot_tax }}</h4></td>
                          <td><h4>{{ $tot_ded }}</h4></td>
                          <td><h4>{{ round($tot_net) }}</h4></td>
<td></td><td></td><td></td><td></td>

                        </tr>
</thead>
                     </table>
                     </div>
                     <input name='print' type='submit' id='print' value='Print Salary Slip' class='btn btn-success'>&nbsp;&nbsp;
                     </form>

<input type='checkbox' onClick='toggle(this)' name='chk1' id='chk1' />                      <strong>{{ trans('lang.select_all')}}</strong><br />
{!! str_replace('/?', '?', $payouts->render()) !!}
                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif                
        </div>
    </div>
</div>
@endsection
