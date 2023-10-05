<div class="modal fade" id="addPermissionModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-border-radius">
            <div class="modal-header header-black">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Permission</h1>
                <button type="button" class="btn-close button-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="errorMessage">
                    <!-- tempat pesan error -->
                </div>
                <div class="form-group row mb-3">
                    <label for="permission" class="col-md-2 col-form-label text-md-right">Permission</label>
                    <div class="col-md-10">
                        <input id="permission" type="text" class="form-control" name="permission" required
                            placeholder="Contoh: view user, delete role">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnSave">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        $("#btnAddPermissionModal").click(function() {
            // memunculkan modal add role
            $("#addPermissionModal").modal("toggle");
            // mengosongkan textbox role
            $("#permission").val("");
        });
        //#########################################################################
        $("#btnSave").click(function() {
            // mendapatkan data pada textbox di modal add role
            var permission = $("#permission").val();
            // mengirim data role
            $.ajax({
                type: "POST",
                url: "{{ route('permission.store') }}",
                data: {
                    "permission": permission,
                    "_token": token
                },
                success: function(data) {
                    //cek jika ada pesan error
                    if ($.isEmptyObject(data.error)) {
                        $("#addPermissionModal").modal("toggle");
                        $('#permissionTable').DataTable().ajax.reload();
                        alert(data);
                    } else {
                        printErrorMsg(data.error, "errorMessage");
                    }
                }
            });
        });
    });
</script>
