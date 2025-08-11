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
        <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Reps DataTable  <button class="btn btn-sm btn-success"><a href="{{ route('manager.addRep')}}" class="text-white">Add Rep</a></button></h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="setsubdatatable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>  Name</th>
                          <th> Email </th>
                          <th> Username </th>
                          <th> Phone Number </th>
                           <th> Pending Credits </th> 
                          <th> Action </th>
                       </tr>
                      </thead>
                      <tbody>
                        @foreach($reps as $rep)
                        <tr>
                          <td> {{ $rep->name??'NULL' }} </td>
                          <td> {{ $rep->email??'NULL' }} </td>
                          <td> {{ $rep->username??'NULL' }}</td>
                          <td> {{ $rep->phoneNumber??'NULL' }}</td>
                          <?php 
                           $usersIDs = App\Models\Rep::find($rep->id)->user()->pluck('id')->toArray();
                
                       $Ptransactions = App\Models\pendTransactions::whereIn('user_id',$usersIDs)->orderBy('created_at', 'DESC')->get();
                          ?>
                           <td> {{ $Ptransactions->count()??'0' }} </td> 
                           <td> <button title="edit rep" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-success"><a  class="text-white" href="{{ route('manager.editRep',['rep' => $rep->id  ])}}"><i class="fa fa-edit" aria-hidden="true"></i></a></button>
                           
                          <button title="change rep password" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-warning"><a  class="text-white" href="{{ route('manager.changeRepPassword',['rep' => $rep->id  ])}}"><i class="fa fa-lock" aria-hidden="true"></i></a></button>
                          
                          <button title="delete rep" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-danger"><a  class="text-white" href="/admin/deleteRep/{{ $rep->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                          
                          <button title="pending credit" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-success"><a  class="text-white" href="/admin/RepPtransactions/{{ $rep->id}}"><i class="fa fa-pause-circle" aria-hidden="true"></i></a></button>

                         </td>

                        </tr>

                    @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>  Name</th>
                        <th> Email </th>
                        <th> Username </th>
                        <th> Phone Number </th>
                        <th> Pending Credits </th> 
                        <th> Action </th>
                     </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

@endsection
