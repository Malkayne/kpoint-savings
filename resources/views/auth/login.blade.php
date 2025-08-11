@extends('layouts.app')

@section('intro')
<section class="intro-single">
  <div class="container">
    <div class="row">
     <div class="col-md-12 col-lg-8">
      <div class="title-single-box">
        <h1 class="title-single">Login</h1>
        <span class="color-text-a"><b>Hello! let's get started with KPOINT</b><br/>Sign in to Continue</span>
      </div>
     </div>
     <div class="col-md-12 col-lg-4">
      <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
        <ol class="breadcrumb">
         <li class="breadcrumb-item">
          <a href="/">Home</a>
         </li>
         <li class="breadcrumb-item">
          <a href="#">KPOINT</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">
          Login
         </li>
        </ol>
      </nav>
     </div>
    </div>
  </div>
</section>
@endsection

@section('bodyContent')

@if ($message = Session::get('greet'))
<div class="row d-flex justify-content-center" style="margin-top:5px">
  <div class="col-md-6">
   <div class="alert alert-success alert-dismissble">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ $message }}
   </div>
  </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="row d-flex justify-content-center" style="margin-top:5px">
  <div class="col-md-6">
   <div class="alert alert-danger alert-dismissble">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ $message }}
   </div>
  </div>
</div>
@endif

<section class="contact">
  <div class="container">
   <div class="row d-flex justify-content-center">
    <div class="col-md-8">
      <form class="form-a" id="myFormId" method="POST" action="{{ route('login.post') }}">
       @csrf
       <div class="col-md-12 mb-3">
        <div class="form-group">
          <input id="username" type="text" class="form-control form-control-lg form-control-a @error('username') is-invalid @enderror" placeholder="Your Username" name="username" value="{{ old('username') }}" autocomplete="username" required>
          @error('username')
           <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
           </span>
          @enderror
        </div>
       </div>
    <div class="col-md-12 mb-3">
  <div class="form-group position-relative">
    <input id="password" type="password" class="form-control form-control-lg form-control-a @error('password') is-invalid @enderror" placeholder="Your Password" name="password" required autocomplete="current-password">
    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"></span>
    @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror
  </div>
</div>


<script>
  document.querySelectorAll('.toggle-password').forEach(function (el) {
    el.addEventListener('click', function () {
      const input = document.querySelector(this.getAttribute('toggle'));
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
  });
</script>

     <div class="col-md-12 mb-3 d-flex justify-content-between align-items-center">
  <a href="{{ route('password.request') }}" class="text-muted" style="font-size: 0.9rem;">
    Forgot Password?
  </a>
</div>

<div class="col-md-12">
  <button type="submit" id="myButtonID" class="btn btn-a">Login Account</button>
</div>

      </form>
    </div>
   </div>
  </div>
</section>

<script type="text/javascript">
$('#myFormId').submit(function(){
  $("#myButtonID", this)
   .html("Sending, Please Wait...")
   .attr('disabled', 'disabled');
  return true;
});
</script>
@endsection
