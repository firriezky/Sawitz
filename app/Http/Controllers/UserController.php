<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Util\Json;
use RazAPI;
class UserController extends Controller
{




    /**
     * Show the application dashboard.
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
            return view('admin.user.manage')
            ->with(compact('user','userAdmin','userCust','userStaff'
        ,'userCount'));
    }





     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $redirectTo = $request->redirectTo;
           $rules = [
            'nama_pengguna'     => 'required',
            'email'     => 'required|unique:users',
            'tanggal_lahir'     => 'required',
            'contact'     => 'required|unique:users|numeric',
            'role'     => 'required',
            'password'     =>  'required','string', 'min:8',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $url_profile = url('/');

        $date_birth = Carbon::parse($request->tanggal_lahir);

        $user = User::create([
            'name' => $request->nama_pengguna,
            'gender' => $request->gender,
            'email' => $request->email,
            'contact' => $request->contact,
            'date_birth' => $date_birth,
            'profile_url' => '',
            'status' => $request->status,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect("$redirectTo")->with(['success' => 'Berhasil Menambah User']);;
        }else{
            return redirect("$redirectTo")->with(['error' => 'Gagal Menambah User']);;
        }
    }


     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $redirectTo = $request->redirectTo;
           $rules = [
            'nama_pengguna'     => 'required',
            'email'     => 'required|unique:users',
            'tanggal_lahir'     => 'required',
            'contact'     => 'required|unique:users|numeric',
            'role'     => 'required',
            'password'     =>  'required','string', 'min:8',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $url_profile = url('/');

        $date_birth = Carbon::parse($request->tanggal_lahir);

        $user = User::create([
            'name' => $request->nama_pengguna,
            'gender' => $request->gender,
            'email' => $request->email,
            'contact' => $request->contact,
            'date_birth' => $date_birth,
            'profile_url' => '',
            'status' => $request->status,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect("$redirectTo")->with(['success' => 'Berhasil Menambah User']);;
        }else{
            return redirect("$redirectTo")->with(['error' => 'Gagal Menambah User']);;
        }
    }

         /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete(Request $request)
    {
        $redirectTo = $request->redirectTo;
           $rules = [
            'nama_pengguna'     => 'required',
            'email'     => 'required|unique:users',
            'tanggal_lahir'     => 'required',
            'contact'     => 'required|unique:users|numeric',
            'role'     => 'required',
            'password'     =>  'required','string', 'min:8',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $this->validate($request, $rules, $customMessages);

        $url_profile = url('/');

        $date_birth = Carbon::parse($request->tanggal_lahir);

        $user = User::create([
            'name' => $request->nama_pengguna,
            'gender' => $request->gender,
            'email' => $request->email,
            'contact' => $request->contact,
            'date_birth' => $date_birth,
            'profile_url' => '',
            'status' => $request->status,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        if ($user) {
            return redirect("$redirectTo")->with(['success' => 'Berhasil Menambah User']);;
        }else{
            return redirect("$redirectTo")->with(['error' => 'Gagal Menambah User']);;
        }
    }
}
