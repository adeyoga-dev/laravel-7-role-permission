<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content card-border-radius">
            <div class="modal-header header-black">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                <button type="button" class="btn-close button-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-3">
                    <label for="name" class="col-md-2 col-form-label text-md-right">Nama</label>
                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name" data-id="" required autofocus>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>
                    <div class="col-md-10">
                        <input id="email" type="text" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="form-group row mb-3">
                    <label for="role" class="col-md-2 col-form-label text-md-right">Role</label>
                    <div class="col-md-10">
                        <select class="form-select" name="role" id="role">
                        </select>
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
        $( document ).on("click", "#btnView", function(){
            // memunculkan modal edit user
            $("#editUserModal").modal("toggle");
            // mengosongkan textbox pemilihan role
            $("#role").empty();
            // mendapatkan data role untuk dimasukkan ke textbox pemilihan role
            $.ajax({
                type : "GET",
                url : "{{route('role.get.json')}}",
                success : function(data){
                    $.each(data, function(index, value){
                        //cek apakah properti name dan id ada di objek value
                        if(value.hasOwnProperty("name") && value.hasOwnProperty("id")){
                            $("#role").append('<option value="'+value["id"]+'">'+value["name"]+'</option>')
                        }else{
                            $("#role").append('<option value="">Data tidak ada</option>')
                        }
                    });
                }
            });
            // mereplace url dengan id
            userId = $(this).attr("data-id");
            var url = "{{ route('user.show', '#id') }}";
            var newUrl = url.replace("#id", userId);
            // mendapatkan data user
            $.ajax({
                type : "GET",
                url : newUrl,
                success : function(data){
                    //cek apakah properti name dan email ada di objek data
                    if(data.hasOwnProperty("user") && data.hasOwnProperty("roleId")){
                        $("#name").val(data.user.name);
                        $("#name").attr("data-id",data.user.id);
                        $("#email").val(data.user.email);
                        $("#role").val(data.roleId);
                    }
                    else{
                        $("#name").val("Data tidak ditemukan");
                        $("#email").val("Data tidak ditemukan");
                    }
                }
            });
        });
        //#########################################################################
        $("#btnSave").click(function(){
            // mendapatkan data pada textbox di modal edit user
            name = $("#name").val();
            userId = $("#name").attr("data-id");
            roleId = $("#role").val();
            // mereplace url dengan id
            var url = "{{ route('user.update', '#id') }}";
            var newUrl = url.replace("#id", userId);
            // mengirim data user
            $.ajax({
                type : "PUT",
                url : newUrl,
                data : {
                    "name" : name,
                    "roleId": roleId,
                    "_token": token
                },
                success : function(data){
                    $("#editUserModal").modal("toggle");
                    $('#userTable').DataTable().ajax.reload();
                    alert(data);
                }
            });
        });
        //#########################################################################
        $( document ).on("click", "#btnActive,#btnNonActive", function(){
            var userId = $(this).attr("data-id");
            // mereplace url dengan id
            var url = "{{ route('user.edit', '#id') }}";
            var newUrl = url.replace("#id", userId);
            // mengupdate status user
            $.ajax({
                type : "GET",
                url : newUrl,
                success : function(data){
                    $('#userTable').DataTable().ajax.reload();
                    alert(data);
                }
            });
        });
        //#########################################################################
        $( document ).on("click", "#btnDelete", function(){
            var userId = $(this).attr("data-id");
            console.log(userId);
            // mereplace url dengan id
            var url = "{{ route('user.destroy', '#id') }}";
            var newUrl = url.replace("#id", userId);
            // mengupdate status user
            $.ajax({
                type : "DELETE",
                url : newUrl,
                data : {
                    "_token": token
                },
                success : function(data){
                    $('#userTable').DataTable().ajax.reload();
                    alert(data);
                }
            });
        });
    });
</script>

