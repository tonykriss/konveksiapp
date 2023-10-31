<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Logout'])

    @include('layouts.shared/head-css', ['mode' => $mode ?? '', 'demo' => $demo ?? ''])
</head>

<body class="authentication-bg">

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-10">
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg">
                                <div class="d-flex flex-column h-100">
                                    <div class="auth-brand p-4">
                                        <a href="" class="logo-light">
                                            <img src="/images/logo.png" alt="logo" height="22">
                                        </a>
                                    </div>
                                    <div class="p-4 my-auto">
                                        <div class="my-auto">
                                            <!-- title-->
                                            <div class="text-center">
                                                <h4 class="mt-0 fs-20">See You Again !</h4>
                                                <p class="text-muted mb-4">You are now successfully sign out.</p>
                                            </div>

                                            <!-- Logout icon -->
                                            <div class="logout-icon m-auto">
                                                <img src="/images/svg/shield.gif" alt="" class="img-fluid">
                                            </div>
                                            <!-- end logout-icon-->
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-dark-emphasis">Back To <a href="{{ route('any', ['login']) }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b>Log In</b></a></p>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt fw-medium">
        <span class="text-dark-emphasis">
            <script>document.write(new Date().getFullYear())</script> © Nustra Studio
        </span>
    </footer>

    @include('layouts.shared/footer-scripts')
</body>

</html>

<script>
    setTimeout(function() {
  window.location.href = "{{ route('any', ['login']) }}"; // Replace with your desired URL
}, 1600); // 2000 milliseconds (2 seconds)
</script>
