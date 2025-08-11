@extends('layouts.users.app')
@section('title', 'Contact')
@section('content-header', 'Contact')
@section('content-header-description', 'Get in touch with us')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contact Information</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Get in Touch</h5>
                            <p class="text-muted">We're here to help and answer any questions you might have.</p>
                            
                            <div class="mb-3">
                                <h6><i class="fas fa-phone text-primary"></i> Phone</h6>
                                <p class="mb-0">+234 123 456 7890</p>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="fas fa-envelope text-primary"></i> Email</h6>
                                <p class="mb-0">support@kpoint.com</p>
                            </div>
                            
                            <div class="mb-3">
                                <h6><i class="fas fa-map-marker-alt text-primary"></i> Address</h6>
                                <p class="mb-0">123 KPOINT Street, Lagos, Nigeria</p>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5>Contact Form</h5>
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="subject" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea class="form-control" id="message" rows="4" required></textarea>
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 