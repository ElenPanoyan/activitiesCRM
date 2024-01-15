<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Admin Panel</title>
    <link href="{{asset('admin/css/styles.css')}}" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet"
          crossorigin="anonymous"/>
    <link rel="icon" type="image/x-icon" href="{{asset('admin/assets/img/favicon.png')}}"/>
    <script data-search-pseudo-elements defer
            src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"
            crossorigin="anonymous"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
    <link rel="stylesheet"
          href="{{asset('admin/css/custom.css')}}">
</head>
<body class="nav-fixed">
<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
     id="sidenavAccordion">
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand" href="#">Admin Panel</a>
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"><i
            data-feather="menu"></i></button>
    <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the md breakpoint-->
    <form class="form-inline mr-auto d-none d-md-block mr-3">
        <div class="input-group input-group-joined input-group-solid">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"/>
            <div class="input-group-append">
                <div class="input-group-text"><i data-feather="search"></i></div>
            </div>
        </div>
    </form>
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ml-auto">
        <!-- Documentation Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block mr-3">
            <div class="dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up"
                 aria-labelledby="navbarDropdownDocs">
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/components"
                   target="_blank">
                    <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="code"></i></div>
                    <div>
                        <div class="small text-gray-500">Components</div>
                        Code snippets and reference
                    </div>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/changelog"
                   target="_blank">
                    <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="file-text"></i></div>
                    <div>
                        <div class="small text-gray-500">Changelog</div>
                        Updates and changes
                    </div>
                </a>
            </div>
        </li>
        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the md breakpoint-->
        <li class="nav-item dropdown no-caret mr-3 d-md-none">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
            <!-- Dropdown - Search-->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up"
                 aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control" type="text" placeholder="Search for..." aria-label="Search"
                               aria-describedby="basic-addon2"/>
                        <div class="input-group-append">
                            <div class="input-group-text"><i data-feather="search"></i></div>
                        </div>
                    </div>
                </form>
            </div>
        </li>
        <!-- Alerts Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block mr-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
               href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"><i data-feather="bell"></i></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownAlerts">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="mr-2" data-feather="bell"></i>
                    Alerts Center
                </h6>
                <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
            </div>
        </li>
        <!-- Messages Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block mr-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages"
               href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"><i data-feather="mail"></i></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownMessages">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="mr-2" data-feather="mail"></i>
                    Message Center
                </h6>
                <a class="dropdown-item dropdown-notifications-footer" href="#!">Read All Messages</a>
            </div>
        </li>
        <!-- User Dropdown-->
        <li class="nav-item dropdown no-caret mr-3 mr-lg-0 dropdown-user">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
               href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
               aria-expanded="false"><img class="img-fluid"
                                          src="{{asset('admin/assets/img/illustrations/profiles/profile-1.png')}}"/></a>
            <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                 aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <img class="dropdown-user-img"
                         src="{{asset('admin/assets/img/illustrations/profiles/profile-1.png')}}"/>
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name">{{ Auth::user()->name }}</div>
                        <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('profile.edit')}}">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">
                    <!-- Sidenav Menu Heading (Account)-->
                    <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                    <div class="sidenav-menu-heading d-sm-none">Account</div>
                    <div class="sidenav-menu-heading">PAGES</div>
                    <!-- Sidenav Accordion (Pages)-->
                    <a class="nav-link "
                       href="{{ Auth::user()->hasRole('super_admin') ? route('users-index') : route('user-activities-list', ['user' => \Illuminate\Support\Facades\Auth::user()]) }}"
                    >
                        <div class="nav-link-icon"><i data-feather="grid"></i></div>
                        {{ Auth::user()->hasRole('super_admin') ? 'Users' : 'Activities' }}
                    </a>
                    <a></a>
                    @if(Auth::user()->hasRole('super_admin'))
                        <a class="nav-link " href="{{ route('activities-index') }}"
                        >
                            <div class="nav-link-icon"><i data-feather="grid"></i></div>
                            Activities
                        </a>
                    @endif
                    <a></a>
                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title">{{Auth::user()->name }}</div>
                </div>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @yield('section')
        </main>
        <footer class="footer mt-auto footer-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 small">Copyright &copy; Your Website 2024</div>
                    <div class="col-md-6 text-md-right small">
                        <a href="#!">Privacy Policy</a>
                        &middot;
                        <a href="#!">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="{{asset('admin/js/scripts.js')}}"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{asset('admin/assets/demo/datatables-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>
<script src="{{asset('admin/assets/demo/date-range-picker-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@stack('scripts-edit')
@stack('scripts-create')
</body>
</html>
