@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>General Tables</h1>
        </div>

        <section class="section">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">
                        @livewire('prdinorder',['idinvoice'=>$id])
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
