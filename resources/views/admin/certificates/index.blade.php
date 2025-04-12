@extends('layouts.app')

@section('title', 'Manage Certificates - Marriage Registration System')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800">Manage Certificates</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Marriage Certificates</h6>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#generateCertificateModal">
                <i class="fas fa-plus"></i> Generate Certificate
            </button>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Certificate Number</th>
                            <th>Bride Name</th>
                            <th>Groom Name</th>
                            <th>Issue Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certificates as $certificate)
                            <tr>
                                <td>{{ $certificate->id }}</td>
                                <td>{{ $certificate->certificate_number }}</td>
                                <td>{{ $certificate->application->bride_name }}</td>
                                <td>{{ $certificate->application->groom_name }}</td>
                                <td>{{ $certificate->issue_date->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.certificates.show', $certificate) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $certificates->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Generate Certificate Modal -->
<div class="modal fade" id="generateCertificateModal" tabindex="-1" role="dialog" aria-labelledby="generateCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateCertificateModalLabel">Generate Marriage Certificate</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.certificates.generate') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="application_id">Select Application</label>
                        <select class="form-control" id="application_id" name="application_id" required>
                            <option value="">Select an application</option>
                            @foreach(App\Models\Application::where('status', 'approved')->get() as $application)
                                <option value="{{ $application->id }}">
                                    {{ $application->bride_name }} & {{ $application->groom_name }} ({{ $application->marriage_date->format('d M Y') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="certificate_number">Certificate Number</label>
                        <input type="text" class="form-control" id="certificate_number" name="certificate_number" required>
                    </div>
                    <div class="form-group">
                        <label for="issue_date">Issue Date</label>
                        <input type="date" class="form-control" id="issue_date" name="issue_date" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Generate Certificate</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush 