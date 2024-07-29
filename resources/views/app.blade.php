<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
          <title> {{ $brand }} | {{ trans('lang.hrm')}}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <?php
           $url=Config::get('app.url');
        ?>
        <!-- Place favicon.ico in the root directory -->
        <link href="{{ asset('/admin/css/vendor.css?version=8') }}" rel="stylesheet">

        <!-- Theme initialization -->
       <link href="{{ asset('/admin/css/app-orange.css?version=6') }}" rel="stylesheet">
       
       <link href="{{ asset('/css/custom.css?ver=3') }}" rel="stylesheet">
       <link href="{{ asset('/datetime/css/bootstrap-material-datetimepicker.css?ver=5') }}" rel="stylesheet">

        @yield('styles')    

    </head>
    <body>
        <div class="main-wrapper">
            <div class="app" id="app">
                <header class="header">
                    <div class="header-block header-block-collapse d-lg-none d-xl-none">
                        <button class="collapse-btn" id="sidebar-collapse-btn">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <div class="header-block header-block-buttons">
                        <a href="https://hrmsoftworks.com" class="btn btn-sm header-btn">
                            <i class="fa fa-leaf"></i>
                            <span>Buy Now</span>
                        </a>
                        <a href="https://www.hrmsoftworks.com" class="btn btn-sm header-btn">
                            <i class="fa fa-star"></i>
                            <span>Premium Version</span>
                        </a>
                    </div>
                    <div class="header-block header-block-nav">
                        <ul class="nav-profile">
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{ Config::get('languages')[App::getLocale()] }}
        <!-- {{ app()->getLocale() }} -->
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
    @foreach (Config::get('languages') as $lang => $language)
        @if ($lang != App::getLocale())
                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
        @endif
    @endforeach
    </div>
</li>


                            <li class="profile dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <div class="img" style="background-image: url('https://avatars3.githubusercontent.com/u/3959008?v=3&s=40')">
                                    </div>
                                    <span class="name"> {{ Auth::user()->name }} </span>
                                </a>
                                <div class="dropdown-menu profile-dropdown-menu" aria-labelledby="dropdownMenu1">

                <a class="dropdown-item" href="{{ url('/admin/settings/profile') }}"><i class="fa fa-user icon"></i> {{ trans('lang.profile')}}</a>
                <a class="dropdown-item" href="{{ url('/admin/settings/general') }}"><i class="fa fa-gear icon"></i> {{ trans('lang.general')}} {{ trans('lang.settings')}} </a>
                <a class="dropdown-item" href="{{ url('/admin/settings/system-logs') }}"><i class="fa fa-bell icon"></i> {{ trans('lang.system')}} {{ trans_choice('lang.log',2)}}</a>

                                
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off icon"></i> {{ trans('lang.logout')}} </a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

                                  <!--   <a class="dropdown-item" href="{{ url('/logout') }}"> <i class="fa fa-power-off icon"></i> {{ trans('lang.logout')}} </a> -->
                                </div>
                            </li>
                        </ul>
                    </div>
                </header>
                <aside class="sidebar">
                    <div class="sidebar-container">
                        <div class="sidebar-header">
                            <div class="brand">
                                <div class="logo">
                                    <span class="l l1"></span>
                                    <span class="l l2"></span>
                                    <span class="l l3"></span>
                                    <span class="l l4"></span>
                                    <span class="l l5"></span>
                                </div>{{ $brand }}
                            </div>
                        </div>
                        <nav class="menu">
                            <ul class="sidebar-menu metismenu" id="sidebar-menu">
                                <li class = "{{ set_active('admin/dashboard') }}">
                                    <a href="{{ url('admin/dashboard') }}"> <i class="fa fa-home"></i> {{ trans('lang.dashboard')}}</a>

                                </li>
                                 <li class = "{{ set_active('admin/emp') }}">
                                    <a href="{{ url('admin/emp') }}"> <i class="fa fa-users"></i> {{ trans_choice('lang.employee',2)}} </a>
                                </li>
                                  <li class = "{{ set_active('admin/projects') }}">
                                    <a href="{{ url('admin/projects') }}"> <i class="fa fa-th-large"></i> {{ trans_choice('lang.project',2)}}<i class="fa arrow"></i> </a>
                                    <ul class="sidebar-nav">
                                        <li> <a href="{{ url('admin/projects') }}">
                                        {{ trans_choice('lang.project',2)}}
                                      </a> </li>
                                    </ul>
                                </li>
                                <li class="{{ set_active(['admin/leave', Request::is('admin/leave/*'), 'admin/leave']) }}">
                                    <a href="{{ url('admin/leave') }}"> <i class="fa fa-plane"></i> {{ trans('lang.vacation')}} <span class="label">{{ $leave_count }}</span> <i class="fa arrow"></i> </a>
                                     <ul class="sidebar-nav">
                                        <li> <a href="{{ url('admin/leave') }}">
                    {{ trans('lang.vacation')}}  {{ trans_choice('lang.request',2) }}
                  </a> </li>
                                        <li> <a href="{{ url('admin/leave/report') }}">
                     {{ trans('lang.vacation')}}  {{ trans('lang.report') }}
                  </a> </li>
                  
                                    </ul>
                                </li>
