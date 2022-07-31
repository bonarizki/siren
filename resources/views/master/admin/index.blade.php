<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - @yield('title')</title>
    @include('master.admin.include.header')
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>DASHMIN</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="admin/img/logo.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link" id="dashboard">
                        <i class="fa fa-tachometer-alt me-2"></i>
                        Dashboard
                    </a>
                    <div class="nav-item dropdown" >
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" id="master">
                            <i class="fa fa-laptop me-2"></i>
                            Master
                        </a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ url('type') }}" class="dropdown-item" id="master-type">Master Type</a>
                            <a href="{{ url('brand') }}" class="dropdown-item" id="master-brand">Master Brand</a>
                            <a href="{{ url('cars') }}" class="dropdown-item" id="master-car">Master Car</a>
                            <a href="{{ url('users') }}" class="dropdown-item" id="master-user">Master User</a>
                        </div>
                    </div>
                    <a href="{{ url('orders') }}" class="nav-item nav-link" id="order">
                        <i class="fa fa-tachometer-alt me-2"></i>
                        Order Rental
                    </a>
                </div>
                <div></div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="admin/img/logo.jpg" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a class="dropdown-item" onclick="ChangePass()">Reset Password</a>
                            <a href="{{ url('logout') }}" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            @yield('content')

           


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By AFRIAN DWI WIBOWO
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Modal -->
        <div class="modal fade" id="modalChangePass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="reset-password">
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-12">
                                        <label for="old_pass" class="form-label">Old Password</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password">
                                        <div class="invalid-feedback" id="old_password_alert"></div>

                                    </div>
                                    <div class="col-12">
                                        <label for="pass_1" class="form-label">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password">
                                        <div class="invalid-feedback" id="new_password_alert"></div>
                                    </div>
                                    <div class="col-12">
                                        <label for="pass_2" class="form-label">Re-New Password</label>
                                        <input type="password" class="form-control" id="re-new_password" name="re-new_password">
                                        <div class="invalid-feedback" id="re-new_password_alert"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveNewPass()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    @include('master.admin.include.footer')

    @yield('script')

    <script>
        const ChangePass = () => {
            $('#modalChangePass').modal('show');
        }

        const saveNewPass = () => {
            let data = $('#reset-password').serialize()
            $.ajax({
                type : "POST",
                url : "{{ url('changePass') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : data,
                success : (res) => {
                    sweetSuccess(res.status,res.message)
                    $('#modalChangePass').modal('hide');
                },
                error : (res) => {
                    errorHandle(res)
                },
                
            })
        }
    </script>
</body>

</html>