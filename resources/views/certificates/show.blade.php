@extends('layouts.app')

@section('title', 'Certificate Details - Marriage Registration System')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800">Certificate Details</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Certificate Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Certificate Number:</th>
                                <td>{{ $certificate->certificate_number }}</td>
                            </tr>
                            <tr>
                                <th>Issue Date:</th>
                                <td>{{ $certificate->issue_date->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Issued By:</th>
                                <td>{{ $certificate->issued_by }}</td>
                            </tr>
                            <tr>
                                <th>Created At:</th>
                                <td>{{ $certificate->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Marriage Information</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Applicant:</th>
                                <td>{{ $certificate->application->user->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Spouse:</th>
                                <td>{{ $certificate->application->spouse_name }} ({{ $certificate->application->spouse_gender }})</td>
                            </tr>
                            <tr>
                                <th>Marriage Date:</th>
                                <td>{{ $certificate->application->marriage_date->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th>Marriage Location:</th>
                                <td>{{ $certificate->application->marriage_location }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Certificate Preview</h6>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h2>Marriage Certificate</h2>
                        <p>Certificate Number: {{ $certificate->certificate_number }}</p>
                        <hr>
                        <p>This is to certify that</p>
                        <h3>{{ $certificate->application->user->full_name }}</h3>
                        <p>and</p>
                        <h3>{{ $certificate->application->spouse_name }}</h3>
                        <p>were married on</p>
                        <h3>{{ $certificate->application->marriage_date->format('d M Y') }}</h3>
                        <p>at</p>
                        <h3>{{ $certificate->application->marriage_location }}</h3>
                        <hr>
                        <p>Certificate issued on: {{ $certificate->issue_date->format('d M Y') }}</p>
                        <p>Issued by: {{ $certificate->issued_by }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a href="{{ route('certificates.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to My Certificates
            </a>
        </div>
    </div>
</div>
@endsection 