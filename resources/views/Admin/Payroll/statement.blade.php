@extends('app')
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
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 class="title">
                    {{ trans('lang.salary')}} {{ trans('lang.slips')}}
                </h3>
<p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.salary')}} {{ trans('lang.slips')}}</li>
        </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                          <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/payroll/statements/filter') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class='input-group date'>
                            <input type='text' class="form-control boxed rounded-s" name="start" data-provide="datepicker" placeholder="{{ trans('lang.start date')}}" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span></div>
                             <div class='input-group date'>
                            <input type='text' class="form-control boxed rounded-s" name="end" data-provide="datepicker" placeholder="{{ trans('lang.end date')}}" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                            </span></div>

                               
                 <div class="input-group"> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="submit">
                        <i class="fa fa-search"></i> {{ trans('lang.filter')}}
                    </button>
                </span> </div> 
                            </form>
                            <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/payroll/statements/search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            
                                <div class="input-group"> <input type="text" name="user" id="user" class="form-control boxed rounded-s" placeholder="Search by Emp ID"> <span class="input-group-btn">
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
                           
                            <div class="col-md-12">
                                <div class="card card-block sameheight-item">
                      @if(count($payouts) > 0)

<form role="form" method="POST" action="{{ url('/admin/payroll/statement-view') }}">
<div class="table-responsive">
                     <table class="table table-hover table-striped sortable">
                     <thead>
                         <tr>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                         <th>
                          <input type='checkbox' onClick='toggle(this)' name='chk1' id='chk1' />
                        </th>
                            <th>{{ trans('lang.paid')}} {{ trans('lang.date')}}</th>
                            <th>{{ trans_choice('lang.employee',1)}}</th>
                            <th>{{ trans('lang.basic')}} {{ trans('lang.pay')}}</th>
                            <th>{{ trans('lang.incentive')}}</th>
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
//$tot_tax=$tot_tax+$payout->tax;
$tot_ded=$tot_ded+($payout->ded+$payout->tax);
$tot_net=$tot_net+$payout->net;

?>

                     <tr>
                          <td><input type='checkbox' name='foo[]' id='foo[]' class='foo' value='{{ $payout->id }} '  /></td>
                            <td><small>{{ $payout->dop }}</small></td>
                            <td>{{ $payout->emp->name }}</td>
                            <td align="right">{{ $payout->pay }}</td>
                            <td align="right">{{ $payout->incentive }}</td>
                            <td align="right">{{ $payout->tax+$payout->ded }}</td>
                            
                            <td align="right">{{ round($payout->net) }}</td>
                            <td><small>{{ $payout->period_frm }}</small></td>
                            <td><small>{{ $payout->period_to }}</small></td>
                            <td>{{ $payout->trans_id }}</td>
                            <td>{{ $payout->trans_mode }}</td>
                        </tr>
                         @endforeach
                         </tbody>
                        <thead>
                       <tr class="active">
                          <td colspan="3"><h4>{{ trans('lang.total')}}</h4></td>
                          <td align="right"><h4>{{ $tot }}</h4></td>
                          <td align="right"><h4>{{ $tot_inc }}</h4></td>
                          <td align="right"><h4>{{ $tot_ded }}</h4></td>
                          <td align="right"><h4>{{ round($tot_net) }}</h4></td>
<td></td><td></td><td></td><td></td>

                        </tr>
</thead>
                     </table>
                     </div>
                     <input name='print' type='submit' id='print' value='Get Salary Slip' class='btn btn-primary'>&nbsp;&nbsp;

                     </form>

<input type='checkbox' onClick='toggle(this)' name='chk1' id='chk1' />                      <strong>{{ trans('lang.select_all')}}</strong><br />
<nav class="text-xs-right">
{!! str_replace('/?', '?', $payouts->render()) !!}
</nav>
                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif
                       
                       </div></div></div>
                     </section>
                    </div>
  </div>
                   
                </article>







@endsection
