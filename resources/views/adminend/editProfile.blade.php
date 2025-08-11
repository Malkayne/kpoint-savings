@extends('adminend.layout')

@section('bodyContent')
<div class="row">
<!-- /.col -->
<div class="col-md-2">
</div>
<div class="col-md-8">
  <div class="card">
    <div class="card-header ">

      <h2>  <li class="nav-item"><a class="text-success" href="#settings" data-toggle="tab">Update Profile</a></li></h2>

    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">

        <!-- /.tab-pane -->

        <div class="active tab-pane" id="settings">
          <form class="form-horizontal" action="{{ route('admin.updateProfile',['adminID' => $adminDetails->id ]) }}" method="POST">
             @csrf
             @method('put')
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="username" id="inputName" value="{{ $adminDetails->username }}" placeholder="Your Surname" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="name" id="inputName" value="{{ $adminDetails->name }}" placeholder="Your Name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail" class="col-sm-2 col-form-label"  >Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="inputEmail" value="{{ $adminDetails->email }}" placeholder="Email" required>
              </div>
            </div>

            <div class="form-group row">
              <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-success">Update</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </div>
  <!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->
<div class="col-md-2">
</div>
</div>

@endSection
