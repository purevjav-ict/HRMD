
@extends('app')

@section('styles')
<style type="text/css">
	tr.cap{
		height:30px;
	}
</style>

@endsection

@section('content')
<article class="content responsive-tables-page">
                    <div class="title-block">
                        <h1 class="title">
		{{ trans('lang.salary')}} {{ trans('lang.statement')}}
	</h1>
                        
                    </div>
                    <section class="section">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                       
                                        <section class="example">
                                            <div class="table-responsive">
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
<div class="float:right">
<h3 class="text-center text-uppercase">{{ trans('lang.salary')}} {{ trans('lang.statement')}}</h3>
<p>
<strong>{{ trans_choice('lang.employee',1)}} {{ trans('lang.name')}}: </strong><span class="text-uppercase"> {{ $payout{$i}{0}->emp->name }} </span> <br />
<strong>{{ trans_choice('lang.designation',1)}}: </strong> {{ $payout{$i}{0}->emp->post->post }}  <br />
<strong>{{ trans('lang.month')}} &amp; {{ trans('lang.year')}}: </strong> {{ date('M, Y', strtotime($payout{$i}{0}->period_frm)) }}  <br />
</p>
</div>
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
<td> {{ $payout{$i}{0}->pay }} </td>
<td><strong>{{ trans('lang.tax')}}</strong></td>
<td> {{ $payout{$i}{0}->tax }} </td></tr>
<tr>
<td><strong>{{ trans('lang.incentive')}}</strong></td>
<td> {{ $payout{$i}{0}->incentive }} </td>
<td><strong>{{ trans('lang.other')}}Other {{ trans('lang.deduction')}}</strong></td>
<td> {{ $payout{$i}{0}->ded }} </td></tr>
<tr class="cap"><td></td><td></td><td></td><td></td></tr>
<tr>
<td><strong>{{ trans('lang.total')}} </strong></td><td>{{ ($payout{$i}{0}->pay+$payout{$i}{0}->incentive) }}</td>
<td><strong>{{ trans('lang.total')}} {{ trans('lang.deduction')}}</strong></td><td>{{ ($payout{$i}{0}->tax+$payout{$i}{0}->ded) }}</td>
</tr>
<tr><td colspan='2'></td>
<td class="active"><strong>{{ trans('lang.net')}} {{ trans('lang.salary')}}</strong></td><td class="active"><strong>{{ round($payout{$i}{0}->net) }} </strong></td></tr>
</table>
<br />
<p class="text-capitalize">
Rupees
<?php $word=App::make("app\Http\Controllers\admin\PayrollController")->int_to_words(round($payout{$i}{0}->net)); ?>
 {{ $word }} only
<p>
<strong>{{ trans('lang.trans')}} {{ trans('lang.mode')}}:</strong> {{ $payout{$i}{0}->trans_mode }} <br />
<strong>{{ trans('lang.trans')}} #:</strong> {{ $payout{$i}{0}->trans_id }} <br />
</p>
<br />
<p><i>{{ trans('lang.thanks')}}, {{ trans('lang.happy_spending')}}</i><p>
<p class="text-right">
<h5>Managing Director</h5>
</p>
<p align='right'><small>{{ trans('lang.computer_gen')}}</small></p>
<br />
<div class='break'></div>
<br />
 @endfor
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </article>
@endsection