<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('img/undraw_rocket.svg') }}" type="image/x-icon">
    <title>Admin : : Login</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url({{ asset("img/login.jpg") }})"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <small>Login</small>
                                    <h1 class="h4 text-gray-900 mb-4">Ticket Pro</h1>
                                    @if (session()->has("error"))
                                    <div class="text-danger">{{ session("error") }}</div>
                                    @endif
                                </div>
                                <form action="{{ route("admin.auth.login") }}" method="post" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email"></label>
                                        @error("email")
                                        <div class="text-danger ml-2">{{ $message }}</div>
                                        @enderror
                                        <input type="email" class="form-control form-control-user"
                                               id="email" name="email" aria-describedby="emailHelp"
                                               placeholder="Email Address" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <label for="password"></label>
                                        @error('password')
                                        <div class="text-danger ml-2">{{ $message }}</div>
                                        @enderror
                                        <input type="password" name="password" class="form-control form-control-user"
                                               id="password" placeholder="Password">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>

                                <table class="table table-sm table-bordered mt-3">
                                    <tr>
                                        <th>Email</th>
                                        <td>admin@gmail.com</td>
                                    </tr>
                                    <tr>
                                        <th>Password</th>
                                        <td>12345</td>
                                    </tr>
                                </table>

                                <p class="text-center mt-5">Copyright &copy; {{ now()->year }} by chanchal.net</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

</body>

</html>
