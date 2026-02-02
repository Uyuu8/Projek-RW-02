<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\ImageSlider;
use Illuminate\Http\Request;
use Session;

class ImageSliderController extends Controller
{
    public function index()
    {
        $image = ImageSlider::orderBy('urutan', 'asc')->get();
        return view('backend.website.content.imageSlider.index', compact('image'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $nama = time().'_'.$image->getClientOriginalName();

        $image->move(public_path('images/slider'), $nama);

        ImageSlider::create([
            'image'     => $nama,
            'title'     => $request->title,
            'desc'      => $request->desc,
            'urutan'    => $request->urutan,
            'is_active' => 1
        ]);

        return redirect()->back()->with('success', 'Slider berhasil ditambah');
    }

    public function edit($id)
    {
        $image = ImageSlider::findOrFail($id);
        return view('backend.website.content.imageSlider.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $slider = ImageSlider::findOrFail($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $nama = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images/slider'), $nama);
            $slider->image = $nama;
        }

        $slider->title     = $request->title;
        $slider->desc      = $request->desc;
        $slider->urutan    = $request->urutan;
        $slider->is_active = $request->is_active ?? 1;
        $slider->save();

        return redirect()->route('backend-imageslider.index')
            ->with('success', 'Slider berhasil diupdate');
    }
}
