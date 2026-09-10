import fs from 'node:fs/promises';
import path from 'node:path';
import { pathToFileURL } from 'node:url';
import { Presentation, PresentationFile } from '@oai/artifact-tool';

const workspaceDir = 'C:\\masjid-cicangkudu';
const SKILL_DIR = 'C:\\Users\\PCRPL\\.codex\\plugins\\cache\\openai-primary-runtime\\presentations\\26.905.11957\\skills\\presentations';
const RUNTIME_PYTHON = 'C:\\Users\\PCRPL\\.cache\\codex-runtimes\\codex-primary-runtime\\dependencies\\python\\python.exe';
const FINAL_PPTX = path.join(workspaceDir, 'output', 'pptx', 'Presentasi_Sistem_Masjid_Cicangkudu_Revisi.pptx');
const { resolvePresentationFont, finalizePresentation } = await import(pathToFileURL(path.join(SKILL_DIR, 'container_tools', 'artifact_tool_utils.mjs')).href);
const font = resolvePresentationFont();
const p = Presentation.create({ slideSize: { width: 1280, height: 720 } });
const C = { green:'#0B5C3D', dark:'#15362B', mint:'#EAF5EF', soft:'#F7FAF8', gold:'#D9A441', white:'#FFFFFF', muted:'#60736B', line:'#C7DED1' };

function shape(slide, geometry, left, top, width, height, fill='none', line='none') {
  return slide.shapes.add({ geometry, position:{left,top,width,height}, fill, line: line === 'none' ? {fill:'none',width:0} : {style:'solid',fill:line,width:1} });
}
function text(slide, value, left, top, width, height, size=22, color=C.dark, bold=false, align='left') {
  const s = shape(slide, 'textbox', left, top, width, height);
  s.text = value; s.text.style = { typeface:font, fontSize:size, color, bold, align, autoFit:'shrinkText' };
  return s;
}
function header(slide, num, title, subtitle='') {
  slide.background.fill = C.soft;
  shape(slide,'rect',0,0,1280,16,C.green);
  text(slide, String(num).padStart(2,'0'), 72, 48, 60, 28, 14, C.gold, true);
  text(slide, title, 72, 78, 1050, 58, 32, C.green, true);
  if (subtitle) text(slide, subtitle, 72, 140, 1040, 34, 16, C.muted);
  text(slide, 'Sistem Digital Masjid Jami Cicangkudu', 72, 678, 420, 18, 10, C.muted);
  text(slide, `${num}/7`, 1140, 678, 68, 18, 10, C.muted, false, 'right');
}
function card(slide, title, body, left, top, width, height, accent=C.green) {
  shape(slide,'roundRect',left,top,width,height,C.white,C.line).shadow='shadow-sm';
  shape(slide,'roundRect',left+20,top+20,8,38,accent,accent);
  text(slide,title,left+46,top+19,width-66,31,18,C.dark,true);
  text(slide,body,left+46,top+61,width-66,height-75,14,C.muted,false);
}

