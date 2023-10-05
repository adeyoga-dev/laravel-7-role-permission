<div class="col-md-12">
    <div class="card">
        <div class="card-header">Daftar Permission</div>
        <div class="card-body table-responsive">
            <div class="d-grid gap-2 my-3">
                <button type="button" class="btn btn-success btn-sm" id="btnAddPermissionModal"><i class="fa fa-plus"></i>
                    Tambahkan Permission
                </button>
            </div>
            <table id="permissionTable" class="table-striped w-100">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Permission</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        $("#permissionTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('permission.get.datatable') }}",
            columns: [{
                    "data": 'DT_RowIndex',
                },
                {
                    "data": "name"
                },
                {
                    "data": "action",
                },
            ],
            "columnDefs": [
                { "searchable": false, "targets": [0,2] },
                { "orderable": false, "targets": [0,2] }
            ]
        });
        //#########################################################################
        $(document).on("click", "#btnDelete", function() {
            //mendapatkan data
            var permissionId = $(this).attr("data-id");
            // mereplace url dengan id
            var url = "{{ route('permission.destroy', '#id') }}";
            var newUrl = url.replace("#id", permissionId);
            // mengupdate status user
            $.ajax({
                type: "DELETE",
                url: newUrl,
                data: {
                    "_token": token
                },
                success: function(data) {
                    $('#permissionTable').DataTable().ajax.reload();
                    alert(data);
                }
            });
        });
    });
</script>
