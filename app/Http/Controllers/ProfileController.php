<?php

namespace App\Http\Controllers;
// model
use App\Models\User;
// package
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use Faker\Factory as Faker;

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

    public function sendEmail(Request $request){
        // validasi data
        $validator =  Validator::make($request->all(), [
            'newEmail' => ['required', 'string', 'email', 'max:255'],
        ]);
        // jika validasi gagal akan mengirim pesan error
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }
        // membuat nomor unik
        $faker = Faker::create();
        $randomNumber = $faker->uuid();
        // inisialisasi data user
        $user = User::find($request->userId);
        $name = $user->name;
        //cek jika token email user masih ada
        if(isset($user->email_token)){
            $user->email_token = NULL;
            $user->save();
        }
        // simpan nomor ke user
        $user->email_token = $user->email." ".$randomNumber;
        $user->save();
        // inisialisasi data
        $data = [
            'header' => 'Kode aktivasi email',
            'name' => 'Hello, '.$name,
            'body' => '
                Senang bisa berkenalan dengan kamu!
                Sebelum memulai, konfirmasi email yang kamu daftarkan
                untuk mendapatkan info lebih lanjut. dengan mengeklik tombol dibawah ini
            ',
            'link' => $user->email_token,
        ];

        Mail::to($request->newEmail)->send(new SendEmail($data));

        return "Kode konfirmasi pergantian email berhasil di kirim ke email lama anda";
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
