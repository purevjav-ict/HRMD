@extends('Employee/app')
@section('styles')
<link rel="stylesheet" href="https://cdn.oesmith.co.uk/morris-0.4.3.min.css">
<style>
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
</style>
@stop

@section('content')
<div class="container">
<h1>{{ trans('lang.dashboard')}}</h1>

    <div class="row">

        <div class="col-md-12">
         <div class="col-md-4">
             <div class="panel">
        <div class="panel-heading panel-home2">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="glyphicon glyphicon-calendar big" aria-hidden="true"></h1>
                        </div>
                        <div class="col-md-8">
                            <h5>{{ trans('lang.overall')}} {{ trans('lang.attendance')}}</h5>
                            <h4>{{ $tot_days }} {{ trans_choice('lang.day',2)}}</h4>
                        </div>
                        
                    </div>
      </div>
            </div>
            </div>

            <div class="col-md-4">
             <div class="panel">
        <div class="panel-heading panel-home2">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="glyphicon glyphicon-certificate big" aria-hidden="true"></h1>
                        </div>
                        <div class="col-md-8">
                            <h5>{{ trans('lang.salary')}}</h5>
                            <h4>$ {{ $salary }}</h4>
                        </div>
                        
                    </div>
      </div>
            </div>
          </div>
          <div class="col-md-3">
             <div class="panel">
        <div class="panel-heading panel-home2">
                    <div class="row">
                        <div class="col-md-4">
                            <h1 class="glyphicon glyphicon-time big" aria-hidden="true"></h1>
                        </div>
                        <div class="col-md-8">
                            <h5>{{ trans('lang.working')}} {{ trans('lang.hours')}}</h5>
                            <h4>{{ $tot_hours }}</h4>
                        </div>
                        
                    </div>
      </div>
            </div>
          </div>

            </div>

        </div>
<hr />
<div class="row" data-wow-delay="0.6s">
<div class="col-md-11">    
    
                <div class="panel">
                <div class="panel-heading panel-warning">{{ trans('lang.daily')}} {{ trans('lang.performance')}}</div>
            <div class="panel-body">
              <div class="col-md-11">
            <div id="line-example"></div>
          </div>
            </div>
            </div>
    

</div>
</div>

    </div>
@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
Morris.Line({
  element: 'line-example',
  data: [
    <?php
    if(count($hours) > 0){
    foreach ($hours as $hours2){
        foreach ($hours2 as $hour){
        echo "{ y: '".date('Y-m-d', strtotime($hour->start_time))."', a: ".date('i', strtotime($hour->total))." },";
        }
      }
    }
    ?>
  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Minutes'],
  lineColors: ['#E57B13'],
  pointFillColors: ['#643C16']
});

</script>
@stop
@endsection
