<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | {{ config('app.name', 'Komite Etik UNAND') }}</title>

    @php
        use Illuminate\Support\Str;

        $heroImage = $featuredNews?->banner_image_url
            ?? 'https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?auto=format&fit=crop&w=1400&q=80';
        $heroTitle = $featuredNews->title ?? 'Portal Komite Etik Universitas Andalas';
        $heroExcerpt = $featuredNews
            ? Str::limit(strip_tags($featuredNews->content), 190)
            : 'Layanan satu pintu untuk pengajuan, pemantauan, dan publikasi berita terkait penilaian etik penelitian.';
        $newsList = $latestNews->when($featuredNews, fn($items) => $items->where('id', '!=', $featuredNews->id))->take(6);
    @endphp

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --blue-900: #04134b;
            --blue-800: #0c2f7a;
            --blue-700: #1e449d;
            --blue-100: #e9efff;
            --yellow: #f6c343;
            --muted: #6b7085;
            --text: #14172a;
            --bg: #f7f8fc;
            --border: #e5e8f1;
            --surface: #ffffff;
            --max-width: 1200px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Source Sans 3', 'Segoe UI', sans-serif;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .container {
            width: min(92%, var(--max-width));
            margin: 0 auto;
        }

        .top-bar {
            background: #f0f2f8;
            color: var(--muted);
            font-size: 0.92rem;
            border-bottom: 1px solid var(--border);
        }

        .top-bar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.45rem 0;
            flex-wrap: wrap;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        .flag {
            width: 30px;
            height: 20px;
            border-radius: 3px;
            background: linear-gradient(90deg, #0a3d91 65%, #ffd700 35%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            letter-spacing: 0.06em;
            color: #fff;
            font-weight: 700;
        }

        header {
            background: #fff;
            border-bottom: 1px solid var(--border);
            padding: 1.1rem 0;
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(8px);
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            flex-wrap: wrap;
        }

        .logo-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-mark {
            width: 88px;
            height: 60px;
            border: 2px solid #0a3d91;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, #0f2f7a, #0a3d91);
        }

        .logo-mark::before,
        .logo-mark::after {
            content: '';
            position: absolute;
            top: 12px;
            bottom: 12px;
            width: 2px;
            background: #fff;
        }

        .logo-mark::before {
            left: 22px;
        }

        .logo-mark::after {
            right: 22px;
        }

        .logo-flag {
            position: absolute;
            bottom: 10px;
            left: 12px;
            width: 32px;
            height: 20px;
            border: 1px solid #fff;
            background: #0f3e94;
            color: #ffd700;
            font-size: 0.55rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            color: var(--blue-900);
            line-height: 1.1;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            flex-wrap: wrap;
            margin-left: auto;
        }

        .pill {
            border: 1px solid var(--border);
            padding: 0.45rem 0.95rem;
            border-radius: 999px;
            display: inline-flex;
            gap: 0.35rem;
            align-items: center;
            font-weight: 600;
            color: var(--blue-800);
            background: #fff;
        }

        .primary-btn {
            background: var(--yellow);
            color: #3b2a01;
            border: none;
            padding: 0.6rem 1.15rem;
            border-radius: 999px;
            font-weight: 700;
            letter-spacing: 0.02em;
            cursor: pointer;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        nav {
            background: var(--blue-900);
            color: #fff;
        }

        .nav-inner {
            display: flex;
            gap: 1.6rem;
            align-items: center;
            padding: 0.8rem 0;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .nav-inner::-webkit-scrollbar {
            display: none;
        }

        .nav-inner a {
            color: inherit;
            font-weight: 600;
            font-size: 0.98rem;
            white-space: nowrap;
        }

        .hero {
            background: radial-gradient(circle at 20% 20%, #e8edff 0, #f3f5ff 30%, #fff 65%);
            padding: 3.3rem 0 2.6rem;
            position: relative;
            overflow: hidden;
        }

        .hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 80% 10%, rgba(12, 47, 122, 0.08), transparent 35%),
                radial-gradient(circle at 10% 80%, rgba(246, 195, 67, 0.1), transparent 30%);
            pointer-events: none;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2.4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-copy h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.3rem, 4vw, 3.1rem);
            margin: 0 0 1rem;
            color: var(--blue-900);
            line-height: 1.1;
        }

        .hero-copy p {
            margin: 0 0 1.5rem;
            color: #2f3347;
            font-size: 1.05rem;
        }

        .eyebrow {
            text-transform: uppercase;
            letter-spacing: 0.18em;
            font-size: 0.78rem;
            color: var(--muted);
            margin: 0 0 0.7rem;
            font-weight: 700;
        }

        .hero-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .ghost-btn {
            border: 1px solid var(--border);
            padding: 0.6rem 1.05rem;
            border-radius: 999px;
            font-weight: 700;
            color: var(--blue-800);
            background: #fff;
        }

        .hero-visual {
            position: relative;
        }

        .hero-card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            min-height: 320px;
            background: #0f1d4a;
            color: #fff;
            box-shadow: 0 22px 60px rgba(10, 20, 70, 0.32);
        }

        .hero-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: linear-gradient(140deg, rgba(4, 19, 75, 0.75), rgba(4, 19, 75, 0));
            z-index: 1;
        }

        .hero-card__image {
            position: absolute;
            inset: 0;
            background-image: var(--hero-image);
            background-size: cover;
            background-position: center;
            transform: scale(1.02);
        }

        .hero-card__content {
            position: relative;
            z-index: 2;
            padding: 1.3rem 1.3rem 1.4rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            gap: 0.5rem;
            min-height: 320px;
            background: linear-gradient(180deg, rgba(6, 21, 70, 0) 0%, rgba(6, 21, 70, 0.84) 72%);
        }

        .hero-pill {
            display: inline-flex;
            gap: 0.35rem;
            align-items: center;
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            font-size: 0.83rem;
            background: rgba(255, 255, 255, 0.16);
            color: #e8edff;
        }

        .hero-card__title {
            margin: 0;
            font-size: 1.25rem;
            line-height: 1.3;
            font-weight: 700;
        }

        .glance {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 0.9rem;
            margin-top: 1.25rem;
        }

        .glance-item {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 0.85rem 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            box-shadow: 0 12px 30px rgba(16, 30, 80, 0.08);
        }

        .glance-label {
            font-size: 0.83rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-weight: 700;
        }

        .glance-value {
            font-size: 1.15rem;
            color: var(--blue-800);
            font-weight: 700;
        }

        .section {
            padding: 2.8rem 0;
        }

        .section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.3rem;
            flex-wrap: wrap;
        }

        .section-title {
            margin: 0;
            font-size: 1.9rem;
            color: var(--blue-900);
        }

        .section-kicker {
            text-transform: uppercase;
            letter-spacing: 0.14em;
            font-size: 0.8rem;
            color: var(--muted);
            margin: 0;
            font-weight: 700;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
        }

        .action-card {
            position: relative;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.1rem 1.1rem 1.2rem;
            display: flex;
            gap: 0.9rem;
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            box-shadow: 0 14px 32px rgba(13, 26, 70, 0.08);
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 42px rgba(13, 26, 70, 0.14);
        }

        .action-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            background: var(--blue-100);
            color: var(--blue-700);
            flex-shrink: 0;
        }

        .action-card h3 {
            margin: 0 0 0.35rem;
            color: var(--blue-800);
            font-size: 1.05rem;
        }

        .action-card p {
            margin: 0;
            color: #2f3347;
            font-size: 0.98rem;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.15rem;
        }

        .news-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            min-height: 340px;
            box-shadow: 0 16px 36px rgba(10, 20, 60, 0.1);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 42px rgba(10, 20, 60, 0.18);
        }

        .news-thumb {
            height: 150px;
            background-size: cover;
            background-position: center;
        }

        .news-body {
            padding: 1.1rem 1rem 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
            flex: 1;
        }

        .news-tag {
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-size: 0.75rem;
            color: var(--muted);
            font-weight: 700;
        }

        .news-body h3 {
            margin: 0;
            font-size: 1.08rem;
            color: var(--blue-800);
        }

        .news-body p {
            margin: 0;
            color: #2e3044;
            font-size: 0.97rem;
            line-height: 1.45;
        }

        .news-meta {
            font-size: 0.85rem;
            color: var(--muted);
            margin-top: auto;
        }

        .pill-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 0.9rem;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--border);
            font-weight: 700;
            color: var(--blue-800);
        }

        .guides {
            background: linear-gradient(120deg, #f5f7ff, #fff8ed);
            border-radius: 18px;
            padding: 1.8rem;
            border: 1px solid var(--border);
            box-shadow: 0 16px 36px rgba(13, 26, 70, 0.08);
        }

        .guides-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1rem;
        }

        .guide-item {
            padding: 1rem 1.1rem;
            background: rgba(255, 255, 255, 0.78);
            border-radius: 14px;
            border: 1px solid var(--border);
            backdrop-filter: blur(4px);
            box-shadow: 0 10px 24px rgba(10, 20, 60, 0.08);
        }

        .guide-item h4 {
            margin: 0 0 0.35rem;
            color: var(--blue-900);
        }

        .guide-item p {
            margin: 0;
            color: #2f3347;
            font-size: 0.95rem;
        }

        footer {
            padding: 1.6rem 0 2.2rem;
            background: #0a1541;
            color: #dbe2ff;
            margin-top: 2.4rem;
        }

        .footer-inner {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            justify-content: space-between;
        }

        .footer-brand h3 {
            margin: 0 0 0.4rem;
            font-size: 1.3rem;
            color: #fff;
        }

        .footer-links {
            display: grid;
            gap: 0.4rem;
        }

        .footer-links a {
            color: #dbe2ff;
            font-weight: 600;
        }

        @media (max-width: 900px) {
            header {
                position: static;
            }

            .header-inner {
                align-items: flex-start;
            }

            .nav-inner {
                gap: 1rem;
            }
        }

        @media (max-width: 600px) {
            .hero {
                padding: 2.5rem 0 2rem;
            }

            .hero-card__content {
                min-height: 260px;
            }

            .glance {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <div class="container top-bar-content">
            <div class="top-left">
                <span class="flag">EU</span>
                <span>Portal resmi Komite Etik – terinspirasi layanan publik Eropa</span>
            </div>
            <a href="#" style="font-weight: 700; color: var(--blue-800);">Cara memverifikasi</a>
        </div>
    </div>

    <header>
        <div class="container header-inner">
            <div class="logo-group">
                <div class="logo-mark">
                    <span class="logo-flag">EU</span>
                </div>
                <div class="logo-text">
                    <div>Komite Etik</div>
                    <div style="font-size: 1.05rem; font-weight: 600; color: var(--blue-800);">Universitas Andalas</div>
                </div>
            </div>
            <div class="header-actions">
                <div class="pill">🌐 EN</div>
                @auth
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form-dashboard').submit();"
                        class="ghost-btn">Logout</a>
                    <form id="logout-form-dashboard" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a class="ghost-btn" href="{{ route('login') }}">Login</a>
                    <a class="primary-btn" href="{{ route('register') }}">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <nav>
        <div class="container nav-inner">
            <a href="#layanan">Layanan</a>
            <a href="#berita">Berita</a>
            <a href="#panduan">Panduan</a>
            <a href="{{ route('profil.index') }}">Profil Komite</a>
            <a href="{{ route('dosen.show') }}">Data Dosen</a>
        </div>
    </nav>

    <section class="hero" style="--hero-image: url('{{ $heroImage }}');">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="eyebrow">Dashboard</p>
                <h1>{{ $heroTitle }}</h1>
                <p>{{ $heroExcerpt }}</p>
                <div class="hero-actions">
                    @auth
                        <a class="primary-btn" href="{{ route('pengajuan-baru.index') }}">Mulai Pengajuan</a>
                        <a class="ghost-btn" href="#layanan">Lihat Menu Layanan</a>
                    @else
                        <a class="primary-btn" href="{{ route('login') }}">Masuk untuk ajukan</a>
                        <a class="ghost-btn" href="#berita">Lihat berita terbaru</a>
                    @endauth
                </div>
                <div class="glance">
                    <div class="glance-item">
                        <span class="glance-label">Status Protokol</span>
                        <span class="glance-value">Transparan & Terpantau</span>
                    </div>
                    <div class="glance-item">
                        <span class="glance-label">Dukungan Sekretariat</span>
                        <span class="glance-value">Setiap langkah</span>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-card">
                    <div class="hero-card__image"></div>
                    <div class="hero-card__content">
                        <span class="hero-pill">Sorotan</span>
                        <p class="hero-card__title">
                            {{ $featuredNews->title ?? 'Berita terbaru seputar kebijakan etik dan pengumuman komite.' }}
                        </p>
                        <a class="pill-link"
                            href="{{ $featuredNews ? route('news.show', $featuredNews) : '#' }}">
                            {{ $featuredNews ? 'Baca selengkapnya' : 'Lihat agenda komite' }} →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section" id="layanan">
        <div class="container">
            <div class="section-head">
                <div>
                    <p class="section-kicker">akses cepat</p>
                    <h2 class="section-title">Layanan utama</h2>
                </div>
                <a class="pill-link" href="{{ route('profil.index') }}">Kenali komite →</a>
            </div>
            @php
                $actions = [
                    [
                        'title' => 'Pengajuan Baru',
                        'desc' => 'Kirim proposal penelitian untuk dinilai oleh Komite Etik.',
                        'icon' => '📝',
                        'link' => route('pengajuan-baru.index'),
                    ],
                    [
                        'title' => 'Pengajuan Perbaikan',
                        'desc' => 'Tambahkan revisi setelah menerima catatan perbaikan.',
                        'icon' => '🧭',
                        'link' => route('perbaikan.index'),
                    ],
                    [
                        'title' => 'Amandemen',
                        'desc' => 'Laporkan perubahan protokol atau metode penelitian.',
                        'icon' => '📄',
                        'link' => route('amandemen.index'),
                    ],
                    [
                        'title' => 'Perpanjangan Penelitian',
                        'desc' => 'Ajukan perpanjangan masa berlaku izin etik.',
                        'icon' => '⏳',
                        'link' => route('perpanjangan.index'),
                    ],
                    [
                        'title' => 'Laporan Akhir',
                        'desc' => 'Serahkan laporan hasil penelitian untuk penutupan.',
                        'icon' => '✅',
                        'link' => route('laporan-akhir.index'),
                    ],
                    [
                        'title' => 'Modul KTD-SAE',
                        'desc' => 'Laporkan kejadian tak diharapkan secara cepat.',
                        'icon' => '🚑',
                        'link' => route('ktd-sae.index'),
                    ],
                ];
            @endphp
            <div class="actions-grid">
                @foreach ($actions as $action)
                    <a href="{{ $action['link'] }}" class="action-card">
                        <div class="action-icon">{{ $action['icon'] }}</div>
                        <div>
                            <h3>{{ $action['title'] }}</h3>
                            <p>{{ $action['desc'] }}</p>
                            @guest
                                <span style="font-size: 0.85rem; color: var(--muted); font-weight: 600;">Login mungkin
                                    diperlukan</span>
                            @endguest
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section" id="berita">
        <div class="container">
            <div class="section-head">
                <div>
                    <p class="section-kicker">berita & pembaruan</p>
                    <h2 class="section-title">Suara terbaru dari Komite Etik</h2>
                </div>
                @if ($featuredNews)
                    <a class="pill-link" href="{{ route('news.show', $featuredNews) }}">Baca berita unggulan →</a>
                @endif
            </div>
            @if ($newsList->count())
                <div class="news-grid">
                    @foreach ($newsList as $news)
                        <article class="news-card">
                            <div class="news-thumb" style="background-image: url('{{ $news->banner_image_url }}');">
                            </div>
                            <div class="news-body">
                                <span class="news-tag">Publikasi</span>
                                <h3>{{ $news->title }}</h3>
                                <p>{{ Str::limit(strip_tags($news->content), 130) }}</p>
                                <div class="news-meta">
                                    {{ optional($news->published_at)->translatedFormat('d M Y') ?? 'Tanggal belum tersedia' }}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="guide-item">
                    <h4>Belum ada berita</h4>
                    <p>Pengumuman akan tampil di sini segera setelah Komite Etik mempublikasikannya.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section" id="panduan">
        <div class="container">
            <div class="guides">
                <div class="section-head" style="margin-bottom: 1rem;">
                    <div>
                        <p class="section-kicker">panduan & referensi</p>
                        <h2 class="section-title" style="font-size: 1.6rem;">Mulai dengan langkah yang jelas</h2>
                    </div>
                    <a class="pill-link" href="{{ route('profil.index') }}">Hubungi Sekretariat →</a>
                </div>
                <div class="guides-grid">
                    <div class="guide-item">
                        <h4>Checklist Berkas</h4>
                        <p>Pastikan informed consent, protokol, dan lampiran etis tersusun rapi sebelum dikirim.</p>
                    </div>
                    <div class="guide-item">
                        <h4>Timeline Penilaian</h4>
                        <p>Pengajuan diproses terjadwal; pastikan tenggat sidang dipantau bersama tim Anda.</p>
                    </div>
                    <div class="guide-item">
                        <h4>Perubahan Protokol</h4>
                        <p>Amandemen wajib dilaporkan agar izin tetap relevan dengan praktik lapangan.</p>
                    </div>
                    <div class="guide-item">
                        <h4>Konsultasi Awal</h4>
                        <p>Butuh arahan? Sekretariat siap memberi dukungan sebelum pengajuan formal.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container footer-inner">
            <div class="footer-brand">
                <h3>Komite Etik UNAND</h3>
                <p>Menjaga integritas riset dengan layanan transparan dan responsif.</p>
            </div>
            <div class="footer-links">
                <a href="{{ route('profil.index') }}">Profil Komite</a>
                <a href="#layanan">Layanan</a>
                <a href="#berita">Berita</a>
                <a href="#panduan">Panduan</a>
            </div>
        </div>
    </footer>
</body>

</html>
