# Naskah Presentasi Mitra — Sistem Digital Masjid Jami Cicangkudu

**Durasi:** sekitar 7–10 menit  
**Peran:** 1 moderator dan 1 presentator  
**Catatan:** Ganti bagian dalam tanda kurung siku, misalnya `[nama moderator]`, sebelum digunakan.

---

## 1. Pembukaan

### Moderator

Assalamu'alaikum warahmatullahi wabarakatuh.

Yang kami hormati Bapak/Ibu selaku mitra, serta seluruh hadirin yang berbahagia. Terima kasih atas waktu dan kesempatan yang telah diberikan kepada kami.

Pada kesempatan ini, kami akan memperkenalkan **Sistem Digital Masjid Jami Cicangkudu**. Sistem ini dirancang untuk membantu pengelolaan informasi, kegiatan, data warga, donasi, kas, dan laporan keuangan masjid secara lebih tertib, cepat, dan transparan.

Presentasi akan disampaikan oleh rekan kami, **[nama presentator]**. Setelah pemaparan, kami akan membuka sesi tanya jawab dan sangat mengharapkan masukan dari Bapak/Ibu. Kepada [nama presentator], kami persilakan.

### Presentator — Slide 1

Terima kasih, [nama moderator]. Assalamu'alaikum warahmatullahi wabarakatuh.

Perkenalkan, saya [nama presentator]. Pada hari ini saya akan memaparkan Sistem Digital Masjid Jami Cicangkudu.

Sistem ini kami bangun sebagai media pelayanan digital antara pengelola masjid dan warga. Melalui satu aplikasi, warga dapat memperoleh informasi dan melakukan transaksi dengan lebih mudah, sedangkan pengurus dapat mengelola data serta administrasi secara terpusat.

---

## 2. Latar belakang dan tujuan

### Presentator — Slide 2

Ada tiga kebutuhan utama yang ingin kami jawab melalui sistem ini.

Pertama, **akses informasi**. Warga membutuhkan informasi masjid seperti pengumuman, kegiatan, jadwal salat, dan laporan yang selalu diperbarui serta mudah diakses.

Kedua, **transaksi yang transparan**. Dalam proses donasi dan pembayaran kas, dibutuhkan bukti transaksi, verifikasi dari admin, dan status yang jelas agar pencatatan lebih dapat dipercaya.

Ketiga, **administrasi yang tertata**. Pengurus perlu mengelola data warga, data keluarga, konten informasi, profil masjid, dan laporan dalam satu tempat.

Tujuan akhirnya adalah agar pelayanan informasi menjadi lebih cepat, pencatatan lebih rapi, dan pengelolaan keuangan masjid semakin transparan.

---

## 3. Alur layanan warga

### Presentator — Slide 3

Di sisi warga, alurnya dibuat sederhana.

Warga terlebih dahulu masuk menggunakan akun yang telah terdaftar. Setelah itu, warga dapat melihat informasi masjid, jadwal salat, kegiatan, donasi, laporan, serta status kas keluarga.

Apabila ingin berdonasi, warga dapat memilih program donasi, mengisi data yang diperlukan, kemudian mengunggah bukti transfer. Selanjutnya, admin akan melakukan verifikasi. Ketika donasi sudah diterima atau ditolak, warga memperoleh notifikasi dan dapat melihat statusnya.

Warga juga dapat memperbarui profil, seperti nama, kata sandi, dan foto profil. Dengan demikian, data pengguna dapat tetap relevan dan dikelola dengan baik.

---

## 4. Alur kerja pengurus atau admin

### Presentator — Slide 4

Untuk pengurus masjid, tersedia dashboard admin sebagai pusat pengelolaan.

Admin dapat membuat dan menerbitkan informasi atau kegiatan masjid. Ketika konten dipublikasikan, warga dapat menerima notifikasi sehingga informasi dapat tersampaikan lebih cepat.

Pada menu donasi, admin dapat mengatur rekening atau QRIS, memeriksa bukti transfer, kemudian menerima atau menolak transaksi donasi. Sistem juga menyediakan pengelolaan kas keluarga, termasuk pencatatan pembayaran dan proses verifikasi.

Selain itu, admin dapat menambah, mengubah, mengimpor, serta menghapus data warga dan keluarga sesuai kebutuhan. Penghapusan massal tetap disertai konfirmasi agar pengelolaan data lebih aman.

---

## 5. Struktur dan teknologi sistem

### Presentator — Slide 5

Secara teknis, sistem dibangun menggunakan Laravel sebagai kerangka aplikasi web dan basis data MySQL untuk penyimpanan data.

