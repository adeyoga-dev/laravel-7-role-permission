<?php

namespace App\Http\Controllers;
// modal
use App\Models\User;
use Spatie\Permission\Models\Role;
// package
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public  function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:show user', ['only' => ['show','get','getUserDatatable']]);
        $this->middleware('permission:create user', ['only' => ['create store']]);
        $this->middleware('permission:edit user', ['only' => ['edit update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('pages.user.index');
    }

    public function getUserDatatable()
    {
        // mendapatkan data user format datatable
        $users = User::get();
        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            $btnActive = $this->buttonAction("success","btnActive","Aktifkan","fa-solid fa-check",$row->id);
            $btnNonActive = $this->buttonAction("danger","btnNonActive","Non-Aktifkan","fa-solid fa-circle-xmark",$row->id);
            $btnStatus = $btnActive;
            // cek tombol status berdasarkan status akun
            if($row->status == 'active') $btnStatus = $btnNonActive;
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
        $user = User::find($id);
        $roleId = $user->roles()->pluck('id')->first();
        //membungkus data
        $data = [
            'user' => $user,
            'roleId' => $roleId
        ];
        return $data;

    }

    public function edit($id)
    {
        $user = User::find($id);
        //update status user
        if($user->status == "active"){
            $user->status = "nonactive";
        }else{
            $user->status = "active";
        }
        if($user){
            $user->save();
            return "Berhasil di aktifkan";
        }
        return "Gagal di non-aktifkan";
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $role = Role::find($request->roleId);
        //update data user
        $user->name = $request->name;
        $user->assignRole($role);
        $user->save();
        //cek jika data tidak ada
        if($user && $role) return "Berhasil disimpan";
        return "Gagal disimpan";
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        if($user) return "Berhasil dihapus";
        return "Gagal terhapus";
    }
}
