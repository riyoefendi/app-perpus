@extends('app')
@section('title', 'Detail Peminjam')
@section('content')
    <div class="row">
        <div align="right" class="col-sm-12">
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>Kembali
            </a>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body"></div>
                <h3 class="card-title">Data Peminjam</h3>
                <table class="table">
                    <tr>
                        <th>Nomor Transaksi</th>
                        <th>{{ $borrow->trans_number ?? '' }}</th>
                    </tr>
                    <tr>
                        <th>Tanggal Kembali Buku</th>
                        <th>{{ \Cabon\Carbon::parse($borrow->return_date)->format('d-M-Y') ?? '' }}</th>
                    </tr>
                    <tr>
                        <th>Catatan</th>
                        <th>{{ $borrow->note ?? '' }}</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body"></div>
                <h3 class="card-title">Data Anggota</h3>

                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>{{ $borrow->member->nama_anggota ?? '' }}</th>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <th>{{ $borrow->member->no_hp }}</th>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <th>{{ $borrow->member->email }}</th>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title"></h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penerbit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrow->detailBorrows as $index => $detailBorrow)
                                <tr>
                                    <td>{{ $index += 1 }}</td>
                                    <td>{{ $detailBorrow->book->judul }}</td>
                                    <td>{{ $detailBorrow->book->penerbit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
