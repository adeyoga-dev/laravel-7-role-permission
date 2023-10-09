<div class="col-md-12">
    <div class="card">
        <div class="card-header">Profil</div>
        <div class="card-body p-5">
            <div class="row">
                <div class="col-md-3">
                    <img src="{{asset('image/profile/profile.png')}}" class="img-fluid" alt="profile-picture">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group m-1">
                                <label for="name" class=" col-form-label text-md-right">Nama</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="name">
                                    <button class="btn btn-primary" type="button" id="btnSaveName" aria-label="Simpan Nama" data-microtip-position="top" role="tooltip"><i class="fa-solid fa-floppy-disk"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group m-1">
                                <label for="nik" class="col-form-label text-md-right">NIK</label>
                                <input type="text" class="form-control" id="nik" onkeydown="return false;">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group m-1">
                                <label for="email" class="col-form-label text-md-right">Email</label>
                                <input type="text" class="form-control" id="email" onkeydown="return false;">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-grid gap-2">
                            <button type="button" class="btn btn-primary my-3 mx-1" id="btnPasswordModal">Ubah Password</button>
                        </div>
                        <div class="col-md-6 d-grid gap-2">
                            <button type="button" class="btn btn-primary my-3 mx-1" id="btnEmailModal">Ubah Email</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // mereplace url dengan id
        var userId = "{{auth()->id()}}";
        var url = "{{ route('profile.show', '#id') }}";
        var newUrl = url.replace("#id", userId);
        // mendapatkan data user
        $.ajax({
            type: "GET",
            url: newUrl,
            success: function(data) {
                //cek jika data ada dan memasukkan data ke textbox
                if(data.hasOwnProperty("name") && data.hasOwnProperty("nik") && data.hasOwnProperty("email")){
                    $("#name").val(data.name);
                    $("#nik").val(data.nik);
                    $("#email ").val(data.email );
                }else{
                    $("#name").val("Data tidak ditemukan");
                    $("#nik").val("Data tidak ditemukan");
                    $("#email ").val("Data tidak ditemukan");
                }
            }
        });
        //#########################################################################
        $("#btnSaveName").click(function(){
            //inisialisasi variabel
            var name = $("#name").val();
            // mereplace url dengan id
            var url = "{{ route('profile.update', '#id') }}";
            var newUrl = url.replace("#id", userId);
            // mengirim data user
            $.ajax({
                type: "PUT",
                url: newUrl,
                data: {
                    "name" : name,
                    "_token" : token
                },
                success: function(data) {
                    alert(data);
                }
            });
        });
        //#########################################################################
    });
</script>
