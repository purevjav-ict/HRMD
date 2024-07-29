@extends('app')

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
               
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                    {{ trans_choice('lang.designation',2)}} <button type="button" class="btn btn-primary btn-sm rounded-s btn-pill-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-location-arrow"></i> {{ trans('lang.new')}} {{ trans_choice('lang.designation',1)}}</button>
                </h3>
    <p class="title-description"> 
        <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
        <li class="breadcrumb-item active">{{ trans_choice('lang.designation',2)}}</li>
        </ol>
</p>
                                </div>
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


                    @if(count($posting) > 0)
                    <table class="table table-striped sortable">
                    
                     <tbody>
                      @foreach ($posting as $emp)
                      <tr>
                            <td><strong><a href="{{ URL::to('admin/company/posting/edit/' . $emp->id) }}">{{ $emp->post }}</a></strong> <br />
                              <span class="label label-default">{{ $emp->dept->department }}</span></td>
                           <td><h5><i class="fa fa-group"></i> {{ $emp->count }} {{ trans_choice('lang.employee',$emp->count)}}</h5></td>
                            
                        </tr>
                         @endforeach
                     </tbody>

                     </table>
                         <nav class="text-xs-right">
                       {!! str_replace('/?', '?', $posting->render()) !!}
                      </nav>
                    @else
                       <h3>{{ trans('lang.no_data')}}</h3>
                    @endif



                      
                   
                </article>



<!-- new creation -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title" id="myModalLabel"><i class="fa fa-location-arrow"></i> {{ trans('lang.new')}} {{ trans_choice('lang.designation',1)}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
 <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/posting/docreate') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="control-label">{{ trans_choice('lang.designation',1)}}*</label>
                            
                                <input type="text" class="form-control underlined" name="post" value="">
                            
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{ trans_choice('lang.department',1)}}*</label>
                            
 <select class="form-control underlined" name="dept_id">                               
@foreach ($dept as $dep)
  <option value="{{ $dep->id }} ">{{ $dep->department }}</option>
  @endforeach
</select>
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('lang.cancel')}}</button>
        <button type="submit" <?php if(env('APP_DEMO')=='1'){ echo 'disabled'; } ?> class="btn btn-primary"><i class="fa fa-check"></i>
          {{ trans('lang.save')}}</button>
        </form>
      </div>
            
      </div>
      
    </div>
  </div>
</div>

        
    </div>
  </div>
</div>
</div></div></div>
@endsection
