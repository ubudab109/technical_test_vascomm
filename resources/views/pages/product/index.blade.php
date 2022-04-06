@extends('layouts.main')
@section('content')
<div class="row mt-5">

  <!-- Modal -->
  <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('product.store')}}" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail" onchange="showName()">
                    <label class="custom-file-label" id="thumbnail-label" for="customFile">Choose file</label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" name="name" id="fullname" class="form-control">
                </div>

                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="number" name="price" id="price" class="form-control">
                </div>

                <div class="form-group">
                  <label for="role">Description</label>
                  <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3>Data Product</h3>
      </div>
      <div class="card-body">
        <div class="col-6 text-left mb-5">
          <button class="btn btn-primary" data-toggle="modal" data-target="#add">Add Product</button>
        </div>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
              <tr>
                <td>
                  <img src="{{asset('storage/images/product/'.$product->thumbnail)}}" alt="" style="width: 50%">
                </td>
                <td>{{$product->name}}</td>
                <td>Rp. {{number_format($product->price)}}</td>
                <td>{{$product->description}}</td>
                <td>
                  <div class="d-flex">
                    <a href="#" id="reject" data-toggle="tooltip" style="margin-right: 3px"
                      title="Reject or Delete Register" onclick="destroy('{{$product->id}}')"><i data-toggle="tooltip"
                        title="Delete" class="bi bi-x"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{$products->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  function destroy(id) {
    var url = "{{route('product.delete',':id')}}"
    url = url.replace(':id', id);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url,
          method: 'DELETE'
        }).then((res) => {
          Swal.fire(
            'Success!',
            'Product Deleted Successfully.',
            'success'
          );
          window.location.reload();
        })
      }
    })
  }

  function showName () {
    var name = document.getElementById('thumbnail'); 
    $("#thumbnail-label").text(name.files.item(0).name);
  };

</script>
@endsection