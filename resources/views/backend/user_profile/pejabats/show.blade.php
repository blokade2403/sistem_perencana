@extends('layouts.main')

@section('container')
    <h1>Detail Pejabat</h1>
    <p>Nama: {{ $pejabat->nama }}</p>
    <p>Jabatan: {{ $pejabat->jabatan }}</p>
    <p>Alamat: {{ $pejabat->alamat }}</p>
    <a href="{{ route('pejabats.index') }}">Kembali</a>
@endsection
