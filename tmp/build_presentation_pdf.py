from reportlab.pdfgen import canvas
from reportlab.lib.pagesizes import landscape, A4
from reportlab.lib import colors
from reportlab.lib.units import cm
from reportlab.pdfbase.pdfmetrics import stringWidth

OUT = r'C:\masjid-cicangkudu\output\pdf\Presentasi_Sistem_Masjid_Cicangkudu.pdf'
W, H = landscape(A4)
GREEN=colors.HexColor('#0B5C3D'); DARK=colors.HexColor('#15362B'); MINT=colors.HexColor('#EAF5EF'); SOFT=colors.HexColor('#F7FAF8'); GOLD=colors.HexColor('#D9A441'); MUTED=colors.HexColor('#60736B'); WHITE=colors.white

def txt(c, value, x, y, size=16, color=DARK, bold=False, maxw=None, leading=None):
    font='Helvetica-Bold' if bold else 'Helvetica'; c.setFont(font,size); c.setFillColor(color)
    lines=[]
    for part in value.split('\n'):
        words=part.split(); line=''
        for word in words:
            n=(line+' '+word).strip()
            if maxw and stringWidth(n,font,size)>maxw and line: lines.append(line); line=word
            else: line=n
        lines.append(line)
    lead=leading or size*1.3
    for i,line in enumerate(lines): c.drawString(x,y-i*lead,line)
    return y-len(lines)*lead
def rect(c,x,y,w,h,fill,stroke=None,r=12):
    c.setFillColor(fill); c.setStrokeColor(stroke or fill); c.roundRect(x,y,w,h,r,fill=1,stroke=1 if stroke else 0)
def page(c,n,title,sub):
    c.setFillColor(SOFT); c.rect(0,0,W,H,fill=1,stroke=0); c.setFillColor(GREEN); c.rect(0,H-12,W,12,fill=1,stroke=0)
    txt(c,f'{n:02d}',54,H-50,11,GOLD,True); txt(c,title,54,H-95,27,GREEN,True); txt(c,sub,54,H-126,13,MUTED,False,maxw=700)
    txt(c,'Sistem Digital Masjid Jami Cicangkudu',54,18,8,MUTED); txt(c,f'{n}/7',W-76,18,8,MUTED)
def card(c,x,y,w,h,title,body,accent=GREEN):
    rect(c,x,y,w,h,WHITE,colors.HexColor('#C7DED1')); c.setFillColor(accent); c.rect(x+18,y+h-45,8,26,fill=1,stroke=0); txt(c,title,x+40,y+h-37,15,DARK,True,maxw=w-55); txt(c,body,x+40,y+h-70,11,MUTED,False,maxw=w-58,leading=15)

c=canvas.Canvas(OUT,pagesize=landscape(A4),pageCompression=1); c.setTitle('Presentasi Sistem Digital Masjid Jami Cicangkudu')
c.setFillColor(GREEN); c.rect(0,0,W,H,fill=1,stroke=0); c.setFillColor(colors.HexColor('#0F7650')); c.circle(W-145,H-150,105,fill=1,stroke=0); c.setFillColor(GOLD); c.circle(W-115,H-330,65,fill=1,stroke=0)
txt(c,'SISTEM DIGITAL',62,H-145,14,GOLD,True); txt(c,'Masjid Jami\nCicangkudu',62,H-215,39,WHITE,True,leading=49); txt(c,'Pengelolaan informasi, kegiatan, donasi,\nlaporan keuangan, dan data warga.',64,H-365,17,colors.HexColor('#D8EDE2'),False,leading=23); rect(c,64,128,205,38,WHITE); txt(c,'Penyaji: [Nama Anda]',84,142,12,GREEN,True); txt(c,'September 2026',64,58,11,colors.HexColor('#D8EDE2')); c.showPage()

page(c,2,'Masalah dan tujuan sistem','Satu sistem untuk menghubungkan pengelola masjid dan warga.')
card(c,54,220,235,160,'Akses informasi','Warga membutuhkan pengumuman, jadwal salat, dan kegiatan yang selalu diperbarui.'); card(c,304,220,235,160,'Transaksi transparan','Donasi membutuhkan bukti transfer, verifikasi admin, dan laporan keuangan yang mudah dipantau.',GOLD); card(c,554,220,235,160,'Administrasi tertata','Admin mengelola warga, konten, profil masjid, serta hapus data terpilih.'); txt(c,'Tujuan: pelayanan lebih cepat, pencatatan lebih rapi, dan keuangan lebih transparan.',54,150,17,GREEN,True,maxw=700); c.showPage()

