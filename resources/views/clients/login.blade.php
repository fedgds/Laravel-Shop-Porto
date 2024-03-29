@extends('clients.index')
@section('main')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="demo4.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="category.html">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            My Account
                        </li>
                    </ol>
                </div>
            </nav>

            <h1>My Account</h1>
        </div>
    </div>

    <div class="container login-container">
                <div class="row justify-content-center">
                    <div class="">
                        <div class="heading mb-1 text-center">
                            <h2 class="title">Login</h2>
                        </div>
                        
                        <form action="" method="post">
                            @csrf
                            <label for="login-email">
                                Username or email address
                                <span class="required">*</span>
                            </label>
                            <input type="email" class="form-input form-wide" id="login-email" name="email" required />

                            <label for="login-password">
                                Password
                                <span class="required">*</span>
                            </label>
                            <input type="password" class="form-input form-wide" id="login-password" name="password" required />

                            @if (session('err'))
                                <div class="text-danger text-center">{{session('err')}}</div>
                            @endif

                            <div class="form-footer">
                                <div class="custom-control custom-checkbox mb-0">
                                    <input type="checkbox" class="custom-control-input" id="lost-password" />
                                    <label class="custom-control-label mb-0" for="lost-password">Remember
                                        me</label>
                                </div>

                                <a href="forgot-password.html" class="forget-password text-dark form-footer-right">Forgot
                                    Password?
                                </a>
                            </div>
                            
                            <button type="submit" class="btn btn-dark btn-md w-100">
                                LOGIN
                            </button>
                            <div class="text-center mt-2">
                                <a href="{{route('register')}}" class="forget-password text-dark form-footer-right text-center">
                                    Register
                                </a>
                            </div>
                            
                        </form>
                    </div>
                </div>
    </div>
</main><!-- End .main -->
@endsection