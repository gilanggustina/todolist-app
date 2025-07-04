# To-Do List PHP With TailwindCSS

## Deskripsi

Aplikasi To-Do List sederhana berbasis PHP yang menyimpan data dalam bentuk array di sisi server menggunakan `$_SESSION`:

```php
$_SESSION["tasks"] = [
    ["title" => "Belajar PHP", "done" => false, "deadline" => "2025-06-14 14:30"],
    ["title" => "Kerjakan tugas UX", "done" => true, "deadline" => "2025-06-14 09:00"],
];
```

## Fitur

- Tambah tugas dengan deadline (opsional)
- Edit tugas yang sudah ada
- Tandai tugas sebagai selesai atau belum
- Hapus tugas
- Drag-and-drop reordering (urutan disimpan secara permanen di sesi)
- Styling modern menggunakan TailwindCSS
- Data disimpan di `$_SESSION` (tanpa database)

## Struktur Folder

```
todolist-app/
├── index.php       # Halaman utama (UI dan JavaScript)
├── tasks.php       # Logika backend untuk tambah/edit/delete/toggle tugas
├── helpers.php     # Fungsi utilitas untuk menampilkan daftar tugas
└── reorder.php     # Endpoint untuk menyimpan urutan drag-and-drop
```

## Cara Menjalankan

1. Pastikan Anda memiliki server lokal seperti Laragon, XAMPP, atau PHP built-in server.
2. Clone atau salin folder `todolist-app/` ke direktori `www` atau `htdocs`.
3. Jalankan dengan:
   ```bash
   php -S localhost:8000
   ```
   Atau langsung buka di:
   ```
   http://localhost/todolist-app/index.php
   ```

## Instruksi yang Dilakukan (Poin-poin Panduan Pengguna)

1. **Tambah Tugas**
   - Isi nama tugas pada input teks.
   - (Opsional) Pilih tanggal dan waktu deadline.
   - Klik tombol **Simpan** untuk menambahkan.

2. **Tandai Tugas Selesai / Belum**
   - Klik checkbox di sebelah tugas untuk menandai selesai atau belum.

3. **Edit Tugas**
   - Klik tombol **Edit** di sebelah tugas.
   - Form di atas akan terisi otomatis.
   - Lakukan perubahan, lalu klik **Simpan**.

4. **Hapus Tugas**
   - Klik tombol **Delete** untuk menghapus tugas secara permanen.

5. **Urutkan Tugas**
   - Gunakan drag-and-drop untuk memindahkan posisi tugas.
   - Urutan otomatis disimpan dalam sesi.

---

## Kontributor
- Cahaya Gilang Gustina https://github.com/gilanggustina