{ const s=p.slides.add(); s.background.fill=C.green;
  shape(s,'ellipse',920,70,280,280,'#0F7650','#0F7650'); shape(s,'ellipse',990,365,175,175,'#D9A441','#D9A441');
  text(s,'SISTEM DIGITAL',78,150,480,35,17,C.gold,true); text(s,'Masjid Jami\nCicangkudu',78,196,670,142,49,C.white,true);
  text(s,'Pengelolaan informasi, kegiatan, donasi,\nlaporan keuangan, dan data warga.',82,366,600,70,20,'#D8EDE2');
  shape(s,'roundRect',82,490,282,48,C.white,C.white); text(s,'Penyaji: [Nama Anda]',104,505,240,22,14,C.green,true);
  text(s,'September 2026',82,610,240,22,13,'#D8EDE2'); s.speakerNotes.textFrame.setText('Sapa audiens dan jelaskan bahwa presentasi ini membahas solusi digital untuk kebutuhan administrasi Masjid Jami Cicangkudu.'); }
{ const s=p.slides.add(); header(s,2,'Masalah dan tujuan sistem','Satu sistem untuk menghubungkan pengelola masjid dan warga.');
  card(s,'Akses informasi','Warga membutuhkan pengumuman, jadwal salat, dan kegiatan yang selalu diperbarui.',72,220,345,225,C.green);
  card(s,'Transaksi transparan','Donasi perlu bukti transfer, verifikasi admin, serta laporan keuangan yang mudah dipantau.',468,220,345,225,C.gold);
  card(s,'Administrasi tertata','Admin perlu pengelolaan warga, konten, profil masjid, dan penghapusan data terpilih.',864,220,345,225,C.green);
  text(s,'Tujuan: pelayanan informasi lebih cepat, pencatatan lebih rapi, dan keuangan lebih transparan.',72,520,1080,38,20,C.green,true); s.speakerNotes.textFrame.setText('Jelaskan tiga masalah utama dan hubungan setiap masalah dengan fitur yang dibangun.'); }
{ const s=p.slides.add(); header(s,3,'Alur layanan untuk warga','Pengalaman warga dibuat sederhana dari login sampai melihat status donasi.');
  const items=[['1','Login','Masuk dengan akun warga'],['2','Akses informasi','Lihat jadwal, berita, kegiatan, dan laporan'],['3','Donasi','Pilih program dan unggah bukti transfer'],['4','Notifikasi','Terima kabar konten baru atau hasil verifikasi']];
  items.forEach((it,i)=>{ const x=72+i*285; shape(s,'ellipse',x,260,72,72,C.green,C.green); text(s,it[0],x,277,72,26,22,C.white,true,'center'); text(s,it[1],x,354,220,28,17,C.dark,true); text(s,it[2],x,390,220,48,13,C.muted); if(i<3) shape(s,'rightArrow',x+218,282,48,28,C.gold,C.gold); });
  text(s,'Profil warga dapat diperbarui untuk nama, kata sandi, dan foto profil.',72,520,920,32,19,C.green,true); s.speakerNotes.textFrame.setText('Jelaskan alur warga dari autentikasi, akses informasi, donasi, hingga notifikasi.'); }
{ const s=p.slides.add(); header(s,4,'Alur kerja admin','Admin mengelola konten, data, pembayaran, dan verifikasi dalam dashboard.');
  card(s,'Kelola konten','Buat informasi atau kegiatan, unggah gambar, lalu terbitkan agar warga memperoleh notifikasi.',72,220,500,165,C.green);
  card(s,'Kelola donasi','Atur rekening dan QRIS sendiri. Periksa bukti transfer dan terima atau tolak donasi.',708,220,500,165,C.gold);
  card(s,'Kelola warga dan profil','Tambah, impor, edit, atau pilih beberapa data warga untuk dihapus sekaligus. Edit kartu profil masjid.',72,420,500,165,C.green);
  card(s,'Kelola laporan','Catat pengeluaran. Donasi yang diverifikasi tampil otomatis sebagai Donasi Masuk.',708,420,500,165,C.green); s.speakerNotes.textFrame.setText('Jelaskan tugas rutin admin dan tekankan bahwa hapus massal meminta konfirmasi sebelum data dihapus.'); }
{ const s=p.slides.add(); header(s,5,'Struktur sistem dan data','Aplikasi Laravel memisahkan tampilan, rute, proses bisnis, dan basis data.');
  const cols=[['Tampilan','Blade admin dan warga','Dashboard, formulir, kartu informasi, profil, notifikasi'],['Rute','routes/web.php','Menghubungkan URL, middleware admin, dan controller'],['Proses','Controller + Model','CRUD, verifikasi donasi, API jadwal, laporan'],['Data','MySQL + storage','Akun, konten, donasi, profil, notifikasi, dan gambar']];
  cols.forEach((c,i)=>card(s,c[0],`${c[1]}\n\n${c[2]}`,72+i*285,230,250,255,i===1?C.gold:C.green));
  text(s,'API jadwal salat memakai data Kab. Tasikmalaya, Jawa Barat, dan pengguna dapat memilih bulan serta tahun.',72,540,1080,34,17,C.green,true); s.speakerNotes.textFrame.setText('Perlihatkan struktur empat lapisan. Sebutkan bahwa API jadwal disesuaikan dengan Kab. Tasikmalaya dan mendukung pilihan bulan serta tahun.'); }
{ const s=p.slides.add(); header(s,6,'Donasi masuk dan riwayat laporan','Laporan hanya menampilkan donasi yang telah diverifikasi, pengeluaran, dan saldo.');
  const y=235; [['Donasi Masuk','Bukti donasi yang diterima admin',C.green],['Pengeluaran','Catatan pengeluaran yang dibuat admin',C.gold],['Saldo','Donasi Masuk dikurangi Pengeluaran',C.green]].forEach((a,i)=>{ const x=120+i*360; shape(s,'roundRect',x,y,320,175,C.white,C.line); shape(s,'roundRect',x+20,y+20,280,34,a[2],a[2]); text(s,a[0],x+32,y+28,256,17,14,C.white,true,'center'); text(s,a[1],x+25,y+75,270,58,14,C.dark,true,'center'); });
  text(s,'Kotak amal serta fasilitas atau inventaris milik santri tidak masuk perhitungan laporan masjid.',72,500,1080,36,18,C.green,true); text(s,'Riwayat laporan dapat ditambah, diubah, dan dihapus oleh admin.',72,548,1040,30,15,C.muted); s.speakerNotes.textFrame.setText('Terangkan bahwa laporan fokus pada donasi terverifikasi dan pengeluaran. Fasilitas atau inventaris milik santri tidak dihitung sebagai laporan masjid.'); }
{ const s=p.slides.add(); header(s,7,'Hasil akhir dan langkah demo','Sistem siap digunakan sebagai dasar pengelolaan masjid yang lebih tertib.');
  card(s,'1. Demo admin','Tambahkan informasi, ubah profil masjid, atur QRIS, verifikasi donasi, lalu periksa riwayat laporan.',72,230,520,210,C.green);
  card(s,'2. Demo warga','Buka jadwal salat, baca informasi, donasi dengan bukti transfer, dan cek notifikasi.',688,230,520,210,C.gold);
  shape(s,'roundRect',72,510,1136,80,C.green,C.green); text(s,'Terima kasih — Sistem Digital Masjid Jami Cicangkudu',98,535,1080,28,23,C.white,true,'center'); s.speakerNotes.textFrame.setText('Tutup dengan rangkuman hasil. Jika ada demo langsung, mulai dari dashboard admin lalu tunjukkan tampilan warga.'); }

