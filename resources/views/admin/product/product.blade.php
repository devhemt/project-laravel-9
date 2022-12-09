@extends('layout.defaultadmin')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>General Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">General</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row addpd">
                <div class="col-lg-6">
                        <div class="form-group">
                            <label>Product's Name</label>
                            <input readonly name="prd_name" class="form-control" placeholder="{{$product[0]->name}}">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input readonly name="prd_price" type="number" min="0" class="form-control" placeholder="{{$product[0]->price}}">
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <input readonly name="prd_category" type="text" class="form-control"
                                   value="@if($product[0]->categories == 1)
                            {{'Men'}}
                            @elseif($product[0]->categories == 2)
                            {{'Women'}}
                            @elseif($product[0]->categories == 3)
                            {{'Kid'}}
                            @elseif($product[0]->categories == 4)
                            {{'Accessories'}}
                            @endif
                            ">
                                {{-- categories(1=men,2=women,3=kid,4=accessories) --}}
                        </div>
                        <div class="form-group">
                            <label>Tag</label>
                            <input readonly name="prd_tag" type="text" class="form-control" placeholder="{{$product[0]->tag}}">
                        </div>
                        <div class="form-group">
                            <label>Brand</label>
                            <input readonly name="prd_brand" type="text" class="form-control" placeholder="{{$product[0]->brand}}">
                        </div>
                        <div class="form-group">
                            <label>Provided name</label>
                            <input readonly name="provided_name" type="text" class="form-control" placeholder="{{$product[0]->provided_name}}">
                        </div>
                        <div class="form-group">
                            <label>Provided phone</label>
                            <input readonly name="provided_phone" type="tel" class="form-control" placeholder="{{$product[0]->provided_phone}}">
                        </div>
                        <div class="form-group">
                            <label>Provided address</label>
                            <input readonly name="provided_address" type="text" class="form-control" placeholder="{{$product[0]->provided_address}}">
                        </div>

                </div>

                <div class="col-lg-6">

                    <div class="form-group">
                        <label>Ảnh sản phẩm</label>
                        <div id="view-images">
                            @foreach($images as $i)
                                    <img src="{{asset('images/'.$i->url)}}" alt="Thumb" style="height: 200px; width: 130px">
                            @endforeach
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Mô tả sản phẩm</label>
                        <textarea readonly name="prd_description" class="form-control" rows="3" placeholder="{{$product[0]->description}}"></textarea>
                    </div>

                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label>Cost price:</label>

                        <table class="table" id="my-table">
                            <tbody>
                            @foreach($batch as $b)
                            <tr>
                                <th>Batch</th>
                                <td><input readonly placeholder="{{$b->batch}}" type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Cost</th>
                                <td><input readonly min="0" placeholder="{{$b->cost}}" type="number" class="form-control"></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="form-group">
                        <label>Nature:</label>

                        <table class="table" id="my-table">
                            <tbody>
                            @foreach($properties as $p)
                            <tr>
                                <th>Size</th>
                                <td><input readonly value="{{$p->size}}" type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td><input readonly value="{{$p->color}}" type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Batch</th>
                                <td><input readonly value="{{$p->batch}}" type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td><input readonly min="0" value="{{$p->amount}}" type="number" class="form-control"></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
