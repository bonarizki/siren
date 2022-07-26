<!doctype html>
<html lang="en">

<head>
    <title>Car Rent | @yield('title')</title>
    @include('master.user.include.header')

</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">


    <div class="site-wrap" id="home-section">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>



        <header class="site-navbar site-navbar-target" role="banner">

            <div class="container">
                <div class="row align-items-center position-relative">

                    <div class="col-3 ">
                        <div class="site-logo">
                            <a href="index.html">CarRent</a>
                        </div>
                    </div>

                    <div class="col-9  text-right">


                        <span class="d-inline-block d-lg-none"><a href="#"
                                class="text-white site-menu-toggle js-menu-toggle py-5 text-white"><span
                                    class="icon-menu h3 text-white"></span></a></span>



                        <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                            <ul class="site-menu main-menu js-clone-nav ml-auto ">
                                <li id="home"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                                <li><a href="services.html" class="nav-link">Services</a></li>
                                <li id="cars"><a href="{{ url('cars-rent') }}" class="nav-link">Cars</a></li>
                                <li><a href="about.html" class="nav-link">About</a></li>
                                <li><a href="blog.html" class="nav-link">Login</a></li>
                                <li><a href="contact.html" class="nav-link">Register</a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

        </header>

        @yield('content')

        <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Book Cars</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="car_id" class="form-label">Car ID</label>
                            <input type="text" class="form-control" id="car_id" name="car_id" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="car_name" class="form-label">Car Name</label>
                            <input type="text" class="form-control" id="car_name" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="car_type" class="form-label">Car Type</label>
                            <input type="text" class="form-control" id="car_type" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="car_price" class="form-label">Car Price</label>
                            <input type="text" class="form-control" id="car_price" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="order_days" class="form-label">Order Days</label>
                            <input type="text" class="form-control" id="order_days" >
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

        <footer>
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i
                                    class="icon-heart text-danger" aria-hidden="true"></i> by <a
                                    href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

    </div>

    @include('master.user.include.footer')

    @yield('script')

    <script>
        const showForm = () => {
            $('#modal').modal('show');
        }
    </script>

</body>

</html>
