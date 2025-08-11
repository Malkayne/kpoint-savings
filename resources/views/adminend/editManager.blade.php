@extends('adminend.layout')

@section('bodyContent')
<div class="row">
<!-- /.col -->
<div class="col-md-2">
</div>
<div class="col-md-8">
  <div class="card">
    <div class="card-header ">

      <h2>  <li class="nav-item"><a class="text-success" href="#settings" data-toggle="tab">Update Rep Profile</a></li></h2>

    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">

        <!-- /.tab-pane -->
        <div class="active tab-pane" id="settings">
          <form class="form-horizontal" action="{{ route('admin.updateManagerProfile',['managerID' => $managerDetails->id ]) }}" enctype="multipart/form-data" method="POST">
             @csrf
             @method('put')
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="name" id="inputName" value="{{ $managerDetails->name }}" placeholder="Your Surname" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label" >Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="username" id="inputName" value="{{ $managerDetails->username??'NULL' }}" placeholder="Rep UserName" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control"  name="email" id="inputName" value="{{ $managerDetails->email??'NULL' }}" placeholder="Rep Email" required>
              </div>
            </div>
           
            <div class="form-group row">
              <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
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
