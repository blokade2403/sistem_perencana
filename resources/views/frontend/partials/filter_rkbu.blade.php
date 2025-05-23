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
        <label for="id_status_validasi_rka" class="form-label">Filter by Status Validasi</label>
        <select name="id_status_validasi_rka" id="id_status_validasi_rka" class="select2 form-select form-select-lg" data-allow-clear="true">
            <option value="">-- Pilih Status Validasi --</option>
            @foreach ($status_validasi_rka as $status)
                <option value="{{ $status->id_status_validasi_rka }}" 
                    {{ request('id_status_validasi_rka') == $status->id_status_validasi_rka ? 'selected' : '' }}>
                    {{ $status->nama_validasi_rka }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url()->current() }}" class="btn btn-secondary ms-2">Reset</a>
    </div>
</div>
