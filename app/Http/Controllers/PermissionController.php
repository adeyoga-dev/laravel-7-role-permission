<?php

namespace App\Http\Controllers;
// model
use Spatie\Permission\Models\Permission;
// package
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view permission', ['only' => ['index']]);
        $this->middleware('permission:show permission', ['only' => ['show','getPermissionDatatable']]);
        $this->middleware('permission:create permission', ['only' => ['create store']]);
        $this->middleware('permission:edit permission', ['only' => ['edit update']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    public function index()
    {
        // kirim hasil
        return view('pages.permission.index');
    }

    public function getPermissionDatatable()
    {
        // mendapatkan data permission format datatable
        $permission = Permission::select('id','name')->orderBy('name')->get();
        // kirim hasil
        return DataTables::of($permission)
        ->addIndexColumn()
        ->addColumn('action', function($row){
            return $this->buttonAction("danger","btnDelete","Hapus","fa-solid fa-trash",$row->id);
        })
        ->rawColumns(['action'])
        ->make();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // validasi data
        $validator =  Validator::make($request->all(), [
            'permission' => ['required', 'string', 'max:255'],
        ]);
        // jika validasi gagal akan mengirim pesan error
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        // membuat permission dari request
        Permission::create(['name' => $request->permission]);
        // kirim hasil
        return "Berhasil disimpan";
    }

    public function show($id)
    {
        //
    }

    public function getPermissionJson()
    {
        // mendapatkan data permission format datatable
        $permission = Permission::select('id','name')->orderBy('id')->get();
        // kirim hasil
        return $permission;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        // mencari permission berdasarkan id
        $permission = Permission::where('id', $id)->first();
        // menghapus permission
        if ($permission) {
            $permission->delete();
            return "Berhasil dihapus";
        }
        return "Gagal dihapus";
    }
}
