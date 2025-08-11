@extends('adminend.layout')

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
                    <h3 class="card-title">Managers DataTable  <button class="btn btn-sm btn-success"><a href="{{ route('admin.addManager')}}" class="text-white">Add Manager</a></button></h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="setsubdatatable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>  Name</th>
                          <th> Email </th>
                          <th> Username </th>
                          <th> Action </th>
                       </tr>
                      </thead>
                      <tbody>
                        @foreach($managers as $manager)
                        <tr>
                          <td> {{ $manager->name??'NULL' }} </td>
                          <td> {{ $manager->email??'NULL' }} </td>
                          <td> {{ $manager->username??'NULL' }}</td>
                        
                           <td> <button title="edit manager" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-success"><a  class="text-white" href="{{ route('admin.editManager',['manager' => $manager->id  ])}}"><i class="fa fa-edit" aria-hidden="true"></i></a></button>
                           
                          <button title="change manager password" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-warning"><a  class="text-white" href="{{ route('admin.changeManagerPassword',['manager' => $manager->id  ])}}"><i class="fa fa-lock" aria-hidden="true"></i></a></button>
                          
                          <button title="delete manager" style="padding:5px;margin:10px" class="btn btn-outline btn-sm btn-danger"><a  class="text-white" href="/admin/deleteManager/{{ $manager->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
                          
                         </td>

                        </tr>

                    @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>  Name</th>
                        <th> Email </th>
                        <th> Username </th>
                        <th> Action </th>
                     </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

@endsection