<li class="{{ set_active(['admin/timesheet', Request::is('admin/timesheet/*'), 'admin/timesheet']) }}">
                                    <a href="{{ url('admin/timesheet') }}"> <i class="fa fa-clock-o"></i> {{ trans('lang.timesheet')}} <i class="fa arrow"></i> </a>
                                     <ul class="sidebar-nav">
                                        <li> <a href="{{ url('admin/timesheet/report') }}">
                    {{ trans('lang.timesheet')}} {{ trans('lang.report')}}
                  </a> </li>
                                        <li> <a href="{{ url('admin/timesheet') }}">
                    {{ trans('lang.timesheet')}} {{ trans_choice('lang.log',2)}}
                  </a> </li>
                                    </ul>
                                </li>
                                 <li class="{{ set_active(['admin/attendance', Request::is('admin/attendance/*'), 'admin/attendance']) }}">
                                    <a href="{{ url('admin/attendance') }}"> <i class="fa fa-calendar"></i> {{ trans('lang.attendance')}} <i class="fa arrow"></i> </a>
                                     <ul class="sidebar-nav">
                                        <li> <a href="{{ url('admin/attendance/guests') }}">
                    {{ trans('lang.visitors')}} {{ trans_choice('lang.log',2)}}
                  </a> </li>
                    <li> <a href="{{ url('admin/attendance') }}">
                    {{ trans('lang.attendance')}} {{ trans_choice('lang.log',2)}}
                  </a> </li>
                    <li> <a href="{{ url('admin/attendance/report') }}">
                    {{ trans('lang.attendance')}} {{ trans('lang.report')}}
                  </a> </li>
                  <li> <a href="{{ url('admin/attendance/calendar-view') }}">
                    {{ trans('lang.calendar')}} {{ trans('lang.view')}}
                  </a> </li>
                      </ul>
                  </li>

                                <li class="{{ set_active(['admin/company', Request::is('admin/company/*'), 'admin/company']) }}">
             <a href="{{ url('admin/company/hierarchy') }}"> <i class="fa fa-sitemap"></i> {{ trans('lang.company')}}<i class="fa arrow"></i> </a>
                                     <ul class="sidebar-nav">
                                        <li> <a href="{{ url('admin/company/dept') }}">
                    {{ trans_choice('lang.department',2)}}
                  </a> </li>
                                        <li> <a href="{{ url('admin/company/posting') }}">
                    {{ trans_choice('lang.designation',2)}}
                  </a> </li>

                  <li> <a href="{{ url('admin/company/hierarchy') }}">
                    {{ trans('lang.hierarchy')}} {{ trans('lang.tree')}}
                  </a> </li>
                                    </ul>
                                </li>

                              
                                 <li class="{{ set_active(['admin/payroll', Request::is('admin/payroll/*'), 'admin/payroll']) }}">
                                   <a href="{{ url('admin/payroll/statements') }}"> <i class="fa fa-briefcase"></i> {{ trans('lang.payroll')}}<i class="fa arrow"></i> </a>
                                     <ul class="sidebar-nav">
                                        <li> <a href="{{ url('admin/payroll') }}">
                    {{ trans('lang.generate')}} {{ trans('lang.payroll')}}
                  </a> </li>
                  <li> <a href="{{ url('admin/payroll/statements') }}">
                    {{ trans('lang.salary')}} {{ trans('lang.slips')}}
                  </a> </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                   
                </aside>
                <div class="sidebar-overlay" id="sidebar-overlay"></div>
                <div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
                <div class="mobile-menu-handle"></div>
                

                    @yield('content')

                
                <footer class="footer">
                    <div class="footer-block buttons">
                        <strong>{{ $brand }}</strong>
                    </div>
                    <div class="footer-block author">
                        <ul>
                            <li> created by <a href="https://www.hrmsoftworks.com?ref=demo">HRMSoftworks</a>
                            </li>
                            <li>
                                <a href="{{ url('../Documentation') }}" target="_blank"><i class="fa fa-book icon"></i>{{ trans('lang.documentation')}}</a> 
                            </li>
                        </ul>
                    </div>
                </footer>
               
               
            </div>
        </div>
        <!-- Reference block for JS -->
        <div class="ref" id="ref">
            <div class="color-primary"></div>
            <div class="chart">
                <div class="color-primary"></div>
                <div class="color-secondary"></div>
            </div>
        </div>

         <script src="{{ asset('/admin/js/vendor.js') }}?ver=11"></script>
        <!--<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script> -->

        <script src="{{ asset('/admin/js/app.js') }}?ver=11"></script>
        <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="{{ asset('/datetime/js/bootstrap-material-datetimepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function()
    {

      $('#date').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });

      $('#date2').bootstrapMaterialDatePicker
      ({
        time: false,
        clearButton: true
      });


      $('#time').bootstrapMaterialDatePicker
      ({
        date: false,
        shortTime: false,
        format: 'HH:mm'
      });

      $('#date-format').bootstrapMaterialDatePicker
      ({
        format: 'YYYY-m-d HH:mm'
      //$('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });

      });
      $('#date-fr').bootstrapMaterialDatePicker
      ({
        format: 'YYYY-M-d HH:mm',
        lang: 'fr',
        weekStart: 1,
        cancelText : 'ANNULER',
        nowButton : true,
        switchOnClick : true
      });

      $('#date-end').bootstrapMaterialDatePicker
      ({
        weekStart: 0, format: 'YYYY-MM-D', time: false,
      });

      $('#date-start').bootstrapMaterialDatePicker
      ({
        weekStart: 0, format: 'YYYY-MM-D', time: false, shortTime : true
      }).on('change', function(e, date)
      {
        $('#date-end').bootstrapMaterialDatePicker('setMinDate', date);
      });

       $('#min-date').bootstrapMaterialDatePicker({ format : 'YYYY-m-d', minDate : new Date() });

      //time start, end
      $('#time-end').bootstrapMaterialDatePicker
      ({
        weekStart: 0, format: 'YYYY-MM-D HH:mm'
      });

      $('#time-start').bootstrapMaterialDatePicker
      ({
        weekStart: 0, format: 'YYYY-MM-D HH:mm', shortTime : true
      }).on('change', function(e, date)
      {
        $('#time-end').bootstrapMaterialDatePicker('setMinTime', date);
      });
      $('#min-time').bootstrapMaterialDatePicker({ format : 'YYYY-m-d HH:mm', minDate : new Date() });
      //$('#min-date').bootstrapMaterialDatePicker({ format : 'YYYY-m-d HH:mm', minDate : new Date() });
      $.material.init()
    });
    </script>

    <script src="{{ asset('/js/sortable.js') }}"></script>

           <script>
           $('.tool-tip').tooltip()
           </script>

        @yield('script')
    </body>
</html>