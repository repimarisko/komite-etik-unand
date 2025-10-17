# API Dosen - Komite Etik UNAND

Implementasi untuk mengambil data dosen dari API SIPPMI UNAND.

## Konfigurasi

### 1. Environment Variables

Tambahkan konfigurasi berikut di file `.env`:

```env
# SIPPMI API Configuration
SIPPMI_API_KEY=your_api_key_here
```

### 2. SSL Certificate

Karena API SIPPMI menggunakan self-signed certificate, implementasi ini menonaktifkan verifikasi SSL untuk development. Untuk production, disarankan untuk menggunakan certificate yang valid.

## Endpoints

### 1. Get All Dosen Data

**URL:** `GET /api/dosen`

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nidn": "0007086503",
            "nama": "Asniati, S.E., M.B.A, Ph.D",
            "fakultas": "Fakultas Ekonomi",
            "prodi": "Manajemen"
        }
    ],
    "message": "Data dosen berhasil diambil"
}
```

### 2. Search Dosen

**URL:** `GET /api/dosen/search?q={query}`

**Parameters:**
- `q` (string): Query pencarian berdasarkan nama atau NIDN

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "nidn": "0007086503",
            "nama": "Asniati, S.E., M.B.A, Ph.D",
            "fakultas": "Fakultas Ekonomi",
            "prodi": "Manajemen"
        }
    ],
    "message": "Data dosen berhasil difilter"
}
```

### 3. View Dosen Data (Web Interface)

**URL:** `GET /dosen`

Halaman web untuk melihat dan mencari data dosen dengan interface yang user-friendly.

## Fitur

### DosenService

- **getDosenData()**: Mengambil semua data dosen dari API SIPPMI
- **searchDosen($query)**: Mencari dosen berdasarkan nama atau NIDN
- Error handling dan logging
- SSL verification disabled untuk development
- Timeout 30 detik

### DosenController

- **index()**: API endpoint untuk mendapatkan semua data dosen
- **search()**: API endpoint untuk pencarian dosen
- **show()**: Halaman web untuk menampilkan data dosen

### Web Interface

- Tabel responsif untuk menampilkan data dosen
- Fitur pencarian real-time
- Refresh data
- Loading states dan error handling
- Mobile-friendly design

## Struktur File

```
app/
├── Services/
│   └── DosenService.php          # Service untuk API SIPPMI
├── Http/Controllers/
│   └── DosenController.php       # Controller untuk endpoint dosen
resources/views/
└── dosen/
    └── index.blade.php           # Halaman web data dosen
routes/
└── web.php                       # Route definitions
```

## Penggunaan

### 1. Akses Web Interface

Buka browser dan kunjungi: `http://127.0.0.1:8000/dosen`

### 2. API Call dengan cURL

```bash
# Get all dosen
curl "http://127.0.0.1:8000/api/dosen"

# Search dosen
curl "http://127.0.0.1:8000/api/dosen/search?q=Asniati"
```

### 3. API Call dengan JavaScript

```javascript
// Get all dosen
fetch('/api/dosen')
    .then(response => response.json())
    .then(data => console.log(data));

// Search dosen
fetch('/api/dosen/search?q=Asniati')
    .then(response => response.json())
    .then(data => console.log(data));
```

## Error Handling

Service ini menangani berbagai jenis error:

1. **SSL Certificate Error**: Diatasi dengan menonaktifkan verifikasi SSL
2. **Network Timeout**: Timeout diset 30 detik
3. **API Response Error**: Logging error dan response yang user-friendly
4. **Invalid API Key**: Error message yang jelas

## Security Notes

⚠️ **Penting untuk Production:**

1. Gunakan HTTPS certificate yang valid
2. Aktifkan kembali SSL verification
3. Implementasi rate limiting
4. Validasi dan sanitasi input
5. Implementasi authentication untuk API endpoints

## Troubleshooting

### SSL Certificate Error

Jika masih mengalami SSL error, pastikan:
1. API key sudah benar di file `.env`
2. Server SIPPMI dapat diakses
3. Firewall tidak memblokir koneksi

### API Key Invalid

1. Periksa API key di file `.env`
2. Pastikan format Bearer token sudah benar
3. Hubungi administrator SIPPMI untuk verifikasi API key

### Data Tidak Muncul

1. Periksa log Laravel di `storage/logs/laravel.log`
2. Periksa network connectivity ke server SIPPMI
3. Pastikan response API sesuai format yang diharapkan