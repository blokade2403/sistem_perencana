 <!-- Refer & Earn Modal -->

 <div class="modal fade" id="referAndEarn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body pt-3 pt-md-0 px-0 pb-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3 class="mb-2">Form Permintaan Barang Persediaan</h3>
                    <p class="text-center w-75 m-auto mt-1">
                        Usulan Permintaan Belanja {{session('nama_lengkap')}}
                    </p>
                </div>
                <div class="row py-2">
                    <div class="col-12 col-lg-4 px-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="modal-refer-and-earn-step bg-label-primary">
                                <i class="mdi mdi-message-outline mdi-36px"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h6 class="fw-semibold mb-2">Ajukan Usulan Belanja</h6>
                            <p class="mb-lg-0">Kategori Belanja dan Komponen</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 px-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="modal-refer-and-earn-step bg-label-primary">
                                <i class="mdi mdi-content-paste mdi-36px"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h6 class="fw-semibold mb-2">Validasi Data Perencanaan</h6>
                            <p class="mb-lg-0">Penyesuian RBA Belanja {{session('nama_lengkap')}}</p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 px-4">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="modal-refer-and-earn-step bg-label-primary">
                                <i class="mdi mdi-medal-outline mdi-36px"></i>
                            </div>
                        </div>
                        <div class="text-center">
                            <h6 class="fw-semibold mb-2">Proses Permintaan Barang</h6>
                            <p class="mb-0">Persetujuan dan Proses Pengadaan</p>
                        </div>
                    </div>
                </div>
                <hr class="my-4 mx-n3 mx-md-n5" />
                <h5 class="pt-2">Pilih Kategori Sesuai dengan Input RBA</h5>
                <form class="row g-3" method="POST" action="{{ route('usulan_barang_persediaans.store') }}">
                    @csrf
                    <div class="col-lg-10">
                        <label class="form-label fw-normal" for="modalRnFEmail">Input Kategori Belanja Sesuai dalam RBA</label>
                        <select id="subKategoriSelect2" name="id_sub_kategori_rkbu" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option data-display="Select">Pilih Sub Kategori RKBU</option>
                            @foreach($sub_kategori_rkbus as $sub_kategori)
                                <option value="{{ $sub_kategori->id_sub_kategori_rkbu }}">{{ $sub_kategori->kode_sub_kategori_rkbu }}. {{ $sub_kategori->nama_sub_kategori_rkbu }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 d-flex align-items-end">
                        <!-- Other hidden fields -->
                        <input type="hidden" name="id_user" value="{{session('id_user')}}">
                        <input type="hidden" name="nama_pengusul_barang" value="{{session('nama_lengkap')}}">
                        <input type="hidden" name="tahun_anggaran" value="{{session('tahun_anggaran')}}">
                        <input type="hidden" name="status_usulan_barang" value="Pending">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <input type="hidden" id="id_sub_kategori_rekening" name="id_sub_kategori_rekening" class="form-control" placeholder="Jenis Belanja"><br/>
                    <input type="hidden" name="id_kategori_rkbu" id="id_kategori_rkbu" class="form-control" placeholder="kategori">
                    <input type="hidden" name="id_jenis_kategori_rkbu" id="id_jenis_kategori_rkbu" class="form-control" placeholder="Jenis Kategori">
                </form>
                
            </div>
        </div>
    </div>
</div>
<!--/ Refer & Earn Modal -->