@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Review Application #{{ $application->id }}</span>
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

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5>Applicant Details</h5>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $application->user->full_name }}</p>
                            <p><strong>Email:</strong> {{ $application->user->email }}</p>
                            <p><strong>Phone:</strong> {{ $application->user->phone_number }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong> {{ $application->user->address }}</p>
                            <p><strong>Date of Birth:</strong> {{ $application->user->dob->format('d M Y') }}</p>
                            <p><strong>Gender:</strong> {{ $application->user->gender }}</p>
                        </div>
                    </div>

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

                    @if($application->status === 'Pending')
                        <form action="{{ route('admin.applications.status', $application) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5>Review Decision</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Decision</label>
                                        <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                            <option value="">Select Decision</option>
                                            <option value="approved">Approve</option>
                                            <option value="rejected">Reject</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('status') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="admin_remarks">Remarks</label>
                                        <textarea class="form-control @error('admin_remarks') is-invalid @enderror" 
                                            id="admin_remarks" name="admin_remarks" rows="3" required></textarea>
                                        @error('admin_remarks')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('admin_remarks') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        Submit Review
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5>Review Details</h5>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Status:</strong> {{ $application->status }}</p>
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
                                    <a href="{{ Storage::url($application->certificate->certificate_file) }}" 
                                        class="btn btn-success" target="_blank">
                                        View Certificate
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 