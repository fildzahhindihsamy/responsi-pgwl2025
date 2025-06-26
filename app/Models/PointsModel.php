<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PointsModel extends Model
{
    protected $table = 'points';

    protected $guarded = ['id'];

    public function geojson_points()
    {
        $points = $this
            ->select(DB::raw('points.id,
                ST_AsGeoJSON(points.geom) as geom,
                points.nama_lokasi,
                points.tenaga_pembangkit,
                points.wilayah,
                points.alasan,
                points.surveyor,
                points.image,
                points.created_at,
                users.name as user_name'))
            ->leftJoin('users', 'points.user_id', '=', 'users.id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($points as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'nama_lokasi' => $p->nama_lokasi,
                    'tenaga_pembangkit' => $p->tenaga_pembangkit,
                    'wilayah' => $p->wilayah,
                    'alasan' => $p->alasan,
                    'surveyor' => $p->surveyor,
                    'image' => $p->image,
                    'created_at' => $p->created_at,
                    'user_name' => $p->user_name,
                ],
            ];

            $geojson['features'][] = $feature;
        }

        return $geojson;
    }

    public function geojson_point($id)
    {
        $points = DB::table($this->table)
            ->select(

                DB::raw(
                    'id,ST_AsGeoJSON(geom) as geom,
                nama_lokasi,
                tenaga_pembangkit,
                wilayah,
                alasan,
                surveyor,
                image,
                created_at,
                updated_at',

                )
            )
            ->where('id', $id)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($points as $p) {
            $geometry = json_decode($p->geom);
            if (!$geometry) {
                $geometry = null;
            }

            $feature = [
                'type' => 'Feature',
                'geometry' => $geometry,
                'properties' => [
                    'id' => $p->id,
                    'nama_lokasi' => $p->nama_lokasi,
                    'tenaga_pembangkit' => $p->tenaga_pembangkit,
                    'wilayah' => $p->wilayah,
                    'alasan' => $p->alasan,
                    'surveyor' => $p->surveyor,
                    'image' => $p->image,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,

                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
