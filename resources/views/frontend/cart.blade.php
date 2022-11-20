@extends('layout.default')
@section('content')

<main id="main">
    <section class="h-100 h-custom cart" id="cart">
        <!-- login form container  -->

        <div class="container">
            <div class="visitor-form-container">

                <i class="fas fa-times" id="form-close"></i>

                <form action="">
                    <h3>login</h3>
                    <input type="email" class="box" placeholder="enter your email">
                    <input type="password" class="box" placeholder="enter your password">
                    <input type="submit" value="login now" class="btn">
                    <p for="remember">remember me</p>
                </form>

            </div>
        </div>

        @livewire('cart')
      </section>


</main>

@endsection
