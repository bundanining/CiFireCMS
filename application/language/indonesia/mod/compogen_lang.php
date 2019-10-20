<?php defined('BASEPATH') OR exit('No direct script access allowed');

$lang['mod_title'] = 'CompoGen';
$lang['mod_setp1'] = 'Komponen';
$lang['mod_setp2'] = 'Database';
$lang['mod_setp3'] = 'Konfigurasi';
$lang['mod_setp4'] = 'Selesai';
$lang['button_generate'] = 'Buat Komponen';
$lang['mod_setp4_1'] = 'Dengan mengklik <span class="badge badge-primary badge-pill">'. $lang['button_generate'] .'</span> maka anda telah menyetujui';
$lang['mod_setp4_2'] = 'ketentuan penggunaan';
$lang['mod_success1'] = 'Komponen telah berhasil dibuat';
$lang['label_component_name'] = 'Nama Komponen';
$lang['label_component_type'] = 'Tipe Komponen';
$lang['label_table_name'] = 'Nama Tabel';
$lang['label_table_filed'] = 'Bidang Tabel';
$lang['label_field'] = 'Bidang';
$lang['label_field_name'] = 'Nama Bidang';
$lang['label_field_type'] = 'Tipe';
$lang['label_field_Length_values'] = 'Panjang / Nilai';
$lang['label_field_default_values'] = 'Nilai Bawaan';
$lang['label_conf_action'] = 'Elemen Aksi';
$lang['label_conf_read'] = 'Baca';
$lang['label_conf_add'] = 'Tambah';
$lang['label_conf_edit'] = 'Ubah';
$lang['label_conf_delete'] = 'Hapus';
$lang['label_conf_multiple_delete'] = 'Hapus Banyak';
$lang['label_conf_Browse'] = 'Bidang Pencarian Berkas';
$lang['label_conf_tinymce'] = 'Bidang Konten TinyMCE';
$lang['label_conf_select'] = 'Bidang Input Pilihan';
$lang['label_conf_option'] = 'Pilihan';
$lang['label_conf_datatable'] = 'Datatable';
$lang['label_conf_frontend'] = 'Antarmuka';
$lang['label_conf_column'] = 'Kolom';
$lang['label_conf_column_name'] = 'Nama Kolom';
$lang['label_conf_field_data'] = 'Data Bidang';
$lang['delete_field'] = 'Hapus bidang';
$lang['button_add_field'] = 'Tambah bidang';
$lang['button_add_option'] = 'Tambah pilihan';
$lang['button_add_column'] = 'Tambah kolom';
$lang['button_next'] = 'Berikutnya';
$lang['button_prev'] = 'Sebelumnya';
$lang['button_goto_component'] = 'Jalankan Komponen';
$lang['mod_db_error1'] = 'Kesalahan Database.! <br> Bidang harus lebih dari 3 item';
$lang['mod_db_error2'] = 'Kesalahan Database.! <br><br>
						  <li>Jika Anda melanjutkan, tabel akan dihapus.</li>
						  <li>Silakan periksa konfigurasi pada bagian database.</li><br>
						  Berhati-hatilah.!';
$lang['mod_tos'] = '
<li><p>Pastikan semua file web dan database telah dibackup terlebih dahulu. Karena kami tidak bertanggung jawab ketika terjadi kesalahan dalam proses generator dan web tidak berjalan dengan semestinya.</p></li>
<li><p>Modul komponen yang digenerate dari CompoGen adalah komponen untuk proses CRUD (Create Read Update Delete) data biasa. Untuk fitur tambahan lebih lanjut kami serahkan ke developer.</p></li>
<li><p>CompoGen akan membuat file modul component baru secara otomatis dan membuat table baru di database. Diharapkan anda pelajari dokumentasi CompoGen dengan teliti.</p></li>';