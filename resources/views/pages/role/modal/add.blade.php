<div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card-border-radius">
            <div class="modal-header header-black">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Role</h1>
                <button type="button" class="btn-close button-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="errorMessage">
                    <!-- tempat pesan error -->
                </div>
                <div class="form-group row mb-3">
                    <label for="role" class="col-md-2 col-form-label text-md-right">Role</label>
                    <div class="col-md-10">
                        <input id="role-add" type="text" class="form-control" name="role" required placeholder="Contoh: Administrator, Moderator, Pengguna">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnAddSave">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        $("#btnAddRoleModal").click(function(){
            // memunculkan modal add role
            $("#addRoleModal").modal("toggle");
            // mengosongkan textbox role
            $("#role-add").val("");
        });
        //#########################################################################
        $("#btnAddSave").click(function(){
            // mendapatkan data pada textbox di modal add role
            var role = $("#role-add").val();
            // mengirim data role
            $.ajax({
                type : "POST",
                url : "{{ route('role.store') }}",
                data : {
                    "role" : role,
                    "_token": token
                },
                success : function(data){
                    //cek jika ada pesan error
                    if($.isEmptyObject(data.error)){
                        $("#addRoleModal").modal("toggle");
                        $('#roleTable').DataTable().ajax.reload();
                        alert(data);
                    }else{
                        printErrorMsg(data.error,"errorMessage");
                    }
                }
            });
        });
    });
</script>

