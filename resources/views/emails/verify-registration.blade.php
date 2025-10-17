<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Komite Etik UNAND</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e5e5e5;
        }
        .logo {
            max-width: 80px;
            height: auto;
            margin-bottom: 15px;
        }
        .title {
            color: #2c3e50;
            font-size: 24px;
            margin: 0;
        }
        .subtitle {
            color: #7f8c8d;
            font-size: 14px;
            margin: 5px 0 0 0;
        }
        .content {
            margin-bottom: 30px;
        }
        .greeting {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        .message {
            margin-bottom: 20px;
            line-height: 1.8;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .verify-button {
            display: inline-block;
            background-color: #3498db;
            color: #ffffff;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .verify-button:hover {
            background-color: #2980b9;
        }
        .info-box {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #3498db;
        }
        .info-title {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
            text-align: center;
            color: #7f8c8d;
            font-size: 12px;
        }
        .contact {
            margin-top: 15px;
        }
        .contact a {
            color: #3498db;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Verifikasi Email</h1>
            <p class="subtitle">Komite Etik Penelitian Universitas Andalas</p>
        </div>

        <div class="content">
            <p class="greeting">Halo {{ $registration->name }},</p>
            
            <p class="message">
                Terima kasih telah mendaftar di sistem Komite Etik Penelitian Universitas Andalas. 
                Untuk melanjutkan proses registrasi, silakan verifikasi alamat email Anda dengan 
                mengklik tombol di bawah ini:
            </p>

            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="verify-button">
                    Verifikasi Email Saya
                </a>
            </div>

            <div class="info-box">
                <div class="info-title">Informasi Registrasi Anda:</div>
                <p><strong>Nama:</strong> {{ $registration->name }}</p>
                <p><strong>Email:</strong> {{ $registration->email }}</p>
                @if($registration->phone)
                    <p><strong>Telepon:</strong> {{ $registration->phone }}</p>
                @endif
                @if($registration->institution)
                    <p><strong>Institusi:</strong> {{ $registration->institution }}</p>
                @endif
                @if($registration->department)
                    <p><strong>Departemen:</strong> {{ $registration->department }}</p>
                @endif
            </div>

            <div class="info-box">
                <div class="info-title">Langkah Selanjutnya:</div>
                <ol>
                    <li>Klik tombol "Verifikasi Email Saya" di atas</li>
                    <li>Tunggu persetujuan dari administrator (1-3 hari kerja)</li>
                    <li>Anda akan menerima email berisi username dan password untuk login</li>
                </ol>
            </div>

            <p class="message">
                <strong>Catatan Penting:</strong><br>
                • Link verifikasi ini berlaku selama 24 jam<br>
                • Jika Anda tidak melakukan registrasi ini, abaikan email ini<br>
                • Jangan bagikan link ini kepada orang lain
            </p>

            <p class="message">
                Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan menempelkan 
                link berikut ke browser Anda:
            </p>
            <p style="word-break: break-all; background-color: #f8f9fa; padding: 10px; border-radius: 3px; font-family: monospace; font-size: 12px;">
                {{ $verificationUrl }}
            </p>
        </div>

        <div class="footer">
            <p>
                Email ini dikirim secara otomatis oleh sistem Komite Etik Penelitian UNAND.<br>
                Mohon tidak membalas email ini.
            </p>
            <div class="contact">
                <p>
                    Butuh bantuan? Hubungi kami di 
                    <a href="mailto:komite.etik@unand.ac.id">komite.etik@unand.ac.id</a>
                </p>
                <p>
                    Komite Etik Penelitian<br>
                    Universitas Andalas<br>
                    Padang, Sumatera Barat
                </p>
            </div>
        </div>
    </div>
</body>
</html>