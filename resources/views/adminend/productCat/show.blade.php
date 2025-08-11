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

<div class="row">

         <!-- left column -->
         <div class="col-md-12">
           <!-- general form elements -->
           <div class="card card-success">
             <div class="card-header">
              <center> <h2 class="card-title"> Create Bill Category </h2> </center>
             </div>
             <!-- /.card-header -->
             <!-- form start -->
             <form  action="/admin/productcats" method="post">
               @csrf
               <div class="card-body">

                 <div class="form-group">
                   <label for="exampleInputEmail1">Name</label>
                   <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ old('name') }}" >
                 </div>

                 <!--<div class="form-group">-->
                 <!--  <label for="exampleInputEmail1">About</label>-->
                 <!--<textarea name="about" class="form-control" placeholder="about product"></textarea>-->
                 <!--</div>-->

               </div>
               <!-- /.card-body -->

               <div class="card-footer">
                 <button type="submit" class="btn bg-success text-white" ><i class="fa fa-arrow-right"></i> Create</button>
               </div>
             </form>
           </div>
         </div>

           

         </div>

 
    <div class="card">
                  <div class="card-header">
                    <h3 class="card-title"><B>Bill Category Datatable</B> </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="morenikedatatable" class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                  
                      <tr>
                                                <th>id</th>
                                                <th>Name</th>
                                                <!--<th>About</th>-->
                                                <th>Action</th>
                                            </tr>
               
                      </thead>
                    <tbody>

  @foreach($productCats as $key=>$productCat)
                                          <tr>
                                              <th>{{ $key+1}}</th>
                                              <th>{{$productCat->name}}</th>
                                              <!--<th>{{ $productCat->about??'NULL'}}</th>-->
                                              <th><a href="/admin/productcats/{{ $productCat->id }}/edit"><i class="fa fa-edit text-warning"></i></a>

                                                <a href="#" onclick="event.preventDefault();
                                                document.getElementById('deleteForm{{ $productCat->id }}').submit();">
                                                <i class="fa fa-trash text-danger"></i>
                                                <form id="deleteForm{{ $productCat->id }}" action="/admin/productcats/{{ $productCat->id }}" method="POST" style="display: none;">
                                                  @method('delete')
                                                      @csrf
                                                  </form>
                                              </a>

                                              </th>
                                          </tr>
                                          @endforeach

           </tbody>
                      <tfoot>
                   <tr>
                    <th>id</th>
                    <th>Name</th>
                    <!--<th>About</th>-->
                    <th>Action</th>
                </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->


@endsection
