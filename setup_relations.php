<?php
include('config/database.php');

echo "<h3>Memproses Relasi Database...</h3>";

// Helper function to execute query
function runQuery($koneksi, $sql, $msg) {
    if (mysqli_query($koneksi, $sql)) {
        echo "<p style='color:green'>[BERHASIL] $msg</p>";
    } else {
        echo "<p style='color:red'>[GAGAL] $msg: " . mysqli_error($koneksi) . "</p>";
    }
}

// 1. Bersihkan data yatim piatu (Orphaned Data) sebelum menambah constraint
// Hapus UMKM yang kategori-nya tidak valid
runQuery($koneksi, 
    "DELETE FROM umkm WHERE id_kategori NOT IN (SELECT id_kategori FROM kategori)", 
    "Membersihkan UMKM dengan kategori tidak valid"
);

// Hapus Ulasan yang user-nya tidak valid
runQuery($koneksi, 
    "DELETE FROM ulasan WHERE id_user NOT IN (SELECT id_user FROM users)", 
    "Membersihkan Ulasan dengan user tidak valid"
);

// Hapus Ulasan yang umkm-nya tidak valid
runQuery($koneksi, 
    "DELETE FROM ulasan WHERE id_umkm NOT IN (SELECT id_umkm FROM umkm)", 
    "Membersihkan Ulasan dengan UMKM tidak valid"
);

echo "<hr>";

// 2. Tambah Foreign Key: UMKM -> Kategori
// ON DELETE RESTRICT: Tidak bisa hapus kategori jika masih ada UMKM di dalamnya
runQuery($koneksi,
    "ALTER TABLE umkm 
     ADD CONSTRAINT fk_umkm_kategori 
     FOREIGN KEY (id_kategori) REFERENCES kategori(id_kategori) 
     ON DELETE RESTRICT ON UPDATE CASCADE",
    "Menambah Relasi UMKM -> Kategori (fk_umkm_kategori)"
);

// 3. Tambah Foreign Key: Ulasan -> Users
// ON DELETE CASCADE: Jika user dihapus, ulasannya ikut terhapus
runQuery($koneksi,
    "ALTER TABLE ulasan 
     ADD CONSTRAINT fk_ulasan_users 
     FOREIGN KEY (id_user) REFERENCES users(id_user) 
     ON DELETE CASCADE ON UPDATE CASCADE",
    "Menambah Relasi Ulasan -> Users (fk_ulasan_users)"
);

// 4. Tambah Foreign Key: Ulasan -> UMKM
// ON DELETE CASCADE: Jika UMKM dihapus, ulasannya ikut terhapus
runQuery($koneksi,
    "ALTER TABLE ulasan 
     ADD CONSTRAINT fk_ulasan_umkm 
     FOREIGN KEY (id_umkm) REFERENCES umkm(id_umkm) 
     ON DELETE CASCADE ON UPDATE CASCADE",
    "Menambah Relasi Ulasan -> UMKM (fk_ulasan_umkm)"
);

echo "<hr>";
echo "<h4>Selesai! Silakan hapus file ini jika sudah tidak digunakan.</h4>";
echo "<a href='index.php'>Kembali ke Beranda</a>";
?>
