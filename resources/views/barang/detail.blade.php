@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('barang') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p></p>
                        <p></p>
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Nama Barang</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['nama_barang']) ? $detail['nama_barang'] : 'Item name tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Stok</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['stok_barang']) ? $detail['stok_barang'] : ' stok tidak ada' }}</p>
                            </div>
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Harga Barang</h5>
                                </div>
                                <p class="mb-1">{{ isset($detail['harga_barang']) ? $detail['harga_barang'] : ' stok tidak ada' }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
