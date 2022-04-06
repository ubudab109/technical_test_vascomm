<div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
    <!-- Card-->
    <div class="card card-shadow rounded border-0">
        <div class="card-body p-4"><img src="{{$img}}"
                alt="" class="img-fluid d-block mx-auto mb-3">
            <h5> <a href="#" class="text-dark">{{$productName}}</a></h5>
            <span class="badge badge-pill badge-primary" style="background: #007bff">Rp. {{number_format($price)}}</span>
            <p class="small text-muted font-italic">{{$desc}}</p>
        </div>
        <div class="card-footer">
            <button class="btn btn-success">Detail</button>
        </div>
    </div>
</div>