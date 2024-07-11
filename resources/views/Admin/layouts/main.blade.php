<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - @yield("title")</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('/admin/css/sb-admin-2.min.css') }}?v={{time()}}" rel="stylesheet">
    <link href="{{ asset('/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Russo+One&display=swap");

        .loader svg {
            font-family: "Russo One", sans-serif;
            width: 100%; height: 100%;
        }
        .loader svg text {
            animation: stroke 6s infinite alternate;
            stroke-width: 1px;
            stroke: #365FA0;
            font-size: 50px;
        }
        @keyframes stroke {
            0%   {
                fill: rgba(72,138,204,0); stroke: rgba(54,95,160,1);
                stroke-dashoffset: 25%; stroke-dasharray: 0 50%; stroke-width: 2;
            }
            70%  {fill: rgba(72,138,204,0); stroke: rgba(54,95,160,1); }
            80%  {fill: rgba(72,138,204,0); stroke: rgba(54,95,160,1); stroke-width: 3; }
            100% {
                fill: rgba(72,138,204,1); stroke: rgba(54,95,160,0);
                stroke-dashoffset: -25%; stroke-dasharray: 50% 0; stroke-width: 0;
            }
        }

        .wrapper {
            background-color: #00000031;
            backdrop-filter: blur(2px);
            width: 100%;
            height: 100%;
        }

        .loader {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 9999;
            display: none
        }

        #errors {
            position: fixed;
            top: 1.25rem;
            right: 1.25rem;
            display: flex;
            flex-direction: column;
            max-width: calc(100% - 1.25rem * 2);
            gap: 1rem;
            z-index: 99999999999999999999;
        }

        #errors >* {
            width: 100%;
            color: #fff;
            font-size: 1.1rem;
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        #errors .error {
            background: #e41749;
        }
        #errors .success {
            background: #12c99b;
        }

        .dataTables_wrapper  {
            width: max-content;
        }

        .laravel_pagination > nav {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .laravel_pagination > nav svg {
            width: 35px;
            height: 35px;
        }
        .laravel_pagination > nav >div:last-child {
            display: flex;
            flex-direction: column-reverse;
            justify-content: center;
            align-items: center;
            gap: 8px;
        }
        .ar .sidebar{
            padding-right: 0;
            padding-left: 2rem;
            min-width: 270px;
        }
        .ar * {
            text-align: right !important
        }
        .ar .sidebar .nav-item .nav-link {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 8px;
        }
        .ar .sidebar .nav-item .nav-link[data-toggle="collapse"].collapsed::after {
            transform: rotateY(180deg);
        }
        .ar .navbar-nav {
            margin-left: 0 !important;
            margin-right: auto;
        }
        .btn {
            text-align: center !important
        }
    </style>

</head>

<body dir="@lang("config.dir")" id="page-top" class="@lang('config.key')">
    <div id="errors"></div>
    <div class="loader">
        <div class="wrapper">
            <svg>
                <text x="50%" y="50%" dy=".35em" text-anchor="middle">
                    @yield("loading_txt") ...
                </text>
            </svg>
        </div>
    </div>


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">@lang("messages.nav.admin_panel")</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.dashboard')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>@lang("messages.nav.dashboard")</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                @lang("messages.nav.manage_inventory")
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-box"></i>
                    <span>@lang("messages.nav.services_packages")</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.products.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.products.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwos"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-users"></i>
                    <span>@lang("messages.nav.teams")</span>
                </a>
                <div id="collapseTwos" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.teams.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.teams.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoss"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-box"></i>
                    <span>@lang("messages.nav.Appointment_services")</span>
                </a>
                <div id="collapseTwoss" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.appointment_services.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.appointment_services.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#cities"
                    aria-expanded="true" aria-controls="cities">
                    <i class="fas fa-fw fa-globe"></i>
                    <span>@lang("messages.nav.cities")</span>
                </a>
                <div id="cities" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.cities.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.cities.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#regions"
                    aria-expanded="true" aria-controls="cities">
                    <i class="fas fa-fw fa-road"></i>
                    <span>@lang("messages.nav.regions")</span>
                </a>
                <div id="regions" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.regions.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.regions.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#branches"
                    aria-expanded="true" aria-controls="cities">
                    <i class="fas fa-fw fa-map"></i>
                    <span>@lang("messages.nav.branches")</span>
                </a>
                <div id="branches" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.branches.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.branches.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#doctors"
                    aria-expanded="true" aria-controls="cities">
                    <i class="fas fa-fw fa-stethoscope"></i>
                    <span>@lang("messages.nav.doctors")</span>
                </a>
                <div id="doctors" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.doctors.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.doctors.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#consultations"
                    aria-expanded="true" aria-controls="cities">
                    <i class="fas fa-fw fa-laptop-medical"></i>
                    <span>@lang("messages.nav.consultations")</span>
                </a>
                <div id="consultations" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.consultations.show") }}">@lang("messages.nav.preview")</a>
                        <a class="collapse-item" href="{{ route("admin.consultations.add") }}">@lang("messages.nav.add")</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.prescriptions')}}">
                    <i class="fas fa-fw fa-capsules"></i>
                    <span>@lang("messages.nav.Prescriptions")</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.cv')}}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>@lang("messages.nav.jobrequests")</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.comments')}}">
                    <i class="fas fa-fw fa-comment"></i>
                    <span>@lang("messages.nav.comments")</span></a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.users')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>@lang("messages.nav.users")</span></a>
            </li>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('admin.msgs')}}">
                    <i class="fas fa-fw fa-envelope"></i>
                    <span>@lang("messages.nav.com_msgs")</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                @lang("messages.nav.manage_requests")
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#heading3"
                    aria-expanded="true" aria-controls="heading3">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>@lang("messages.nav.orders")</span>
                </a>
                <div id="heading3" class="collapse" aria-labelledby="heading3" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.orders.show.all") }}">@lang("messages.nav.all")</a>
                        <a class="collapse-item" href="{{ route("admin.orders.show.review") }}">@lang("messages.nav.under_review")</a>
                        <a class="collapse-item" href="{{ route("admin.orders.show.confirmed") }}">@lang("messages.nav.confirmed")</a>
                        <a class="collapse-item" href="{{ route("admin.orders.show.completed") }}">@lang("messages.nav.completed")</a>
                        <a class="collapse-item" href="{{ route("admin.orders.show.canceled") }}">@lang("messages.nav.canceled")</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#asdadf"
                    aria-expanded="true" aria-controls="asdadf">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>@lang("messages.nav.appointments")</span>
                </a>
                <div id="asdadf" class="collapse" aria-labelledby="asdadf" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.appointments.show.all") }}">@lang("messages.nav.all")</a>
                        <a class="collapse-item" href="{{ route("admin.appointments.show.review") }}">@lang("messages.nav.under_review")</a>
                        <a class="collapse-item" href="{{ route("admin.appointments.show.confirmed") }}">@lang("messages.nav.confirmed")</a>
                        <a class="collapse-item" href="{{ route("admin.appointments.show.completed") }}">@lang("messages.nav.completed")</a>
                        <a class="collapse-item" href="{{ route("admin.appointments.show.canceled") }}">@lang("messages.nav.canceled")</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#medical_consultations"
                    aria-expanded="true" aria-controls="asdadf">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>@lang("messages.nav.doctor_consultations")</span>
                </a>
                <div id="medical_consultations" class="collapse" aria-labelledby="asdadf" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.medical_consultations.show.all") }}">@lang("messages.nav.all")</a>
                        <a class="collapse-item" href="{{ route("admin.medical_consultations.show.review") }}">@lang("messages.nav.under_review")</a>
                        <a class="collapse-item" href="{{ route("admin.medical_consultations.show.confirmed") }}">@lang("messages.nav.confirmed")</a>
                        <a class="collapse-item" href="{{ route("admin.medical_consultations.show.completed") }}">@lang("messages.nav.completed")</a>
                        <a class="collapse-item" href="{{ route("admin.medical_consultations.show.canceled") }}">@lang("messages.nav.canceled")</a>
                    </div>
                </div>
            </li>
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Visits"
                    aria-expanded="true" aria-controls="Visits">
                    <i class="fas fa-fw fa-receipt"></i>
                    <span>@lang("messages.nav.visits")</span>
                </a>
                <div id="Visits" class="collapse" aria-labelledby="Visits" data-parent="#Visits">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route("admin.visits.show.all") }}">@lang("messages.nav.all")</a>
                        <a class="collapse-item" href="{{ route("admin.visits.show.review") }}">@lang("messages.nav.under_review")</a>
                        <a class="collapse-item" href="{{ route("admin.visits.show.confirmed") }}">@lang("messages.nav.confirmed")</a>
                        <a class="collapse-item" href="{{ route("admin.visits.show.completed") }}">@lang("messages.nav.completed")</a>
                        <a class="collapse-item" href="{{ route("admin.visits.show.canceled") }}">@lang("messages.nav.canceled")</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <div class="d-flex align-items-center" style="gap: 16px">
                            <a href="/locale/@lang("config.switch_key")" class="btn btn-secondary">
                                @lang("config.switch")
                            </a>
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 ml-2 d-none d-lg-inline text-gray-600 small">@lang("nav.hello") Admin!</span>
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset("/admin/img/undraw_profile.svg") }}">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </div>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield("content")
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('/admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('/admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('/admin/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('/admin/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('/admin/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('/admin/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('/admin/vendor/axios/axios.min.js') }}"></script>
    <script src="{{ asset('/admin/vendor/vue/vue.min.js') }}"></script>
    <script>axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');</script>

    @yield("scripts")
</body>

</html>
