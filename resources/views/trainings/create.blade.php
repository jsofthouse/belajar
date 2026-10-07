@extends('layouts.app')

@section('title', 'Tambah Training')

@section('content')
    <h1>Tambah Training</h1>

    <form action="{{ route('trainings.store') }}" method="POST">
        @csrf
        @include('trainings._form')
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
