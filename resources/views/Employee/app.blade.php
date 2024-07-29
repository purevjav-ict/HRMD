<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> {{ $brand }} | Employer Self Serve Portal</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <!-- bootstrap 3.0.2 -->
    <link href="{{ asset('temp_new/css/bootstrap.min.css?version=2') }}" rel="stylesheet" type="text/css" />
    <!-- font Awesome -->
    <link href="{{ asset('temp_new/css/font-awesome.css') }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{ asset('/datetime/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('temp_new/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="{{ asset('temp_new/css/morris/morris.css') }}" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="{{ asset('temp_new/css/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
   
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="{{ asset('temp_new/css/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <!-- Theme style -->
    <link href="{{ asset('temp_new/css/style.css?version=13') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->

    @yield('styles')   
      </head>

      <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="#" class="logo">
                {{ $brand }}
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                       
    <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        {{ Config::get('languages')[App::getLocale()] }}
    </a>
    <ul class="dropdown-menu">
        @foreach (Config::get('languages') as $lang => $language)
            @if ($lang != App::getLocale())
                <li>
                    <a href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                </li>
            @endif
        @endforeach
    </ul>
</li>

<?php $rand=rand(1,1000);
?>

@if(count($emps) > 0)
@foreach ($emps as $member)  
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span>{{ $member->name}} <i class="caret"></i></span>
                            </a>
        <ul class="dropdown-menu dropdown-custom dropdown-menu-right">
                <li class="dropdown-header text-center">{{ trans('lang.manage')}}</li>            
                                <li class="divider"></li>
                                    <li>
                                        <a href="{{ URL('/employee/profile') }}">
                                        <i class="fa fa-user fa-fw pull-right"></i>
                                            {{ trans('lang.profile')}}
                                        </a>
                                        <a data-toggle="modal" href="{{ URL('/employee/password') }}">
                                        <i class="fa fa-lock fa-fw pull-right"></i>
                                            {{ trans('lang.password')}}
                                        </a>
                                        </li>

                                        <li class="divider"></li>
                                        <li>
                                            <a href="{{ URL('employee/logout') }}"><i class="fa fa-ban fa-fw pull-right"></i>{{ trans('lang.logout')}}</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>
                <div class="wrapper row-offcanvas row-offcanvas-left">
                    <!-- Left side column. contains the logo and sidebar -->
                    <aside class="left-side sidebar-offcanvas">
                        <!-- sidebar: style can be found in sidebar.less -->
                        <section class="sidebar">
                            <!-- Sidebar user panel -->
                            <div class="user-panel">
                                <div class="pull-left image">

                                    @if($member->photo!="")             
                                    <img src="{{ asset('../uploads/photo/'.$member->photo.'') }}?ver={{ $rand }}" class="img-circle" alt="User Image" />
                                    @else
                                    <img src="{{ asset('images/10.jpg') }}" class="img-circle" alt="User Image" />
                                    @endif
                                </div>

                                <div class="pull-left info">
                                    <p>{{ trans('lang.hello')}}, {{ $member->name }}</p>
                                    <h4><span class="label label-success">{{ $member->post->post}}</span></h4>
                                    @endforeach
                                    @endif

                                    <a href="#"><i class="fa fa-circle text-success"></i>
                                        {{ trans('lang.online')}} </a>
                                </div>
                            </div>
                          
                            <?php
                            $url=request()->route()->uri;
                            // echo $url;
                            // $url=Route::getCurrentRoute()->getPath();
                            ?>                            
                            <ul class="sidebar-menu">
                                <li <?php if($url=="employee/dashboard") echo 'class="active"'; ?> >
                                    <a href="{{ URL('employee/dashboard') }}">
                                        <i class="fa fa-dashboard"></i><span>{{ trans('lang.dashboard')}}</span>
                                    </a>
                                </li>
                                <li <?php if($url=="employee/appointment-letter") echo 'class="active"'; ?> >
                                    <a href="{{ URL('employee/appointment-letter') }}">
                                        <i class="fa fa-file"></i><span>{{ trans('lang.appointment')}} {{ trans('lang.letter')}}</span>
                                    </a>
                                </li>
                               

                                <li <?php if($url=="employee/attendance") echo 'class="active"'; ?> >
                                    <a href="{{ URL('employee/attendance') }}">
                                        <i class="fa fa-calendar"></i><span>{{ trans('lang.attendance')}}</span>
                                    </a>
                                </li>
                                 <li <?php if($url=="employee/timesheet") echo 'class="active"'; ?> >
                                    <a href="{{ URL('employee/timesheet') }}">
                                        <i class="fa fa-clock-o"></i><span>{{ trans('lang.timesheet')}}</span>
                                    </a>
                                </li>
                                <li <?php if($url=="employee/leave") echo 'class="active"'; ?> >
                                    <a href="{{ URL('employee/leave') }}">
                                        <i class="fa fa-road"></i><span>{{ trans('lang.vacation')}}</span>
                                    </a>
                                </li>
                                 <li <?php if($url=="employee/payroll") echo 'class="active"'; ?> >
                                    <a href="{{ URL('employee/payroll') }}">
                                        <i class="fa fa-money"></i><span>{{ trans('lang.payroll')}}</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ URL('employee/logout') }}">
                                        <i class="fa fa-sign-out"></i><span>{{ trans('lang.logout')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </section>
                        <!-- /.sidebar -->
                    </aside>

                    <aside class="right-side">
                       @yield('content')                  
                    </aside>
                    <!-- /.right-side -->

        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

        <!-- jQuery UI 1.10.3 -->
        <script src="{{ asset('temp_new/js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>

        <!-- Bootstrap -->
        <script src="{{ asset('temp_new/js/bootstrap.min.js') }}" type="text/javascript"></script>
        
          <!-- daterangepicker -->
        <script src="{{ asset('temp_new/js/plugins/chart.js') }}" type="text/javascript"></script>

     
        <!-- iCheck -->
        <script src="{{ asset('temp_new/js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
        
        <!-- Director App -->
        <script src="{{ asset('temp_new/js/Director/app.js') }}" type="text/javascript"></script>

        <!-- Director dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('temp_new/js/Director/dashboard.js') }}" type="text/javascript"></script>

<script src="{{ asset('/js/material.js') }}"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="{{ asset('/datetime/js/bootstrap-material-datetimepicker.js') }}"></script>
<script src="{{ asset('temp_new/js/custom.js') }}" type="text/javascript"></script>
@yield('script')
@yield('scripts')

</body>
</html>