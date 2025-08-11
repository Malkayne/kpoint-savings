@extends('smyl.layout')

@section('bodyContent')

        <div class="row">

          <div class="col-md-3">
</div>
          <div class="col-md-6">

            <!-- Profile Image -->
            <div class="card card-success card-outline">
              <div class="card-body box-profile">


                <h3 class="profile-username text-center">Wallet Balance</h3>

                <p class="text-muted text-center">( {{auth::user('user')->accNum}} )</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Name</b> <a class="float-right">{{ auth::user('user')->firstName.' '.auth::user('user')->lastName }}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Wallet Balance</b> <a class="float-right"><del>N</del>
                     {{ number_format( auth::user('user')->wallet->amount??'0.00' ) }}
                    </a>
                  </li>

                </ul>

                <a href="{{ route('smyl.transactions' )}}" class="btn btn-success btn-block"><b>Transactions</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


          </div>
          <div class="col-md-6">
</div>
        </div>

        @endsection
