<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>

    <link rel="stylesheet" href="{{ asset('assets/css/metro.all.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    {{-- Custom Stylesheets --}}
    <link rel="stylesheet" href="{{ asset('assets/css/general/general.css') }}">
</head>

<body class="d-flex py-5">
    <div class="card card-width p-10 shadow-large">
        <div class="d-flex flex-column flex-justify-center flex-align-center">
            <div class="img-container fit-cover w-25 m-auto">
                <img src="{{ asset('assets/img/logo1.png') }}" alt="" srcset="">
            </div>
            {{-- @if (session('success'))
                <div>
                    {{ session('success') }}
                </div>
            @endif --}}
            <div class="w-100 m-auto">
                <form class="" action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="form-group mb-4">
                        <label class="" for="form6Example5">Email</label>
                        <input type="email" id="form6Example5" class="" name="email"
                            value="{{ old('email') }}" required />
                        @error('email')
                            <div class="fg-red">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-4">
                        <label class="" for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" class="password-input" name="password" required />
                            <span class="toggle-password" data-target="#password">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="fg-red">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Submit button -->
                    <button type="submit" name="submit" class="primary outline" id="loginBtn">Login</button>
                    <div class="d-flex flex-justify-center  mb-4">
                        {{-- <input class="mr-2" type="checkbox" value="" id="form6Example8" checked /> --}}
                        <a class="" href="{{ route('register') }}"> Don't have an account? </a>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

<script src="{{ asset('assets/js/metro.all.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/self/auth.js') }}"></script>

</html>
