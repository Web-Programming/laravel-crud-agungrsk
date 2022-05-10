{{-- @include("layout.header", ['title' => "Halaman Program Studi"]) --}}

@extends("layout.master")
@section("title", "Halaman Program Studi")

@section("content")
    {{-- <h1>Program Studi</h1>
    @if(count($prodi) > 0 )
        @foreach($prodi as $item)
            <li>{{ $item->nama }} {{ $item->fakultas->nama }}</li>
        @endforeach
    @else
        Program Studi tidak ditemukan
    @endif --}}
    <div class="row pt-4">
        <div class="col">
            <h2>Prodi</h2>
            <div class="d-md-flex justify-content-md-end">
                <a href="{{ route('prodi.create') }}" class="btn btn-primary">Tambah</a>
            </div>
            @if (session()->has('info'))
                <div class="alert alert-success">
                    {{ session()->get('info') }}
                </div>
            @endif
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nama</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodis as $item)
                        <tr>
                            <td>{{ $item -> nama }}</td>
                            <td>
                                <form action="{{ route('prodi.destroy', ['prodi' => $item->id]) }}" method="POST">
                                    <a href="{{ url('/prodi/'.$item->id) }}" class="btn btn-warning">Detail</a>
                                    <a href="{{ url('/prodi/'.$item->id.'/edit') }}" class="btn btn-info">Ubah</a>
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                    <div></div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

{{-- @include("layout.footer") --}}