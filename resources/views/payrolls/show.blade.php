@extends('layouts.dashboard')

@section('content')
<style>
    /* Styling agar tampilan di layar tetap oke, tapi di print jadi slip gaji */
    @media print {
        /* Sembunyikan semua elemen kecuali area print */
        body * {
            visibility: hidden;
        }
        #print-area, #print-area * {
            visibility: visible;
        }
        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 20px;
            color: black !important;
        }
        .btn, header, .breadcrumb, .card-title, .card-header {
            display: none !important;
        }
        /* Style tambahan untuk slip gaji */
        .slip-header {
            text-align: center;
            border-bottom: 2px solid #000;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .table-slip {
            width: 100%;
            margin-top: 20px;
        }
        .table-slip td {
            padding: 8px 0;
        }
        .text-end {
            text-align: right;
        }
    }
</style>

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Payroll Detail</h3>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-body">
                <div id="print-area">
                    <div class="slip-header">
                        <h4>SLIP GAJI KARYAWAN</h4>
                        <p>Periode: {{ \Carbon\Carbon::parse($payroll->pay_date)->format('F Y') }}</p>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <table class="table-slip">
                                <tr>
                                    <td width="40%"><strong>Nama Karyawan</strong></td>
                                    <td>: {{ $payroll->employee->fullname }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Bayar</strong></td>
                                    <td>: {{ \Carbon\Carbon::parse($payroll->pay_date)->format('d F Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <h6>Pemasukan</h6>
                            <table class="table-slip">
                                <tr>
                                    <td>Gaji Pokok</td>
                                    <td class="text-end">Rp {{ number_format($payroll->salary) }}</td>
                                </tr>
                                <tr>
                                    <td>Bonus</td>
                                    <td class="text-end">Rp {{ number_format($payroll->bonuses) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            <h6>Potongan</h6>
                            <table class="table-slip">
                                <tr>
                                    <td>Deductions</td>
                                    <td class="text-end">Rp {{ number_format($payroll->deductions) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-3">
                        <div class="col-12 text-end">
                            <h5>Total Gaji Bersih (Net Salary)</h5>
                            <h3 class="text-primary">Rp {{ number_format($payroll->net_salary) }}</h3>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('payrolls.index') }}" class="btn btn-secondary">Back</a>
                    <button type="button" onclick="window.print()" class="btn btn-primary">
                        <i class="bi bi-printer"></i> Print Slip
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection