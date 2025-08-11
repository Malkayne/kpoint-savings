@extends('smyl.layout')

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
          <form class="form-horizontal" action="{{ route('smyl.updateProfile',['userID' => $userDetails->id ]) }}" method="POST">
             @csrf
             @method('put')
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >Surname</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="surname" id="inputName" value="{{ $userDetails->surname }}" placeholder="Your Surname" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >First Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="firstName" id="inputName" value="{{ $userDetails->firstName }}" placeholder="Your First Name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >Last Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="lastName" id="inputName" value="{{ $userDetails->lastName }}" placeholder="Your Last Name" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName" class="col-sm-2 col-form-label"  >Phone Number</label>
              <div class="col-sm-10">
                <input type="text" class="form-control"  name="phoneNumber" id="inputName" value="{{ $userDetails->phoneNumber}}" placeholder="Your Phone Number" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail" class="col-sm-2 col-form-label"  >Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" id="inputEmail" value="{{ $userDetails->email??'NULL' }}" placeholder="Email" >
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName2" class="col-sm-2 col-form-label">Account Number</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="accNum" id="inputName2"  value="{{ $userDetails->accNum }}" required readonly>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputSkills" class="col-sm-2 col-form-label">Referral</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="inputSkills" readonly value="{{ $userDetails->rep->name??'NULL' }}">
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
