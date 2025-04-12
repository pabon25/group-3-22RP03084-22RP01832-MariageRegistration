@extends('layouts.app')

@section('title', 'My Certificates - Marriage Registration System')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="h3 mb-4 text-gray-800">My Certificates</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Marriage Certificates</h6>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($certificates->isEmpty())
                <div class="text-center py-4">
                    <p class="mb-0">You don't have any certificates yet.</p>
                    <p class="text-muted">Certificates will be available after your marriage application is approved.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Certificate Number</th>
                                <th>Bride Name</th>
                                <th>Groom Name</th>
                                <th>Marriage Date</th>
                                <th>Issue Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($certificates as $application)
                                <tr>
                                    <td>{{ $application->certificate->certificate_number }}</td>
                                    <td>{{ $application->bride_name }}</td>
                                    <td>{{ $application->groom_name }}</td>
                                    <td>{{ $application->marriage_date->format('d M Y') }}</td>
                                    <td>{{ $application->certificate->issue_date->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('certificates.show', $application->certificate) }}" class="btn btn-sm btn-info">
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
            @endif
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