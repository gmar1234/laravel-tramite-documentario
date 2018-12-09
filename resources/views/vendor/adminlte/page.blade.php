@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/pace.min.css')}}">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper">

        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                            {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
            @else
            <!-- Logo -->
            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                </a>
            @endif
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">

                              <!--  INICIO DE ALERTA ALQUILERE -->
                    <li class="dropdown tasks-menu" data-toggle="tooltip" data-placement="bottom" data-original-title="Notificaciones">
                        <a href="#" class="dropdown-toggle" style="font-size: 25px;"  data-toggle="dropdown" aria-expanded="false">
                          <i class="fa fa-bell-o"></i>
                          <?php $cont=0 ?>
                          @foreach ($do as $do)
                            @if ($do->areas_id ==auth()->user()->areas_id)
                              <?php $cont++ ?>
                            @endif

                          @endforeach
                          <span class="label label-danger" style="font-size: 12px;">{{$cont}}</span>
                        </a>
                        <ul class="dropdown-menu">
                          <li class="header">Notificaciones</li>
                          <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                              @foreach ($dom as $doc)
                                @if ($doc->areas_id ==auth()->user()->areas_id)
                                  <li style="background: #ffbcb4;">
                                         <a href="{{route('documento.detalleindex',[$doc->id])}}">
                                            <h3>
                                               TREMITE NUEVO {{$doc->codigo}}
                                            </h3>
                                          </a>
                                    </li>
                                @endif

                              @endforeach

                            </ul>
                          </li>
                        </ul>
                      </li>

                      <li class="dropdown user user-menu">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="/img/avatar/{{auth()->user()->imagen}}" class="user-image" alt="Imagen de Usuario">
                            <span class="hidden-xs">{{auth()->user()->name}}</span>
                          </a>
                          <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                              <img src="/img/avatar/{{auth()->user()->imagen}}" class="img-circle" alt="Imagen de Usuario">
                              <p>
                                {{auth()->user()->name}}
                                <small>Fecha de registro {{auth()->user()->created_at}}</small>
                              </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                              <div class="pull-left">
                                <a href="{{route('user.detallesindex',[Auth::user()->id])}}" class="btn btn-default btn-flat">Perfil</a>
                              </div>
                              <div class="pull-right">
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" class="btn btn-default btn-flat">Salir</a>
                              </div>
                            </li>
                          </ul>
                        </li>

                        <li>
                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                            @else
                                <a href="#"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                >
                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                    @if(config('adminlte.logout_method'))
                                        {{ method_field(config('adminlte.logout_method')) }}
                                    @endif
                                    {{ csrf_field() }}
                                </form>
                            @endif
                        </li>
                    </ul>
                </div>
                @if(config('adminlte.layout') == 'top-nav')
                </div>
                @endif
            </nav>
        </header>

        @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <div class="user-panel" style="height: 70px;">
                      <div class="pull-left info" style="left: 0px">
                        <p>{{ auth()->user()->name }}</p>
                        <a href="#"> {{ auth()->user()->area->nombre}}</a>
                      </div>
                    </div>
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>
        @endif

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
            <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
            </div>
            <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- ./wrapper -->
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/pace.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });

          $(document).ajaxStart(function() { Pace.restart(); });
    </script>
    @stack('js')
    @yield('js')
@stop
