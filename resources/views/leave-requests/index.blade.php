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
                    <h3>Roles</h3>
                    <p class="text-subtitle text-muted">Handle Roles</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Role</li>
                            <li class="breadcrumb-item active" aria-current="page">Index</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data Roles
                    </h5>
                </div>
                <div class="card-body">

                    <div class="d-flex">
                        <a href="{{ route('leave-requests.create') }}" class="btn btn-primary mb-3 ms-auto">New Leave
                            Request</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveRequests as $leaveRequest)
                                <tr>
                                    <td>{{ $leaveRequest->employee->fullname }}</td>
                                    <td>{{ $leaveRequest->leave_type }}</td>
                                    <td>{{ $leaveRequest->start_date }}</td>
                                    <td>{{ $leaveRequest->end_date }}</td>
                                    <td>
                                        @if ($leaveRequest->status == 'approved')
                                            <span class="text-success">Approved</span>
                                        @elseif ($leaveRequest->status == 'rejected')
                                            <span class="text-danger">Rejected</span>
                                        @else
                                            <span class="text-warning">
                                                {{ ucfirst($leaveRequest->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($leaveRequest->status == 'pending' || $leaveRequest->status == 'rejected')
                                            {{-- confirm --}}
                                            <a href="{{ route('leave-requests.approve', $leaveRequest->id) }}"
                                                class="btn btn-icon btn-success">
                                                <i class="bi bi-check"></i>
                                            </a>
                                        @else
                                            {{-- rejected --}}
                                            <a href="{{ route('leave-requests.reject', $leaveRequest->id) }}"
                                                class="btn btn-icon btn-danger">
                                                <i class="bi bi-x"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('leave-requests.edit', $leaveRequest->id) }}"
                                            class="btn btn-icon btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('leave-requests.destroy', $leaveRequest->id) }}"
                                            method="POST" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this leave request?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
