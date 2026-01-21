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
                    <h3>Pressences</h3>
                    <p class="text-subtitle text-muted">Handle Pressences</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pressence</li>
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
                        Data Pressences
                    </h5>
                </div>
                <div class="card-body">

                    <div class="d-flex">
                        <a href="{{ route('pressences.create') }}" class="btn btn-primary mb-3 ms-auto">New Pressence</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pressences as $pressence)
                                <tr>
                                    
                                    <td>{{ $pressence->employee->fullname }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pressence->check_in)->format('d F Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pressence->check_out)->format('d F Y H:i') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($pressence->date)->format('d F Y') }}</td>
                                    <td>
                                        @if ($pressence->status == 'present')
                                            <span class="text-success">Present</span>
                                        @else
                                            <span class="text-danger">{{ ucfirst($pressence->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pressences.edit', $pressence->id) }}"
                                            class="btn btn-icon btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('pressences.destroy', $pressence->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this pressence?')">
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
