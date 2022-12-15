<div class="card-body">
{{--    <div class="visitor-form-container" style="top:{{$top}};">--}}

{{--        <form action="">--}}
{{--            <h3>Are you sure about delete this product</h3>--}}
{{--            <input wire:click="yes" type="button" value="Yes" class="btn danger">--}}
{{--            <input wire:click="no" type="button" value="No" class="btn no">--}}
{{--            <p for="remember">Please consider your optios.</p>--}}
{{--        </form>--}}

{{--    </div>--}}

    <h5 class="card-title">Table with stripped rows</h5>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Demo image</th>
            <th scope="col">Created at</th>
            <th scope="col">Update at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($prd as $p)
            <tr>
                <th scope="row">{{$p->prd_id}}</th>
                <td>{{$p->name}}</td>
                <td><img src="{{asset('images/'.$p->demoimage)}}" alt=""></td>
                <td>{{$p->created_at}}</td>
                <td>{{$p->updated_at}}</td>
                <td>
                    <a href="#" wire:click="block('{{$p->prd_id}}')" id="deleteprd"><i class="fas fa-trash "></i></a>
                    <a href="{{url('admin/product/'.$p->prd_id)}}"><i class="fas fa-eye "></i></a>
                    <a href="{{url('admin/product/'.$p->prd_id.'/edit')}}"><i class="fas fa-edit "></i></a>
                    <a href="{{url('admin/addbatch/'.$p->prd_id)}}"><i class="fa-solid fa-circle-plus "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>