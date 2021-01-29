<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RequestSellController extends Controller
{
    /**
     * Show the sell request dashboard
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function manage()
    {
        $userCount = User::count();
        $userAdmin = User::where('role', 1)->count();
        $userStaff = User::where('role', 2)->count();
        $userCust = User::where('role', 3)->count();
        $user = User::orderBy('role')->get();
        return view('admin.sellRequest.manage')
            ->with(compact('user','userAdmin','userCust','userStaff'
                ,'userCount'));
    }

    public function create()
    {
        $userCount = User::count();
        $userAdmin = User::where('role', 1)->count();
        $userStaff = User::where('role', 2)->count();
        $userCust = User::where('role', 3)->count();
        $user = User::orderBy('role')->get();
        return view('admin.sellRequest.create')
            ->with(compact('user','userAdmin','userCust','userStaff'
                ,'userCount'));
    }



    public function removeTokenByUser($userID)
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }

    public function removeTokenByID($tokenID)
    {
        $this->api_token = str_random(60);
        $this->save();
        return $this->api_token;
    }

    /**
     * store the request sell
     *
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_pengguna' => 'required',
            'status' => 'required',
            'email' => 'required|unique:users',
            'tanggal_lahir' => 'required',
            'contact' => 'required|unique:users|numeric',
            'role' => 'required',
            'password' => 'required', 'string', 'min:8',
        ];

        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

//        $date_birth = Carbon::parse($request->tanggal_lahir);

        $user = User::create([
            'name' => $request->nama_pengguna,
            'gender' => $request->gender,
            'email' => $request->email,
            'contact' => $request->contact,
            'date_birth' => $request->tanggal_lahir,
            'profile_url' => '',
            'status' => $request->status,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return response()->json([
                'http_response' => 200,
                'status' => 1,
                'message_id' => 'Registrasi Berhasil, Silakan Login Menggunakan Akun Anda',
                'message' => 'Registration Success',
            ]);
        } else {
            return response()->json([
                'http_response' => 400,
                'status' => 0,
                'message_id' => 'Registrasi Gagal',
                'message' => 'Registration Failed',
            ]);
        }
    }
}
