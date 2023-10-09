<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content card-border-radius">
            <div class="modal-header header-black">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Email</h1>
                <button type="button" class="btn-close button-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="errorMessage">
                    <!-- tempat pesan error -->
                </div>
                <div class="form-group m-1">
                    <label for="email" class="col-form-label text-md-right">Email Baru</label>
                    <input type="email" class="form-control" id="newEmail" placeholder="contoh: budi@gmail.com">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="btnEmailSave">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // mereplace url dengan id
        var userId = "{{auth()->id()}}";
        //#########################################################################
        $("#btnEmailModal").click(function(){
            // memunculkan modal edit email
            $("#editEmailModal").modal("toggle");
            // mengosongkan textbox email
            $("#newEmail").val("");
        });
        //#########################################################################
        $("#btnEmailSave").click(function() {
            // inisialisasi variabel
            var newEmail = $("#newEmail").val();
            // mengirim data password
            $.ajax({
                type: "POST",
                url: "{{route('profile.send.email')}}",
                data: {
                    "userId": userId,
                    "newEmail": newEmail,
                    "_token": token
                },
                success: function(data) {
                    //cek jika ada pesan error
                    if ($.isEmptyObject(data.error)) {
                        $("#editEmailModal").modal("toggle");
                        alert(data);
                    } else {
                        printErrorMsg(data.error, "errorMessage");
                    }
                }
            });
        });
    });
</script>
