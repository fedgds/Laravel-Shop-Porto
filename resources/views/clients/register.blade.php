@extends('clients.index')
@section('main')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('index')}}">Home</a></li>
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
                            <h2 class="title">Register</h2>
                        </div>

                        <form action="" method="post">
                            @csrf
                            <label for="register-email">
                                Full name
                                <span class="required">*</span>
                            </label>
                            <input type="text" class="form-input form-wide" id="register-email" name="name" required />

                            <label for="register-email">
                                Email address
                                <span class="required">*</span>
                            </label>
                            <input type="email" class="form-input form-wide" id="register-email" name="email" required />

                            <label for="register-password">
                                Password
                                <span class="required">*</span>
                            </label>
                            <input type="password" class="form-input form-wide" id="register-password" name="password"
                                required />

                            <label for="register-password">
                                Comfirm Password
                                <span class="required">*</span>
                            </label>
                            <input type="password" class="form-input form-wide" id="register-password"
                                required />

                            <div class="form-footer mb-2">
                                <button type="submit" class="btn btn-dark btn-md w-100 mr-0">
                                    Register
                                </button>
                            </div>
                            <div class="text-center mt-2">
                                <a href="{{route('login')}}" class="forget-password text-dark form-footer-right text-center">
                                    Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
    </div>
</main><!-- End .main -->
@endsection