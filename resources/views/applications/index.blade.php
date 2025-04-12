@extends('layouts.app')

@section('title', 'My Applications')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">My Applications</h1>
            </div>
            <div class="col-sm-6">
                <div class="float-sm-right">
                    <a href="{{ route('applications.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> New Application
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @if($applications->isEmpty())
                    <div class="text-center py-4">
                        <p class="text-muted">You haven't submitted any applications yet.</p>
                        <a href="{{ route('applications.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Submit Your First Application
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Application ID</th>
                                    <th>Spouse Name</th>
                                    <th>Marriage Date</th>
                                    <th>Status</th>
                                    <th>Submitted On</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                    <tr>
                                        <td>{{ $application->id }}</td>
                                        <td>
                                            {{ $application->spouse_name }} ({{ $application->spouse_gender }})
                                        </td>
                                        <td>{{ $application->marriage_date->format('d M Y') }}</td>
                                        <td>
                                            @if($application->status == 'Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif($application->status == 'Approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif($application->status == 'Rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                        <td>{{ $application->created_at->format('d M Y') }}</td>
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
                @endif
            </div>
        </div>
    </div>
</section>
@endsection 