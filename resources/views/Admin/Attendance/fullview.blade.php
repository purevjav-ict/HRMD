@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.calendar')}} {{ trans('lang.view')}}                    
               </h3>
                                    <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans('lang.calendar')}} {{ trans('lang.view')}}</li>
    </ol>
</p>
                                </div>
                            </div>
                        </div>
                       
                    </div>
 @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong>{{ trans('lang.error')}}<br><br>
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
                                <div class="card card-block">
                                    <div id="calendar"></div>
                                    </div></div></div>
</section>

</article>     
    </div>
  </div>
</div>
</div></div></div>
@endsection


@section('script')
<!-- calendar -->
<link href="{{ asset('calendar/fullcalendar.css') }}" rel="stylesheet" />
<link href="{{ asset('calendar/fullcalendar.print.css') }}" rel="stylesheet" media="print" />
<script src="{{ asset('calendar/lib/moment.min.js') }}"></script>
<script src="{{ asset('calendar/lib/jquery.min.js') }}"></script>
<script src="{{ asset('calendar/fullcalendar.min.js') }}"></script>

<script>
  $(document).ready(function() {
    "use strict";
    $("#calendar").fullCalendar({
      defaultDate: Date(),
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
      <?php
      foreach ($employees as $emp) {
        echo "{
        title: '".$emp->emp->name."',
        start: '".date('Y-m-d', strtotime($emp->work_in))."'
        },";
      }
      ?>     
      ]
    });
  });
</script>
@stop

