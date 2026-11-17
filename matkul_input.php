<h2>📚 Tambah Matakuliah</h2>
<p class="sub">Isi data lalu simpan.</p>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <form action="matkul_proses.php?action=store" method="post">
                <div class="mb-3">
                    <label for="matkul_kode" class="form-label">Kode</label>
                    <input type="text" id="matkul_kode" class="form-control" name="matkul_kode" value="" placeholder="Contoh: TIF301" required>
                </div>
                <div class="mb-3">
                    <label for="matkul_nama" class="form-label">Nama mata kuliah</label>
                    <input type="text" id="matkul_nama" class="form-control" name="matkul_nama" value="" placeholder="Nama mata kuliah" required>
                </div>
                <div class="mb-3">
                    <label for="matkul_sks" class="form-label">SKS (1-6)</label>
                    <input type="number" id="matkul_sks" class="form-control" name="matkul_sks" value="" min="1" max="6" placeholder="3" required>
                </div>
                <div class="mb-3">
                    <label for="matkul_semester" class="form-label">Semester</label>
                    <select id="matkul_semester" class="form-control" name="matkul_semester" required><option value="">-- pilih --</option><option value="1">Semester 1</option><option value="2">Semester 2</option><option value="3">Semester 3</option><option value="4">Semester 4</option><option value="5">Semester 5</option><option value="6">Semester 6</option><option value="7">Semester 7</option><option value="8">Semester 8</option></select>
                </div>
                <button type="submit" name="store" class="btn">Simpan</button>
                <a href="index.php?page=matkul" class="btn btn-secondary">Batal</a>
            </form>
            </div>
        </div>
    </div>
</div>