await fs.mkdir(path.dirname(FINAL_PPTX),{recursive:true});
const stagingDir=path.join(workspaceDir,'.codex-finalizer'); await fs.mkdir(stagingDir,{recursive:true});
const candidatePath=path.join(stagingDir,'candidate.pptx'); await (await PresentationFile.exportPptx(p)).save(candidatePath);
const requirements={explicitTotalSlideCount:7,requiredNativeTableOwnerSlides:[],requiredNativeChartOwnerSlides:[]};
await finalizePresentation({ ...requirements, workspaceDir, candidatePath, finalPath:FINAL_PPTX, pythonExecutable:RUNTIME_PYTHON, integrityValidatorPath:path.join(SKILL_DIR,'container_tools','inspect_presentation_package_integrity.py'), layoutValidatorPath:path.join(SKILL_DIR,'container_tools','inspect_presentation_layout_geometry.py'), layoutArgs:['--expected-slide-size-emu','12192000,6858000','--validate-bullet-geometry','--validate-heading-fit'], fontPolicy:{basis:'design',families:[font]}, verifyArtifactToolImport:true, receiptPath:path.join(stagingDir,'Presentasi_Sistem_Masjid_Cicangkudu_Revisi.validation.json') });
for (let i=0;i<7;i++) { const img=await p.export({slide:p.slides.items[i],format:'png',scale:1}); await fs.writeFile(path.join(workspaceDir,'tmp','slides',`slide-${i+1}.png`),new Uint8Array(await img.arrayBuffer())); }
