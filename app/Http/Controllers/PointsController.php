<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Map',
        ];

        return view('map', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lokasi' => 'required|unique:points,nama_lokasi',
            'tenaga_pembangkit' => 'required',
            'wilayah' => 'required',
            'alasan' => 'required',
            'surveyor' => 'required',
            'geom_points' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:3000',
        ]);

        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'nama_lokasi' => $request->nama_lokasi,
            'tenaga_pembangkit' => $request->tenaga_pembangkit,
            'wilayah' => $request->wilayah,
            'alasan' => $request->alasan,
            'surveyor' => $request->surveyor,
            'geom' => $request->geom_points,
            'image' => $name_image,
            'user_id' => auth()->user()->id,
        ];

        if (!$this->points->create($data)) {
            return redirect()->route('map')->with('error', 'Usulan gagal ditambahkan');
        }

        return redirect()->route('map')->with('success', 'Usulan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Point',
            'id' => $id,
        ];

        return view('edit-point', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lokasi' => 'required|unique:points,nama_lokasi,' . $id,
            'tenaga_pembangkit' => 'required',
            'wilayah' => 'required',
            'alasan' => 'required',
            'surveyor' => 'required',
            'geom_points' => 'required',
            'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:3000',
        ]);

        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777, true);
        }

        $old_image = $this->points->find($id)->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            if ($old_image != null && file_exists('./storage/images/' . $old_image)) {
                unlink('./storage/images/' . $old_image);
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'nama_lokasi' => $request->nama_lokasi,
            'tenaga_pembangkit' => $request->tenaga_pembangkit,
            'wilayah' => $request->wilayah,
            'alasan' => $request->alasan,
            'surveyor' => $request->surveyor,
            'geom' => $request->geom_points,
            'image' => $name_image,
        ];

        if (!$this->points->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Usulan gagal diperbarui');
        }

        return redirect()->route('map')->with('success', 'Usulan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $imagefile = $this->points->find($id)->image;

        if (!$this->points->destroy($id)) {
            return redirect()->route('map')->with('error', 'Usulan gagal dihapus');
        }

        if ($imagefile != null && file_exists('./storage/images/' . $imagefile)) {
            unlink('./storage/images/' . $imagefile);
        }

        return redirect()->route('map')->with('success', 'Usulan berhasil dihapus');
    }
}
