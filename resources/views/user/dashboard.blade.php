@extends('layouts.app')

@section('title', 'Dashboard - Marriage Registration System')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
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
                        <span class="info-box-text">Applications</span>
                        <span class="info-box-number">{{ $totalApplications }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Approved</span>
                        <span class="info-box-number">{{ $approvedApplications }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pending</span>
                        <span class="info-box-number">{{ $pendingApplications }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main row -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Recent Applications</h3>
                    </div>
                    <div class="card-body">
                        @if($recentApplications->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Application ID</th>
                                            <th>Spouse Name</th>
                                            <th>Marriage Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($recentApplications as $application)
                                            <tr>
                                                <td>{{ $application->id }}</td>
                                                <td>{{ $application->spouse_name }}</td>
                                                <td>{{ $application->marriage_date->format('d M Y') }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $application->status === 'approved' ? 'success' : ($application->status === 'pending' ? 'warning' : 'danger') }}">
                                                        {{ ucfirst($application->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('applications.show', $application) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-center">No applications found.</p>
                        @endif
                        <div class="text-center mt-3">
                            <a href="{{ route('applications.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> New Application
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Quick Actions</h3>
                    </div>
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
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
                            <li class="nav-item">
                                <a href="{{ route('profile') }}" class="nav-link">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 