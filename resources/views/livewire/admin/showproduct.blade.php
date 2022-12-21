<div class="card-body">
    <div class="visitor-form-container" style="top:{{$top}};">

        <form action="">
            <h3>Are you sure about delete this product</h3>
            <input wire:click="yes" type="button" value="Yes" class="btn danger">
            <input wire:click="no" type="button" value="No" class="btn no">
            <p for="remember">Please consider your optios.</p>
        </form>

    </div>

    <div class="row">
        <div class="col-6">
            <h5 class="card-title">Table of products ({{$total}})</h5>
        </div>
        <div class="col-6">
            <a style="float: right" href="{{ url('admin/product/create') }}">
                <h3 class="card-title">Add new product</h3>
            </a>
        </div>
    </div>


    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Demo image</th>
            <th scope="col">Batch new</th>
            <th scope="col">Batch old</th>
            <th scope="col">Created at</th>
            <th scope="col">Update at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
        <tr>
            <th scope="row">{{$p->prd_id}}</th>
            <td>{{$p->name}}</td>
            <td><img src="{{asset('images/'.$p->demoimage)}}" alt=""></td>
            <td>{{$stocklast[$p->prd_id]}} about {{$percentlast[$p->prd_id]}}%</td>
            <td>
                @if(isset($stockfirst[$p->prd_id]))
                {{$stockfirst[$p->prd_id]}} about {{$percentfirst[$p->prd_id]}}%
                @else
                    Don't have
                @endif
            </td>
            <td>{{$p->created_at}}</td>
            <td>{{$p->updated_at}}</td>
            <td>
                <a href="#" wire:click="block('{{$p->prd_id}}')" id="deleteprd" title="Delete product"><i class="fas fa-trash "></i></a>
                <a href="{{url('admin/product/'.$p->prd_id)}}" title="Detail of product"><i class="fas fa-eye "></i></a>
                <a href="{{url('admin/product/'.$p->prd_id.'/edit')}}" title="Edit product"><i class="fas fa-edit "></i></a>
                <a href="{{url('admin/addbatch/'.$p->prd_id)}}" title="Add new batch"><i class="fa-solid fa-circle-plus "></i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>
