<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonsModel extends Model
{
    protected $table = 'polygons';
    protected $guarded = ['id'];

    public function geojson_polygons()
    {
        $polygons = DB::table($this->table)
            ->select([
                'polygons.id',
                DB::raw('ST_AsGeoJSON(polygons.geom) as geom'),
                'polygons.nama_area',
                'polygons.tenaga_pembangkit',
                'polygons.rencana_pengembangan',
                'polygons.wilayah',
                'polygons.alasan',
                'polygons.surveyor',
                DB::raw('ST_Area(polygons.geom, true) as luas_m2'),
                'polygons.created_at',
                'polygons.updated_at',
                'polygons.image',
                'polygons.user_id',
                'users.name as user_name'
            ])
            ->leftJoin('users', 'polygons.user_id', '=', 'users.id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $geometry = json_decode($p->geom);

            $feature = [
                'type' => 'Feature',
                'geometry' => $geometry,
                'properties' => [
                    'id' => $p->id,
                    'nama_area' => $p->nama_area,
                    'tenaga_pembangkit' => $p->tenaga_pembangkit,
                    'rencana_pengembangan' => $p->rencana_pengembangan,
                    'wilayah' => $p->wilayah,
                    'alasan' => $p->alasan,
                    'surveyor' => $p->surveyor,
                    'luas_m2' => $p->luas_m2,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_name' => $p->user_name,
                ],
            ];

            $geojson['features'][] = $feature;
        }

        return $geojson;
    }
}
