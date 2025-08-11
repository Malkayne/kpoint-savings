@extends('layouts.template')

@section('maincontent')

<section id="contact mainnmt" style="margin-top:80px;height:100%;margin-bottom:0px" class="bg-light">

<div class="contact-gmap">
    <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.802789784723!2d3.179110314094566!3d6.671341623279492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1
            !3m3!1m2!1s0x103b994bbb861cb3%3A0x4741860fdd8a4ac4!2sDe%20Universal%20Success%20Academy!5e0!3m2!1sen!2sng!4v1574036278331!5m2!1sen!2sng" allowfullscreen="" frameborder="0"></iframe>
  </div>

 <div class="container wow fadeInUp bg-light"  style="padding-bottom:60px">
   <div class="row justify-content-center" id="contactForm"  style="margin-top:10px">

     <div class="col-md-7 clr">

       <div class="container wow fadeInUp" >
         <div class="section-header">
           <h3>Contact Us</h3>
           <!-- <p>We would love to hear from you</p> -->
         </div>
       </div>

       <div class="form">
         @if ($message = Session::get('success'))
         <div class="alert alert-success alert-block">
             <button type="button" class="close" data-dismiss="alert">×</button>
             <strong>{{ $message }}</strong>
         </div>
         @endif

         @if ($message = Session::get('error'))
         <div class="alert alert-danger alert-block">
             <button type="button" class="close" data-dismiss="alert">×</button>
             <strong>{{ $message }}</strong>
         </div>
         @endif
         <form   method="POST" action="{{route('contact')}}" enctype="multipart/form-data">
           @csrf
           <div class="form-group" >
             <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Your Name" value="{{ old('name') }}"/>
             @error('name')
             <p class="text-danger">
                     <strong>{{ $message }}</strong>
               </p>
             @enderror
           </div>
           <div class="form-group">
             <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Your Email" value="{{ old('mail') }}"/>
             @error('email')
             <p class="text-danger">
                     <strong>{{ $message }}</strong>
               </p>
             @enderror
           </div>
           <div class="form-group">
             <input type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number" placeholder="Your Phone Number" value="{{ old('phone_number') }}" />
             @error('phone_number')
             <p class="text-danger">
                     <strong>{{ $message }}</strong>
               </p>
             @enderror
           </div>
           <div class="form-group">
             <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" id="subject" placeholder="subject" value="{{ old('subject') }}" />
             @error('subject')
             <p class="text-danger">
                     <strong>{{ $message }}</strong>
               </p>
             @enderror
           </div>
           <div class="form-group">
             <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="5"  placeholder="Message" > {{ old('message') }}</textarea>
             @error('message')
             <p class="text-danger">
                     <strong>{{ $message }}</strong>
               </p>
             @enderror
           </div>
           <div class="text-center"><button type="submit" class="btn" id="myButtonID"  style="background:#05192f;color:white;border:none; padding:12px;">Send Message</button></div>
         </form>
       </div>

     </div>

     <div class=" col-md-5">
       <div class="container wow fadeInUp">
         <div class="section-header">
           <h3>Contact Information</h3>
           <strong>Get in touch us</strong><br/><br/>
    <label><div class="text-muted" style="font-size:1em; font-weight:bold">Location:</div><div class="text-dark">
    20 Alani Biliaminu Street, Off Unity Estate, Iyana Iyesi Ota, Ogun State</label></div>
<br/>
<br/>

    <label><div class="text-muted" style="font-size:1em; font-weight:bold">Email:</div><div class="text-dark">
  admin@deusa.com.ng</label></div>
<br/>
<br/>
<label><div class="text-muted" style="font-size:1em; font-weight:bold">Phone:</div><div class="text-dark">
+2347052157851, +2347034385080</label></div>

         </div>
       </div>


     </div>

   </div>

 </div>
</section><!-- #contact -->

<script type="text/javascript">

$('#contact').submit(function(){
$("#myButtonID", this)
  .html("Sending,Please Wait...")
  .attr('disabled', 'disabled');
return true;
});

</script>
@endsection
