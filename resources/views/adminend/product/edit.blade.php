@extends('adminend.layout')

@section('bodyContent')


     
     
      <div class="row">

         <!-- left column -->
         <div class="col-md-12">
           <!-- general form elements -->
           <div class="card card-success">
             <div class="card-header">
              <center> <h2 class="card-title"> Edit Product </h2> </center>
             </div>
             <!-- /.card-header -->
             <!-- form start -->
             <form action="/admin/products/{{ $product->id }}" method="post"  accept-charset="utf-8" enctype="multipart/form-data">
               @method('PUT')
               @csrf()
               <div class="card-body">

                 <div class="form-group">
                   <label for="exampleInputEmail1">Name</label>
                   <input type="text" name="name" placeholder="Product Name*" class="form-control" id="exampleInputEmail1" value="{{ $product->name }}" >
                 </div>


    
                <div class="form-group row">

                              <div class="col-md-12">
                 <label for="exampleInputEmail1">Product Category</label>
                                <select name="productcat_id" required="required" class="form-control">
                                
                                <option selected value="{{ $product->productcat->id }}">{{ $product->productcat->name }}</option>
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
                                   
                                   <input type="number" class="form-control" name="price" value="{{ $product->price }}" required placeholder="price of product" onkeypress="return isNumberKey(event)">
                                   
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

                                
                            </div>
                         
                          <div class="card-footer">
                 <button type="submit" class="btn bg-success text-white float-right" ><i class="fa fa-arrow-right"></i> Submit</button>
               </div>   

               </div>
               <!-- /.card-body -->

              
             </form>
           </div>
         </div>

           

         </div>
 

@endsection
