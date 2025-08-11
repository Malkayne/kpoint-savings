@extends('managerend.layout')


@section('bodyContent')

<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ App\Models\User::all()->count() }}</h3>

        <p>Users</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ App\Models\Transaction::all()->count() }}</h3>

        <p>Transactions</p>
      </div>
      <div class="icon">
        <i class="fa fa-retweet"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><del>N</del>{{ number_format( App\Models\Wallet::sum('amount')) }}</h3>

        <p>Account Balance</p>
      </div>
      <div class="icon">
        <i class="fas fa-money-bill"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>100</h3>

        <p>Refrencee Code</p>
      </div>
      <div class="icon">
        <i class="fa fa-qrcode"></i>
      </div>
    </div>
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

       <div class="row">

                 <div class="col-md-12">
                   <div class="card">
                     <!-- <div class="card-header">
                       <h3 class="card-title">Bordered Table</h3>
                     </div> -->
                     <!-- /.card-header -->
                     <div class="card-body">
                       <table class="table table-bordered table-striped">
                         <thead class="bg bg-success text-white">
                           <tr>
                             <!-- <th style="width: 10px">#</th> -->
                             <th>Describtion</th>
                             <th colspan="4">Amount</th>
                           </tr>
                         </thead>
                         <tbody>
                           <tr>
                             <!-- <td>1.</td> -->
                             <td>Smyl Wallet Fund</td>

                             <td><del>N</del>{{ number_format(App\Models\Transaction::where('transType','credit')->sum('amount') ) }}</span></td>
                           </tr>

                           <tr>
                             <td>Amount Used From Wallet</td>

                             <td><del>N</del>{{ number_format(App\Models\Transaction::where('transType','debit')->sum('amount') ) }}</span></td>
                           </tr>


                           <tr class="bg bg-success text-white">
                             <td>Total User Balance</td>

                             <td><h5><span style="font-weight:500px"><del>N</del>
                              {{ number_format( App\Models\Wallet::sum('amount')) }}
                             </span></h5></td>
                           </tr>
                         </tbody>
                       </table>
                     </div>

                   </div>
                   </div>
                   <!-- /.card -->

         </div>

@endsection
