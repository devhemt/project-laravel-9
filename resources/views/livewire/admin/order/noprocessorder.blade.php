<div class="card-body">
    <h5 class="card-title">Table with stripped rows</h5>
    <div class="row mb-3">
        <label class="col-sm-1 col-form-label">Select:</label>
        <div class="col-sm-3">
            <select wire:model="type" class="form-select" aria-label="Default select example">
                @foreach ($options as $op)
                    @if ($op=='Have account')
                        <option selected="selected" value="{{ $op }}">{{ $op }}</option>
                    @else
                        <option value="{{ $op }}">{{ $op }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

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
        @foreach($order as $p)
            <tr>
                <th scope="row">{{$p->invoice_id}}</th>
                <td>{{$p->name}}</td>
                <td>{{$p->phone}}</td>
                <td>{{$p->created_at}}</td>
                <td>{{$p->updated_at}}</td>
                <td>
                    <a href="#"><i class="fas fa-trash "></i></a>
                    <a href="{{url('admin/order/'.$p->invoice_id)}}"><i class="fas fa-eye "></i></a>
                    <a href="#"><i class="fas fa-edit "></i></a>
                    <a href="#"><i class="fa-solid fa-circle-plus "></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $order->links() }}
</div>
