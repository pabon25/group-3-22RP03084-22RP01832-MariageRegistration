@extends('layouts.app')

@section('title', 'New Marriage Application')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">New Marriage Application</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">Marriage Registration Form</div>

            <div class="card-body">
                <form method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data" id="applicationForm">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>Spouse Details</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="spouse_name" class="form-label">Spouse Name</label>
                            <input type="text" class="form-control @error('spouse_name') is-invalid @enderror" 
                                id="spouse_name" name="spouse_name" value="{{ old('spouse_name') }}" required>
                            @error('spouse_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="spouse_gender" class="form-label">Spouse Gender</label>
                            <select class="form-select @error('spouse_gender') is-invalid @enderror" 
                                id="spouse_gender" name="spouse_gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('spouse_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('spouse_gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('spouse_gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="spouse_dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('spouse_dob') is-invalid @enderror" 
                                id="spouse_dob" name="spouse_dob" value="{{ old('spouse_dob') }}" required>
                            @error('spouse_dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="spouse_email" class="form-label">Email Address</label>
                            <input type="email" class="form-control @error('spouse_email') is-invalid @enderror" 
                                id="spouse_email" name="spouse_email" value="{{ old('spouse_email') }}" required>
                            @error('spouse_email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="spouse_phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('spouse_phone') is-invalid @enderror" 
                                id="spouse_phone" name="spouse_phone" value="{{ old('spouse_phone') }}" required>
                            @error('spouse_phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="spouse_address" class="form-label">Address</label>
                            <textarea class="form-control @error('spouse_address') is-invalid @enderror" 
                                id="spouse_address" name="spouse_address" rows="2" required>{{ old('spouse_address') }}</textarea>
                            @error('spouse_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>Witness Details</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="witness_name" class="form-label">Witness Name</label>
                            <input type="text" class="form-control @error('witness_name') is-invalid @enderror" 
                                id="witness_name" name="witness_name" value="{{ old('witness_name') }}" required>
                            @error('witness_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="witness_contact" class="form-label">Witness Contact</label>
                            <input type="text" class="form-control @error('witness_contact') is-invalid @enderror" 
                                id="witness_contact" name="witness_contact" value="{{ old('witness_contact') }}" required>
                            @error('witness_contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>Marriage Details</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="marriage_date" class="form-label">Marriage Date</label>
                            <input type="date" class="form-control @error('marriage_date') is-invalid @enderror" 
                                id="marriage_date" name="marriage_date" value="{{ old('marriage_date') }}" required>
                            @error('marriage_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="marriage_location" class="form-label">Marriage Location</label>
                            <textarea class="form-control @error('marriage_location') is-invalid @enderror" 
                                id="marriage_location" name="marriage_location" rows="2" required>{{ old('marriage_location') }}</textarea>
                            @error('marriage_location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h5>Required Documents</h5>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="groom_id_card" class="form-label">Groom ID Card</label>
                            <input type="file" class="form-control @error('groom_id_card') is-invalid @enderror" 
                                id="groom_id_card" name="groom_id_card" required>
                            @error('groom_id_card')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="groom_passport_photo" class="form-label">Groom Passport Photo</label>
                            <input type="file" class="form-control @error('groom_passport_photo') is-invalid @enderror" 
                                id="groom_passport_photo" name="groom_passport_photo" required>
                            @error('groom_passport_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="bride_id_card" class="form-label">Bride ID Card</label>
                            <input type="file" class="form-control @error('bride_id_card') is-invalid @enderror" 
                                id="bride_id_card" name="bride_id_card" required>
                            @error('bride_id_card')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="bride_passport_photo" class="form-label">Bride Passport Photo</label>
                            <input type="file" class="form-control @error('bride_passport_photo') is-invalid @enderror" 
                                id="bride_passport_photo" name="bride_passport_photo" required>
                            @error('bride_passport_photo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Submit Application
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('applicationForm');
        const submitBtn = document.getElementById('submitBtn');
        
        form.addEventListener('submit', function(event) {
            // Check if all required fields are filled
            const requiredFields = form.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(function(field) {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            });
            
            if (!isValid) {
                event.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    });
</script>
@endpush
@endsection 