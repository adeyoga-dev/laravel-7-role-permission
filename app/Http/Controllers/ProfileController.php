<?php

namespace App\Http\Controllers;
// model
use App\Models\User;
// package
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    public function index()
    {
        //kirm hasil
        return view('pages.profile.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        // mendapatkan data user
        $user = User::select('id','name','email','nik')->find($id);
        // kirim hasil
        return $user;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // update data user
        $user = User::find($id);
        $user->name = $request->name;
        $user->save();
        // cek jika data ada lalu kirim hasil
        if($user) return "Berhasil disimpan";
        return "Gagal disimpan";
    }

    public function updatePassword(Request $request){
        // validasi data
        $validator =  Validator::make($request->all(), [
            'currentPassword' => ['required', 'string', 'max:255'],
            'newPassword' => ['required', 'string', 'max:255'],
        ]);
        // jika validasi gagal akan mengirim pesan error
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        // inisialisasi data user
        $user = User::find($request->userId);
        $oldPassword = $user->password;
        $currentPassword = $request->currentPassword;
        // cek jika password sama
        if (Hash::check($currentPassword, $oldPassword)) {
            // mengubah password user
            $user->password = Hash::make($request->newPassword) ;
            $user->save();
            // kirim hasil
            return "Password berhasil diubah";
        }
        // kirim hasil
        return "Password tidak sama dengan yang lama";

    }

    public function destroy($id)
    {
        //
    }
}
