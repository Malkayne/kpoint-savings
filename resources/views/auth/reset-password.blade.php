@extends('layouts.app')

@section('intro')
<section class="intro-single">
  <div class="container">
    <div class="row">
     <div class="col-md-12 col-lg-8">
      <div class="title-single-box">
        <h1 class="title-single">Reset Password</h1>
        <span class="color-text-a"><b>Set a new password for your account</b></span>
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
      <form class="form-a" method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        
        <div class="col-md-12 mb-3">
          <input type="email" name="email" class="form-control form-control-lg form-control-a" placeholder="Your Email" required>
        </div>

        {{-- New Password --}}
        <div class="col-md-12 mb-3 position-relative">
          <input type="password" name="password" id="new-password" class="form-control form-control-lg form-control-a" placeholder="New Password" required>
          <span toggle="#new-password" class="toggle-password" style="position:absolute; right:15px; top:12px; cursor:pointer;">👁️</span>
        </div>

        {{-- Confirm Password --}}
        <div class="col-md-12 mb-3 position-relative">
          <input type="password" name="password_confirmation" id="confirm-password" class="form-control form-control-lg form-control-a" placeholder="Confirm Password" required>
          <span toggle="#confirm-password" class="toggle-password" style="position:absolute; right:15px; top:12px; cursor:pointer;">👁️</span>
        </div>

        <div class="col-md-12">
          <button type="submit" class="btn btn-a">Reset Password</button>
        </div>
      </form>
    </div>
   </div>
  </div>
</section>

<script>
  document.querySelectorAll('.toggle-password').forEach(function(el) {
    el.addEventListener('click', function() {
      const input = document.querySelector(el.getAttribute('toggle'));
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      el.textContent = type === 'password' ? '👁️' : '🙈';
    });
  });
</script>
@endsection
