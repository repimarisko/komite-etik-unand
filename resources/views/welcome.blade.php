<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Komite Etik Unand') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Source+Sans+3:wght@400;500;600&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --blue-dark: #040b3c;
            --blue-mid: #142556;
            --accent: #f5b547;
            --grey: #f6f6f6;
            --text: #1f2233;
            --muted: #6f6f7a;
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
            color: var(--text);
            background: #fff;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: min(var(--max-width), 92%);
            margin: 0 auto;
        }

        .top-bar {
            background: var(--grey);
            border-bottom: 1px solid #e3e3ea;
            font-size: 0.9rem;
            color: var(--muted);
        }


        .top-bar-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            padding: 0.35rem 0;
            flex-wrap: wrap;
        }

        .top-bar-left {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
        }

        .flag {
            width: 28px;
            height: 18px;
            border-radius: 2px;
            background: linear-gradient(90deg, #0a3d91 65%, #ffd700 35%);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            letter-spacing: 0.04em;
            color: #fff;
            font-weight: 600;
        }

        .top-bar a {
            color: var(--blue-mid);
            font-weight: 600;
            white-space: nowrap;
        }

        header {
            background: #fff;
            padding: 1.3rem 0;
            border-bottom: 1px solid #e3e3ea;
        }

        .header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .logo-group {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-mark {
            width: 90px;
            height: 60px;
            border: 2px solid #0a3d91;
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }

        .logo-mark::before,
        .logo-mark::after {
            content: '';
            position: absolute;
            top: 10px;
            bottom: 10px;
            width: 2px;
            background: #0a3d91;
        }

        .logo-mark::before {
            left: 20px;
        }

        .logo-mark::after {
            right: 20px;
        }

        .logo-flag {
            position: absolute;
            bottom: 8px;
            left: 10px;
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
            font-size: 1.7rem;
            font-weight: 600;
            color: #101b3f;
            line-height: 1.2;
        }

        .logo-text span {
            display: block;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-left: auto;
        }

        .language-switcher {
            display: flex;
            align-items: center;
            gap: 0.35rem;
            border: 1px solid #d2d2d9;
            padding: 0.4rem 0.85rem;
            border-radius: 999px;
            font-weight: 600;
            color: var(--blue-mid);
        }

        .language-switcher span {
            font-size: 0.95rem;
        }

        .search-box {
            display: flex;
            align-items: center;
            border: 1px solid #d2d2d9;
            border-radius: 999px;
            overflow: hidden;
        }

        .search-box input {
            border: none;
            padding: 0.5rem 0.85rem;
            font-size: 0.95rem;
            min-width: 230px;
            font-family: inherit;
        }

        .search-box button {
            border: none;
            background: transparent;
            padding: 0.45rem 0.85rem;
            cursor: pointer;
            color: var(--blue-mid);
            font-size: 1rem;
        }

        nav {
            background: var(--blue-dark);
            color: #fff;
        }

        .nav-inner {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            padding: 0.75rem 0;
            overflow-x: auto;
        }

        .nav-inner a {
            color: inherit;
            font-weight: 500;
            display: flex;
            gap: 0.25rem;
            align-items: center;
            white-space: nowrap;
        }

        .chevron {
            font-size: 0.8rem;
            opacity: 0.7;
        }

        .hero {
            background: linear-gradient(110deg, #f0f3ff, #fef7f1);
            padding: 3rem 0;
        }

        .hero-inner {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            flex-wrap: wrap;
        }

        .hero-text {
            flex: 1 1 320px;
        }

        .hero-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.9rem;
            line-height: 1.1;
            margin: 0 0 1rem;
            color: var(--blue-mid);
        }

        .hero-text p {
            font-size: 1.05rem;
            color: #3d405a;
            margin-bottom: 1.7rem;
        }

        .btn-primary {
            background: var(--accent);
            border: none;
            border-radius: 999px;
            padding: 0.75rem 1.6rem;
            font-size: 1rem;
            font-weight: 600;
            color: #402800;
            cursor: pointer;
            box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
        }

        .hero-media {
            flex: 1 1 300px;
            display: flex;
            justify-content: center;
        }

        .hero-media img {
            width: 100%;
            max-width: 520px;
            border-radius: 22px;
            box-shadow: 0 30px 60px rgba(19, 23, 56, 0.35);
            border: 4px solid #fff;
        }

        .news {
            padding: 3rem 0 4rem;
        }

        .news h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--blue-mid);
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1.5rem;
        }

        .news-card {
            border: 1px solid #e3e3ea;
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            display: flex;
            flex-direction: column;
            min-height: 320px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .news-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 40px rgba(5, 12, 46, 0.15);
        }

        .news-image {
            height: 170px;
            background-size: cover;
            background-position: center;
        }

        .news-body {
            padding: 1.2rem;
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }

        .news-tag {
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            color: var(--muted);
            font-weight: 600;
        }

        .news-body h3 {
            margin: 0;
            font-size: 1.15rem;
            color: var(--blue-mid);
        }

        .news-body p {
            margin: 0;
            color: #4a4c5b;
            font-size: 0.95rem;
            line-height: 1.4;
        }

        .ethics-menu {
            padding: 1rem 0 4rem;
            background: #f8f9ff;
            border-top: 1px solid #e3e3ea;
        }

        .ethics-head {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            margin-bottom: 1.5rem;
        }

        .section-kicker {
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.14em;
            color: var(--muted);
            font-weight: 700;
            margin: 0;
        }

        .ethics-head h2 {
            font-size: 2rem;
            color: var(--blue-mid);
            margin: 0;
        }

        .ethics-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.2rem;
        }

        .ethics-card {
            position: relative;
            background: #fff;
            border: 1px solid #e3e3ea;
            border-radius: 16px;
            padding: 1.2rem 1.2rem 1.3rem;
            box-shadow: 0 12px 28px rgba(10, 18, 64, 0.08);
            transition: transform 0.18s ease, box-shadow 0.18s ease;
            min-height: 150px;
        }

        .ethics-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(10, 18, 64, 0.14);
        }

        .ethics-card h3 {
            margin: 0 0 0.35rem;
            color: #1f4fc1;
            font-size: 1.12rem;
        }

        .ethics-card p {
            margin: 0;
            color: #303349;
            line-height: 1.45;
            max-width: 92%;
        }

        .icon-badge {
            position: absolute;
            top: 0.95rem;
            right: 0.9rem;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .badge-blue {
            background: #ecf1ff;
            color: #365bff;
        }

        .badge-green {
            background: #e6f5ec;
            color: #2f9f6f;
        }

        .badge-purple {
            background: #f0eaff;
            color: #7c4fd6;
        }

        .badge-orange {
            background: #fff4e3;
            color: #d48a21;
        }

        .badge-pink {
            background: #ffeaf3;
            color: #cc5c9e;
        }

        .badge-slate {
            background: #eaf0f7;
            color: #3d4a75;
        }

        @media (max-width: 768px) {
            .header-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .search-box input {
                min-width: 160px;
            }

            .hero-text h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="top-bar">
        <div class="container top-bar-content">
            <div class="top-bar-left">
                <span class="flag">EU</span>
                <span>An official website of the European Union</span>
            </div>
            <a href="#">How do you know?</a>
        </div>
    </div>

    <header>
        <div class="container header-inner">
            <div class="logo-group">
                <div class="logo-mark">
                    <span class="logo-flag">EU</span>
                </div>
                <div class="logo-text">
                    <span>European</span>
                    <span>Commission</span>
                </div>
            </div>
            <div class="header-actions">
                <div class="language-switcher">
                    <span>🌐</span>
                    <span>EN</span>
                </div>
                <form class="search-box">
                    <input type="search" placeholder="Search" aria-label="Search">
                    <button type="submit">🔍</button>
                </form>
            </div>
        </div>
    </header>

    <nav>
        <div class="container nav-inner">
            <a href="#">Home</a>
            <a href="#">About us <span class="chevron">▾</span></a>
            <a href="#">Our priorities <span class="chevron">▾</span></a>
            <a href="#">News and media <span class="chevron">▾</span></a>
            <a href="#">Topics <span class="chevron">▾</span></a>
            <a href="#">Resources <span class="chevron">▾</span></a>
            <a href="#">Europe and you <span class="chevron">▾</span></a>
        </div>
    </nav>

    <section class="hero">
        <div class="container hero-inner">
            <div class="hero-text">
                <p
                    style="text-transform: uppercase; font-size: 0.9rem; letter-spacing: 0.2em; color: var(--muted); margin: 0 0 0.5rem;">
                    Spotlight
                </p>
                <h1>Protecting our democracy, upholding our values</h1>
                <p>
                    The European Commission is working with citizens, communities and partners to strengthen
                    participation in public life, safeguard elections, and protect the integrity of our Union.
                </p>
                <button class="btn-primary">Learn more</button>
            </div>
            <div class="hero-media">
                <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?auto=format&fit=crop&w=1200&q=80"
                    alt="Children voting">
            </div>
        </div>
    </section>

    <section class="news">
        <div class="container">
            <h2>News</h2>
            <div class="news-grid">
                <article class="news-card">
                    <div class="news-image"
                        style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?auto=format&fit=crop&w=800&q=80');">
                    </div>
                    <div class="news-body">
                        <span class="news-tag">Announcements</span>
                        <h3>Commission updates roadmap for 2025 priorities</h3>
                        <p>Key initiatives on climate, digital innovation and research collaboration were presented in
                            Brussels.</p>
                    </div>
                </article>
                <article class="news-card">
                    <div class="news-image"
                        style="background-image: url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=800&q=80');">
                    </div>
                    <div class="news-body">
                        <span class="news-tag">News</span>
                        <h3>EU launches new education exchange network</h3>
                        <p>More than 2,000 schools will exchange innovative teaching practices through the initiative.
                        </p>
                    </div>
                </article>
                <article class="news-card">
                    <div class="news-image"
                        style="background-image: url('https://images.unsplash.com/photo-1489515217757-5fd1be406fef?auto=format&fit=crop&w=800&q=80');">
                    </div>
                    <div class="news-body">
                        <span class="news-tag">Press release</span>
                        <h3>Green transition fund unlocks investments</h3>
                        <p>Grants and guarantees will accelerate clean energy projects in member states.</p>
                    </div>
                </article>
                <article class="news-card">
                    <div class="news-image"
                        style="background-image: url('https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?auto=format&fit=crop&w=800&q=80');">
                    </div>
                    <div class="news-body">
                        <span class="news-tag">Events</span>
                        <h3>Citizens' dialogue on democracy and youth</h3>
                        <p>Young leaders shared priorities for 2024 elections in a live discussion from Strasbourg.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="ethics-menu">
        <div class="container">
            <div class="ethics-head">
                <p class="section-kicker">menu komite etik</p>
                <h2>Komite Etik dan Anda</h2>
            </div>
            <div class="ethics-grid">
                <article class="ethics-card">
                    <div class="icon-badge badge-blue">👥</div>
                    <h3>Profil Komite Etik</h3>
                    <p>Kenali mandat, struktur tim, serta prinsip yang kami pegang dalam menilai protokol penelitian.</p>
                </article>
                <article class="ethics-card">
                    <div class="icon-badge badge-green">📝</div>
                    <h3>Ajukan Protokol</h3>
                    <p>Panduan langkah demi langkah untuk mengirim proposal, termasuk syarat dokumen yang wajib dilampirkan.</p>
                </article>
                <article class="ethics-card">
                    <div class="icon-badge badge-purple">📂</div>
                    <h3>Panduan & Formulir</h3>
                    <p>Unduh SOP, template informed consent, dan format laporan kemajuan penelitian terbaru.</p>
                </article>
                <article class="ethics-card">
                    <div class="icon-badge badge-orange">📅</div>
                    <h3>Jadwal Sidang</h3>
                    <p>Lihat kalender sidang komite, tenggat pengumpulan berkas, serta alur review bulanan.</p>
                </article>
                <article class="ethics-card">
                    <div class="icon-badge badge-pink">✅</div>
                    <h3>Lacak Status</h3>
                    <p>Cek progres penilaian proposal Anda, catatan perbaikan, dan surat keputusan yang tersedia.</p>
                </article>
                <article class="ethics-card">
                    <div class="icon-badge badge-slate">💬</div>
                    <h3>Konsultasi & Bantuan</h3>
                    <p>Jadwalkan sesi konsultasi atau hubungi sekretariat untuk pertanyaan terkait kepatuhan etik.</p>
                </article>
            </div>
        </div>
    </section>
</body>

</html>
