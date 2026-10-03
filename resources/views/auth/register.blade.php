@extends('layouts.app')

@section('intro')
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<section class="intro-single">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8">
        <div class="title-single-box">
          <h1 class="title-single">Create Account</h1>
          <span class="color-text-a">Creating an account is easy. It only takes a few steps.</span>
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
              Create Account
            </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>
@endsection

@section('bodyContent')
<section class="contact">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-1"></div>
      <div class="col-md-10">

        @if ($message = Session::get('error'))
        <center>
          <div class="row d-flex justify-content-center" style="margin-top:5px">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <div class="alert alert-success alert-dismissble">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ $message }}
              </div>
            </div>
            <div class="col-md-3"></div>
          </div>
        </center>
        @endif

        <form class="form-a" id="myFormId" method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
          @csrf

          {{-- Personal Details --}}
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <input id="name" type="text" class="form-control form-control-lg form-control-a @error('name') is-invalid @enderror" placeholder="Your Full Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <input id="username" type="text" class="form-control form-control-lg form-control-a @error('username') is-invalid @enderror" placeholder="Your Username" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
              <input id="rep_username" type="text" class="form-control form-control-lg form-control-a @error('rep_username') is-invalid @enderror" placeholder="Referral code" name="rep_username" value="{{ old('rep_username') }}" required autocomplete="off">
              @error('rep_username')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <input id="phone" type="text" class="form-control form-control-lg form-control-a @error('phone') is-invalid @enderror" placeholder="Your Phone Number" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <div class="form-group">
                <textarea name="address" class="form-control form-control-lg form-control-a @error('address') is-invalid @enderror" placeholder="Your Address" required>{{ old('address') }}</textarea>
                @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
            
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <input id="signature" type="file" class="form-control form-control-lg form-control-a @error('signature') is-invalid @enderror" placeholder="Your Signature" name="signature" value="{{ old('signature') }}" required autocomplete="signature">
                                <small class="text-left text-info">snap and upload your signature</small>
                @error('address')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            
             <div class="col-md-6 mb-3">
              <div class="form-group">
                <input id="profile_pix" type="file" class="form-control form-control-lg form-control-a @error('profile_pix') is-invalid @enderror" placeholder="Your profile picture" name="profile_pix" value="{{ old('profile_pix') }}" required autocomplete="profile_pix">
                                <small class="text-left text-info">upload your recent photo</small>
                @error('profile_pix')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>



            <div class="col-md-6 mb-3">
              <div class="form-group">
                <input id="email" type="email" class="form-control form-control-lg form-control-a @error('email') is-invalid @enderror" placeholder="Your Email (optional)" name="email" value="{{ old('email') }}" autocomplete="email" >
                <!--<small class="text-left text-info">Email Address (optional)</small>-->
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <input id="dob" type="date" class="form-control form-control-lg form-control-a @error('dob') is-invalid @enderror" placeholder="Date Of Birth" name="dob" value="{{ old('dob') }}" required>
                <small class="text-left text-info">Date Of Birth (optional)</small>
                @error('dob')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            {{-- Password --}}
           <div class="col-md-6 mb-3">
  <div class="form-group position-relative">
    <input id="password" type="password" class="form-control form-control-lg form-control-a @error('password') is-invalid @enderror" placeholder="Your New Password" name="password" required autocomplete="new-password">
    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"></span>
    @error('password')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
  </div>
</div>

<div class="col-md-6 mb-3">
  <div class="form-group position-relative">
    <input id="password-confirm" type="password" class="form-control form-control-lg form-control-a" name="password_confirmation" placeholder="Confirm New Password" required autocomplete="new-password">
    <span toggle="#password-confirm" class="fa fa-fw fa-eye field-icon toggle-password" style="position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer;"></span>
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


          </div>

          {{-- Next of Kin --}}
          <div class="row">
            <div class="col-12 co">
              <div class="title-single-box d-flex justify-content-center">
                <h1 class="title-single">Next Of Kin Details</h1>
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <input id="nok_name" type="text" class="form-control form-control-lg form-control-a @error('nok_name') is-invalid @enderror" placeholder="NOK Name" name="nok_name" value="{{ old('nok_name') }}" required>
                @error('nok_name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <input id="nok_phone" type="text" class="form-control form-control-lg form-control-a @error('nok_phone') is-invalid @enderror" placeholder="NOK Phone number" name="nok_phone" value="{{ old('nok_phone') }}" required>
                @error('nok_phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="col-md-4 mb-3">
              <div class="form-group">
                <input id="nok_relationship" type="text" class="form-control form-control-lg form-control-a @error('nok_relationship') is-invalid @enderror" placeholder="NOK Relationship" name="nok_relationship" value="{{ old('nok_relationship') }}" required>
                @error('nok_relationship')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
          </div>

          {{-- Submit --}}
          <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
              <button type="submit" id="myButtonID" class="btn btn-a">Create Account</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
</section>

<script type="text/javascript">
  $('#myFormId').submit(function(event) {
    $("#myButtonID", this)
      .html("Sending, Please Wait...")
      .attr('disabled', 'disabled');
    return true;
  });
</script>
@endsection
