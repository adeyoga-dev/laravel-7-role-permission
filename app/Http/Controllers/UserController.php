<?php

namespace App\Http\Controllers;
// model
use App\Models\User;
use Spatie\Permission\Models\Role;
// package
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public  function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:show user', ['only' => ['show','getUserDatatable']]);
        $this->middleware('permission:create user', ['only' => ['create store']]);
        $this->middleware('permission:edit user', ['only' => ['edit update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        // kirim hasil
        return view('pages.user.index');
    }

    public function getUserDatatable()
    {
        // mendapatkan data user format datatable
        $users = User::select('id','name','email','nik','status')->get();
        // kirim hasil
        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btnActive = $this->buttonAction("success","btnActive","Aktifkan","fa-solid fa-check",$row->id);
            $btnNonActive = $this->buttonAction("warning","btnNonActive","Non-Aktifkan","fa-solid fa-circle-xmark",$row->id);
            $btnStatus = $btnActive;
            // cek tombol status berdasarkan status akun
            if($row->status == 'active') $btnStatus = $btnNonActive;
            // cek jika akun super admin
            if($row->id == 1){
                return "Tidak ada aksi";
            }
            return
                $this->buttonAction("primary","btnView","Lihat/Edit","fa-solid fa-pen-to-square",$row->id)
                .$this->buttonAction("danger","btnDelete","Hapus","fa-solid fa-trash",$row->id)
                .$btnStatus
            ;
        })
        ->editColumn('status',function($row){
            $badgeActive = '<span class="badge bg-success">Active</span>';
            $badgeNonActive = '<span class="badge bg-danger">Non Active</span>';
            // cek badge status berdasarkan status akun
            if($row->status == 'active') return $badgeActive;
            return $badgeNonActive;
        })
        ->rawColumns(['action','status'])
        ->make();
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        // mendapatkan data user
        $user = User::select('id','name','email')->find($id);
        $roleId = $user->roles()->pluck('id')->first();
        // membungkus data
        $data = [
            'user' => $user,
            'roleId' => $roleId
        ];
        // kirim hasil
        return $data;

    }

    public function edit($id)
    {
        $user = User::find($id);
        // check jika user ada
        if(!isset($user)){
            return "Gagal di non-aktifkan";
        }
        // update status user
        if($user->status == "active"){
            $user->status = "nonactive";
            $message = "Berhasil di non-aktifkan";
        }else{
            $user->status = "active";
            $message = "Berhasil di aktifkan";
        }
        $user->save();
        // kirim hasil
        return $message;
    }

    public function update(Request $request, $id)
    {
        // validasi data
        $validator =  Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ]);
        // jika validasi gagal akan mengirim pesan error
        if($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        $user = User::find($id);
        $role = Role::find($request->roleId);
        // menghapus semua role pada user
        $user->revokeAllRoles();
        // update data user
        $user->name = $request->name;
        $user->assignRole($role);
        $user->save();
        // cek jika data ada lalu kirim hasil
        if($user && $role) return "Berhasil disimpan";
        return "Gagal disimpan";
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        // cek jika data ada lalu kirim hasil
        if($user) return "Berhasil dihapus";
        return "Gagal terhapus";
    }

}
