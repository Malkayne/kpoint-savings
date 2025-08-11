@extends('managerend.layout')

@section('bodyContent')

@if ($message = Session::get('success'))
      <center>
      <div class="row d-flex justify-content-center" style="margin-top:5px">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <div class="alert alert-success alert-dismissble">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ $message }}
          </div>
        </div>
        <div class="col-md-3">
        </div>
      </div>
    </center>
    @endif

    @if ($message = Session::get('error'))
          <center>
          <div class="row d-flex justify-content-center" style="margin-top:5px">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <div class="alert alert-danger alert-dismissble">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $message }}
              </div>
            </div>
            <div class="col-md-3">
            </div>
          </div>
        </center>
        @endif

<div class="row">

  <div class="col-md-3">
</div>
  <div class="col-md-6">

    <!-- Profile Image -->
    <div class="card card-success card-outline">
      <div class="card-body box-profile">

        <h3 class="profile-username text-center">Profile</h3>

        <p class="text-muted text-center">({{ auth::user('admin')->role }})</p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Username</b> <a class="float-right">{{ auth::user('admin')->username }}</a>
          </li>
          <li class="list-group-item">
            <b>Name</b> <a class="float-right">{{ auth::user('admin')->name }}</a>
          </li>

          <li class="list-group-item">
            <b>Email</b> <a class="float-right">{{ auth::user('admin')->email??'NULL' }}</a>
          </li>

        </ul>

        <a href="{{ route('manager.editProfile',['admin'=> auth::user('admin')->id  ])}}" class="btn btn-success btn-block"><b>Edit Profile</b></a>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->


  </div>
  <div class="col-md-6">
</div>
</div>

@endsection
