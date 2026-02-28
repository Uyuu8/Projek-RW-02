<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use App\Http\Requests\BeritaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Session;

class BeritaController extends Controller
{
    public function index()
    {
        $kategori = KategoriBerita::where('is_active', '0')->get();
        $berita   = Berita::latest()->get();

        return view('backend.website.content.berita.index', compact('kategori','berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::where('is_active', '0')->get();
        return view('backend.website.content.berita.create', compact('kategori'));
    }

    public function store(BeritaRequest $request)
    {
        try {

            $nama_image = null;

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $nama_image = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/berita'), $nama_image);
            }

            Berita::create([
                'title'       => $request->title,
                'slug'        => Str::slug($request->title),
                'content'     => $request->content,
                'kategori_id' => $request->kategori_id,
                'thumbnail'   => $nama_image,
                'created_by'  => Auth::id(),
                'is_active'   => '0',
            ]);

            Session::flash('success','Berita berhasil ditambah!');
            return redirect()->route('backend-berita.index');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $kategori = KategoriBerita::where('is_active','0')->get();
        $berita   = Berita::findOrFail($id);

        return view('backend.website.content.berita.edit', compact('kategori','berita'));
    }

    public function update(BeritaRequest $request, $id)
    {
        try {

            $berita = Berita::findOrFail($id);

            if ($request->hasFile('thumbnail')) {

                // Hapus gambar lama jika ada
                if ($berita->thumbnail && File::exists(public_path('images/berita/'.$berita->thumbnail))) {
                    File::delete(public_path('images/berita/'.$berita->thumbnail));
                }

                // Upload gambar baru
                $image = $request->file('thumbnail');
                $nama_image = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/berita'), $nama_image);

                $berita->thumbnail = $nama_image;
            }

            $berita->title       = $request->title;
            $berita->slug        = Str::slug($request->title);
            $berita->content     = $request->content;
            $berita->kategori_id = $request->kategori_id;
            $berita->is_active   = $request->is_active ?? 0;
            $berita->save();

            Session::flash('success','Berita berhasil diupdate!');
            return redirect()->route('backend-berita.index');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {

            $berita = Berita::findOrFail($id);

            // Hapus gambar jika ada
            if ($berita->thumbnail && File::exists(public_path('images/berita/'.$berita->thumbnail))) {
                File::delete(public_path('images/berita/'.$berita->thumbnail));
            }

            $berita->delete();

            Session::flash('success','Berita berhasil dihapus!');
            return redirect()->route('backend-berita.index');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}