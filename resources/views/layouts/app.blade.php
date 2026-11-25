<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('brand.name'))</title>
    <meta name="description" content="@yield('meta_description', 'Ashwick Outdoor Structures designs and builds custom pergolas and gazebos across Charlotte, NC—engineered shade for lasting outdoor living.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0D4F6C;
            --primary-dark: #093A50;
            --accent: #E8A838;
            --ink: #102A33;
            --mist: #E7F1F5;
            --wood: #6E4B2A;
            --cream: #F4F8FA;
            --font-display: "Fraunces", Georgia, serif;
            --font-body: "Sora", sans-serif;
        }
        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: var(--font-body);
            color: var(--ink);
            background: var(--cream);
            line-height: 1.6;
        }
        a { color: inherit; text-decoration: none; }
        img { max-width: 100%; display: block; }
        .container { width: min(1120px, 92%); margin-inline: auto; }
        .site-header {
            position: sticky; top: 0; z-index: 40;
            backdrop-filter: blur(12px);
            background: rgba(244,248,250,.92);
            border-bottom: 1px solid rgba(13,79,108,.12);
        }
        .nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 1rem 0; gap: 1rem;
        }
        .brand {
            font-family: var(--font-display);
            font-size: 1.45rem; font-weight: 700; letter-spacing: .01em;
            color: var(--primary-dark);
        }
        .brand span { color: var(--accent); }
        .nav-links { display: flex; gap: 1.25rem; align-items: center; flex-wrap: wrap; }
        .nav-links a { font-size: .92rem; font-weight: 500; opacity: .85; }
        .nav-links a:hover { opacity: 1; color: var(--primary); }
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: .4rem;
            padding: .85rem 1.35rem; border-radius: .55rem; border: none; cursor: pointer;
            font-family: var(--font-body); font-weight: 600; font-size: .95rem;
            transition: transform .2s ease, background .2s ease, box-shadow .2s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--primary); color: #fff; box-shadow: 0 10px 24px rgba(13,79,108,.25); }
        .btn-primary:hover { background: var(--primary-dark); }
        .btn-accent { background: var(--accent); color: var(--ink); }
        .btn-ghost { background: transparent; border: 1.5px solid rgba(16,42,51,.2); }
        .hero {
            position: relative; min-height: 92vh; display: grid; align-items: end;
            color: #fff; overflow: hidden;
        }
        .hero-media {
            position: absolute; inset: 0; background-size: cover; background-position: center;
            transform: scale(1.02); animation: drift 18s ease-in-out infinite alternate;
        }
        .hero-media::after {
            content: ""; position: absolute; inset: 0;
            background: linear-gradient(180deg, rgba(16,42,51,.22) 0%, rgba(9,58,80,.78) 55%, rgba(9,58,80,.92) 100%);
        }
        @keyframes drift { from { transform: scale(1.02) translateY(0); } to { transform: scale(1.08) translateY(-1.5%); } }
        .hero-content { position: relative; z-index: 1; padding: 5rem 0 4rem; }
        .hero h1 {
            font-family: var(--font-display); font-size: clamp(2.8rem, 7vw, 5rem);
            line-height: 1.05; margin: 0 0 .75rem; max-width: 14ch; font-weight: 600;
        }
        .hero p { max-width: 38ch; font-size: 1.1rem; opacity: .92; margin: 0 0 1.5rem; }
        .hero-actions { display: flex; gap: .75rem; flex-wrap: wrap; }
        .section { padding: 5rem 0; }
        .section-kicker {
            text-transform: uppercase; letter-spacing: .16em; font-size: .72rem;
            color: var(--primary); font-weight: 600; margin-bottom: .6rem;
        }
        .section h2 {
            font-family: var(--font-display); font-size: clamp(2rem, 4vw, 3rem);
            margin: 0 0 .75rem; line-height: 1.15; font-weight: 600;
        }
        .lead { max-width: 52ch; color: rgba(16,42,51,.75); margin-bottom: 2rem; }
        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .grid-2 { display: grid; grid-template-columns: 1.1fr .9fr; gap: 2.5rem; align-items: center; }
        .service-card img { width: 100%; height: 220px; object-fit: cover; border-radius: .75rem; }
        .service-card h3 { font-family: var(--font-display); font-size: 1.6rem; margin: 1rem 0 .35rem; }
        .service-card p { margin: 0 0 1rem; color: rgba(16,42,51,.72); }
        .price { color: var(--wood); font-weight: 600; }
        .panel {
            background: linear-gradient(145deg, #0D4F6C, #093A50 60%, #163B48);
            color: #fff; border-radius: 1.25rem; padding: 2rem; overflow: hidden;
            position: relative;
        }
        .panel img { border-radius: .75rem; margin-top: 1.25rem; opacity: .95; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 1.5rem; }
        .stat strong { display: block; font-family: var(--font-display); font-size: 2rem; }
        .stat span { font-size: .85rem; opacity: .8; }
        .fade-up { animation: fadeUp .8s ease both; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: none; } }
        .site-footer {
            background: var(--ink); color: rgba(255,255,255,.82); padding: 3rem 0 2rem; margin-top: 2rem;
        }
        .footer-grid { display: grid; grid-template-columns: 1.4fr 1fr 1fr; gap: 2rem; }
        .site-footer a:hover { color: var(--accent); }
        .whatsapp-float {
            position: fixed; right: 1.25rem; bottom: 1.25rem; z-index: 50;
            background: #25D366; color: #fff; width: 56px; height: 56px; border-radius: 50%;
            display: grid; place-items: center; box-shadow: 0 12px 28px rgba(0,0,0,.2);
            font-weight: 700; font-size: 1.35rem; animation: pulse 2.4s ease infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 12px 28px rgba(37,211,102,.35); }
            50% { box-shadow: 0 12px 36px rgba(37,211,102,.55); }
        }
        .chat-widget {
            position: fixed; right: 1.25rem; bottom: 5.5rem; z-index: 50; width: min(360px, calc(100vw - 2rem));
        }
        .chat-toggle {
            margin-left: auto; display: block; background: var(--primary); color: #fff;
            border: none; border-radius: 999px; padding: .7rem 1.1rem; font-weight: 600; cursor: pointer;
            font-family: var(--font-body);
        }
        .chat-panel {
            display: none; margin-bottom: .75rem; background: #fff; border-radius: 1rem;
            box-shadow: 0 18px 40px rgba(16,42,51,.18); overflow: hidden; border: 1px solid rgba(13,79,108,.12);
        }
        .chat-panel.open { display: block; animation: fadeUp .35s ease; }
        .chat-head { background: var(--primary); color: #fff; padding: .9rem 1rem; font-weight: 600; }
        .chat-body { height: 260px; overflow-y: auto; padding: 1rem; background: var(--mist); }
        .chat-msg { margin-bottom: .75rem; padding: .7rem .85rem; border-radius: .75rem; font-size: .9rem; }
        .chat-msg.bot { background: #fff; }
        .chat-msg.user { background: #d5e8f0; margin-left: 1.5rem; }
        .chat-form { display: flex; gap: .4rem; padding: .75rem; border-top: 1px solid rgba(0,0,0,.06); }
        .chat-form input {
            flex: 1; border: 1px solid rgba(0,0,0,.12); border-radius: .55rem; padding: .65rem .75rem;
            font-family: var(--font-body);
        }
        .form-card {
            background: #fff; border-radius: 1rem; padding: 1.5rem;
            box-shadow: 0 14px 36px rgba(16,42,51,.08); border: 1px solid rgba(13,79,108,.08);
        }
        .form-card label { display: block; font-size: .85rem; font-weight: 600; margin-bottom: .35rem; }
        .form-card input, .form-card textarea, .form-card select {
            width: 100%; margin-bottom: 1rem; padding: .75rem .85rem; border-radius: .55rem;
            border: 1px solid rgba(16,42,51,.15); font-family: var(--font-body);
        }
        .alert-success {
            background: #e3f2f7; color: #093A50; padding: .85rem 1rem; border-radius: .55rem; margin-bottom: 1rem;
        }
        .page-hero {
            padding: 4rem 0 2rem;
            background: radial-gradient(circle at top right, rgba(232,168,56,.18), transparent 45%),
                        linear-gradient(180deg, #E7F1F5, #F4F8FA);
        }
        .article-body { max-width: 72ch; }
        .article-body h3 { font-family: var(--font-display); font-size: 1.6rem; }
        .kb-group { margin-bottom: 2rem; }
        .kb-list { list-style: none; padding: 0; margin: 0; }
        .kb-list li { border-bottom: 1px solid rgba(13,79,108,.1); }
        .kb-list a { display: block; padding: .9rem 0; font-weight: 500; }
        .kb-list a:hover { color: var(--primary); }
        @media (max-width: 900px) {
            .grid-3, .grid-2, .footer-grid, .stats { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .hero { min-height: 78vh; }
        }
    </style>
    @stack('head')
</head>
<body>
    <header class="site-header">
        <div class="container nav">
            <a class="brand" href="{{ route('home') }}">Ashwick <span>Outdoor</span></a>
            <nav class="nav-links">
                <a href="{{ route('services.index') }}">Services</a>
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('blog.index') }}">Journal</a>
                <a href="{{ route('kb.index') }}">Knowledge</a>
                <a href="{{ route('contact') }}">Contact</a>
                <a class="btn btn-primary" href="{{ route('contact') }}">Free shade consult</a>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div>
                <div class="brand" style="color:#fff">Ashwick <span>Outdoor</span></div>
                <p style="margin:.75rem 0 0; max-width:36ch">Custom pergolas and gazebos for Charlotte homeowners who want engineered shade and outdoor rooms that last.</p>
            </div>
            <div>
                <strong>Visit</strong>
                <p>{{ config('brand.address') }}<br>{{ config('brand.hours') }}</p>
            </div>
            <div>
                <strong>Connect</strong>
                <p>
                    <a href="tel:{{ preg_replace('/\D+/', '', config('brand.phone')) }}">{{ config('brand.phone') }}</a><br>
                    <a href="mailto:{{ config('brand.email') }}">{{ config('brand.email') }}</a><br>
                    <a href="/admin">Staff login</a>
                </p>
            </div>
        </div>
    </footer>

    <a class="whatsapp-float" href="https://wa.me/{{ config('brand.whatsapp') }}" target="_blank" rel="noopener" aria-label="WhatsApp">WA</a>

    <div class="chat-widget" id="chat-widget">
        <div class="chat-panel" id="chat-panel">
            <div class="chat-head">Ashwick AI Concierge</div>
            <div class="chat-body" id="chat-body">
                <div class="chat-msg bot">Ask about pergola vs gazebo, timelines, materials, permits, or pricing ranges for Charlotte builds.</div>
            </div>
            <form class="chat-form" id="chat-form">
                <input type="text" id="chat-input" placeholder="Ask a question…" required maxlength="2000">
                <button class="btn btn-primary" type="submit">Send</button>
            </form>
        </div>
        <button class="chat-toggle" type="button" id="chat-toggle">Chat with AI</button>
    </div>

    <script>
        (() => {
            const toggle = document.getElementById('chat-toggle');
            const panel = document.getElementById('chat-panel');
            const form = document.getElementById('chat-form');
            const input = document.getElementById('chat-input');
            const body = document.getElementById('chat-body');
            const sessionId = 'aos-' + Math.random().toString(36).slice(2);
            toggle?.addEventListener('click', () => panel.classList.toggle('open'));
            const addMsg = (text, who) => {
                const el = document.createElement('div');
                el.className = 'chat-msg ' + who;
                el.textContent = text;
                body.appendChild(el);
                body.scrollTop = body.scrollHeight;
            };
            form?.addEventListener('submit', async (e) => {
                e.preventDefault();
                const message = input.value.trim();
                if (!message) return;
                addMsg(message, 'user');
                input.value = '';
                try {
                    const res = await fetch('{{ route('chat') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({ message, session_id: sessionId }),
                    });
                    const data = await res.json();
                    addMsg(data.answer || 'Sorry, try again shortly.', 'bot');
                } catch (err) {
                    addMsg('Connection issue. Call us at {{ config('brand.phone') }}.', 'bot');
                }
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
