@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('pengiriman') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p></p>
                        <p></p>
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">No Pengiriman</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['no_pengiriman']) ? $detail['no_pengiriman'] : 'No Pengiriman tidak ada' }}</p>
                            </div>
                            
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Tanggal</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['tanggal']) ? $detail['tanggal'] : 'Tangga tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Lokasi ID</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['lokasi_id']) ? $detail['lokasi_id'] : 'Lokasi tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Barang ID</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['barang_id']) ? $detail['barang_id'] : 'barang tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Barang</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['jumlah_barang']) ? $detail['jumlah_barang'] : 'Jumlah barang tidak ada' }}</p>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
