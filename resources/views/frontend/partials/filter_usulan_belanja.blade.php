<!-- frontend/partials/filter_rkbu.blade.php -->
<div class="row mb-4">
    <div class="col-md-4">
        <label for="sub_kategori_rkbu" class="form-label">Filter by Sub Kategori Rkbu</label>
        <select name="sub_kategori_rkbu" id="sub_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
            <option value="">-- Pilih Sub Kategori --</option>
            @foreach ($sub_kategori_usulan_belanja as $subKategori)
                <option value="{{ $subKategori->id_sub_kategori_rkbu }}" 
                    {{ request('sub_kategori_rkbu') == $subKategori->id_sub_kategori_rkbu ? 'selected' : '' }}>
                    {{ $subKategori->kode_sub_kategori_rkbu }}. {{ $subKategori->nama_sub_kategori_rkbu }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
        <label for="status_permintaan_barang" class="form-label">Filter by Status Permintaan</label>
        <select name="status_permintaan_barang" id="status_permintaan_barang" class="select2 form-select form-select-lg" data-allow-clear="true">
            <option value="">-- Pilih Status Permintaan --</option>
            <option value="Disetujui Perencana" {{ request('status_permintaan_barang') == 'Disetujui Perencana' ? 'selected' : '' }}>Disetujui Perencana</option>
            <option value="Perlu Validasi Perencana" {{ request('status_permintaan_barang') == 'Perlu Validasi Perencana' ? 'selected' : '' }}>Perlu Validasi Perencana</option>
        </select>
    </div>
    
    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url()->current() }}" class="btn btn-secondary ms-2">Reset</a>
    </div>
</div>
