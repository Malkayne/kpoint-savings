@extends('layouts.app')

@section('intro')
<section class="intro-single">
  <div class="container">
    <div class="row">
     <div class="col-md-12 col-lg-8">
      <div class="title-single-box">
        <h1 class="title-single">Forgot Password</h1>
        <span class="color-text-a"><b>Enter your email to receive a reset link</b></span>
      </div>
     </div>
    </div>
  </div>
</section>
@endsection

@section('bodyContent')
<section class="contact">
  <div class="container">
   <div class="row d-flex justify-content-center">
    <div class="col-md-8">
      @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      <form class="form-a" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="col-md-12 mb-3">
          <input type="email" name="email" class="form-control form-control-lg form-control-a" placeholder="Your Email" required>
        </div>
        <div class="col-md-12">
          <button type="submit" class="btn btn-a">Send Reset Link</button>
        </div>
      </form>
    </div>
   </div>
  </div>
</section>
@endsection
