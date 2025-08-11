@extends('adminend.layout')

@section('bodyContent')
<div class="row">
<!-- /.col -->
<div class="col-md-2">
</div>
<div class="col-md-8">
  <div class="card">
    <div class="card-header ">

      <h2>  <li class="nav-item"><a class="text-success" href="#settings" data-toggle="tab">Change Manager Password</a></li></h2>

    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">

        <!-- /.tab-pane -->
        <div class="active tab-pane" id="settings">
          <form class="form-horizontal" action="{{ route('admin.updateManagerPassword',['repID' => $managerDetails->id ]) }}" enctype="multipart/form-data" method="POST">
             @csrf
             @method('put')
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label">New Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" id="inputName"  placeholder="New Password" required>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >Confirm Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control"  name="password_confirmation" id="inputName"  placeholder="Confrim Password" required>
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
