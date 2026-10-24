@if(session('success'))
    <div class="alert alert-success" role="alert">
        <strong>Berhasil:</strong> {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
        <strong>Terjadi Kesalahan:</strong> {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <div>
            <strong>Periksa kembali formulir Anda:</strong>
            <ul style="margin-top: 0.25rem; margin-left: 1.25rem; font-size: 0.8125rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
