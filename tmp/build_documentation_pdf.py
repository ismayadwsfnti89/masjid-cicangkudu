from reportlab.lib import colors
from reportlab.lib.enums import TA_CENTER
from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import cm
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, Table, TableStyle, PageBreak, KeepTogether

OUT = r"C:\masjid-cicangkudu\output\pdf\Dokumentasi_Sistem_Masjid_Cicangkudu.pdf"
GREEN = colors.HexColor('#0B5C3D')
MINT = colors.HexColor('#F3F8F5')
INK = colors.HexColor('#17362B')
MUTED = colors.HexColor('#5F6F68')

styles = getSampleStyleSheet()
styles.add(ParagraphStyle(name='CoverTitle', parent=styles['Title'], fontName='Helvetica-Bold', fontSize=24, leading=30, textColor=GREEN, alignment=TA_CENTER, spaceAfter=13))
styles.add(ParagraphStyle(name='CoverSub', parent=styles['Normal'], fontName='Helvetica', fontSize=12, leading=17, textColor=MUTED, alignment=TA_CENTER))
styles.add(ParagraphStyle(name='H1Green', parent=styles['Heading1'], fontName='Helvetica-Bold', fontSize=16, leading=20, textColor=GREEN, spaceBefore=12, spaceAfter=7))
styles.add(ParagraphStyle(name='BodySmall', parent=styles['BodyText'], fontName='Helvetica', fontSize=9.6, leading=14, textColor=INK, spaceAfter=7))
styles.add(ParagraphStyle(name='TableCell', parent=styles['BodyText'], fontName='Helvetica', fontSize=8.2, leading=11, textColor=INK))
styles.add(ParagraphStyle(name='TableHead', parent=styles['BodyText'], fontName='Helvetica-Bold', fontSize=8.4, leading=11, textColor=colors.white))

def P(text, style='BodySmall'):
    return Paragraph(text, styles[style])

def make_table(headers, rows, widths):
    data = [[P(h, 'TableHead') for h in headers]] + [[P(v, 'TableCell') for v in row] for row in rows]
    t = Table(data, colWidths=widths, repeatRows=1, hAlign='LEFT')
    commands = [
        ('BACKGROUND', (0,0), (-1,0), GREEN), ('TEXTCOLOR', (0,0), (-1,0), colors.white),
        ('GRID', (0,0), (-1,-1), .35, colors.HexColor('#D9D9D9')), ('VALIGN', (0,0), (-1,-1), 'MIDDLE'),
        ('LEFTPADDING', (0,0), (-1,-1), 7), ('RIGHTPADDING', (0,0), (-1,-1), 7),
        ('TOPPADDING', (0,0), (-1,-1), 6), ('BOTTOMPADDING', (0,0), (-1,-1), 6),
    ]
    for i in range(1, len(data)):
        if i % 2 == 0: commands.append(('BACKGROUND', (0,i), (-1,i), MINT))
    t.setStyle(TableStyle(commands))
    return t

def footer(canvas, doc):
    canvas.saveState(); canvas.setFont('Helvetica', 8); canvas.setFillColor(MUTED)
    canvas.drawCentredString(A4[0]/2, 1.0*cm, 'Sistem Digital Masjid Jami Cicangkudu')
    canvas.drawRightString(A4[0]-1.7*cm, 1.0*cm, f'Halaman {doc.page}')
    canvas.restoreState()

