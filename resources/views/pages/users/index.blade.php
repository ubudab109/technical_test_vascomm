@extends('layouts.main')
@section('content')
<div class="row mt-5">

  <!-- Modal -->
<div class="modal fade" id="detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12 text-center">
            <img src="" id="image-user" alt="" style="clip-path: circle(); width: 50%;" >
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="form-group">
              <label for="name">Fullname</label>
              <input type="text" name="" id="fullname" disabled readonly class="form-control">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="" id="email" disabled readonly class="form-control">
            </div>

            <div class="form-group">
              <label for="role">Role</label>
              <input type="text" name="" id="role" disabled readonly class="form-control">
            </div>

            <div class="form-group">
              <label for="status">Status Register</label>
              <input type="text" name="" id="status" disabled readonly class="form-control">
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3>Data users</h3>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status Register</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{strtoupper($user->role)}}</td>
                <td>{{$user->is_registered ? 'Approved' : 'Not Approved'}}</td>
                <td>
                  <div class="d-flex">
                    @if (!$user->is_registered)
                    <a href="#" data-toggle="tooltip" style="margin-right: 3px" title="Approve Register"
                      onclick="approve('{{$user->id}}')"><i class="bi bi-check2"></i></a>
                    @endif

                    @if ($user->id !== Auth::user()->id)
                      <a href="#" id="reject" data-toggle="tooltip" style="margin-right: 3px" title="Reject or Delete Register"
                      onclick="reject('{{$user->id}}')"><i data-toggle="tooltip"
                          title="Reject" class="bi bi-x"></i></a>
                    @endif

                    <a href="#"><i class="bi bi-sunglasses" onclick="detailUser('{{$user->id}}')" data-toggle="modal" data-target="#detail"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{$users->links()}}
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  function approve(id) {
    var url = "{{route('users.update',':id')}}"
    url = url.replace(':id', id);
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, approve this users!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: url,
          method: 'PUT'
        }).then((res) => {
          Swal.fire(
            'Approved!',
            'User Register Status was Approved.',
            'success'
          );
          window.location.reload();
        })
      }
    })
  }


  function reject(id) {
    var url = "{{route('users.delete',':id')}}"
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
          method: 'PUT'
        }).then((res) => {
          Swal.fire(
            'Success!',
            'User Register Status was Inactive.',
            'success'
          );
          window.location.reload();
        })
      }
    })
  }

  function detailUser(id) {
    var url = "{{route('users.detail',':id')}}"
    url = url.replace(':id', id);
    $.ajax({
      type: 'GET',
      url :url,
    }).then((res) => {
      var data = res.data;

      if (data.profile_pictures === null) {
        $("#image-user").attr('src','https://www.kindpng.com/picc/m/24-248253_user-profile-default-image-png-clipart-png-download.png');
      } else {
        var imgUrl = "{{asset('storage/images/user/'.':data')}}"
        imgUrl = imgUrl.replace(':data', data.profile_pictures);
        $("#image-user").attr('src',imgUrl);

      }
      $("#fullname").val(data.name);
      $("#email").val(data.email);
      $("#role").val(data.role);
      $("#status").val(data.is_registered === 1 ? 'Register Approved' : 'Register Not Approved');
    })
  }
</script>
@endsection