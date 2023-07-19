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
                                    <h5 class="mb-1">Kurir</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['kurir_name']) ? $detail['kurir_name'] : 'Nama kurir tidak ada' }}</p>
                            </div>
                            
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Barang</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['barang_name']) ? $detail['barang_name'] : 'Nama kurir tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Lokasi</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['lokasi_name']) ? $detail['lokasi_name'] : 'Nama lokasi tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Stok</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['jumlah_stok']) ? $detail['jumlah_stok'] : 'Jumlah stok tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Display</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['jumlah_display']) ? $detail['jumlah_display'] : 'Jumlah display tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Visit Date</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['visit_datetime']) ? $detail['visit_datetime'] : 'Tanggal visit tidak ada' }}</p>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
