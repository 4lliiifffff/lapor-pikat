# Dokumentasi Routing & Controller
## Sistem Informasi Pelaporan & Edukasi Perundungan PKBM Pintar Berbakat

---

## 1. Daftar Rute Web (Routes)

| Method | URI | Name | Middleware / Otorisasi | Controller & Method | Deskripsi |
| :--- | :--- | :--- | :--- | :--- | :--- |
| `GET` | `/` | `reports.create` | Public | `ReportController@create` | Menampilkan formulir pelaporan utama |
| `POST` | `/lapor` | `reports.store` | Public | `ReportController@store` | Menyimpan laporan baru (anonim / data diri) |
| `GET` | `/lapor/sukses/{code}` | `reports.success` | Public | `ReportController@success` | Halaman sukses menampilkan kode pelacakan |
| `GET` | `/lacak` | `reports.track` | Public | `ReportController@track` | Halaman form pencarian status laporan |
| `POST` | `/lacak` | `reports.track.search` | Public | `ReportController@trackSearch` | Proses pencarian berdasarkan kode pelacakan |
| `GET` | `/lacak/{code}` | `reports.track.detail` | Public | `ReportController@trackDetail` | Menampilkan detail status & timeline laporan |
| `GET` | `/edukasi` | `education.index` | Public | `EducationController@index` | Halaman edukasi perundungan |
| `GET` | `/login` | `login` | Guest | `AuthenticatedSessionController@create` | Form masuk admin/petugas (Breeze) |
| `POST` | `/login` | `login.store` | Guest | `AuthenticatedSessionController@store` | Proses autentikasi login (Breeze) |
| `GET` / `POST` | `/logout` | `logout` | Auth | `AuthenticatedSessionController@destroy` | Proses logout sesi petugas |
| `GET` | `/admin` | `admin.reports.index` | `auth`, `role:admin\|officer` | `AdminReportController@index` | Dashboard & daftar laporan masuk |
| `GET` | `/admin/laporan/{report}` | `admin.reports.show` | `auth`, `role:admin\|officer` | `AdminReportController@show` | Detail laporan dan berkas bukti |
| `PUT` | `/admin/laporan/{report}/status` | `admin.reports.updateStatus` | `auth`, `role:admin\|officer` | `AdminReportController@updateStatus` | Memperbarui status dan catatan tindak lanjut |

---

## 2. Struktur Data Payload Validasi

### 2.1 Pengiriman Laporan (`POST /lapor`)

```json
{
  "report_method": "anonymous | personal",
  "reporter_name": "string | nullable (wajib jika personal)",
  "reporter_class": "string | nullable (wajib jika personal)",
  "reporter_phone": "string | nullable (wajib jika personal)",
  "incident_type": "fisik | verbal | sosial | online | lainnya (wajib)",
  "chronology": "string (wajib, min: 10)",
  "incident_date": "date | nullable (format Y-m-d)",
  "incident_location": "string | nullable (max: 150)",
  "parties_involved": "string | nullable (max: 255)",
  "attachments": "array of files (maks 5 berkas, @1MB, mimes: jpg, jpeg, png, webp, pdf)"
}
```

### 2.2 Pencarian Pelacakan (`POST /lacak`)

```json
{
  "tracking_code": "string (wajib, format misal ABT-XXXX-XXXX)"
}
```

### 2.3 Pembaruan Status Admin (`PUT /admin/laporan/{report}/status`)

```json
{
  "status": "pending | reviewing | investigating | resolved | rejected",
  "note": "string | nullable"
}
```
