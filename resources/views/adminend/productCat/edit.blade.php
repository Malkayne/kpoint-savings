@extends('adminend.layout')

@section('bodyContent')


     <div class="row">
        <div class="col-md-12">
            <div class="card">
                 <div class="card-header">  <h5 class="card-title">Edit Bill Category</h5></div>
                <div class="card-block">
                    <form action="/admin/productcats/{{ $productCat->id }}" method="post" class="form-horizontal">
                      @method('put')
                      @csrf()
                        <div class="row container">
                            <div class="col-md-12">
                                
                                <div class="form-group row margin-top-10">
                                    <div class="col-md-12">
                                        <input type="text" name="name" placeholder="name*" value="{{ $productCat->name }}" class="form-control margin-top-20" required>
                                    </div>
                                </div>
                                
                                <!--<div class="form-group row">-->
                                <!--    <div class="col-md-12">-->
                                <!--    <textarea name="about" rows="7" placeholder="about"  class="form-control">{{ $productCat->about }}</textarea>-->
                                <!--    </div>-->
                                <!--</div>-->

                            </div>
                        </div>

                        <div class="pull-left margin-top-20">

                            <button type="submit" class="btn btn-primary">
                                Update
                                <i class="fa fa-arrow-right position-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
