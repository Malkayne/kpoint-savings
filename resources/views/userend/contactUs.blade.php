@extends('layouts.users.app')
@section('title', 'Contact Us')
@section('content-header', 'Contact Us')
@section('content-header-description', 'We’re here to help')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Contact Us</h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="documentationAccordion">

                        <!-- Contact Us -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                                    Contact Us
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse show" aria-labelledby="headingSeven" data-bs-parent="#documentationAccordion">
                                <div class="accordion-body">
                                    <h5>We’re here to help</h5>
                                    <p>If you need to reach out to us directly, you can use any of the options below:</p>
                                    <ul>
                                        <li><strong>WhatsApp:</strong>
                                            <a href="https://wa.me/2348166618178" target="_blank">
                                                Chat with us on WhatsApp
                                            </a>
                                        </li>
                                        <li><strong>Email:</strong>
                                            <a href="mailto:kpointsavings@gmail.com">
                                                Send us an email at kpointsavings@gmail.com
                                            </a>
                                        </li>
                                    </ul>
                                    <p>We aim to respond as quickly as possible during working hours.</p>
                                </div>
                            </div>
                        </div>
                        <!-- End Contact Us -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
