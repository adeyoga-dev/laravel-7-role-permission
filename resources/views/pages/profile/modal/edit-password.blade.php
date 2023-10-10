<div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-border-radius">
            <div class="modal-header header-black">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Password</h1>
                <button type="button" class="btn-close button-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="errorMessagePassword">
                    <!-- tempat pesan error -->
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group m-1">
                            <label for="currentPassword" class="col-form-label text-md-right">Password Lama</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="currentPassword" placeholder="*********">
                                <button class="btn btn-primary" type="button" id="btnCurrentPassword" aria-label="Perlihatkan Password" data-microtip-position="top" role="tooltip"><i class="fa-solid fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group m-1">
                            <label for="newPassword" class="col-form-label text-md-right">Password Baru</label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" id="newPassword" placeholder="*********">
                                <button class="btn btn-primary" type="button" id="btnNewPassword" aria-label="Perlihatkan Password" data-microtip-position="top" role="tooltip"><i class="fa-solid fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnPasswordSave">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // mereplace url dengan id
        var userId = "{{auth()->id()}}";
        //#########################################################################
        $("#btnPasswordModal").click(function(){
            // memunculkan modal edit password
            $("#editPasswordModal").modal("toggle");
            // mengosongkan textbox role
            $("#currentPassword,#newPassword").val("");
        });
        //#########################################################################
        $("#btnCurrentPassword").click(function(){
            var type = $("#currentPassword").attr("type");
            // memunculkan password
            if(type === "password"){
                $("#currentPassword").attr("type","text");
            }else{
                $("#currentPassword").attr("type","password");
            }

        });
        //#########################################################################
        $("#btnNewPassword").click(function(){
            var type = $("#newPassword").attr("type");
            // memunculkan password tergantung kondisi type textbox
            if(type === "password"){
                $("#newPassword").attr("type","text");
            }else{
                $("#newPassword").attr("type","password");
            }
        });
        //#########################################################################
        $("#btnPasswordSave").click(function() {
            // inisialisasi variabel
            var currentPassword = $("#currentPassword").val();
            var newPassword = $("#newPassword").val();
            // mengirim data password
            $.ajax({
                type: "POST",
                url: "{{route('profile.update.password')}}",
                data: {
                    "userId": userId,
                    "currentPassword": currentPassword,
                    "newPassword": newPassword,
                    "_token": token
                },
                success: function(data) {
                    //cek jika ada pesan error
                    if ($.isEmptyObject(data.error)) {
                        $("#editPasswordModal").modal("toggle");
                        alert(data);
                    } else {
                        printErrorMsg(data.error, "errorMessagePassword");
                    }
                }
            });
        });
    });
</script>
