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
              <center> <h2 class="card-title"> Create Bill Price </h2> </center>
             </div>
             <!-- /.card-header -->
             <!-- form start -->
             <form  action="/admin/products" method="post" accept-charset="utf-8" enctype="multipart/form-data">
               @csrf
               <div class="card-body">

                 <div class="form-group">
                   <label for="exampleInputEmail1">Name</label>
                   <input type="text" name="name" placeholder="Product Name*" class="form-control" id="exampleInputEmail1" value="{{ old('name') }}" >
                 </div>

                 

                            
              
       <div class="form-group row">

                <div class="col-md-12">
                 <label for="exampleInputEmail1">Product Category</label>
                                <select name="productcat_id" required="required" class="form-control">
                                  <option value="">Select Product/Service Category </option>
                                  @foreach($productCats as $productCat)
                                  <option value="{{ $productCat->id }}">{{ $productCat->name }}</option>
                                @endforeach
                                </select>
                </div>

        </div>          
        
        
        
        <div class="form-group row">
            <div class="col-md-12">
                    <label for="exampleInputEmail1">Product Price</label>

                            <div class="input-group">
                                   <div class="input-group-prepend">
                                     <span class="input-group-text"><del>N</del></span>
                                   </div>
                                   <input type="number" class="form-control" name="price"  required placeholder="price of product" onkeypress="return isNumberKey(event)">
                                   <div class="input-group-append">
                                     <span class="input-group-text">.00</span>
                                   </div>
                                 </div>
                                 <script>
                                 // if( charCode > 38 && ( charCode !=46 && (charCode < 48 || charCode > 57) ) )
                                 function isNumberKey(evt){
                                   var charCode = (evt.which)?evt.which:evt.keyCode
                                   if( charCode > 38 && (charCode < 48 || charCode > 57 ) )
                                   return false;
                                   return true;
                                 }
                                 </script>
  <br/>

               </div>
        </div>

                        
                    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script >
$(function() {
// Multiple images preview with JavaScript
var previewImages = function(input, imgPreviewPlaceholder) {
if (input.files) {
var filesAmount = input.files.length;
for (i = 0; i < filesAmount; i++) {
var reader = new FileReader();
reader.onload = function(event) {
$($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
}
reader.readAsDataURL(input.files[i]);
}
}
};
$('#images').on('change', function() {
previewImages(this, 'div.images-preview-div');
});
});
</script>            
                           

                            </div>
                         
                          <div class="card-footer">
                 <button type="submit" class="btn bg-success text-white float-right" ><i class="fa fa-arrow-right"></i> Create</button>
               </div>   

               </div>
               <!-- /.card-body -->

              
             </form>
           </div>
         </div>

           

         </div>
 

 <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Bill Prices DataTable </h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="morenikedatatable" class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                   <tr>
           <th>Bill Category</th>
             <th>Bill Name</th>
             <th>Bill Price</th>
             <th>Action</th>
         </tr>
               
                      </thead>
                    <tbody>


          @foreach($products as $product)

                                         <tr>
                                      
                                             <td>{{ $product->productcat->name }}</td>
                                             <!-- <td></td> -->
                                             <td>{{ $product->name }}</td>
                                            
                                             <td><s>N</s>{{ number_format($product->price) }}</td>
                                             
                                             <td><a href="/admin/products/{{ $product->id }}/edit"><i class="fa fa-edit text-warning"></i></a>

                                               <a href="#" onclick="event.preventDefault();
                                               document.getElementById('deleteForm{{ $product->id }}').submit();">
                                               <i class="fa fa-trash text-danger"></i>
                                               <form id="deleteForm{{ $product->id }}" action="/admin/products/{{ $product->id }}" method="POST" style="display: none;">
                                                 @method('delete')
                                                     @csrf
                                                 </form>
                                             </a>

                                             </td>
                                         </tr>

                                         @endforeach

           </tbody>
                      <tfoot>
                 <tr>
           <th>Bill Category</th>
             <th>Bill Name</th>
             <th>Bill Price</th>
             <th>Action</th>
         </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->




 
@endsection