<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('email', '=', $request->email)->first();
        $status = 'error';
        $message = '';
        $data = null;
        $code = 401;
        if ($user && !$validator->fails()) {
            if (Hash::check($request->password, $user->password)) {
                $user->generateToken();
                $status = 'success';
                $message = 'Login Sukses';
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = 'Login Gagal, password salah';
            }
        } else {
            $message = 'Login gagal, username atau password salah';
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255', // name harus diisi teks dengan panjang maksimal 255
            'email' => 'required|string|email|max:255|unique:users', // email harus unik pada tabel users
            'password' => 'required|string|min:6', // password minimal 6 karakter
        ]);

        $status = 'error';
        $message = '';
        $data = null;
        $code = 400;
        if ($validator->fails()) { // fungsi untuk ngecek apakah validasi gagal
            $errors = $validator->errors();
            $message = $errors;
        } else{
            $user = \App\User::create([
                'name'  => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            if ($user) {
                $user->generateToken();
                $status = 'success';
                $message = 'register successfully';
                $data = $user->toArray();
                $code = 200;
            } else {
                $message = 'register failded';
            }
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function logout(Request $request)
    {
        $user = \Auth::user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'logout berhasil',
            'data' => []
        ], 200);
    }
}
