<div class="modal-onboarding modal fade animate__animated" id="onboardImageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content text-center">
            <div class="modal-header border-0">
                <a class="text-muted close-label" href="javascript:void(0);" data-bs-dismiss="modal">Skip Intro</a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="onboarding-media">
                    <div class="mx-2">
                        <img src="assets/img/illustrations/file.png" alt="file" width="335" class="img-fluid" data-app-light-img="illustrations/file.png" data-app-dark-img="illustrations/file.png" />
                    </div>
                </div>
                <div class="onboarding-content mb-0">
                    <h4 class="onboarding-title text-body">Tuliskan Keterangan Perubahan</h4>
                    <div class="onboarding-info">
                        Contoh : Perubahan Harga karena menyesuaikan harga ekatalog, dll.
                    </div>
                    <form id="keteranganForm">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-floating form-floating-outline mb-3">
                                    <input class="form-control" placeholder="Tuliskan Keterangan" type="text" name="keterangan_status" value="" tabindex="0" id="nameEx3" />
                                    <label for="nameEx3">Keterangan</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <h4 class="onboarding-title text-body">Upload File Pendukung</h4>
                    <div class="onboarding-info">
                        Contoh : Nota Dinas, KAP dll
                    </div>
                    <div class="form-floating form-floating-outline mb-0">
                        <input class="form-control" type="file" name="upload_file_5" id="formFileMultiple" multiple />
                        <label for="nameEx3">FIle Pendukung</label>
                    </div>
                </div>


            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>