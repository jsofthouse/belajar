@extends('layouts.app')

@section('title', 'Daftar Training')

@section('content')
    <a href="{{ route('trainings.create') }}" class="btn btn-primary mb-3">Tambah Training</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Tanggal</th>
                <th>Kuota</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($trainings as $training)
                <tr>
                    <td>{{ $trainings->firstItem() + $loop->index }}</td>
                    <td>{{ $training->title }}</td>
                    <td>{{ $training->description }}</td>
                    <td>{{ $training->location }}</td>
                    <td>{{ $training->held_at }}</td>
                    <td>{{ $training->quota }}</td>
                    <td>{{ number_format($training->price, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('trainings.show', $training) }}" class="btn btn-sm btn-info">Detail</a>
                        <a href="{{ route('trainings.edit', $training) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('trainings.destroy', $training) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus training ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data training.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        {{ $trainings->links() }}
    </div>

@endsection
