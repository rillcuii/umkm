<form method="POST" action="{{ route('admin.simpan.banner') }}">
    @csrf
    <div class="form-group">
        <label>Nama banner</label>
        <input type="text" class="form-control" name="nama_banner" required>
    </div>
    <div class="form-group">
        <label>Foto Banner</label>
        <input type="file" class="form-control" name="link" required>
    </div>
    <button type="submit" class="btn btn-primary mb-3">Submit</button>
</form>