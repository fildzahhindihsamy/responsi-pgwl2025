@extends('layout/template')

@section('content')
<div class="container mt-5">
    {{-- Data Titik --}}
    <div class="card border-0 shadow mb-4" style="background: linear-gradient(145deg, #111827, #1f2937); color: #f8f9fa;">
        <div class="card-header border-0" style="background: transparent;">
            <h5 class="fw-bold" style="color: #ffc107;">
                <i class="fa-solid fa-map-pin me-2"></i>Data Titik Usulan Pembangkit
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-dark table-striped table-hover" id="pointstable">
                <thead style="background-color: #212529;">
                    <tr>
                        <th>No</th>
                        <th>Nama Lokasi</th>
                        <th>Jenis Pembangkit</th>
                        <th>Wilayah</th>
                        <th>Surveyor</th>
                        <th>Gambar</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($points as $i => $p)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $p->nama_lokasi }}</td>
                            <td>{{ $p->tenaga_pembangkit }}</td>
                            <td>{{ $p->wilayah }}</td>
                            <td>{{ $p->surveyor }}</td>
                            <td>
                                @if ($p->image)
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt="img" width="100" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $p->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Data Polygon --}}
    <div class="card border-0 shadow mb-4" style="background: linear-gradient(145deg, #111827, #1f2937); color: #f8f9fa;">
        <div class="card-header border-0" style="background: transparent;">
            <h5 class="fw-bold" style="color: #0dcaf0;">
                <i class="fa-solid fa-draw-polygon me-2"></i>Data Area Rencana Pengembangan
            </h5>
        </div>
        <div class="card-body">
            <table class="table table-dark table-striped table-hover" id="polygonstable">
                <thead style="background-color: #212529;">
                    <tr>
                        <th>No</th>
                        <th>Nama Area</th>
                        <th>Jenis Pembangkit</th>
                        <th>Wilayah</th>
                        <th>Luas (ha)</th>
                        <th>Surveyor</th>
                        <th>Gambar</th>
                        <th>Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($polygons as $i => $a)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $a->nama_area }}</td>
                            <td>{{ $a->tenaga_pembangkit }}</td>
                            <td>{{ $a->wilayah }}</td>
                            <td>{{ number_format($a->luas_m2 / 10000, 2) }}</td>
                            <td>{{ $a->surveyor }}</td>
                            <td>
                                @if ($a->image)
                                    <img src="{{ asset('storage/images/' . $a->image) }}" alt="img" width="100" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $a->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css">
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
        new DataTable('#pointstable');
        new DataTable('#polygonstable');
    </script>
@endsection
