<h2>🎓 Tambah Mahasiswa</h2>
<p class="sub">Isi data lalu simpan.</p>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <form action="mhsw_proses.php?action=store" method="post">
                <div class="mb-3">
                    <label for="mhsw_nim" class="form-label">NIM</label>
                    <input type="text" id="mhsw_nim" class="form-control" name="mhsw_nim" value="" placeholder="Contoh: 2201001" required>
                </div>
                <div class="mb-3">
                    <label for="mhsw_nama" class="form-label">Nama lengkap</label>
                    <input type="text" id="mhsw_nama" class="form-control" name="mhsw_nama" value="" placeholder="Nama mahasiswa" required>
                </div>
                <div class="mb-3">
                    <label for="mhsw_alamat" class="form-label">Alamat</label>
                    <textarea id="mhsw_alamat" class="form-control" name="mhsw_alamat" placeholder="Alamat tinggal"></textarea>
                </div>
                <button type="submit" name="store" class="btn">Simpan</button>
                <a href="index.php?page=mhsw" class="btn btn-secondary">Batal</a>
            </form>
            </div>
        </div>
    </div>
</div>
