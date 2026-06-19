<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $portfolio->brand_name }} - Portfolio</title>

    <style>
        * {
            box-sizing: border-box;
        }

        :root {
            --ink: #12201b;
            --muted: #60716a;
            --green: #16a34a;
            --teal: #0f766e;
            --gold: #f59e0b;
            --soft: #f5fbf7;
            --line: #dce9e2;
            --white: #ffffff;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--soft);
            font-family: "Segoe UI", Arial, sans-serif;
        }

        a {
            color: inherit;
        }

        .nav {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            padding: 16px max(20px, calc((100vw - 1120px) / 2));
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid rgba(220, 233, 226, 0.9);
            backdrop-filter: blur(16px);
        }

        .brand {
            font-size: 20px;
            font-weight: 900;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 16px;
            color: var(--muted);
            font-size: 14px;
            font-weight: 700;
        }

        .nav-links a {
            text-decoration: none;
        }

        .hero {
            min-height: 82vh;
            display: grid;
            align-items: center;
            padding: 64px max(20px, calc((100vw - 1120px) / 2));
            background:
                linear-gradient(90deg, rgba(18, 32, 27, 0.88), rgba(18, 32, 27, 0.44), rgba(18, 32, 27, 0.16)),
                url("{{ $portfolio->hero_image ?: 'https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1400&q=80' }}");
            background-size: cover;
            background-position: center;
            color: var(--white);
        }

        .hero-content {
            max-width: 720px;
        }

        .eyebrow {
            display: inline-flex;
            padding: 9px 13px;
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            color: rgba(255, 255, 255, 0.86);
            font-size: 13px;
            font-weight: 800;
        }

        h1 {
            margin: 18px 0 16px;
            font-size: clamp(38px, 7vw, 78px);
            line-height: 0.98;
            letter-spacing: 0;
        }

        .hero p {
            max-width: 640px;
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
            font-size: 18px;
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            min-height: 48px;
            padding: 0 18px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 900;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--green), var(--teal));
            color: var(--white);
        }

        .btn-light {
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.24);
            color: var(--white);
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: -44px;
            padding: 0 max(20px, calc((100vw - 1120px) / 2));
        }

        .stat {
            padding: 24px;
            border-radius: 8px;
            background: var(--white);
            border: 1px solid var(--line);
            box-shadow: 0 18px 42px rgba(18, 32, 27, 0.1);
        }

        .stat strong {
            display: block;
            color: var(--green);
            font-size: 34px;
            line-height: 1;
        }

        .stat span {
            display: block;
            margin-top: 8px;
            color: var(--muted);
            font-weight: 800;
        }

        section {
            padding: 76px max(20px, calc((100vw - 1120px) / 2));
        }

        .section-head {
            max-width: 680px;
            margin-bottom: 30px;
        }

        h2 {
            margin: 0;
            font-size: clamp(28px, 4vw, 44px);
            line-height: 1.1;
            letter-spacing: 0;
        }

        .section-head p,
        .about-text {
            color: var(--muted);
            font-size: 16px;
            line-height: 1.75;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
        }

        .card {
            padding: 24px;
            border-radius: 8px;
            background: var(--white);
            border: 1px solid var(--line);
            box-shadow: 0 14px 34px rgba(18, 32, 27, 0.06);
        }

        .card h3 {
            margin: 0 0 10px;
            font-size: 20px;
        }

        .card p {
            margin: 0;
            color: var(--muted);
            line-height: 1.65;
        }

        .category {
            display: inline-flex;
            margin-bottom: 14px;
            padding: 7px 10px;
            color: #166534;
            border-radius: 999px;
            background: #dcfce7;
            font-size: 12px;
            font-weight: 900;
        }

        .about-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 34px;
            align-items: start;
        }

        .skills {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill {
            padding: 10px 12px;
            border-radius: 999px;
            background: var(--white);
            border: 1px solid var(--line);
            color: var(--teal);
            font-size: 14px;
            font-weight: 900;
        }

        .contact {
            background: #10201b;
            color: var(--white);
        }

        .contact .section-head p,
        .contact p {
            color: rgba(255, 255, 255, 0.75);
        }

        .contact-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .contact-item {
            padding: 18px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
        }

        .contact-item span {
            display: block;
            color: rgba(255, 255, 255, 0.58);
            font-size: 13px;
            font-weight: 800;
        }

        .contact-item strong,
        .contact-item a {
            display: block;
            margin-top: 8px;
            color: var(--white);
            text-decoration: none;
            overflow-wrap: anywhere;
        }

        footer {
            padding: 22px 20px;
            background: #0b1713;
            color: rgba(255, 255, 255, 0.66);
            text-align: center;
            font-size: 14px;
        }

        @media (max-width: 820px) {
            .nav {
                align-items: flex-start;
                flex-direction: column;
            }

            .hero {
                min-height: 72vh;
                padding-top: 52px;
                padding-bottom: 88px;
            }

            .stats,
            .grid,
            .about-wrap,
            .contact-list {
                grid-template-columns: 1fr;
            }

            .stats {
                margin-top: -34px;
            }
        }

        @media (max-width: 520px) {
            .nav-links {
                width: 100%;
                overflow-x: auto;
                padding-bottom: 4px;
            }

            .hero-actions {
                display: grid;
            }

            .btn {
                justify-content: center;
                width: 100%;
            }

            section {
                padding-top: 54px;
                padding-bottom: 54px;
            }
        }
    </style>
</head>

<body>
    <nav class="nav">
        <a class="brand" href="/portfolio">{{ $portfolio->brand_name }}</a>
        <div class="nav-links">
            <a href="#services">Services</a>
            <a href="#projects">Projects</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
        </div>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <span class="eyebrow">Digital Marketing Portfolio</span>
            <h1>{{ $portfolio->headline }}</h1>
            <p>{{ $portfolio->tagline }}</p>
            <div class="hero-actions">
                <a href="{{ $portfolio->cta_url ?: '#contact' }}" class="btn btn-primary">{{ $portfolio->cta_text ?: 'Start a Project' }}</a>
                <a href="#projects" class="btn btn-light">See Work</a>
            </div>
        </div>
    </header>

    @if(!empty($portfolio->stats))
        <div class="stats">
            @foreach($portfolio->stats as $stat)
                <div class="stat">
                    <strong>{{ $stat['value'] ?? '' }}</strong>
                    <span>{{ $stat['label'] ?? '' }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <section id="services">
        <div class="section-head">
            <h2>Services</h2>
            <p>Focused digital marketing support for brands that need practical execution and clear results.</p>
        </div>

        <div class="grid">
            @foreach($portfolio->services ?? [] as $service)
                <article class="card">
                    <h3>{{ $service['title'] ?? '' }}</h3>
                    <p>{{ $service['description'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section id="projects">
        <div class="section-head">
            <h2>Selected Work</h2>
            <p>Simple project snapshots that show strategy, campaign thinking, and business impact.</p>
        </div>

        <div class="grid">
            @foreach($portfolio->projects ?? [] as $project)
                <article class="card">
                    @if(!empty($project['category']))
                        <span class="category">{{ $project['category'] }}</span>
                    @endif
                    <h3>{{ $project['title'] ?? '' }}</h3>
                    <p>{{ $project['description'] ?? '' }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section id="about">
        <div class="about-wrap">
            <div>
                <h2>About</h2>
                <p class="about-text">{{ $portfolio->about }}</p>
            </div>
            <div>
                <h2>Skills</h2>
                <div class="skills" style="margin-top: 20px;">
                    @foreach($portfolio->skills ?? [] as $skill)
                        <span class="skill">{{ $skill }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if(!empty($portfolio->testimonials))
        <section>
            <div class="section-head">
                <h2>Client Words</h2>
            </div>

            <div class="grid">
                @foreach($portfolio->testimonials as $testimonial)
                    <article class="card">
                        <p>"{{ $testimonial['quote'] ?? '' }}"</p>
                        <h3 style="margin-top: 18px;">{{ $testimonial['name'] ?? '' }}</h3>
                        <p>{{ $testimonial['role'] ?? '' }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section id="contact" class="contact">
        <div class="section-head">
            <h2>Let us talk growth</h2>
            <p>Use the details below to connect for digital marketing, campaign planning, or portfolio work.</p>
        </div>

        <div class="contact-list">
            <div class="contact-item">
                <span>Email</span>
                <a href="mailto:{{ $portfolio->email }}">{{ $portfolio->email ?: 'Not added' }}</a>
            </div>
            <div class="contact-item">
                <span>Phone</span>
                <strong>{{ $portfolio->phone ?: 'Not added' }}</strong>
            </div>
            <div class="contact-item">
                <span>Location</span>
                <strong>{{ $portfolio->address ?: 'Not added' }}</strong>
            </div>
        </div>

        <div class="hero-actions">
            @if($portfolio->facebook_url)
                <a class="btn btn-light" href="{{ $portfolio->facebook_url }}" target="_blank">Facebook</a>
            @endif
            @if($portfolio->linkedin_url)
                <a class="btn btn-light" href="{{ $portfolio->linkedin_url }}" target="_blank">LinkedIn</a>
            @endif
            @if($portfolio->website_url)
                <a class="btn btn-light" href="{{ $portfolio->website_url }}" target="_blank">Website</a>
            @endif
        </div>
    </section>

    <footer>
        &copy; {{ date('Y') }} {{ $portfolio->brand_name }}. All rights reserved.
    </footer>
</body>

</html>
