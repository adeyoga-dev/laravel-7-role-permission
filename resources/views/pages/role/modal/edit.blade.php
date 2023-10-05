<div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-border-radius">
            <div class="modal-header header-black">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Role</h1>
                <button type="button" class="btn-close button-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="errorMessage">
                    <!-- tempat pesan error -->
                </div>
                <div class="form-group row mb-3">
                    <label for="role-edit" class="col-md-2 col-form-label text-md-right">Role</label>
                    <div class="col-md-10">
                        <input id="role-edit" type="text" class="form-control" data-id="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnEditSave">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        $(document).on("click", "#btnView", function() {
            // memunculkan modal add role
            $("#editRoleModal").modal("toggle");
            // mereplace url dengan id
            roleId = $(this).attr("data-id");
            var url = "{{ route('role.show', '#id') }}";
            var newUrl = url.replace("#id", roleId);
            /// mendapatkan data role
            $.ajax({
                type: "GET",
                url: newUrl,
                success: function(data) {
                    //cek apakah properti name dan email ada di objek data
                    if (data.hasOwnProperty("name") && data.hasOwnProperty("id")) {
                        $("#role-edit").val(data.name);
                        $("#role-edit").attr("data-id", data.id);
                    } else {
                        $("#role-edit").val("Data tidak ditemukan");
                    }
                }
            });
        });
        //#########################################################################
        $("#btnEditSave").click(function() {
            // mendapatkan data pada textbox di modal edit user
            role = $("#role-edit").val();
            roleId = $("#role-edit").attr("data-id");
            // mereplace url dengan id
            var url = "{{ route('role.update', '#id') }}";
            var newUrl = url.replace("#id", roleId);
            // mengirim data user
            $.ajax({
                type: "PUT",
                url: newUrl,
                data: {
                    "role": role,
                    "_token": token
                },
                success: function(data) {
                    //cek jika ada pesan error
                    if ($.isEmptyObject(data.error)) {
                        $("#editRoleModal").modal("toggle");
                        $('#roleTable').DataTable().ajax.reload();
                        alert(data);
                        //mereset error message
                        $("#errorMessage").empty();
                    } else {
                        printErrorMsg(data.error, "errorMessage");
                    }
                }
            });
        });
    });
</script>