page(c,3,'Alur layanan untuk warga','Pengalaman warga dibuat sederhana dari login sampai melihat status donasi.')
items=[('1','Login','Masuk dengan akun warga'),('2','Akses informasi','Lihat jadwal, berita, kegiatan, dan laporan'),('3','Donasi','Pilih program dan unggah bukti transfer'),('4','Notifikasi','Terima kabar konten baru atau hasil verifikasi')]
for i,(n,t,b) in enumerate(items):
    x=54+i*190; c.setFillColor(GREEN); c.circle(x+30,270,27,fill=1,stroke=0); txt(c,n,x+21,265,12,WHITE,True); txt(c,t,x,215,14,DARK,True,maxw=150); txt(c,b,x,190,10,MUTED,False,maxw=150); 
    if i<3: txt(c,'→',x+150,260,28,GOLD,True)
txt(c,'Profil warga dapat diperbarui untuk nama, kata sandi, dan foto profil.',54,112,17,GREEN,True,maxw=700); c.showPage()

page(c,4,'Alur kerja admin','Admin mengelola konten, data, pembayaran, dan verifikasi dalam dashboard.')
card(c,54,310,340,120,'Kelola konten','Buat informasi atau kegiatan, unggah gambar, lalu terbitkan agar warga memperoleh notifikasi.'); card(c,448,310,340,120,'Kelola donasi','Atur rekening dan QRIS sendiri. Periksa bukti transfer dan terima atau tolak donasi.',GOLD); card(c,54,145,340,120,'Warga dan profil','Tambah, impor, edit, atau pilih beberapa data warga untuk dihapus sekaligus.'); card(c,448,145,340,120,'Keuangan','Catat pemasukan atau pengeluaran. Donasi diterima menjadi pemasukan otomatis.'); c.showPage()

page(c,5,'Struktur sistem dan data','Aplikasi Laravel memisahkan tampilan, rute, proses bisnis, dan basis data.')
cols=[('Tampilan','Blade admin dan warga','Dashboard, formulir, kartu informasi, profil, notifikasi'),('Rute','routes/web.php','URL, middleware admin, dan controller'),('Proses','Controller + Model','CRUD, donasi, API jadwal, neraca kas'),('Data','MySQL + storage','Akun, konten, donasi, profil, gambar')]
for i,(a,b,d) in enumerate(cols): card(c,54+i*190,225,165,175,a,b+'\n\n'+d,GOLD if i==1 else GREEN)
txt(c,'API jadwal salat memakai data Kab. Tasikmalaya, Jawa Barat (wilayah Cicangkudu).',54,130,15,GREEN,True,maxw=700); c.showPage()

page(c,6,'Donasi terverifikasi dan Neraca Kas','Pencatatan berbasis kas agar mudah dipahami dan siap dikembangkan.')
cols=[('Pemasukan','Donasi diterima + transaksi pemasukan',GREEN),('Pengeluaran','Transaksi pengeluaran',GOLD),('Kas dan Bank','Pemasukan - Pengeluaran',GREEN),('Dana Bersih','Kas dan Bank - kewajiban',GREEN)]
for i,(a,b,col) in enumerate(cols): card(c,54+i*190,250,165,130,a,b,col)
txt(c,'Dalam versi ini kewajiban bernilai Rp0, sehingga Aset Kas = Dana Bersih.',54,160,17,GREEN,True,maxw=700); txt(c,'Jika nanti ada utang atau aset tetap, modul dapat diperluas tanpa mengubah alur transaksi kas.',54,124,12,MUTED,maxw=700); c.showPage()

page(c,7,'Hasil akhir dan langkah demo','Sistem siap digunakan sebagai dasar pengelolaan masjid yang lebih tertib.')
card(c,54,260,340,150,'1. Demo admin','Tambahkan informasi, ubah profil masjid, atur QRIS, verifikasi donasi, dan lihat neraca kas.'); card(c,448,260,340,150,'2. Demo warga','Buka jadwal salat, baca informasi, donasi dengan bukti transfer, dan cek notifikasi.',GOLD); rect(c,54,125,734,62,GREEN); c.setFont('Helvetica-Bold',19); c.setFillColor(WHITE); c.drawCentredString(W/2,148,'Terima kasih — Sistem Digital Masjid Jami Cicangkudu'); c.showPage(); c.save()
