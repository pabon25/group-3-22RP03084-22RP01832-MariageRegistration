@extends('layouts.app')

@section('title', 'Welcome - Marriage Registration System')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Welcome to Marriage Registration System</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Online Registration</span>
                        <span class="info-box-number">Easy and Fast</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Digital Certificates</span>
                        <span class="info-box-number">Secure and Valid</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">24/7 Service</span>
                        <span class="info-box-number">Always Available</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">How to Register</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>For Couples</h5>
                                <ol>
                                    <li>Create an account</li>
                                    <li>Fill in personal details</li>
                                    <li>Submit required documents</li>
                                    <li>Track application status</li>
                                    <li>Receive digital certificate</li>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <h5>Required Documents</h5>
                                <ul>
                                    <li>Valid ID proof</li>
                                    <li>Birth certificates</li>
                                    <li>Address proof</li>
                                    <li>Passport size photos</li>
                                    <li>Witness details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Links</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            @auth
                                <li class="nav-item">
                                    <a href="{{ route('dashboard') }}" class="nav-link">
                                        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('applications.create') }}" class="nav-link">
                                        <i class="fas fa-file-alt mr-2"></i> New Application
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('applications.index') }}" class="nav-link">
                                        <i class="fas fa-list mr-2"></i> My Applications
                                    </a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="nav-link">
                                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">
                                        <i class="fas fa-user-plus mr-2"></i> Register
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 