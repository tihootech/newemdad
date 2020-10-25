<!DOCTYPE html>
<html lang="fa">
    <head>
        @yield('title')
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{asset('dashboard/css/main.css')}}?v=2.6" />
        <link rel="stylesheet" type="text/css" href="{{asset('css/pdp.css')}}?v=2.4" />
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    </head>
    <body class="app sidebar-mini">

        @include('dashboard.dashheader')
        @include('dashboard.dashaside')

        <main class="app-content">
            @include('partials.errors_and_messages')
            @yield('main')
        </main>
        <!-- Essential javascripts for application to work-->
        <script src="{{asset('dashboard/js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{asset("dashboard/js/jq-ui.js")}}"></script>
        <script src="{{asset('dashboard/js/popper.min.js')}}"></script>
        <script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
        <!-- The javascript plugin to display page loading on top-->
        <script src="{{asset('dashboard/js/plugins/pace.min.js')}}"></script>
        <script src="{{asset("dashboard/js/plugins/sweetalert.min.js")}}"></script>
        <script src="{{asset("dashboard/js/plugins/select2.min.js")}}"></script>
        <script src="{{asset("dashboard/js/cats-treeview.js")}}"></script>
        <script src="{{asset("js/pdp.min.js")}}"></script>
        <script type="text/javascript" src="{{asset('dashboard/js/plugins/chart.js')}}"></script>
        <!-- Page specific javascripts-->
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js" charset="utf-8"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js" charset="utf-8"></script>
        <script src="{{ asset('js/main.js') }}?v=2.5"></script>
        <script src="{{asset('dashboard/js/main.js')}}?v=2.5"></script>
    </body>
</html>
