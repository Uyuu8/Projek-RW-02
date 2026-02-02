<?php

namespace App\Http\Controllers\Backend\Pengguna;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('backend.pengguna.user.index', compact('users'));
    }

    public function create()
    {
        return view('backend.pengguna.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'username' => 'required|unique:users',
            'role' => 'required',
            'status' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $nama_img = null;

            if ($request->hasFile('foto_profile')) {
                $image = $request->file('foto_profile');
                $nama_img = time()."_".$image->getClientOriginalName();
                $image->move(public_path('uploads/profile'), $nama_img);
            }

            $user = new User();
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->username     = $request->username;
            $user->role         = $request->role;
            $user->status       = $request->status;
            $user->foto_profile = $nama_img;

            // PASSWORD DEFAULT
            $user->password     = Hash::make('123456');

            $user->save();

            DB::commit();

            Session::flash('success','User berhasil ditambahkan');
            return redirect()->route('backend-pengguna-user.index');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.pengguna.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id,
        ]);

        $nama_img = $user->foto_profile;

        if ($request->hasFile('foto_profile')) {
            $image = $request->file('foto_profile');
            $nama_img = time()."_".$image->getClientOriginalName();
            $image->move(public_path('uploads/profile'), $nama_img);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'role' => $request->role,
            'status' => $request->status,
            'foto_profile' => $nama_img
        ]);

        Session::flash('success','User berhasil diupdate');
        return redirect()->route('backend-pengguna-user.index');
    }

    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('success','User berhasil dihapus');
        return redirect()->route('backend-pengguna-user.index');
    }
}
