<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ProfileSettingsRequest;
use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profile
     */
    public function index()
    {
        $profile = Auth::user();
        return view('backend.profile.index', compact('profile'));
    }

    /**
     * Form create (tidak dipakai)
     */
    public function create()
    {
        //
    }

    /**
     * Store (tidak dipakai)
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show (tidak dipakai)
     */
    public function show($id)
    {
        //
    }

    /**
     * Edit (tidak dipakai)
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update profile
     */
    public function update(ProfileSettingsRequest $request, $id)
    {
        $profile = User::findOrFail($id);

        // Upload foto profile
        if ($request->hasFile('foto_profile')) {

            $image = $request->file('foto_profile');
            $nama_image = time().'_'.$image->getClientOriginalName();

            $image->move(public_path('images/profile'), $nama_image);

            $profile->foto_profile = $nama_image;
        }

        // Jika email berubah maka verifikasi ulang
        if ($profile->email != $request->email) {
            $profile->email_verified_at = null;
        }

        $profile->name     = $request->name;
        $profile->username = $request->username;
        $profile->email    = $request->email;

        $profile->save();

        Session::flash('success', 'Profile berhasil diupdate!');
        return back();
    }

    /**
     * Ubah password
     */
    public function changePassword(ChangePasswordRequest $request, $id)
    {
        $profile = User::findOrFail($id);

        $profile->password = Hash::make($request->password);
        $profile->save();

        Session::flash('success', 'Password berhasil diupdate!');
        return back();
    }
}