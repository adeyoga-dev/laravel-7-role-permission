<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content card-border-radius">
            <div class="modal-header header-black">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Permission</h1>
                <button type="button" class="btn-close button-close" data-bs-dismiss="modal"aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="rolePermission"></div>
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
        // inisialisasi variabel
        var roleId;
        // event tombol action permission
        $(document).on("click", "#btnPermission", function() {
            // memunculkan modal edit user
            $("#editPermissionModal").modal("toggle");
            // mengosongkan textbox pemilihan role
            $("#rolePermission").empty();
            //mendapatkan id role
            roleId = $(this).attr("data-id");
            // mendapatkan data role untuk dimasukkan ke textbox pemilihan role
            $.ajax({
                type: "GET",
                url: "{{ route('permission.get.json') }}",
                success: function(data) {
                    $.each(data, function(index, value) {
                        //cek apakah properti name dan id ada di objek value, lalu loop checkbox nya
                        if (value.hasOwnProperty("name") && value.hasOwnProperty("id")) {
                            $("#rolePermission").append(
                                `
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="`+value.name+`">`+value.name+`</label>
                                    <input class="form-check-input" type="checkbox" id="`+value.name+`" role="switch" value="`+value.id+`">
                                </div>
                                `
                            )
                        } else {
                            $("#rolePermission").append('Permission tidak ada')
                        }
                    });
                }
            });
            //membuat url baru
            var url = "{{ route('role.get.permission', ['id' => '#id']) }}";
            newUrl = url.replace("#id", roleId);
            // mereset input checkbox ke keadaan unchecked
            $("[type='checkbox']").each(function(index) {
                $(this).prop("checked", false);
            })
            // mendapatkan data permission berdasarkan role
            $.ajax({
                type: "GET",
                url: newUrl,
                success: function(data) {
                    //me-looping checkbox
                    $("[type='checkbox']").each(function(index) {
                        var valueCheckbox = $(this).val();
                        //me-looping checkbox
                        for (var key in data.permissions) {
                            // check apakah variabel data ada properti
                            if (data.hasOwnProperty("permissions")) {
                                var permissionId = data.permissions[key].id;
                                var valueCheckbox = $(this).val();
                                valueCheckbox = parseInt(valueCheckbox);
                                // jika nilai sama maka checkbox akan di checked
                                if (valueCheckbox === permissionId) {
                                    $(this).prop("checked", true);
                                }
                            }
                        }
                    })
                }
            });
        });
        //#########################################################################
        // event tombol action simpan
        $("#btnSave").click(function() {
            // inisialisasi array
            var permission = [];
            //me-looping checkbox
            $("[type='checkbox']").each(function(index) {
                // cek jika checbox di kondisi checked
                if ($(this).prop("checked") == true) {
                    permission.push($(this).val());
                }
            })
            // mengirim data permission berdasarkan role
            $.ajax({
                type: "POST",
                url: "{{route('role.update.permission')}}",
                data: {
                    "roleId" : roleId,
                    "permission": permission,
                    "_token": token
                },
                success: function(data) {
                    //cek jika ada pesan error
                    if ($.isEmptyObject(data.error)) {
                        $("#editPermissionModal").modal("toggle");
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
