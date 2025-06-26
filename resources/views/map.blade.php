@extends('layout/template')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">

    <style>
        #map {
            width: 100%;
            height: calc(100vh - 56px);
        }
    </style>
@endsection

@section('content')
    <div id="map"></div>

    <!-- Modal Create Point -->
    <div class="modal fade" id="createpointModal" tabindex="-1" aria-labelledby="createpointModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('points.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createpointModalLabel">Usulan Titik Pembangkit Listrik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Lokasi</label>
                            <textarea class="form-control" name="nama_lokasi" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Pembangkit</label>
                            <input type="text" class="form-control" name="tenaga_pembangkit" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kabupaten/Kota</label>
                            <textarea class="form-control" name="wilayah" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alasan Pemilihan Lokasi</label>
                            <textarea class="form-control" name="alasan" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surveyor</label>
                            <input type="text" class="form-control" name="surveyor" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Geometri (otomatis)</label>
                            <textarea class="form-control" id="geom_points" name="geom_points" rows="2" readonly></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dokumentasi Lokasi</label>
                            <input type="file" class="form-control" name="image"
                                onchange="document.getElementById('preview-image-point').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" id="preview-image-point" class="img-thumbnail mx-auto d-block mt-2"
                                style="max-width: 100%; height: auto; max-height: 300px;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Usulan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Create Polygon -->
    <div class="modal fade" id="createpolygonsModal" tabindex="-1" aria-labelledby="createpolygonModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('polygons.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createpolygonModalLabel">Usulan Area Rencana Pengembangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Area</label>
                            <textarea class="form-control" name="nama_area" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Pembangkit</label>
                            <input type="text" class="form-control" name="tenaga_pembangkit" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Rencana Pengembangan</label>
                            <textarea class="form-control" name="rencana_pengembangan" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kabupaten/Kota</label>
                            <textarea class="form-control" name="wilayah" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alasan Pemilihan Lokasi</label>
                            <textarea class="form-control" name="alasan" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surveyor</label>
                            <input type="text" class="form-control" name="surveyor" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Geometri (otomatis)</label>
                            <textarea class="form-control" id="geom_polygons" name="geom_polygons" rows="2" readonly></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Dokumentasi Lokasi</label>
                            <input type="file" class="form-control" name="image"
                                onchange="document.getElementById('preview-image-polygons').src = window.URL.createObjectURL(this.files[0])">
                            <img src="" id="preview-image-polygons" class="img-thumbnail mx-auto d-block mt-2"
                                style="max-width: 100%; height: auto; max-height: 300px;">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Usulan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <script src="https://unpkg.com/@terraformer/wkt"></script>


    <script>
        var map = L.map('map').setView([-7.361067, 109.660378], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        /* Digitize Function */
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                position: 'topleft',
                polyline: true,
                polygon: true,
                rectangle: true,
                circle: false,
                marker: true,
                circlemarker: false
            },
            edit: false
        });

        map.addControl(drawControl);

        map.on('draw:created', function(e) {
            var type = e.layerType,
                layer = e.layer;


            console.log(type);

            var drawnJSONObject = layer.toGeoJSON();
            var objectGeometry = Terraformer.geojsonToWKT(drawnJSONObject.geometry);

            console.log(drawnJSONObject);
            // console.log(objectGeometry);

            if (type === 'polyline') {
                console.log("Create " + type);
                $('#geom_polylines').val(objectGeometry);
                $('#createpolylinesModal').modal('show');

            } else if (type === 'polygon' || type === 'rectangle') {
                console.log("Create " + type);
                $('#geom_polygons').val(objectGeometry);
                $('#createpolygonsModal').modal('show');

            } else if (type === 'marker') {
                console.log("Create " + type);
                $('#geom_points').val(objectGeometry);
                $('#createpointModal').modal('show');

            } else {
                console.log('_undefined_');
            }

            drawnItems.addLayer(layer);
        });

        // GeoJSON Points
        var point = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('points.destroy', ':id') }}".replace(':id', feature.properties.id);
                var routeedit = "{{ route('points.edit', ':id') }}".replace(':id', feature.properties.id);

                var popupContent = `
            <table style="border-collapse: collapse; width: 100%; text-align: left; border: 1px solid black;">
                <thead>
                    <tr style="background-color: #FFB100; color: white;">
                        <th style="padding: 5px; border: 1px solid black;" colspan="2">Informasi Titik</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Nama Lokasi</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.nama_lokasi}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Jenis Pembangkit</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.tenaga_pembangkit}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Kabupaten/Kota</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.wilayah}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Alasan Pemilihan Lokasi</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.alasan}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Surveyor</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.surveyor}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Dibuat</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.created_at}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Gambar</b></td>
                        <td style="padding: 5px; border: 1px solid black;">
                            ${feature.properties.image
                                ? `<img src="/storage/images/${feature.properties.image}" width="200" alt="Gambar Lokasi">`
                                : 'Tidak ada gambar'}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-3">
                <div class="col-6 text-end">
                    <a href="${routeedit}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                </div>
                <div class="col-6 text-start">
                    <form method="POST" action="${routedelete}" onsubmit="return confirm('Yakin mau hapus titik ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        `;

                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.nama_lokasi);
            }
        });

        $.getJSON("{{ route('api.points') }}", function(data) {
            point.addData(data);
            map.addLayer(point);
        });

        // GeoJSON Polygon
        var polygon = L.geoJson(null, {
            onEachFeature: function(feature, layer) {
                var routedelete = "{{ route('polygons.destroy', ':id') }}".replace(':id', feature.properties
                    .id);
                var routeedit = "{{ route('polygons.edit', ':id') }}".replace(':id', feature.properties.id);

                var luasFormatted = feature.properties.luas_m2 ?
                    (feature.properties.luas_m2 / 10000).toFixed(2) + ' hektar' :
                    'Data luas tidak tersedia';

                var popupContent = `
            <table style="border-collapse: collapse; width: 100%; text-align: left; border: 1px solid black;">
                <thead>
                    <tr style="background-color: #FFB100; color: white;">
                        <th style="padding: 5px; border: 1px solid black;" colspan="2">Informasi Area</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Nama Area</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.nama_area}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Jenis Pembangkit</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.tenaga_pembangkit}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Rencana Pengembangan</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.rencana_pengembangan}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Kecamatan & Kabupaten/Kota</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.wilayah}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Alasan Pemilihan Lokasi</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.alasan}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Surveyor</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.surveyor}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Luas</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${luasFormatted}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Dibuat oleh</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.user_name}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Dibuat</b></td>
                        <td style="padding: 5px; border: 1px solid black;">${feature.properties.created_at}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; border: 1px solid black;"><b>Gambar</b></td>
                        <td style="padding: 5px; border: 1px solid black;">
                            ${feature.properties.image
                                ? `<img src="/storage/images/${feature.properties.image}" width="200" alt="Gambar Area">`
                                : 'Tidak ada gambar'}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row mt-3">
                <div class="col-6 text-end">
                    <a href="${routeedit}" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i> Edit
                    </a>
                </div>
                <div class="col-6 text-start">
                    <form method="POST" action="${routedelete}" onsubmit="return confirm('Yakin mau hapus area ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-trash-can"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        `;

                layer.bindPopup(popupContent);
                layer.bindTooltip(feature.properties.nama_area);
            },
        });
        $.getJSON("{{ route('api.polygons') }}", function(data) {
            polygon.addData(data);
            map.addLayer(polygon);
        });

        fetch('/storage/geojson/titik_pl_3.geojson')
            .then(res => res.json())
            .then(data => {
                var geojsonLayer = L.geoJSON(data, {
                    pointToLayer: function(feature, latlng) {
                        var thunderIcon = L.icon({
                            iconUrl: '/icons/Thunder.png', // path relatif di public
                            iconSize: [32, 40], // ukuran ikon disesuaikan
                            iconAnchor: [16, 40], // titik dasar ikon (biasanya bawah tengah)
                            popupAnchor: [0, -40] // agar popup muncul di atas ikon
                        });

                        return L.marker(latlng, {
                            icon: thunderIcon
                        });
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(
                            "<b>" + feature.properties.Nama + "</b><br>" +
                            "Tenaga: " + feature.properties.Tenaga + "<br>" +
                            "Kecamatan: " + feature.properties.Kecamatan + "<br>" +
                            "Kab/Kota: " + feature.properties.KotaKab + "<br>" +
                            "Provinsi: " + feature.properties.Provinsi
                        );
                    }
                }).addTo(map);
            })
            .catch(error => {
                console.error('Fetch error:', error);
            });


        fetch('/storage/geojson/area_pl_3.geojson')
    .then(res => res.json())
    .then(data => {
        var geojsonLayer = L.geoJSON(data, {
            style: function(feature) {
                return {
                    color: '#ff5733',       // outline merah-oranye
                    weight: 3,              // tebal garis
                    opacity: 0.9,
                    fillColor: '#ffc300',   // isi kuning cerah
                    fillOpacity: 0.5
                };
            },
            onEachFeature: function(feature, layer) {
                // DEBUG: cek isi properties
                console.log(feature.properties);

                var luasFormatted = feature.properties.luas_m2
                    ? (feature.properties.luas_m2 / 10000).toFixed(2) + ' hektar'
                    : 'Data luas tidak tersedia';

                var popupContent = `
                    <table style="border-collapse: collapse; width: 100%; text-align: left; border: 1px solid black;">
                        <thead>
                            <tr style="background-color: #FF5733; color: white;">
                                <th colspan="2" style="padding: 6px; border: 1px solid black;">Informasi Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Nama Area</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.nama_area || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Jenis Pembangkit</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.tenaga_pembangkit || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Rencana Pengembangan</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.rencana_pengembangan || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Wilayah</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.wilayah || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Alasan Lokasi</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.alasan || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Surveyor</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.surveyor || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Luas</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${luasFormatted}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Dibuat oleh</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.user_name || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Tanggal Buat</b></td>
                                <td style="padding: 5px; border: 1px solid black;">${feature.properties.created_at || '-'}</td>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border: 1px solid black;"><b>Gambar</b></td>
                                <td style="padding: 5px; border: 1px solid black;">
                                    ${feature.properties.image
                                        ? `<img src="/storage/images/${feature.properties.image}" width="200" alt="Dokumentasi">`
                                        : 'Tidak ada gambar'}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                `;

                layer.bindPopup(popupContent);
            }
        }).addTo(map);
    })
    .catch(error => {
        console.error('Fetch error:', error);
    });

    </script>
@endsection
