# Tutorial Menghubungkan Project Flutter APP ACEH TICKET TRAVEL CAR ke MySQL dengan API

## Pendahuluan
Repository ini adalah penghubung antara project Flutter dan MySQL (dengan XAMPP sebagai server lokal), yang biasa disebut sebagai API. Ikuti langkah-langkah berikut untuk mengatur dan menjalankan aplikasi Anda.

---

## Langkah 1: Clone Repository Project Flutter
Clone terlebih dahulu repository project Flutter yang akan digunakan:

<div align="center">
  <a href="https://github.com/TEUNGKU-ZULKIFLI/ACEH_TICKET_TRAVEL_CAR"><button style="font-size: 18px; padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">REPO APP ACEH TICKET TRAVEL CAR</button></a>
</div>

---

## Langkah 2: Clone Repository API
Pastikan repository API ini di-clone ke dalam folder `htdocs` di direktori XAMPP Anda. Contoh lokasi:

```
C:\xampp\htdocs\
```

---

## Langkah 3: Membuat Database dan Tabel
Jalankan kode SQL berikut untuk membuat database dan tabel-tabel yang diperlukan:

```CODINGAN
-- Membuat database baru
CREATE DATABASE aceh_travel;

-- Menggunakan database aceh_travel
USE aceh_travel;

-- Membuat tabel 'tickets'
CREATE TABLE tickets (
  id INT(11) NOT NULL AUTO_INCREMENT,
  kota_asal VARCHAR(100) NOT NULL,
  kota_tujuan VARCHAR(100) NOT NULL,
  tanggal DATE NOT NULL,
  waktu_berangkat VARCHAR(50) NOT NULL,
  harga DECIMAL(10,2) NOT NULL,
  jumlah_kursi INT(11) NOT NULL,
  PRIMARY KEY (id)
);

-- Membuat tabel 'users'
CREATE TABLE users (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  no_hp VARCHAR(15) NOT NULL,
  role ENUM('penumpang', 'sopir') NOT NULL DEFAULT 'penumpang',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
);

-- Membuat tabel 'user_ticket_transactions'
CREATE TABLE user_ticket_transactions (
  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  ticket_id INT(11) NOT NULL,
  seat_number INT(11) NOT NULL,
  status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY user_id (user_id),
  KEY ticket_id (ticket_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE
);

-- Menampilkan struktur tabel setelah dibuat
SHOW TABLES;
```
## Langkah 4: Menguji API
Gunakan browser kesayangan anda untuk menguji endpoint API. Pastikan endpoint seperti `http://localhost/app_aceh_travel/` berfungsi dengan baik.
pastikan anda melihat list foder yang sama seperti repo ini juga.
---

## Penutup
Dengan mengikuti tutorial ini, Anda telah berhasil menghubungkan project Flutter dengan MySQL menggunakan API. Semoga berhasil dan selamat mencoba!
