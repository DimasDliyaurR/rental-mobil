<!DOCTYPE html>
<html>

<head>

    <!-- iCheck -->
    <link rel="stylesheet" href={{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}>
    <!-- JQVMap -->
    <link rel="stylesheet" href={{ asset('plugins/jqvmap/jqvmap.min.css') }}>
    <!-- Theme style -->
    <link rel="stylesheet" href={{ asset('dist/css/adminlte.min.css') }}>
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href={{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}>
    <!-- Daterange picker -->
    <link rel="stylesheet" href={{ asset('plugins/daterangepicker/daterangepicker.css') }}>
    <!-- summernote -->
    <link rel="stylesheet" href={{ asset('plugins/summernote/summernote-bs4.min.css') }}>

    {{-- Bootsrap ICON --}}
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <title>{{ $title }}</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            max-width: 900px;
            margin: auto;
        }
    </style>
</head>

<body>

    @include('layouts-admin.nav')

    @include('layouts-admin.sidebar')

    <div class="content-wrapper">
        <div id='calendar'></div>
    </div>


    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.11/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                themeSystem: "bootstrap5",
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                events: "/get-event",
            })
            calendar.render()
        })
    </script>
    <script src={{ asset('plugins/jquery/jquery.min.js') }}></script>
    <!-- jQuery UI 1.11.4 -->
    <script src={{ asset('plugins/jquery-ui/jquery-ui.min.js') }}></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src={{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}></script>
    <!-- ChartJS -->
    <script src={{ asset('plugins/chart.js/Chart.min.js') }}></script>
    <!-- Sparkline -->
    <script src={{ asset('plugins/sparklines/sparkline.js') }}></script>
    <!-- JQVMap -->
    <script src={{ asset('plugins/jqvmap/jquery.vmap.min.js') }}></script>
    <script src={{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}></script>
    <!-- jQuery Knob Chart -->
    <script src={{ asset('plugins/jquery-knob/jquery.knob.min.js') }}></script>
    <!-- daterangepicker -->
    <script src={{ asset('plugins/moment/moment.min.js') }}></script>
    <script src={{ asset('plugins/daterangepicker/daterangepicker.js') }}></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src={{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}></script>
    <!-- Summernote -->
    <script src={{ asset('plugins/summernote/summernote-bs4.min.js') }}></script>
    <!-- overlayScrollbars -->
    <script src={{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}></script>
    <!-- AdminLTE App -->
    <script src={{ asset('dist/js/adminlte.js') }}></script>
    {{-- Font Awasome Kit --}}
    <script src="https://kit.fontawesome.com/ea0284c37e.js" crossorigin="anonymous"></script>
</body>

</html>
