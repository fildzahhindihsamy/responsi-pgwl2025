<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolylinesModel extends Model
{
    protected $table = 'polylines';

    protected $guarded = ['id'];

    public function geojson_polylines()
    {
        $polylines = DB::table($this->table)
            ->selectRaw('polylines.id, ST_AsGeoJSON(polylines.geom) as geom,
                polylines.name, polylines.description,
                ST_Length(geography(polylines.geom)) as length_m,
                ST_Length(geography(polylines.geom)) / 1000 as length_km,
                polylines.created_at,
                polylines.updated_at,
                polylines.image,
                polylines.user_id,
                users.name as user_name')
            ->leftJoin('users', 'polylines.user_id', '=', 'users.id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polylines as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'length_m' => $p->length_m,
                    'length_km' => $p->length_km,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_name' => $p->user_name,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

    public function geojson_polyline($id)
    {
        $polylines = DB::table($this->table)
            ->selectRaw('polylines.id, ST_AsGeoJSON(polylines.geom) as geom,
                polylines.name, polylines.description,
                ST_Length(geography(polylines.geom)) as length_m,
                ST_Length(geography(polylines.geom)) / 1000 as length_km,
                polylines.created_at,
                polylines.updated_at,
                polylines.image,
                polylines.user_id,
                users.created_at as user_created_at,
                users.name as user_name')
            ->where('polylines.id', $id)
            ->leftJoin('users', 'polylines.user_id', '=', 'users.id')
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polylines as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'length_m' => $p->length_m,
                    'length_km' => $p->length_km,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'image' => $p->image,
                    'user_id' => $p->user_id,
                    'user_created_at' => $p->user_created_at,
                    'user_name' => $p->user_name,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