Struktur sistem dibagi menjadi beberapa bagian. Pertama, tampilan untuk warga dan admin. Kedua, rute yang mengatur akses setiap halaman. Ketiga, proses bisnis yang menangani pengelolaan data, verifikasi, dan laporan. Keempat, penyimpanan data untuk akun, konten, donasi, kas, notifikasi, profil masjid, dan gambar pendukung.

Untuk jadwal salat, sistem menyediakan data untuk Kabupaten Tasikmalaya, Jawa Barat. Pengguna dapat memilih bulan dan tahun sehingga informasi jadwal dapat disesuaikan dengan kebutuhan.

---

## 6. Transparansi donasi dan laporan

### Presentator — Slide 6

Salah satu fokus utama sistem ini adalah transparansi laporan keuangan.

Dalam laporan, donasi yang tampil sebagai pemasukan adalah donasi yang sudah diverifikasi oleh admin. Pengeluaran dicatat oleh admin berdasarkan kebutuhan operasional atau kegiatan masjid. Saldo kemudian dihitung dari total donasi masuk dikurangi total pengeluaran.

Riwayat laporan dapat ditambah, diubah, dan dihapus oleh admin sesuai kewenangan. Sistem juga membedakan dana masjid dari fasilitas atau inventaris pribadi, sehingga laporan masjid tetap fokus pada transaksi yang memang menjadi tanggung jawab pengelolaan masjid.

---

## 7. Hasil dan rencana demonstrasi

### Presentator — Slide 7

Sebagai hasilnya, Sistem Digital Masjid Jami Cicangkudu menyediakan dasar pengelolaan masjid yang lebih tertib dan terintegrasi.

Melalui sistem ini, pengurus dapat mengelola informasi, data warga dan keluarga, donasi, kas, serta laporan dalam satu aplikasi. Di sisi lain, warga dapat memperoleh informasi, melakukan donasi, melihat status transaksi, dan menerima notifikasi dengan lebih mudah.

Dalam demonstrasi singkat, kami dapat memperlihatkan dua sisi penggunaan. Dari sisi admin, kami akan menunjukkan pengelolaan informasi, pengaturan QRIS atau rekening, verifikasi donasi, dan riwayat laporan. Dari sisi warga, kami akan menunjukkan akses jadwal salat, informasi masjid, proses donasi, kas keluarga, dan notifikasi.

Kami berharap sistem ini dapat menjadi sarana pendukung bagi Masjid Jami Cicangkudu untuk meningkatkan kualitas layanan kepada jamaah dan mewujudkan pengelolaan yang lebih terbuka serta akuntabel.

Terima kasih. Wassalamu'alaikum warahmatullahi wabarakatuh.

---

## 8. Penutup dan tanya jawab

### Moderator

Terima kasih kepada [nama presentator] atas pemaparannya.

Demikian pengenalan Sistem Digital Masjid Jami Cicangkudu. Kami berharap sistem ini dapat membantu pengurus dalam memberikan pelayanan yang lebih baik kepada warga dan jamaah, terutama dalam penyampaian informasi, administrasi, serta transparansi transaksi.

Selanjutnya, kami membuka sesi tanya jawab. Kami dengan senang hati menerima pertanyaan, masukan, maupun saran dari Bapak/Ibu mitra.

*(Setelah sesi tanya jawab selesai)*

Terima kasih atas pertanyaan dan masukan yang telah diberikan. Masukan tersebut akan menjadi bahan evaluasi kami untuk pengembangan sistem ke depan.

Dengan demikian, presentasi kami akhiri. Terima kasih atas perhatian Bapak/Ibu.

Wassalamu'alaikum warahmatullahi wabarakatuh.

---

## Kalimat singkat untuk menjawab pertanyaan mitra

**Jika ditanya manfaat utama:**  
"Manfaat utamanya adalah informasi masjid lebih cepat tersampaikan, transaksi donasi dan kas lebih tertata, serta laporan keuangan lebih mudah dipantau."

**Jika ditanya keamanan verifikasi:**  
"Setiap bukti pembayaran diperiksa terlebih dahulu oleh admin. Donasi atau pembayaran baru berstatus diterima setelah proses verifikasi dilakukan."

**Jika ditanya siapa yang dapat mengelola data:**  
"Pengelolaan data inti dilakukan oleh akun admin. Warga memiliki akses untuk melihat informasi dan memperbarui profilnya sendiri."

**Jika ditanya pengembangan berikutnya:**  
"Pengembangan dapat diarahkan pada penyempurnaan tampilan, perluasan notifikasi, integrasi metode pembayaran, serta penyesuaian fitur sesuai kebutuhan pengurus dan warga."
