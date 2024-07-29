@extends('app')

@section('styles')
<style type="text/css">

   .red > li.active > a, .red > li.active > a:focus {
        color: white;
        background-color: #D9534F;
    }

        .red > li.active > a:hover {
            background-color: #D33B36;
            color:white;
        }
.red > li > a{
  color:#D33B36;
}

.box{
  border:1px solid #D7DDE4;
/*  border-radius: 10px;*/
  /*text-align: center; */
  background: white;
  max-width: 300px;
  padding:10px;
  height:100px;
  margin-right: 8px;
  box-shadow: 1px 2px 20px gray;
}
.box .left-side{
width:30%;
float:left;
}
.box .right-side{
width:70%;
float:left;
text-align: right;
}

.box h3{
  font-size: 28px;
}

/*new dashboard boxes*/
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}


.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
    border: none;
    margin-bottom: 30px;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}

.card .card-block {
    padding: 25px;
}

.order-card i {
    font-size: 26px;
}

.f-left {
    float: left;
}

.f-right {
    float: right;
}

</style>
@stop


@section('content')
<article class="content charts-morris-page">
<div class="title-block">
<h3 class="title">{{ trans('lang.dashboard')}}</h3>
                        <p class="title-description"> of {{ trans('lang.hrm')}} </p>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="container">
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-blue order-card">
                <div class="card-block">
                    <h6 class="m-b-20">{{ trans_choice('lang.employee', $employee_count)}} </h6>
                    <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{ $employee_count }}</span></h2>
                    <p class="m-b-0"><span class="f-right">in our team</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-green order-card">
                <div class="card-block">
                    <h6 class="m-b-20">{{ trans_choice('lang.project', $project_count)}}</h6>
                    <h2 class="text-right"><i class="fa fa-rocket f-left"></i><span>{{ $project_count }}</span></h2>
                    <p class="m-b-0"><span class="f-right">completed &amp; ongoing</span></p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-yellow order-card">
                <div class="card-block">
                    <h6 class="m-b-20">{{ trans('lang.payroll')}}</h6>
                    <h2 class="text-right"><i class="fa fa-credit-card f-left"></i><span>{{ $pay_total }}</span></h2>
                    <p class="m-b-0">
                        <span class="f-right">salary distributed</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-xl-3">
            <div class="card bg-c-pink order-card">
                <div class="card-block">
                    <h6 class="m-b-20">{{ trans('lang.timesheet')}} </h6>
                    <h2 class="text-right"><i class="fa fa-clock-o f-left"></i><span>{{ $hours_total }}</span></h2>
                    <p class="m-b-0">
                        <span class="f-right">{{ trans('lang.working')}} {{ trans('lang.hours')}}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
                        </div>
                    </div>

                       <!-- <div class="row">
                            <div class="col-md-12">
                                
                                           <div class="row">
                                            <div class="col-md-3 box">
                                              <div class="left-side">
                                                <h3><i class="fa fa-group fa-2x text-warning"></i></h3>
                                               </div> 
                                               <div class="right-side">
                                                <strong>{{ trans_choice('lang.employee', $employee_count)}} </strong>
                                                <h3>{{ $employee_count }}</h3>
                                               </div> 
                                            </div>

                                            <div class="col-md-3 box">
                                              <div class="left-side">
                                                <h3><i class="fa fa-folder-open-o fa-2x text-success"></i></h3>
                                               </div> 
                                               <div class="right-side">
                                                <strong>{{ trans_choice('lang.project', $project_count)}}</strong>
                                                <h3>{{ $project_count }}</h3>
                                               </div> 
                                            </div>

                                            <div class="col-md-3 box">
                                              <div class="left-side">
                                                <h3><i class="fa fa-money fa-2x text-info"></i></h3>
                                               </div> 
                                               <div class="right-side">
                                                <strong>{{ trans('lang.payroll')}}</strong>
                                                <h3>{{ $pay_total }}</h3>
                                               </div> 
                                            </div>

                                            <div class="col-md-3 box">
                                              <div class="left-side">
                                                <h3><i class="fa fa-clock-o fa-2x text-primary"></i></h3>
                                               </div> 
                                               <div class="right-side">
                                                <strong>{{ trans('lang.timesheet')}} <br /> <small>{{ trans('lang.working')}} {{ trans('lang.hours')}}</small></strong>
                                                <h5>{{ $hours_total }}</h5>

                                               </div> 
                                            </div>
                                          </div>
                                    </div>
                                </div>  -->

                    <div class="clearfix"></div>
                    <br />

                    <section class="example">
                           <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">{{ trans('lang.daily')}} {{ trans('lang.performance')}}</h3> </div>
                                        <section class="example">
                                           <div id="hours-chart"></div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                      </div>
                     
                    </section>

                    
                    <section class="section">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
             {{ trans('lang.top')}} 5 {{ trans_choice('lang.performer', 5)}}
            </h3> </div>
                                        <section class="example">
                                            <div id="top-earners"></div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="card-title-block">
                                            <h3 class="title">
              {{ trans('lang.today')}} {{ trans('lang.attendance')}}
            </h3> </div>
                                        <section class="example">
                                           @foreach($emps as $emp)
<ul class="list-group">
  <li class="list-group-item">
    <span class="badge">{{ $emp->work_in }}
    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></span>
    {{ $emp->emp->name }}
  </li>
</ul>

@endforeach
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    
                   
                </article>
                @section('script')

<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="//cdn.jsdelivr.net/spinjs/1.3.0/spin.min.js"></script>

<script>
Morris.Bar({
  element: 'top-earners',
  data: [
 <?php
if(count($employees) > 0){
foreach ($employees as $emp){
   echo "{ y: '".$emp->emp->name."', a: ".date('H', strtotime($emp->total))." },";
}
}
?>
 
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Worked Hours'],
  barColors: ['#E57B13']
});


Morris.Line({
  element: 'hours-chart',
  data: [
 <?php
if(count($hours_data) > 0){
foreach ($hours_data as $data){
  $value=date('H', strtotime($data->total)).".".date('i', strtotime($data->total));
  $value=floatval($value);
   echo "{ y: '".$data->date."', a: ".$value." },";
}
}
?>  
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Working Hours'],
  lineColors: ['#E57B13']
});

</script>
@stop

@endsection
