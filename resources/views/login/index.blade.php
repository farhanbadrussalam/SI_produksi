<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center mt-2">
            <div class="col-md-4">

                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                    {{ session('success') }}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
                @endif

                @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                    {{ session('loginError') }}
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                </div>
                @endif

                <main class="form-signin w-100 m-auto border rounded shadow p-3">
                    <form action="/" method="POST">
                        @csrf
                        <div class="w-100 text-center">
                            <img class="mb-1" src="{{ asset('image/PT-Sinar-Continental.png') }}" alt="" width="280" height="167">
                        </div>
                        <div class="form-floating mb-3">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control rounded @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback text-lg-start">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control rounded" id="password" placeholder="Password" required>
                        </div>

                        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                    </form>
                </main>
            </div>
        </div>

    </div>
</body>

</html>