<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image_desktop' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'link' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:50',
            'sort_order' => 'integer',
        ]);

        $data = $request->except(['image_desktop', 'image_mobile']);
        $data['status'] = $request->boolean('status', true);
        $data['image_desktop'] = $this->upload($request->file('image_desktop'), 'sliders');

        if ($request->hasFile('image_mobile')) {
            $data['image_mobile'] = $this->upload($request->file('image_mobile'), 'sliders');
        }

        Slider::create($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider created.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image_desktop' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'image_mobile' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'link' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:50',
            'sort_order' => 'integer',
        ]);

        $data = $request->except(['image_desktop', 'image_mobile']);
        $data['status'] = $request->boolean('status', true);

        if ($request->hasFile('image_desktop')) {
            if ($slider->image_desktop && file_exists(public_path($slider->image_desktop))) {
                unlink(public_path($slider->image_desktop));
            }
            $data['image_desktop'] = $this->upload($request->file('image_desktop'), 'sliders');
        }

        if ($request->hasFile('image_mobile')) {
            if ($slider->image_mobile && file_exists(public_path($slider->image_mobile))) {
                unlink(public_path($slider->image_mobile));
            }
            $data['image_mobile'] = $this->upload($request->file('image_mobile'), 'sliders');
        }

        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image_desktop && file_exists(public_path($slider->image_desktop))) {
            unlink(public_path($slider->image_desktop));
        }
        if ($slider->image_mobile && file_exists(public_path($slider->image_mobile))) {
            unlink(public_path($slider->image_mobile));
        }
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted.');
    }

    private function upload($file, $folder)
    {
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/' . $folder), $filename);
        return 'uploads/' . $folder . '/' . $filename;
    }
}
