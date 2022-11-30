@extends('layout.default')
@section('content')

<main id="main">
    <section class="h-100 h-custom cart" id="cart">
        <!-- login form container  -->

        <div class="container">
            @livewire('takeinfor')
        </div>

        @if(isset($resultCode))
            @livewire('truecart',['resultCode' => $resultCode])
        @else
            @livewire('truecart')
        @endif

      </section>


</main>

@endsection
