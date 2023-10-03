<div class="col-md-12">
    <div class="card">
        <div class="card-header">Daftar Role</div>
        <div class="card-body table-responsive">
            <div class="d-grid gap-2 my-3">
                <button type="button" class="btn btn-success btn-sm" id="btnAddRoleModal"><i class="fa fa-plus"></i> Tambahkan Role</button>
            </div>
            <table id="roleTable" class="table-striped w-100">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        $("#roleTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('role.get.datatable') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    "data": "name"
                },
                {
                    "data": "action",
                    orderable: false,
                    searchable: false
                },
            ],
        });
        //#########################################################################
        $( document ).on("click", "#btnDelete", function(){
            //mendapatkan data
            var role = $(this).attr("data-id");
            // mereplace url dengan id
            var url = "{{ route('role.destroy', '#id') }}";
            var newUrl = url.replace("#id", role);
            // mengupdate status user
            $.ajax({
                type : "DELETE",
                url : newUrl,
                data : {
                    "_token": token
                },
                success : function(data){
                    $('#roleTable').DataTable().ajax.reload();
                    alert(data);
                }
            });
        });
    });
</script>
