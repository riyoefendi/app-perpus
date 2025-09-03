@extends('app')
@section('title', 'Peminjaman Buku')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $title ?? '' }}</h3>

            <form action="" method="post">
                @csrf

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">No Transaksi</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="trans_number" value="{{ $trans_number }}" readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Anggota</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="id_anggota" id="id_anggota" class="form-control">
                                    <option value="">Pilih Anggota</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->nama_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Kategori Buku</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="" id="id_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Buku</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="" id="id_buku" class="form-control">
                                    <option value="">Pilih Buku</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

<script>
    let category = document.getElementById('id_kategori');
    category.addEventListener('change', async function() {
        const id_kategori = this.value; //artinya si selector id_category, mau ambi value
        const selectBuku = document.querySelector('#id_buku');
        selectBuku.innerHTML = "<option value=''>Pilih Buku</option>"

        if (!category) {
            selectBuku.innerHTML = "<option value=''>Pilih Buku</option>"
            return;
        }

        try {
            const res = await fetch(`/get-buku/${id_category}`);
            const data = await res.json();
            data.foreach(buku => {
                const option = document.createElement('option');
                option.value = buku.id;
                option.textContent = buku.judul;
                selectBuku.appendChild(option);
            });
        } catch (error) {
            console.log('error fetch buku', error);
        }
    });
</script>
