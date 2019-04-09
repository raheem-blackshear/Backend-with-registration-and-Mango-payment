<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="utf-8" />

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>

        Benvenuto Su Smart Contract System Admin Dashboard

    </title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

    <!--     Fonts and icons     -->

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- CSS Files -->

    <link href="{{ asset('css/material-dashboard.css?v=2.1.1') }}" rel="stylesheet" />

    <!-- CSS Just for demo purpose, don't include it in your project -->

    <link href="{{ asset('demo/demo.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

</head>



<body class="">

<div class="wrapper ">

    <div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('img/sidebar-1.jpg') }}">

        <!--

          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"



          Tip 2: you can also add an image using data-image tag

      -->

        <div class="logo">

            <a href="{{ route('admin-dashboard') }}" class="simple-text logo-normal">

                Benvenuto {{ session()->get('name') }}

            </a>

        </div>

        <div class="sidebar-wrapper">

            <ul class="nav">

                <li class="nav-item {{ session()->get('page_class') }}">

                    <a class="nav-link" href="{{ route('admin-dashboard') }}">

                        <i class="material-icons">dashboard</i>

                        <p>Dashboard</p>

                    </a>

                </li>

                
                <li class="nav-item {{ session()->get('page_class') }}">

                    <a class="nav-link" href="{{ route('category') }}">

                        <i class="material-icons">category</i>

                        <p>Categorie</p>

                    </a>

                </li>

            </ul>

        </div>

    </div>

    <div class="main-panel">

        <!-- Navbar -->

        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">

            <div class="container-fluid">

                <div class="navbar-wrapper">

                    <a class="navbar-brand" href="#">{{ session()->get('page_name') }}</a>

                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">

                    <span class="sr-only">Toggle navigation</span>

                    <span class="navbar-toggler-icon icon-bar"></span>

                    <span class="navbar-toggler-icon icon-bar"></span>

                    <span class="navbar-toggler-icon icon-bar"></span>

                </button>

                <div class="collapse navbar-collapse justify-content-end">

{{--                    <form class="navbar-form">--}}

{{--                        <div class="input-group no-border">--}}

{{--                            <input type="text" value="" class="form-control" placeholder="Search...">--}}

{{--                            <button type="submit" class="btn btn-white btn-round btn-just-icon">--}}

{{--                                <i class="material-icons">search</i>--}}

{{--                                <div class="ripple-container"></div>--}}

{{--                            </button>--}}

{{--                        </div>--}}

{{--                    </form>--}}

                    <ul class="navbar-nav">



                        <li class="nav-item dropdown">

                            <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="material-icons">person</i>

                                <p class="d-lg-none d-md-block">

                                    Account

                                </p>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                                <a class="dropdown-item" href="{{ route('profile', session()->get('id')) }}">Profile</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('admin-logout') }}">Log out</a>

                            </div>

                        </li>

                    </ul>

                </div>

            </div>

        </nav>

        <!-- End Navbar -->

        <div class="content">

            @yield('content')

        </div>

    </div>

</div>

<!--   Core JS Files   -->

<script src="{{ asset('js/core/jquery.min.js') }}"></script>

<script src="{{ asset('js/core/popper.min.js') }}"></script>

<script src="{{ asset('js/core/bootstrap-material-design.min.js') }}"></script>

<script src="{{ asset('js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>

<!-- Plugin for the momentJs  -->

<script src="{{ asset('js/plugins/moment.min.js') }}"></script>

<!--  Plugin for Sweet Alert -->

<script src="{{ asset('js/plugins/sweetalert2.js') }}"></script>

<!-- Forms Validations Plugin -->

<script src="{{ asset('js/plugins/jquery.validate.min.js') }}"></script>

<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->

<script src="{{ asset('js/plugins/jquery.bootstrap-wizard.js') }}"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->

<script src="{{ asset('js/plugins/bootstrap-selectpicker.js') }}"></script>

<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->

<script src="{{ asset('js/plugins/bootstrap-datetimepicker.min.js') }}"></script>

<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->

<script src="{{ asset('js/plugins/jquery.dataTables.min.js') }}"></script>

<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->

<script src="{{ asset('js/plugins/bootstrap-tagsinput.js') }}"></script>

<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->

<script src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}"></script>

<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->

<script src="{{ asset('js/plugins/fullcalendar.min.js') }}"></script>

<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->

<script src="{{ asset('js/plugins/jquery-jvectormap.js') }}"></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->

<script src="{{ asset('js/plugins/nouislider.min.js') }}"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

<!-- Library for adding dinamically elements -->

<script src="{{ asset('js/plugins/arrive.min.js') }}"></script>

<!--  Google Maps Plugin    -->

{{--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>--}}

<!-- Chartist JS -->

<script src="{{ asset('js/plugins/chartist.min.js') }}"></script>

<!--  Notifications Plugin    -->

<script src="{{ asset('js/plugins/bootstrap-notify.js') }}"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->

<script src="{{ asset('js/material-dashboard.js?v=2.1.1') }}" type="text/javascript"></script>


<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</body>

</html>