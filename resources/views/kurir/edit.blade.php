@extends('layout')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ url('/kurir') }}" class="btn btn-success btn-sm pull-right"><i
                                    class="fa fa-pencil"></i> Kembali</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{url('kurir/'.$detail->id)}}">
                            @csrf
                            @method('PUT')
                            <h1>Edit Data</h1>
                            <div class="form-group">
                                
                                <label for="name" class="required">Nama Kurir</label>
                                @error('name')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="text" class="form-control" id="name"  value={{$detail->name}} name="name" required>
                                <label for="email" class="required">Email Kurir</label>
                                @error('email')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="email" class="form-control" id="email"  value={{$detail->email}}  name="email"
                                       required>

                                <label for="password" class="required">Password Kurir</label>
                                @error('password')
                                <div class="error">{{ $message }}</div>
                                @enderror
                                <input type="password" class="form-control" id="password" name="password"
                                       required>
                                       
                            @error('error_msg')
                                <div class="error">{{ $errors->first('error_msg') }}</div>
                            @enderror
                            </div>
                            <button type="submit" class="form-control btn btn-success">Submit</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
