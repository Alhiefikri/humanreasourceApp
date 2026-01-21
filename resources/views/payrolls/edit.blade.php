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
                    <h3>Edit Payrolls</h3>
                    <p class="text-subtitle text-muted">Handle payroll</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Payrolls</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Edit payroll Employee
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('payrolls.update', $payroll->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ old('employee_id', $employee->id) }}"
                                        @if (old('employee_id', $payroll->employee_id) == $employee->id) selected @endif>
                                        {{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control" value="{{ old('salary', $payroll->salary) }}" name="salary" required>
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bonuses" class="form-label">Bonuses</label>
                            <input type="number" class="form-control" value="{{ old('bonuses', $payroll->bonuses) }}" name="bonuses" required>
                            @error('bonuses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deductions" class="form-label">Deductions</label>
                            <input type="number" class="form-control" value="{{ old('deductions', $payroll->deductions) }}" name="deductions"
                                required>
                            @error('deductions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pay_date" class="form-label">Pay Date</label>
                            <input type="date" class="form-control date @error('pay_date') is-invalid @enderror"
                                value="{{ old('pay_date', $payroll->pay_date) }}" name="pay_date" required>
                            @error('pay_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back to List</a>

                    </form>
                </div>
            </div>

        </section>
    </div>
@endsection
