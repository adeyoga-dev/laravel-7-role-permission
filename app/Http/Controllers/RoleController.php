<?php

namespace App\Http\Controllers;
// model
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// package
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:show role', ['only' => ['show getRoleJson getRoleDatatable']]);
        $this->middleware('permission:create role', ['only' => ['create store']]);
        $this->middleware('permission:edit role', ['only' => ['edit update updatePermissionRole']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index()
    {
        // kirim hasil
        return view('pages.role.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {   // validasi data
        $validator =  Validator::make($request->all(), [
            'role' => ['required', 'string', 'max:255'],
        ]);
        // jika validasi gagal akan mengirim pesan error
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        // membuat role dari request
        Role::create(['name' => $request->role]);
        // kirim hasil
        return "Berhasil disimpan";
    }

    public function show($id)
    {
        $role = Role::select('id','name')->find($id);
        return $role;
    }

    public function getRoleDatatable()
    {
        // mendapatkan data user format datatable
        $roles = Role::select('id','name')->get();
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                // cek jika role super admin
                if($row->id == 1){
                    return "Tidak ada aksi";
                }
                return $this->buttonAction("primary","btnView","Lihat/Edit","fa-solid fa-pen-to-square",$row->id)
                    .$this->buttonAction("info","btnPermission","Edit Permission","fa-solid fa-key",$row->id)
                    .$this->buttonAction("danger", "btnDelete", "Hapus", "fa-solid fa-trash", $row->id);
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function getRoleJson()
    {
        $roles = Role::select('id','name')->get();
        return $roles;
    }

    public function getRolePermission($id){
        // mendapatkan data permission berdasarkan role
        $permission = Role::with('permissions')->find($id);
        return $permission;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // validasi data
        $validator =  Validator::make($request->all(), [
            'role' => ['required', 'string', 'max:255'],
        ]);
        // jika validasi gagal akan mengirim pesan error
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        // mencari role berdasarkan id
        $role = Role::find($id);
        if(!$role) return "Gagal disimpan";
        // update data role
        $role->name = $request->role;
        $role->save();
        // cek jika data ada lalu kirim hasil

        return "Behasil disimpan";

    }

    public function updatePermissionRole(Request $request){
        //mendapatkan data role
        $role = Role::find($request->roleId);
        if(!$role) return "Gagal di simpan";
        // menghapus semua permission berdasarkan role
        $role->syncPermissions([]);
        // check jika data di request ada
        if ($request->has('permission') && is_array($request->permission)) {
            foreach ($request->permission as $item) {
                $permission = Permission::find($item);
                // update permission berdasarkan role
                $role->givePermissionTo($permission);
            }
        }

        return "Berhasil di simpan";
    }

    public function destroy($id)
    {
        // mencari role berdasarkan id
        $role = Role::where('id', $id)->first();
        // cek user yang menggunakan role
        $userHasRole = $role->users;
        // cek jumlah user jika memakai role tersebut
        if($userHasRole->count() > 0){
            return "Gagal, role memiliki user terdaftar";
        }
        // menghapus role
        if ($role) {
            $role->delete();
            return "Berhasil dihapus";
        }
        return "Gagal dihapus";

    }
}
