@extends('layouts.app')

@section('title', 'Tambah Training')

@section('content')
    <h1>Tambah Training</h1>

    <form action="{{ route('trainings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Lokasi</label>
            <input type="text" name="location" id="location"
                class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
            @error('location')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="held_at" class="form-label">Tanggal</label>
            <input type="datetime-local" name="held_at" id="held_at"
                class="form-control @error('held_at') is-invalid @enderror" value="{{ old('held_at') }}">
            @error('held_at')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="quota" class="form-label">Kuota</label>
            <input min="1" type="number" name="quota" id="quota"
                class="form-control @error('quota') is-invalid @enderror" value="{{ old('quota') }}">
            @error('quota')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input min="0" type="number" name="price" id="price"
                class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
