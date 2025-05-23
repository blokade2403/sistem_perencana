 <!-- Refer & Earn Modal -->
 <div class="modal fade" id="referAndEarn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body pt-3 pt-md-0 px-0 pb-md-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <img src="assets/img/illustrations/file.png" height="157" width="275" alt="user image" class="text-center mb-3" />
                    <h3 class="mb-2">Upload Data Komponen Barang</h3>
                    <p class="text-center w-75 m-auto mt-1">
                        Upload Data Rencana Kebutuhan Unit
                    </p>
                </div>
                <form action="{{ route('komponens.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-10">
                        <label class="form-label fw-normal" for="modalRnFEmail"><span class="text-danger"> * yang bisa upload berekstention .xls</span></label>
                        <input type="file" name="file" id="formfile" class="form-control" />
                    </div>
                    <h5 class="mt-4">Download Format Upload File</h5>
                    <div class="col-lg-9">
                        <label class="form-label fw-normal" for="modalRnFLink"><a href="" class="btn btn-outline-secondary btn-primary"> Download Format. 🥳 </a></label>
                    </div>
                    <div class="modal-footer">
                        <a href="" class="btn btn-secondary light">Back</a>
                        <button type="submit" value="Upload file" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Refer & Earn Modal -->