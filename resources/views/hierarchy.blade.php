@extends('app')

@section('styles')
<style type="text/css">
  .tree ul {
  padding-top: 20px; position: relative;

  
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
}

.tree li {
  float: left; text-align: center;
  list-style-type: none;
  position: relative;
  padding: 20px 5px 0 5px;
  
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
  content: '';
  position: absolute; top: 0; right: 50%;
  border-top: 1px solid #ccc;
  width: 50%; height: 20px;
}
.tree li::after{
  right: auto; left: 50%;
  border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
  display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
  border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
  border-right: 1px solid #ccc;
  border-radius: 0 5px 0 0;
  -webkit-border-radius: 0 5px 0 0;
  -moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
  border-radius: 5px 0 0 0;
  -webkit-border-radius: 5px 0 0 0;
  -moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
  content: '';
  position: absolute; top: 0; left: 50%;
  border-left: 1px solid #ccc;
  width: 0; height: 20px;
}

.tree li a{
  border: 1px solid #ccc;
  background: white;
  padding: 5px 10px;
  text-decoration: none;
  color: #666;
  font-size: 16px;
  display: inline-block;
  
  border-radius: 5px;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
  -moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
  background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
  border-color:  #94a0b4;
}
</style>

@endsection

@section('content')
  <article class="content items-list-page">
                    <div class="title-search-block">
                
                        <div class="title-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="title">
                  {{ trans('lang.hierarchy')}} {{ trans('lang.tree')}}
                  
                </h3>
                                    <p class="title-description"> 
    
    
    <ol class='breadcrumb'>
        <li class="breadcrumb-item"><a href="{{ URL('admin/dashboard') }}"><i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a></li>
         <li> {{ trans('lang.hierarchy')}} {{ trans('lang.tree')}}</a></li>
        

    </ul>
</p>
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
                               
<div class="tree">
  <ul>
    <li>
      <a href="#">Top Level Management</a>
      <ul>
         @foreach($depts as $dept)
            <li><a href="#">{{ $dept->department }}</a>
              <ul>
              @foreach($array as $arr)
        @foreach ($arr as $arr2)
              @if($arr2->dept_id==$dept->id)
            <li><a href="#">{{ $arr2->post }}</a> </li>
              @endif
              @endforeach
              @endforeach
              </ul>
            </li>
            @endforeach
        </ul>
    </li>
</ul>
</div>                            </div>
                            
                        </div>
                    </section>
                    </div>
                </article>
    </div>      
    </div>
    </div>
    </div>
</div></div></div>
@endsection
