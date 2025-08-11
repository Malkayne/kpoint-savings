@extends('smyl.layout')

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

  <div class="image d-flex justify-content-center">
          <img src="<?= Auth::user('user')->imgLink?'/public/Images/Users/'.Auth::user('user')->imgLink : '/public/Images/Users/default.jpeg' ?>" class="img-circle elevation-2" width="100px" height="100px" alt="User Image">
        </div>

        <h3 class="profile-username text-center">Profile</h3>

        <p class="text-muted text-center">({{ auth::user('user')->accNum }})</p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Surname</b> <a class="float-right">{{ auth::user('user')->surname }}</a>
          </li>
          <li class="list-group-item">
            <b>First Name</b> <a class="float-right">{{ auth::user('user')->firstName }}</a>
          </li>
          <li class="list-group-item">
            <b>Last Name</b> <a class="float-right">{{ auth::user('user')->lastName }}</a>
          </li>
          <li class="list-group-item">
            <b>Phone Number</b> <a class="float-right">{{ auth::user('user')->phoneNumber }}</a>
          </li>
          <li class="list-group-item">
            <b>Email</b> <a class="float-right">{{ auth::user('user')->email??'NULL' }}</a>
          </li>

          <li class="list-group-item">
            <b>Referral </b> <a class="float-right">{{ Auth::user('user')->rep->name??'NULL' }}</a>
          </li>

          <li class="list-group-item">
            <b>Account Number</b> <a class="float-right">{{ auth::user('user')->accNum }}</a>
          </li>

        </ul>

        <a href="{{ route('smyl.editProfile',['user'=> auth::user('user')->id  ])}}" class="btn btn-success btn-block"><b>Edit Profile</b></a>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->


  </div>
  <div class="col-md-6">
</div>
</div>

@endsection
