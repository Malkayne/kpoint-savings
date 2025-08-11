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
        <div class="row align-items-center justify-content-between">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="card ">
                  <div class="card-header">
                    <h3 class="card-title">Clients DataTable</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive">
                    <table id="setsubdatatable" class="table table-bordered table-stripped" id="dataTable"  width="100%" cellspacing="0">
                      <thead>
                        <tr>

                          <th>  Surname</th>
                          <th> First Name </th>
                          <th> Last Name </th>
                          <th> Phone Number </th>
                          <th> Address </th>
                          <th> Account Number </th>
                           <th> Pending Credits </th> 
                          <th> Referral </th>
                          <th> Action </th>
                       </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td> {{ $user->surname }} </td>
                          <td> {{ $user->firstName }} </td>
                          <td> {{ $user->lastName }}</td>
                          <td> {{ $user->phoneNumber }}</td>
                          <td> {{ $user->address??'Null' }}</td>
                          <td> {{ $user->accNum }}</td>

                    <?php   $Ptransactions = App\Models\pendTransactions::where('user_id',$user->id)->get();
                          ?>
                           <td> {{ $Ptransactions->count()??'0' }} </td>                           <td> {{ $user->rep->name??'NULL' }}</td>
                        </td>
                           <td> <button style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-success"><a class="text-white" href="{{ route('manager.editUser',['user' => $user->id  ])}}"><i class="fa fa-edit" aria-hidden="true"></i></a></button>
                          <button style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-warning"><a class="text-white" href="{{ route('manager.changeUserPassword',['user' => $user->id  ])}}"><i class="fa fa-lock" aria-hidden="true"></i></a></button>
                          <button style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-danger"><a class="text-white" href="/admin/deleteUser/{{ $user->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                           <button title="pending credit" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-success"><a  class="text-white" href="/admin/pendingUserCredit/{{ $user->id}}"><i class="fa fa-pause-circle" aria-hidden="true"></i></a></button>
                         </td>

                        </tr>

                    @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>  Surname</th>
                        <th> First Name </th>
                        <th> Last Name </th>
                        <th> Phone Number </th>
                          <th> Address </th>
                        <th> Account Number </th>
                         <th> Pending Credit </th> 
                        <th> Referral </th>
                        <th> Action </th>
                     </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

              </div>
            </div>

@endsection
