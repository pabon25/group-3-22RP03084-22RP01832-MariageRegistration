@extends('layouts.app')

@section('title', 'Application Details')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Application Details</span>
                        <span class="badge bg-{{ $application->status === 'Approved' ? 'success' : ($application->status === 'Rejected' ? 'danger' : 'warning') }}">
                            {{ $application->status }}
                        </span>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Spouse Details</h5>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $application->spouse_name }}</p>
                            <p><strong>Gender:</strong> {{ $application->spouse_gender }}</p>
                            <p><strong>Date of Birth:</strong> {{ $application->spouse_dob->format('d M Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $application->spouse_email }}</p>
                            <p><strong>Phone:</strong> {{ $application->spouse_phone }}</p>
                            <p><strong>Address:</strong> {{ $application->spouse_address }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Witness Details</h5>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $application->witness_name }}</p>
                            <p><strong>Contact:</strong> {{ $application->witness_contact }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Marriage Details</h5>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date:</strong> {{ $application->marriage_date->format('d M Y') }}</p>
                            <p><strong>Location:</strong> {{ $application->marriage_location }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Uploaded Documents</h5>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Groom ID Card:</strong></p>
                            <img src="{{ Storage::url($application->groom_id_card) }}" alt="Groom ID Card" class="img-fluid mb-2">
                            
                            <p><strong>Groom Passport Photo:</strong></p>
                            <img src="{{ Storage::url($application->groom_passport_photo) }}" alt="Groom Passport Photo" class="img-fluid mb-2">
                        </div>
                        <div class="col-md-6">
                            <p><strong>Bride ID Card:</strong></p>
                            <img src="{{ Storage::url($application->bride_id_card) }}" alt="Bride ID Card" class="img-fluid mb-2">
                            
                            <p><strong>Bride Passport Photo:</strong></p>
                            <img src="{{ Storage::url($application->bride_passport_photo) }}" alt="Bride Passport Photo" class="img-fluid mb-2">
                        </div>
                    </div>

                    @if($application->status === 'Approved' && $application->certificate)
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5>Certificate Details</h5>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Certificate Number:</strong> {{ $application->certificate->certificate_number }}</p>
                                <p><strong>Issue Date:</strong> {{ $application->certificate->issue_date->format('d M Y') }}</p>
                                <p><strong>Issued By:</strong> {{ $application->certificate->issued_by }}</p>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('applications.download-certificate', $application) }}" class="btn btn-success">
                                    Download Certificate
                                </a>
                            </div>
                        </div>
                    @endif

                    @if($application->admin_remarks)
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Admin Remarks</h5>
                                <p>{{ $application->admin_remarks }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 