@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Lowongan</h2>
    <a href="{{ route('jobs.create')}}" class="btn btn-success mb-3">Tambah Lowongan</a>
    <table class="table table-bordered">
        <tr>
            <th>Judul</th>
            <th>Perusahan</th>
            <th>Lokasi</th>
            <th>Gaji</th>
            <th>Logo</th>
            <th>Aksi</th>
        </tr>
        @foreach($jobs as $job)
        <tr>
            <td>{{ $job->title }}</td>
            <td>{{ $job->company }}</td>
            <td>{{ $job->location }}</td>
            <td>{{ $job->salary }}</td>
            <td>
                @if($job->logo)
                <img src="{{ asset('storage/' .$job->logo) }}" width="80">
            </td>
            <td>
                <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('jobs.destroy', $job->id }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data?')">Hapus</button>
                </form>
            </td>

        </tr>
        @endforeach
    </table>
</div>
@endsection