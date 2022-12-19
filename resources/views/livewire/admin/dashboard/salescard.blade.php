<div class="col-xxl-4 col-md-6">
    <div class="card info-card sales-card">

        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                </li>

                <li><a wire:click="today" class="dropdown-item" href="#">Today</a></li>
                <li><a wire:click="thismonth" class="dropdown-item" href="#">This Month</a></li>
                <li><a wire:click="thisyear" class="dropdown-item" href="#">This Year</a></li>
            </ul>
        </div>

        <div class="card-body">
            <h5 class="card-title">Sales <span>| {{$time}}</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-cart"></i>
                </div>
                <div class="ps-3">
                    <h6>{{$amount}}</h6>
                    <span class="{{$class}} small pt-1 fw-bold">{{$percent}}%</span> <span class="text-muted small pt-2 ps-1">{{$status}}</span>

                </div>
            </div>
        </div>

    </div>
</div>
