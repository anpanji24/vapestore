@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12"><br>
            @if(session()->get('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
            @endif
            <div class="card-body">
                <div class="card">
                    <div class="card-header">Data Coil
                        <a href="{{ route('barangmasuk.create') }}" class="float-right btn btn-success btn-floating"> Tambah Data</a>
                    </div>
                        <div class="row">
                             <div class="col-md-12">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis</th>
                                                    <th>Jumlah</th>
                                                    <th>Nama Barang</th>
                                                    <th>action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @foreach($masuk as $masuks)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{$masuks->jenis}}</td>
                                                    <td>{{$masuks->jumlah}}</td>
                                                    <td>{{$masuks->barang->namabarang}}</td>
                                                    <td>
                                                    <form action="{{ route('barangmasuk.destroy', $masuks->id) }}"method="POST">
                                                        @csrf @method('delete')
                                                       
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Ingin Menghapus Data?')">Delete</button>
                                                    </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection