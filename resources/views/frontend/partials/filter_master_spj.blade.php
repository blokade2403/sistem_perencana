<!-- frontend/partials/filter_rkbu.blade.php -->
<div class="row mb-4">
    <div class="col-md-4">
        <label for="sub_kategori_rkbu" class="form-label">Filter by Sub Kategori Rkbu</label>
        <select name="sub_kategori_rkbu" id="sub_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
            <option value="">-- Pilih Sub Kategori --</option>
            @foreach ($sub_kategori_rkbus as $subKategori)
                <option value="{{ $subKategori->id_sub_kategori_rkbu }}" 
                    {{ request('sub_kategori_rkbu') == $subKategori->id_sub_kategori_rkbu ? 'selected' : '' }}>
                        {{ $subKategori->kode_sub_kategori_rkbu }}. {{ $subKategori->nama_sub_kategori_rkbu }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="status_pembayaran" class="form-label">Filter by Status Pembayaran</label>
        <select name="status_pembayaran" id="status_pembayaran" class="select2 form-select form-select-lg" data-allow-clear="true">
            <option value="">-- Pilih Status Pembayaran --</option>
            <option value="Sudah di Bayar" {{ request('status_pembayaran') == 'Sudah di Bayar' ? 'selected' : '' }}>Sudah di Bayar</option>
            <option value="Revisi" {{ request('status_pembayaran') == 'Revisi' ? 'selected' : '' }}>Revisi</option>
            <option value="Bayar Parsial" {{ request('status_pembayaran') == 'Bayar Parsial' ? 'selected' : '' }}>Bayar Parsial</option>
        </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url()->current() }}" class="btn btn-secondary ms-2">Reset</a>
    </div>
</div>
