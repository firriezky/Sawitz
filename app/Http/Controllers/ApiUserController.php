<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\ApiToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiUserController extends Controller
{

    /**
     * getAllUserData.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll(Request $request)
    {
        $this->validate($request, [
            'api_key'     => 'required',
        ]);

        $key = $request->api_key;
        $check = DB::table('api_key')
            ->where('key', '=', "$key")
            ->count();

        if ($check==0){
            return response()->json([
                'message' => "Unauthorized, Api Key Mismatch",
                'http_response' => 401,
                'status_code' => 0,
            ], 401);
        }

        $userCount = User::count();
        $userAdmin = User::where('role', 1)->count();
        $userStaff = User::where('role', 2)->count();
        $userCust = User::where('role', 3)->count();
        $users = User::orderBy('role')->get();

        $stat = array(
            "user_count" => $userCount,
            "user_admin" => $userAdmin,
            "user_staff" => $userStaff,
            "user_customer" => $userCust,
        );

        return response()->json([
            'http_response' => 200,
            'status' => 1,
            'message_id' => 'Berhasil Mengambil Data User',
            'message' => 'User Data retrieved successfully',
            'user_statistic' => $stat,
            'users' => UserResource::collection($users),
        ]);
    }

    public function generateToken($userID)
    {
        $api_token = Str::random(60);
        $token = ApiToken::create([
            'user_id' => $userID,
            'token' => $api_token,
        ]);
        if ($token){
            return array(1,$api_token);
        }else{
            return (0);
        }
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
     * Show the application dashboard.
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


    public function login(Request $request)
    {
        $rules = [
            'username'     => 'required',
            'password'     => 'required',

        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);

        $username = $request->username;
        $password = $request->password;

        $loginStatus = 0;

        if(is_numeric($request->get('username'))){
            if (Auth::attempt(['contact' => $username, 'password' => $password])) {
                $loginStatus=1;
            }else{
                $loginStatus=0;
            }
        }
        elseif (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
            if (Auth::attempt(['email' => $username, 'password' => $password])) {
                $loginStatus=1;
            }else{
                $loginStatus=0;
            }
        }

        if ($loginStatus==1){

            $userID = Auth::user()->id;
            $userName = Auth::user()->name;
            $user = User::find($userID);

            $generateToken = $this->generateToken($userID);
            if ($generateToken[0]==1){
                $userData = (new UserResource($user));
                return response()->json([
                    'http_response' => 200,
                    'status' => 1,
                    'message_id' => 'Berhasil Login',
                    'message' => 'Login Success',
                    'token' => "$generateToken[1]",
                    'userData' => $userData
                ]);
            }else{
                return response()->json([
                    'http_response' => 500,
                    'status' => 0,
                    'message_id' => 'Terjadi Kesalahan',
                    'message' => 'An error occured, try again later',
                ]);
            }
        }else{
            return response()->json([
                'http_response' => 400,
                'status' => 3,
                'message_id' => 'Username Atau Password Salah',
                'message' => 'Username or password didnt match',
            ]);
        }
    }

}
