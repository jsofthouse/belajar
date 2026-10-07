@extends('layouts.app')

@section('title', 'Edit Training')

@section('content')
    <h1>Edit Training</h1>

    <form action="{{ route('trainings.update', $training) }}" method="POST">
        @csrf
        @method('PUT')
        @include('trainings._form')
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
