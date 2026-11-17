<h2>🧑‍🏫 Tambah Dosen</h2>
<p class="sub">Isi data lalu simpan.</p>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <form action="dosen_proses.php?action=store" method="post">
                <div class="mb-3">
                    <label for="dosen_nip" class="form-label">NIP</label>
                    <input type="text" id="dosen_nip" class="form-control" name="dosen_nip" value="" placeholder="18 digit NIP" required>
                </div>
                <div class="mb-3">
                    <label for="dosen_nama" class="form-label">Nama lengkap & gelar</label>
                    <input type="text" id="dosen_nama" class="form-control" name="dosen_nama" value="" placeholder="Nama dosen" required>
                </div>
                <div class="mb-3">
                    <label for="dosen_golongan" class="form-label">Golongan</label>
                    <select id="dosen_golongan" class="form-control" name="dosen_golongan"><option value="">-- pilih --</option><option value="III/a">III/a</option><option value="III/b">III/b</option><option value="III/c">III/c</option><option value="III/d">III/d</option><option value="IV/a">IV/a</option><option value="IV/b">IV/b</option><option value="IV/c">IV/c</option></select>
                </div>
                <button type="submit" name="store" class="btn">Simpan</button>
                <a href="index.php?page=dosen" class="btn btn-secondary">Batal</a>
            </form>
            </div>
        </div>
    </div>
</div>
