@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                  {{ trans('lang.generate')}} {{ trans('lang.payroll')}}
                  
                </h3>
                                    <p class="title-description"> 
    
    
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item">{{ trans('lang.save')}} {{ trans('lang.payroll')}}</li>

    </ol>
    <p class="text-left">*{{ trans('lang.payroll_info')}}</p>

                                </div>
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
                    </div>


          
            
  <section class="section">
                        <div class="row sameheight-container">
                           
                            <div class="col-md-12">
                                <div class="card card-block sameheight-item">
  @if(count($employee) > 0)
<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/payroll/savedata') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">                                             
<input type="hidden" name="date_start" value="{{ $date_start }} ">
<input type="hidden" name="date_end" value="{{ $date_end }} ">
<input type="hidden" name="count2" value="{{ $count }} ">
                        
<div class="table-responsive">
                     <table class="table table-striped sortable">
                     <thead>
                         <tr>
                           <th>{{ trans_choice('lang.employee',1)}}</th>
                           <th>{{ trans('lang.basic')}} {{ trans('lang.pay')}}</th>
                           <th>{{ trans('lang.working')}} {{ trans_choice('lang.day',2)}}</th>
                           <th>{{ trans('lang.gross')}} {{ trans('lang.pay')}}*</th>
                           <th>{{ trans('lang.incentive')}}</th>
                           <th>{{ trans('lang.tax')}}*</th>
                           <th>{{ trans('lang.deduction')}}*</th>
                           <th>{{ trans('lang.net')}}*</th>
                           <th>{{ trans('lang.trans')}} #</th>
                           <th>{{ trans('lang.trans')}} {{ trans('lang.mode')}}</th>
                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($employee as $emp)
                      <?php
                      $per_day=$allow=$ded=$net=0;
                      $allowed_days=6;
                      $tax1=($tax/100);
                      $ded1=($pf/100);


    
$per_day=round(($emp->emp->salary)/30);
$salary=$per_day*$emp->working_days;
$tax=$salary*$tax1;
$ded=$salary*$ded1;
$net=($salary-($tax-$ded));

            "<br />";
            ?>
                      <td>

                        <input type="hidden" name="emp_id[]" value="{{ $emp->emp_id }} ">

                        <label>{{ $emp->emp->name }}</label>
                      </td>
                      <td>
                        <label>{{ $emp->emp->salary }}</label>
                      </td>
                      <td>
                        <label>{{ $emp->working_days }} </label>
                      </td>
                      <td>
                        <div class="col-sm-9">
                        <input type="text" class="form-control underlined" name='pay[]' value="{{ $salary }}" readonly/>
                      </div>
                      </td>
                      <td>
                        <div class="col-sm-9">
                        <input type="number" class="form-control underlined txt"  name='inc[]' value="" />
                      </div>
                      </td>
                      <td>
                        <div class="col-sm-9">
                        <input type="text" class="form-control underlined"  id="tax[]" name='tax[]' value="{{ $tax }}" readonly />
                      </div>
                      </td>
                      <td>
                        <div class="col-sm-9">
                        <input type="text" class="form-control underlined"  name='ded[]' value="{{ $ded }}" readonly />
                      </div>
                      </td>
                      <td>
                        <div class="col-sm-9">
                        <input type="text" class="form-control underlined"  name='net[]' value="{{ $net }}" readonly />
                      </div>
                      </td>
                      <td>
                        <div class="col-sm-9">
                        <input type="text" class="form-control underlined"  id='trans[]' name='trans[]' value="" />
                      </div>
                      </td>
                      <td>
                        <div class="col-sm-9">
                        <input type="text" class="form-control underlined"  id='trans_txt[]' name='trans_txt[]' value="" />
                      </div>
                      </td>

                      </tr>
                         @endforeach
                     </tbody>
                     
                     </table>
                     <div class="form-group">
              <div class="col-md-12">
                <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary btn-block">
                   {{ trans('lang.save')}}
                </button>
              </div>
            </div>

                 </div>
                       
                     

                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif
                   </div>
                            </div>
                        </div>
                    </section>

      
                        
                    </div>
                  
                   
                </article>
    </div>      
    </div>
    </div>
    </div>
</div></div></div>
@section('script')
<script>
    $(document).ready(function() {
    "use strict";
    //iterate through each textboxes and add keyup
    //handler to trigger sum event
    $(".txt").keyup(function() {
        calculateSum();
    });

  });

  function calculateSum() {
    "use strict";

    var sum = 0;
    //iterate through each textboxes and add the values
    $(".txt").each(function() {

      //add only if the value is number
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }

    });
    //.toFixed() method will roundoff the final sum to 2 decimal places
    $("#sum").html(sum.toFixed(2));
  }
</script>
@stop
@endsection
