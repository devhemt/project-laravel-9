<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div class="p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                    <h6 class="mb-0 text-muted">{{$totalquantity}} items</h6>
                                </div>
                                <hr class="my-4">
                                @if(isset($cart))
                                @foreach($cart as $c)
                                <div class="row mb-4 d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img
                                            src="{{url('images/'.$c['attributes'][0]['image'])}}"
                                            class="img-fluid rounded-3" alt="Cotton T-shirt">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <h6 class="text-muted">{{$c['name']}}</h6>
                                        <h6 class="color">Color:
                                            <div class="color-container">
                                                <div id="colors" class="colors" style="background-color:{{$c['attributes'][0]['color']}};"></div>
                                            </div>
                                        </h6>
                                        <h6 class="size">Size:
                                            <div class="size-container">
                                                <div id="sizes" class="sizes">{{$c['attributes'][0]['size']}}</div>
                                            </div>
                                        </h6>
                                            <h6 class="text-danger">
                                                @if(isset($checked[$c['id']]))
                                                {{$checked[$c['id']]}}
                                                @endif
                                            </h6>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <button wire:click="minus({{$c['id']}})" class="btn btn-link px-2">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <input id="form3" class="quantity" min="0" name="quantity" value="{{$c['quantity']}}" type="number" readonly/>

                                        <button wire:click="plus({{$c['id']}})" class="btn btn-link px-2">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <h6 class="mb-0">$ {{$c['price']}}</h6>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="#!" class="text-muted"><i wire:click="deleteCartItem({{$c['id']}})" class="fas fa-times"></i></a>
                                    </div>
                                </div>

                                <hr class="my-4">
                                @endforeach
                                @endif

                                <div class="pt-5">
                                    <h6 class="mb-0"><a href="{{url('shop')}}" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-grey">
                            <div class="p-5">
                                <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="text-uppercase">{{$totalquantity}} items</h5>
                                    <h5>$ {{$total}}</h5>
                                </div>

                                <h5 class="text-uppercase mb-3">Shipping</h5>

                                <div class="mb-4 pb-2">
{{--                                    <select class="select">--}}
{{--                                        <option value="1">Standard-Delivery- €5.00</option>--}}
{{--                                        <option value="2">Two</option>--}}
{{--                                        <option value="3">Three</option>--}}
{{--                                        <option value="4">Four</option>--}}
{{--                                    </select>--}}
                                    <select wire:model="deliverymethod" class="select">
                                        @foreach ($options as $op)
                                            @if ($op=='Default delivery $5')
                                                <option selected="selected" value="{{ $op }}">{{ $op }}</option>
                                            @else
                                                <option value="{{ $op }}">{{ $op }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <h5 class="text-uppercase mb-3">Give code</h5>

                                <div class="mb-5">
                                    <div class="form-outline">
                                        <input type="text" id="form3Examplea2" class="form-control form-control-lg" />
                                        <label class="form-label" for="form3Examplea2">Enter your code</label>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between mb-5">
                                    <h5 class="text-uppercase">Total price</h5>
                                    <h5>$ {{$totalpl}}</h5>
                                </div>
                                @if($momodirec)
                                    <form method="POST" action="{{ url('admin/invoice') }}">
                                        @csrf
                                        <div class="d-flex justify-content-between mb-5">
                                            <input hidden name="delivery" value="{{$deliverymethod}}">
                                            <input hidden name="amount" value="{{$totalpl}}">
                                            <input type="submit" class="btn btn-info" value="MoMo payment">
                                        </div>
                                    </form>
                                @endif
                                @if(!$momodirec)
                                    <form method="POST" action="">
                                        <div class="d-flex justify-content-between mb-5">
                                            <input wire:click="momonoacc" type="button" class="btn btn-info" value="MoMo payment">
                                        </div>
                                    </form>
                                @endif
                                <button wire:click="register" type="button" class="btn btn-dark btn-block btn-lg"
                                        data-mdb-ripple-color="dark" id="visitor-btn">Cash payment</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
