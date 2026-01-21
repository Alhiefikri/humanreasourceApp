@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Leave Request</h3>
                    <p class="text-subtitle text-muted">Handle employee Leave Request</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Leave Request</li>
                            <li class="breadcrumb-item active" aria-current="page">New</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Create Employee Leave Request
                    </h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('leave-requests.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="employee" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Leave Type --}}
                        <div class="mb-3">
                            <label for="leave_type" class="form-label">Leave Type</label>
                            <select name="leave_type" id="leave_type"
                                class="form-control @error('leave_type') is-invalid @enderror">
                                <option value="">Select Leave Type</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Vacation Leave">Vacation Leave</option>
                                <option value="Birth Leave">Birth Leave</option>
                            </select>
                            @error('leave_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Start Date</label>
                            <input type="date" class="form-control date @error('start_date') is-invalid @enderror"
                                value="{{ old('start_date') }}" name="start_date" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">End Date</label>
                            <input type="date" class="form-control date @error('end_date') is-invalid @enderror"
                                value="{{ old('end_date') }}" name="end_date" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('leave-requests.index') }}" class="btn btn-secondary">Back to List</a>

                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
