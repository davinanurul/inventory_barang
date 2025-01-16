<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>INVENTORY BARANG - Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('asset/dist/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/dist/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image text-center">
                                <img src="{{ asset('asset/dist/img/login-img.png') }}" alt="Login Image"
                                    style="max-width: 70%; height: auto;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"><strong>Welcome Back!</strong></h1>
                                    </div>
                                    <!-- Login Form -->
                                    <form action="{{ route('login') }}" method="POST" class="user">
                                        @csrf

                                        <!-- Username Input -->
                                        <div class="form-group">
                                            <input type="text" name="user_nama"
                                                class="form-control form-control-user" id="user_nama"
                                                placeholder="Enter Username" value="{{ old('user_nama') }}" required>
                                            @error('user_nama')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Password Input -->
                                        <div class="form-group">
                                            <input type="password" name="user_pass"
                                                class="form-control form-control-user" id="user_pass"
                                                placeholder="Enter Password" required>
                                            @error('user_pass')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <!-- Remember Me Checkbox -->
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>

                                        <!-- Login Button -->
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>

                                    <!-- Forgot Password Link -->
                                    <div class="text-center mt-5">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('asset/dist/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/dist/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('asset/dist/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('asset/dist/js/sb-admin-2.min.js') }}"></script>

</body>

</html>