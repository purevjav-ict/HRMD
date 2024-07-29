@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans('lang.vacation')}} {{ trans('lang.report')}}
                   </h3>
                                    <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ URL('admin/leave') }}"><i class="fa fa-plane-o"></i> {{ trans('lang.vacation')}} </a></li>
        <li class="breadcrumb-item active">{{ trans('lang.report')}}</li>
      </ol>
</p>
                                </div>
                            </div>
                        </div>
                        <div class="items-search">
                          <form class="form-inline" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/leave/reportprocess') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class='input-group date'>
                            <input type='text' class="form-control boxed rounded-s" name="start" id="date-start" data-provide="datepicker" placeholder="{{ trans('lang.start date')}}" />
                            <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </span></div>
                             <div class='input-group date'>
                            <input type='text' class="form-control boxed rounded-s" name="end" id="date-end" data-provide="datepicker" placeholder="{{ trans('lang.end date')}}" />
                            <span class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                            </span></div>

                               
                 <div class="input-group"> <span class="input-group-btn">
                    <button class="btn btn-secondary rounded-s" type="submit">
                        <i class="fa fa-search"></i> {{ trans('lang.generate')}} {{ trans('lang.report')}}
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
                            <strong>{{ Session('message') }} </strong>
                        </div>
                    @endif

                      @if($data>0)
                       @if(count($employees) > 0)

                <div class="table-responsive">
                  <table class="table table-striped sortable">
                     <thead>
                         <tr>
                            
                            <th>{{ trans_choice('lang.employee',1)}}</th>
                            <th>{{ trans('lang.no_of')}} {{ trans_choice('lang.day',2)}}</th>

                         </tr>
                     </thead>
                     <tbody>
                      @foreach ($employees as $emp)
                     
                           
                            <td><strong>{{ $emp->emp_id }}#</strong> {{ $emp->emp->name }} </td>
                            <td>{{ $emp->duration+1 }} {{ trans_choice('lang.day',($emp->duration+1))}} </td>
                        </tr>
                         @endforeach
                     </tbody>

                     </table>
                 </div>                  
                    @endif
                    @endif
                    </div>
                </article>
              </div>
    </div>
  </div>
</div>
</div></div></div>
@endsection
