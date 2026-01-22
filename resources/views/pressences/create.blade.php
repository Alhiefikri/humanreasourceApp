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
                    <h3>Pressence</h3>
                    <p class="text-subtitle text-muted">Handle employee Pressence</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pressence</li>
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
                        Create Pressence
                    </h5>
                </div>
                <div class="card-body">

                    @if (session('role') == 'HR')
                        <form action="{{ route('pressences.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="employee" class="form-label">Employee</label>
                                <select name="employee_id" id="employee_id"
                                    class="form-control @error('employee_id') is-invalid @enderror">
                                    <option value="">Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                                    @endforeach
                                </select>
                                @error('assigned_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Check In</label>
                                <input type="date" class="form-control datetime @error('check_in') is-invalid @enderror"
                                    value="{{ old('check_in') }}" name="check_in" required>
                                @error('check_in')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Check Out</label>
                                <input type="date" class="form-control datetime @error('check_out') is-invalid @enderror"
                                    value="{{ old('check_out') }}" name="check_out" required>
                                @error('check_out')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Date</label>
                                <input type="date" class="form-control date @error('date') is-invalid @enderror"
                                    value="{{ old('date') }}" name="date" required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                    <option value="present">Present</option>
                                    <option value="absent">Absent</option>
                                    <option value="leave">Leave</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('pressences.index') }}" class="btn btn-secondary">Back to List</a>

                        </form>
                    @else
                        <form action="{{ route('pressences.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <b>Note</b> : Mohon izinkan akses lokasi, supaya presensi diterima

                                <div class="mb-3">
                                    <label for="" class="form-label">Latitude</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude" required>
                                </div>

                                <div class="mb-3">
                                    <label for="" class="form-label">Longitude</label>
                                    <input type="text" class="form-control" name="longitude" id="longitude" required>
                                </div>

                                <div class="mb-3">
                                    <iframe src="" width="500" height="300" frameborder="0" scolling="no"
                                        marginheight="0" marginwidth="0"></iframe>
                                </div>

                                <button type="submit" class="btn btn-primary" id="btn-pressence" disabled>Pressence</button>

                            </div>
                        </form>
                    @endif

                </div>
            </div>

        </section>
    </div>

    <script>
        const officeLat = -0.954192989280175;
        const officeLon = 122.78967434745915;
        const threshold = 0.01; // Sekitar 1.1 km

        document.addEventListener('DOMContentLoaded', (event) => {
            const iframe = document.querySelector('iframe');
            const btnPresence = document.getElementById('btn-pressence');

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;

                    // Isi input otomatis
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lon;

                    // Update Map
                    if (iframe) {
                        iframe.src = `https://maps.google.com/maps?q=${lat},${lon}&output=embed`;
                    }

                    // Hitung Jarak (Pythagoras Sederhana)
                    const distance = Math.sqrt(Math.pow(lat - officeLat, 2) + Math.pow(lon - officeLon, 2));

                    if (distance <= threshold) {
                        alert('Anda berada di wilayah kantor');
                        if (btnPresence) btnPresence.removeAttribute('disabled');
                    } else {
                        alert('Anda di luar jangkauan kantor!');
                    }
                }, function(error) {
                    // Kasih tau kalau GPS dimatikan user atau error
                    alert("Error GPS: " + error.message);
                });
            } else {
                alert("Browser Anda tidak mendukung Geolokasi");
            }
        });
    </script>

@endsection
