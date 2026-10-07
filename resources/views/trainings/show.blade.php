@extends('layouts.app')

@section('title', $training->title)

@section('content')
    <a href="{{ route('trainings.index') }}" class="btn btn-secondary mb-3">&larr; Kembali</a>
    <h1>{{ $training->title }}</h1>
    <p>Deskripsi: {{ $training->description }}</p>
    <p>Tanggal: {{ $training->date }}</p>
    <p>Lokasi: {{ $training->location }}</p>
    <p>Harga: {{ $training->price }}</p>
    <p>Kuota: {{ $training->participants()->count() }}/{{ $training->quota }}
        (sisa: {{ $training->quota - $registered->count() }})
    </p>

    <h4>Peserta Terdaftar</h4>
    <table class="table">
        <thead>...</thead>
        <tbody>
            @forelse ($registered as $participant)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>
                        <form action="{{ route('trainings.unregister', [$training, $participant]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin membatalkan pendaftaran peserta ini?')">Batalkan
                                Pendaftaran</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Tidak ada peserta terdaftar.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <h4>Daftarkan Peserta</h4>
    <form action="{{ route('trainings.register', $training) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="participant_id" class="form-label">Pilih Peserta</label>
            <select name="participant_id" id="participant_id"
                class="form-select @error('participant_id') is-invalid @enderror">
                <option value="">-- Pilih Peserta --</option>
                @foreach ($available as $p)
                    <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->email }})</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Daftarkan Peserta</button>
        @error('participant_id')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    @endsection
