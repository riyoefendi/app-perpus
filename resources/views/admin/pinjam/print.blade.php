<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Pinjam Buku</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0
        }

        .text-center {
            text-align: center;
        }

        .small {
            font-size: 11px;
        }

        .text-bold {
            font-weight: bold;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .divider {
            border-top: 1px dashed black;
            margin: 10px 0;
        }
    </style>
</head>

<body onload="window.p  rint(); setTimeout(() =>window.close(), 500)">
    <h5 class="text-center">Perpustakaan PPKD Jakarta Pusat</h5>
    <div class="text-center small">Jl. Karet Baru</div>
    <br>
    <div class="divider"></div>

    <div class="small">
        <div class="row">
            <span>Kode Transaksi</span>
            <span class="text-bold">{{ $borrow->trans_number ?? '' }}</span>
        </div>
        <div class="row">
            <span>
                Tanggal Pinjam
            </span>
            <span class="text-bold">{{ \Carbon\Carbon::parse($borrows->created_at)->format('d m Y') }}</span>
        </div>
        <div class="row">
            <span>
                Tanggal Pengembalian
            </span>
            <span class="text-bold">{{ \Carbon\Carbon::parse($borrows->return_date)->format('d m Y') }}</span>
        </div><div class="row">
            <span>
                Nama Peminjam
            </span>
            <span class="text-bold">{{ $borrow->member->nama_anggota ?? ''}}</span>
        </div>
        <div class="divider"></div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penerbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrow->detailBorrow as $index => $detailborrow )
                <tr>
                    <td>{{ $index += 1 }}</td>
                    <td>{{ $detailborrow->book->judul }}</td>
                    <td>{{ $detailborrow->book->penerbit }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