story = []
story += [Spacer(1, 6.0*cm), P('Dokumentasi Sistem Digital Masjid Jami Cicangkudu', 'CoverTitle'), P('Panduan alur sistem, struktur kode, dan penggunaan admin', 'CoverSub'), Spacer(1, .8*cm), P('Penyaji: [Nama Anda]', 'CoverSub'), Spacer(1, .2*cm), P('September 2026', 'CoverSub'), PageBreak()]
story += [P('Ringkasan Sistem', 'H1Green'), P('Sistem Digital Masjid Jami Cicangkudu adalah aplikasi Laravel untuk warga dan pengelola masjid. Warga memperoleh jadwal salat Tasikmalaya, informasi dan kegiatan, donasi, laporan keuangan, notifikasi, dan profil. Admin mengelola data warga, konten, pembayaran, verifikasi donasi, laporan, profil masjid, dan notifikasi.')]
story += [P('Aktor dan Hak Akses', 'H1Green'), make_table(['Aktor', 'Akses Utama'], [['Warga', 'Melihat jadwal, informasi, donasi, laporan keuangan, notifikasi, serta mengubah nama, kata sandi, dan foto profil.'], ['Admin', 'Mengelola warga, informasi dan kegiatan, program donasi, QRIS dan rekening, laporan keuangan, profil masjid, serta verifikasi bukti donasi.']], [3.0*cm, 14.4*cm])]
story += [P('Alur Sistem', 'H1Green'), make_table(['Tahap', 'Alur'], [['1. Autentikasi', 'Pengguna login. Middleware membatasi halaman admin hanya untuk role admin.'], ['2. Informasi', 'Admin membuat informasi atau kegiatan dan memilih status terbit. Konten tampil pada warga dan menghasilkan notifikasi.'], ['3. Donasi', 'Warga memilih program, mengunggah bukti transfer, lalu sistem membuat data berstatus pending.'], ['4. Verifikasi', 'Admin menerima atau menolak bukti. Donasi diterima dicatat otomatis sebagai pemasukan laporan keuangan.'], ['5. Neraca', 'Saldo kas dihitung dari pemasukan dikurangi pengeluaran. Aset kas dan dana bersih ditampilkan pada neraca kas.']], [3.2*cm, 14.2*cm])]
story += [P('Struktur Kode', 'H1Green'), make_table(['Bagian', 'File Penting', 'Tanggung Jawab'], [['Routing', 'routes/web.php', 'Mendaftarkan halaman warga, admin, CRUD konten, verifikasi donasi, dan hapus massal.'], ['Konten Admin', 'AdminContentController.php', 'CRUD informasi, kegiatan, donasi, laporan keuangan, serta hapus massal konten.'], ['Donasi', 'DonationController.php dan AdminDonationController.php', 'Unggah bukti, pemberitahuan admin, menerima atau menolak donasi.'], ['Keuangan', 'LaporanController.php', 'Menghitung pemasukan, pengeluaran, saldo, dan neraca kas.'], ['Profil Masjid', 'MasjidProfileController.php', 'Menyimpan foto, biodata, visi, dan misi yang tampil pada warga.'], ['Profil Warga', 'WargaProfileController.php', 'Memperbarui nama, kata sandi, dan foto profil warga.']], [2.5*cm, 5.0*cm, 9.9*cm])]
story += [PageBreak(), P('Struktur Data Utama', 'H1Green'), make_table(['Tabel', 'Isi'], [['users', 'Akun warga dan admin beserta role.'], ['warga_profiles', 'Nomor HP, alamat, dan avatar warga.'], ['masjid_contents', 'Informasi, kegiatan, program donasi, serta transaksi laporan keuangan.'], ['donations', 'Nominal, metode pembayaran, bukti transfer, status verifikasi, dan relasi warga.'], ['payment_settings', 'Rekening bank dan gambar QRIS yang tampil pada halaman donasi.'], ['masjid_profiles', 'Foto, biodata, visi, dan misi masjid.'], ['notifications', 'Notifikasi bukti donasi untuk admin dan konten atau status donasi untuk warga.']], [4.0*cm, 13.4*cm])]
story += [P('Pengelolaan Neraca Kas', 'H1Green'), P('Sistem menggunakan basis kas. Pemasukan menambah kas dan dana bersih. Pengeluaran mengurangi kas dan dana bersih. Neraca menampilkan Aset berupa Kas dan Bank, Kewajiban bernilai nol sampai modul utang ditambahkan, serta Dana Bersih yang sama dengan saldo kas. Jumlah aset selalu setara dengan kewajiban ditambah dana bersih.'), make_table(['Komponen', 'Rumus'], [['Total Pemasukan', 'Jumlah semua transaksi pemasukan yang telah diterbitkan.'], ['Total Pengeluaran', 'Jumlah semua transaksi pengeluaran yang telah diterbitkan.'], ['Kas dan Bank', 'Total Pemasukan - Total Pengeluaran.'], ['Dana Bersih', 'Kas dan Bank - Kewajiban.']], [5.0*cm, 12.4*cm])]
story += [P('Panduan Admin', 'H1Green'), make_table(['Menu', 'Langkah'], [['Informasi dan Kegiatan', 'Tambah data, pilih jenis konten, isi judul, deskripsi, tanggal, gambar, dan status terbit. Gunakan Profil Masjid untuk mengubah kartu biodata warga.'], ['Program Donasi', 'Tambah program, atur rekening dan QRIS, lalu periksa bukti transfer yang masuk.'], ['Laporan Keuangan', 'Tambah pemasukan atau pengeluaran. Pantau ringkasan dan Neraca Kas. Donasi terverifikasi masuk otomatis sebagai pemasukan.'], ['Data Warga', 'Tambah manual, impor Excel, edit, hapus satu data, atau pilih beberapa warga untuk hapus massal.'], ['Hapus Massal', 'Centang data yang diperlukan, klik Hapus data terpilih, lalu konfirmasi. Tindakan tidak dapat dibatalkan.']], [4.0*cm, 13.4*cm])]
story += [P('Pengujian dan Pemeliharaan', 'H1Green'), P('Setelah perubahan kode, jalankan php artisan migrate untuk menerapkan struktur database baru, php artisan storage:link agar gambar dapat ditampilkan, php artisan view:cache untuk memeriksa template Blade, dan php artisan test untuk menjalankan pengujian dasar. Buat cadangan database sebelum memakai hapus massal.')]

SimpleDocTemplate(OUT, pagesize=A4, rightMargin=1.7*cm, leftMargin=1.7*cm, topMargin=1.7*cm, bottomMargin=1.6*cm, title='Dokumentasi Sistem Digital Masjid Jami Cicangkudu', author='Sistem Digital Masjid').build(story, onFirstPage=footer, onLaterPages=footer)
