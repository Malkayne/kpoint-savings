@extends('layouts.users.app')
@section('title', 'Documentation')
@section('content-header', 'Documentation')
@section('content-header-description', 'Learn how to use KPOINT platform')
@section('content')

<div class="container-fluid content-inner mt-n5 py-0">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">KPOINT Platform Documentation</h4>
                </div>
                <div class="card-body">
                    <div class="accordion" id="documentationAccordion">

                        <!-- Getting Started -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Getting Started
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#documentationAccordion">
                                <div class="accordion-body">
                                    <h5>Welcome to KPOINT!</h5>
                                    <p>KPOINT is a savings and contribution platform that helps you manage your finances effectively. Here's how to get started:</p>
                                    <ul>
                                        <li>Complete your profile with accurate information</li>
                                        <li>View your wallet balance and transaction history</li>
                                        <li>Check your contribution plans and progress</li>
                                        <li>Contact your representative for any assistance</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Understanding Your Dashboard -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Understanding Your Dashboard
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#documentationAccordion">
                                <div class="accordion-body">
                                    <h5>Dashboard Overview</h5>
                                    <p>Your dashboard provides a quick overview of your account:</p>
                                    <ul>
                                        <li><strong>Wallet Balance:</strong> Your current available balance</li>
                                        <li><strong>Active Plans:</strong> Number of ongoing contribution plans</li>
                                        <li><strong>Recent Transactions:</strong> Latest financial activities</li>
                                        <li><strong>Progress Summary:</strong> Overview of your savings progress</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Contribution Plans -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Contribution Plans
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#documentationAccordion">
                                <div class="accordion-body">
                                    <h5>How Contribution Plans Work</h5>
                                    <p>Contribution plans help you save systematically:</p>
                                    <ul>
                                        <li><strong>Plan Creation:</strong> Your representative creates plans based on your goals</li>
                                        <li><strong>Daily Contributions:</strong> Regular contributions are made according to the plan</li>
                                        <li><strong>Progress Tracking:</strong> Monitor your progress through the dashboard</li>
                                        <li><strong>Completion:</strong> Plans are marked complete when all contributions are made</li>
                                    </ul>
                                    <p><strong>Note:</strong> Only your representative can create and manage contribution plans.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Transactions -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Transactions
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#documentationAccordion">
                                <div class="accordion-body">
                                    <h5>Understanding Transactions</h5>
                                    <p>All financial activities are recorded as transactions:</p>
                                    <ul>
                                        <li><strong>Credits:</strong> Money added to your wallet</li>
                                        <li><strong>Debits:</strong> Money deducted from your wallet</li>
                                        <li><strong>Wallet Types:</strong> Different categories for your funds</li>
                                        <li><strong>Descriptions:</strong> Details about each transaction</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Management -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    Profile Management
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#documentationAccordion">
                                <div class="accordion-body">
                                    <h5>Managing Your Profile</h5>
                                    <p>Keep your information up to date:</p>
                                    <ul>
                                        <li><strong>Personal Information:</strong> Update your contact details</li>
                                        <li><strong>Next of Kin:</strong> Ensure NOK information is current</li>
                                        <li><strong>Address:</strong> Keep your address information accurate</li>
                                        <li><strong>Professional Details:</strong> Update your profession and education</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Getting Help -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    Getting Help
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#documentationAccordion">
                                <div class="accordion-body">
                                    <h5>Support and Assistance</h5>
                                    <p>If you need help, here are your options:</p>
                                    <ul>
                                        <li><strong>Contact Your Representative:</strong> Your primary point of contact</li>
                                        <li><strong>Platform Support:</strong> Use the contact form for technical issues</li>
                                        <li><strong>Documentation:</strong> Refer to this guide for common questions</li>
                                        <li><strong>Emergency Contact:</strong> Use the provided contact information</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Us -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSeven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                    Contact Us
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#documentationAccordion">
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
