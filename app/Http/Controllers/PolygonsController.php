<?php

namespace App\Http\Controllers;

use App\Models\PolygonsModel;
use Illuminate\Http\Request;

class PolygonsController extends Controller
{
    public function __construct()
    {
        $this->polygons = new PolygonsModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Map',
        ];

        return view('map', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation sesuai nama field modal
        $request->validate(
            [
                'nama_area' => 'required|unique:polygons,nama_area',
                'tenaga_pembangkit' => 'required',
                'rencana_pengembangan' => 'required',
                'wilayah' => 'required',
                'alasan' => 'required',
                'surveyor' => 'required',
                'geom_polygons' => 'required',
                'luas_m2' => 'nullable',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:3000',
            ],
            [
                'nama_area.required' => 'Nama Area wajib diisi',
                'nama_area.unique' => 'Nama Area sudah ada',
                // ... pesan lain bisa ditambah sesuai kebutuhan
            ]
        );

        // Buat folder storage/images jika belum ada
        if (!is_dir('storage/images')) {
            mkdir('storage/images', 0777, true);
        }

        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        // Data yang disimpan ke DB (sesuaikan field DB kamu)
        $data = [
            'nama_area' => $request->nama_area,
            'tenaga_pembangkit' => $request->tenaga_pembangkit,
            'rencana_pengembangan' => $request->rencana_pengembangan,
            'wilayah' => $request->wilayah,
            'alasan' => $request->alasan,
            'surveyor' => $request->surveyor,
            'luas_m2' => $request->luas_m2,
            'geom' => $request->geom_polygons,
            'image' => $name_image,
            'user_id' => auth()->user()->id,
        ];

        if (!$this->polygons->create($data)) {
            return redirect()->route('map')->with('error', 'Polygon gagal ditambahkan');
        }

        return redirect()->route('map')->with('success', 'Polygon berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Polygon',
            'id' => $id,
        ];

        return view('edit-polygon', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nama_area' => 'required|unique:polygons,nama_area,' . $id,
                'tenaga_pembangkit' => 'required',
                'rencana_pengembangan' => 'required',
                'wilayah' => 'required',
                'alasan' => 'required',
                'surveyor' => 'required',
                'geom_polygons' => 'required',
                'luas_m2' => 'nullable',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:3000',
            ],
            [
                'nama_area.required' => 'Nama Area wajib diisi',
                'nama_area.unique' => 'Nama Area sudah ada',
            ]
        );

        if (!is_dir('storage/images')) {
            mkdir('storage/images', 0777, true);
        }

        $old_image = $this->polygons->find($id)->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            // Hapus gambar lama jika ada
            if ($old_image != null && file_exists('storage/images/' . $old_image)) {
                unlink('storage/images/' . $old_image);
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'nama_area' => $request->nama_area,
            'tenaga_pembangkit' => $request->tenaga_pembangkit,
            'rencana_pengembangan' => $request->rencana_pengembangan,
            'wilayah' => $request->wilayah,
            'alasan' => $request->alasan,
            'surveyor' => $request->surveyor,
            'luas_m2' => $request->luas_m2,
            'geom' => $request->geom_polygons,
            'image' => $name_image,
        ];

        if (!$this->polygons->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Polygon gagal diperbarui');
        }

        return redirect()->route('map')->with('success', 'Polygon berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagefile = $this->polygons->find($id)->image;

        if (!$this->polygons->destroy($id)) {
            return redirect()->route('map')->with('error', 'Polygon gagal dihapus');
        }

        if ($imagefile != null && file_exists('storage/images/' . $imagefile)) {
            unlink('storage/images/' . $imagefile);
        }

        return redirect()->route('map')->with('success', 'Polygon berhasil dihapus');
    }
}
