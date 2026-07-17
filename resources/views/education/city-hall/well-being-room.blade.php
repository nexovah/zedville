@extends('layouts.profile')

@section('title', 'Wellbeing Room - Educational Finance Department')

@section('content')
@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;1,400&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
  <style>
    :root {
      --gold: #B8860B; --gold-light: rgba(184,134,11,0.10); --gold-border: rgba(184,134,11,0.30);
      --teal: #0F6E56; --teal-light: rgba(15,110,86,0.10); --teal-border: rgba(15,110,86,0.25);
      --green: #3B6D11; --green-light: rgba(59,109,17,0.10); --green-border: rgba(59,109,17,0.25);
      --blue: #185FA5; --blue-light: rgba(24,95,165,0.10); --blue-border: rgba(24,95,165,0.25);
      --purple: #534AB7; --purple-light: rgba(83,74,183,0.10);
      --glass: rgba(255,255,255,0.92); --shadow: 0 4px 24px rgba(0,0,0,0.09);
      --radius: 16px; --radius-sm: 10px;
    }
   

    .wb-layout {
      max-width: 1060px; margin: 0 auto;
      padding: 2rem 1.5rem 4rem;
      display: flex; flex-direction: column; gap: 1.25rem;
    }

    /* ── BREADCRUMB ── */
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #5a7a6a; }
    .breadcrumb a { color: #5a7a6a; text-decoration: none; display: flex; align-items: center; gap: 4px; }
    .breadcrumb a:hover { color: var(--teal); }

    /* ── HEADER ── */
    .wb-header {
      background: var(--glass); border: 0.5px solid var(--teal-border);
      border-radius: var(--radius); padding: 1.25rem 1.5rem; box-shadow: var(--shadow);
      display: flex; align-items: center; justify-content: space-between;
      animation: fadeUp 0.4s ease both;
    }
    .wb-header-left { display: flex; align-items: center; gap: 14px; }
    .wb-icon {
      width: 48px; height: 48px; border-radius: 12px;
      background: var(--teal-light); border: 0.5px solid var(--teal-border);
      display: flex; align-items: center; justify-content: center; font-size: 22px; color: var(--teal);
    }
    .wb-title { font-family: 'Lora', serif; font-size: 20px; font-weight: 600; color: #1a2e28; }
    .wb-subtitle { font-size: 12px; color: #6a8a7a; margin-top: 2px; }
    .wb-back {
      font-size: 12px; font-weight: 500; color: var(--teal);
      background: var(--teal-light); border: 0.5px solid var(--teal-border);
      border-radius: 8px; padding: 6px 14px; text-decoration: none;
      display: flex; align-items: center; gap: 5px; transition: background 0.15s;
    }
    .wb-back:hover { background: rgba(15,110,86,0.18); }

    /* ── FILTER BAR ── */
    .filter-bar {
      display: flex; gap: 8px; flex-wrap: wrap;
      animation: fadeUp 0.4s 0.07s ease both;
    }
    .filter-btn {
      padding: 7px 16px; border-radius: 20px;
      font-family: 'DM Sans', sans-serif; font-size: 12px; font-weight: 500;
      border: 0.5px solid var(--teal-border); background: var(--glass);
      color: #5a7a6a; cursor: pointer; transition: all 0.15s;
    }
    .filter-btn:hover { background: var(--teal-light); color: var(--teal); }
    .filter-btn.active {
      background: var(--teal-light); color: var(--teal);
      border-color: var(--teal-border);
    }

    /* ── SECTION LABEL ── */
    .sec-label {
      font-size: 11px; font-weight: 500; text-transform: uppercase;
      letter-spacing: 0.08em; color: #7a9a8a;
    }

    /* ── FEATURED ARTICLE (large card at top) ── */
    .featured-card {
      background: var(--glass); border: 0.5px solid var(--teal-border);
      border-radius: var(--radius); padding: 1.5rem;
      box-shadow: var(--shadow); display: flex; gap: 1.5rem; align-items: flex-start;
      cursor: pointer; transition: border-color 0.2s, transform 0.18s;
      text-decoration: none;
      animation: fadeUp 0.4s 0.12s ease both;
    }
    .featured-card:hover { border-color: var(--teal); transform: translateY(-2px); }
    .featured-icon {
      width: 56px; height: 56px; border-radius: 14px; flex-shrink: 0;
      background: var(--teal-light); border: 0.5px solid var(--teal-border);
      display: flex; align-items: center; justify-content: center; font-size: 26px; color: var(--teal);
    }
    .featured-body { flex: 1; }
    .featured-tag {
      display: inline-block; font-size: 10px; font-weight: 500;
      padding: 2px 8px; border-radius: 8px; margin-bottom: 8px;
    }
    .tag-financial { background: var(--gold-light); color: var(--gold); }
    .tag-stress    { background: rgba(163,45,45,0.10); color: #A32D2D; }
    .tag-lifestyle { background: var(--purple-light); color: var(--purple); }
    .tag-general   { background: var(--teal-light); color: var(--teal); }
    .tag-video     { background: var(--blue-light); color: var(--blue); }

    .new-badge {
      display: inline-block; font-size: 10px; font-weight: 500;
      padding: 2px 7px; border-radius: 8px; margin-left: 6px;
      background: rgba(15,110,86,0.12); color: var(--teal);
      vertical-align: middle;
    }
    .featured-title {
      font-family: 'Lora', serif; font-size: 17px; font-weight: 600;
      color: #1a2e28; line-height: 1.5; margin-bottom: 6px;
    }
    .featured-desc { font-size: 13px; color: #4a6a5a; line-height: 1.6; margin-bottom: 10px; }
    .featured-meta { font-size: 11px; color: #8aaa9a; display: flex; align-items: center; gap: 12px; }
    .read-more {
      font-size: 12px; font-weight: 500; color: var(--teal);
      display: flex; align-items: center; gap: 4px; margin-top: 10px;
    }

    /* ── CONTENT GRID ── */
    .content-grid {
      display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;
      animation: fadeUp 0.4s 0.18s ease both;
    }

    /* ── ARTICLE CARD ── */
    .article-card {
      background: var(--glass); border: 0.5px solid var(--teal-border);
      border-radius: var(--radius); padding: 1rem 1.1rem;
      box-shadow: var(--shadow); cursor: pointer;
      transition: border-color 0.2s, transform 0.18s;
      text-decoration: none; display: flex; flex-direction: column; gap: 8px;
    }
    .article-card:hover { border-color: var(--teal); transform: translateY(-2px); }
    .article-icon {
      width: 36px; height: 36px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center; font-size: 18px;
    }
    .ai-teal   { background: var(--teal-light); color: var(--teal); }
    .ai-green  { background: var(--green-light); color: var(--green); }
    .ai-gold   { background: var(--gold-light); color: var(--gold); }
    .ai-stress { background: rgba(163,45,45,0.10); color: #A32D2D; }
    .ai-purple { background: var(--purple-light); color: var(--purple); }

    .article-title {
      font-family: 'Lora', serif; font-size: 13px; font-weight: 600;
      color: #1a2e28; line-height: 1.5;
    }
    .article-desc { font-size: 12px; color: #4a6a5a; line-height: 1.5; }
    .article-meta { font-size: 11px; color: #8aaa9a; display: flex; align-items: center; gap: 8px; margin-top: auto; }

    /* ── VIDEO CARD ── */
    .video-card {
      background: var(--glass); border: 0.5px solid var(--blue-border);
      border-radius: var(--radius); padding: 1rem 1.1rem;
      box-shadow: var(--shadow); cursor: pointer;
      transition: border-color 0.2s, transform 0.18s;
      text-decoration: none; display: flex; flex-direction: column; gap: 8px;
    }
    .video-card:hover { border-color: var(--blue); transform: translateY(-2px); }
    .video-thumb {
      width: 100%; height: 80px; border-radius: 8px;
      background: var(--blue-light); border: 0.5px solid var(--blue-border);
      display: flex; align-items: center; justify-content: center;
      position: relative; overflow: hidden;
    }
    .video-play {
      width: 32px; height: 32px; border-radius: 50%;
      background: var(--blue); display: flex; align-items: center; justify-content: center;
      color: white; font-size: 14px;
    }
    .video-title {
      font-family: 'Lora', serif; font-size: 13px; font-weight: 600;
      color: #1a2e28; line-height: 1.5;
    }
    .video-meta { font-size: 11px; color: #8aaa9a; display: flex; align-items: center; gap: 8px; margin-top: auto; }
    .video-duration {
      display: inline-flex; align-items: center; gap: 3px;
      font-size: 10px; font-weight: 500;
      background: var(--blue-light); color: var(--blue);
      padding: 2px 7px; border-radius: 8px;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
      text-align: center; padding: 3rem 1rem;
      color: #8aaa9a; font-size: 13px; grid-column: 1 / -1;
    }
    .empty-state i { font-size: 36px; display: block; margin-bottom: 10px; opacity: 0.35; }

    /* ── READ ARTICLE MODAL ── */
    .modal-overlay {
      display: none; position: fixed; inset: 0;
      background: rgba(0,0,0,0.45); z-index: 100;
      align-items: flex-start; justify-content: center;
      padding: 2rem 1rem; overflow-y: auto;
    }
    .modal-overlay.open { display: flex; }
    .modal {
      background: white; border-radius: var(--radius);
      padding: 2rem; max-width: 680px; width: 100%;
      box-shadow: 0 8px 40px rgba(0,0,0,0.18);
      position: relative; margin: auto;
      animation: fadeUp 0.3s ease both;
    }
    .modal-close {
      position: absolute; top: 1rem; right: 1rem;
      width: 32px; height: 32px; border-radius: 50%;
      background: rgba(0,0,0,0.06); border: none; cursor: pointer;
      display: flex; align-items: center; justify-content: center;
      font-size: 16px; color: #5a7a6a; transition: background 0.15s;
    }
    .modal-close:hover { background: rgba(0,0,0,0.12); }
    .modal-tag { margin-bottom: 10px; }
    .modal-title {
      font-family: 'Lora', serif; font-size: 22px; font-weight: 600;
      color: #1a2e28; line-height: 1.4; margin-bottom: 8px;
    }
    .modal-meta { font-size: 12px; color: #8aaa9a; margin-bottom: 1.25rem; display: flex; gap: 12px; }
    .modal-body {
      font-size: 14px; color: #3a5a4a; line-height: 1.8;
      border-top: 0.5px solid var(--teal-border); padding-top: 1.25rem;
    }
    .modal-body p { margin-bottom: 1rem; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }

    @media (max-width: 700px) {
      .content-grid { grid-template-columns: 1fr; }
      .featured-card { flex-direction: column; }
      .wb-header { flex-direction: column; align-items: flex-start; gap: 10px; }
    }
    @media (max-width: 900px) {
      .content-grid { grid-template-columns: 1fr 1fr; }
    }
  </style>  
@endpush
<div class="wb-layout">

  <!-- BREADCRUMB -->
  <div class="breadcrumb">
    <a href="{{ route('education.main-hall') }}"><i class="ti ti-building-community" aria-hidden="true"></i> City Hall</a>
    <span style="color:#a0c0b0;">›</span>
    <span>Wellbeing Room</span>
  </div>

  <!-- HEADER -->
  <div class="wb-header">
    <div class="wb-header-left">
      <div class="wb-icon"><i class="ti ti-heart" aria-hidden="true"></i></div>
      <div>
        <div class="wb-title">Wellbeing Room</div>
        <div class="wb-subtitle">Articles and videos to balance your life</div>
      </div>
    </div>
    <a href="{{ route('education.city-hall') }}" class="wb-back">
      <i class="ti ti-arrow-left" aria-hidden="true"></i> Back to City Hall
    </a>
  </div>

  <!-- FILTER BAR -->
  <!-- IT TEAM: filter buttons show/hide cards by category using data-category attribute -->
  <div class="filter-bar">
    <button class="filter-btn active" onclick="filterContent('all')">All</button>
    <button class="filter-btn" onclick="filterContent('financial')">
      <i class="ti ti-coins" style="font-size:12px;vertical-align:-1px;" aria-hidden="true"></i> Financial
    </button>
    <button class="filter-btn" onclick="filterContent('stress')">
      <i class="ti ti-brain" style="font-size:12px;vertical-align:-1px;" aria-hidden="true"></i> Stress
    </button>
    <button class="filter-btn" onclick="filterContent('lifestyle')">
      <i class="ti ti-sun" style="font-size:12px;vertical-align:-1px;" aria-hidden="true"></i> Lifestyle
    </button>
    <button class="filter-btn" onclick="filterContent('video')">
      <i class="ti ti-player-play" style="font-size:12px;vertical-align:-1px;" aria-hidden="true"></i> Videos
    </button>
  </div>

  <!-- FEATURED ARTICLE -->
  <!-- IT TEAM: show the most recent published article as featured -->
  <!-- IT TEAM: mark as seen — POST /city-hall/wellbeing/{id}/seen when student opens it -->
@if($featured)

<div id="featured-section">

    <div class="sec-label" style="margin-bottom:9px;">
        Featured
    </div>

    <div class="featured-card"
         data-category="{{ $featured->category }}"
         onclick="openArticle('{{ $featured->id }}')">

        <div class="featured-icon">
            <i class="ti ti-heart"></i>
        </div>

        <div class="featured-body">

            <span class="featured-tag tag-{{ $featured->category }}">
                {{ ucfirst($featured->category) }}
            </span>

            @if($featured->featured)
                <span class="new-badge">
                    Featured
                </span>
            @endif

            <div class="featured-title">
                {{ $featured->title }}
            </div>

            <div class="featured-desc">
                {{ $featured->short_description }}
            </div>

            <div class="featured-meta">

                <span>
                    <i class="ti ti-clock"></i>
                    {{ $featured->read_time }}
                </span>

                <span>
                    {{ $featured->published_at?->format('d M Y') }}
                </span>

            </div>

            <div class="read-more">

                Read article

                <i class="ti ti-arrow-right"></i>

            </div>

        </div>

    </div>

</div>

@endif

  <!-- CONTENT GRID -->
  <div class="sec-label">All content</div>
  <div class="content-grid" id="contentGrid">

    <!-- IT TEAM: repeat article-card block for each published article from wellbeing_posts WHERE type='article' -->

    <!-- ARTICLE 1 -->
    @foreach($articles as $article)

<div class="article-card"
     data-category="{{ $article->category }}"
     onclick="openArticle('{{ $article->id }}')">

    <div class="article-icon ai-{{ $article->category }}">
        <i class="ti ti-heart"></i>
    </div>

    <span class="featured-tag tag-{{ $article->category }}">
        {{ ucfirst($article->category) }}
    </span>

    <div class="article-title">
        {{ $article->title }}
    </div>

    <div class="article-desc">
        {{ $article->short_description }}
    </div>

    <div class="article-meta">

        <span>

            <i class="ti ti-clock"></i>

            {{ $article->read_time }}

        </span>

    </div>

</div>

@endforeach

   

    

    

    

    <!-- IT TEAM: repeat video-card block for each published video from wellbeing_posts WHERE type='video' -->

    <!-- VIDEO 1 -->
    @foreach($videos as $video)

<div class="video-card"
     data-category="video {{ $video->category }}"
     onclick="window.open('{{ $video->youtube_url }}','_blank')">

    <div class="video-thumb">

        <div class="video-play">

            <i class="ti ti-player-play"></i>

        </div>

    </div>

    <span class="featured-tag tag-video">

        Video

    </span>

    <span class="featured-tag tag-{{ $video->category }}" style="margin-left:4px;">

        {{ ucfirst($video->category) }}

    </span>

    <div class="video-title">

        {{ $video->title }}

    </div>

    <div class="video-meta">

        <span>

            <i class="ti ti-clock"></i>

            {{ $video->read_time }}

        </span>

    </div>

</div>

@endforeach

  </div><!-- /contentGrid -->

</div><!-- /wb-layout -->
@foreach($articles as $article)

<div id="article-data-{{ $article->id }}" style="display:none;">

    <div class="title">{{ $article->title }}</div>

    <div class="category">{{ ucfirst($article->category) }}</div>

    <div class="read">{{ $article->read_time }}</div>

    <div class="date">{{ $article->published_at?->format('d M Y') }}</div>

    <div class="body">

        {!! nl2br(e($article->content)) !!}

    </div>

</div>

@endforeach
<!-- ── READ ARTICLE MODAL ── -->
<!-- IT TEAM: populate modal content dynamically from DB when article is clicked -->
<div class="modal-overlay" id="articleModal">
  <div class="modal">
    <button class="modal-close" onclick="closeModal()" aria-label="Close">
      <i class="ti ti-x" aria-hidden="true"></i>
    </button>
    <div class="modal-tag">
      <span class="featured-tag tag-financial" id="modalTag">Financial</span>
    </div>
    <div class="modal-title" id="modalTitle">Three simple habits to reduce financial stress before exams</div>
    <div class="modal-meta">
      <span id="modalReadTime"><i class="ti ti-clock" style="font-size:12px;vertical-align:-1px;" aria-hidden="true"></i> 4 min read</span>
      <span id="modalDate">Published 2 days ago</span>
    </div>
    <div class="modal-body" id="modalBody">
      <!-- IT TEAM: replace with article content_text from DB -->
      <p>Feeling anxious about money is more common than you think — especially around exam season when pressure builds up from every direction. The good news is that you do not need to earn more or solve everything at once. Small daily habits can make a big difference in how you feel.</p>
      <p><strong>Habit 1 — Check your balance once a day.</strong> Just one glance, every morning. Not to judge yourself, just to know. Uncertainty is what causes anxiety, not the number itself. When you know where you stand, your brain stops worrying in the background.</p>
      <p><strong>Habit 2 — Separate needs from wants before spending.</strong> Before any purchase, ask yourself: is this a need or a want? You do not have to say no to wants — just be honest with yourself. Awareness is the first step.</p>
      <p><strong>Habit 3 — Set one small savings goal.</strong> It does not matter how much. Even saving 50 zeds a week gives you a sense of progress and control. Progress, not perfection, is what builds confidence.</p>
      <p>These three habits take less than five minutes a day. Start with just one this week and see how you feel.</p>
    </div>
  </div>
</div>

<script>
  // ── FILTER ──
  function filterContent(category) {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
    event.currentTarget.classList.add('active');

    const featured = document.getElementById('featured-section');
    const cards = document.querySelectorAll('#contentGrid [data-category]');

    if (category === 'all') {
      featured.style.display = 'block';
      cards.forEach(c => c.style.display = 'flex');
    } else if (category === 'video') {
      featured.style.display = 'none';
      cards.forEach(c => {
        c.style.display = c.dataset.category.includes('video') ? 'flex' : 'none';
      });
    } else {
      featured.style.display =
        document.querySelector('.featured-card').dataset.category === category ? 'block' : 'none';
      cards.forEach(c => {
        c.style.display = c.dataset.category.includes(category) ? 'flex' : 'none';
      });
    }
  }

  // ── OPEN ARTICLE MODAL ──
  // IT TEAM: replace static content with fetch to /city-hall/wellbeing/{id}
  // IT TEAM: also POST /city-hall/wellbeing/{id}/seen to mark as viewed
  const articleData = {
    'featured': {
      tag: 'Financial', tagClass: 'tag-financial',
      title: 'Three simple habits to reduce financial stress before exams',
      readTime: '4 min read', date: 'Published 2 days ago',
      body: document.getElementById('modalBody').innerHTML
    },
    '1': {
      tag: 'Stress', tagClass: 'tag-stress',
      title: 'How to recognise when stress is becoming too much',
      readTime: '3 min read', date: 'Published 1 week ago',
      body: '<p>There is a difference between useful pressure — the kind that motivates you to study or prepare — and harmful stress that drains your energy and affects your health. Learning to tell the difference is a life skill.</p><p>Signs that stress is becoming too much include: difficulty sleeping, loss of appetite, feeling irritable or withdrawn, trouble concentrating, and a general sense of dread. If you notice more than two of these regularly, it is worth talking to someone.</p><p>The first step is simply to name it. Say to yourself: "I am stressed right now." This simple act activates the rational part of your brain and reduces the emotional response. From there, small actions — a walk, a conversation, or even just a glass of water — can start to shift your state.</p>'
    },
    '2': {
      tag: 'Financial', tagClass: 'tag-financial',
      title: 'How budgeting helps you feel more in control of your week',
      readTime: '5 min read', date: 'Published 2 days ago',
      body: '<p>Most people think of a budget as a restriction — a list of things you cannot have. But the real purpose of a budget is the opposite. A budget is a plan that tells you exactly what you can have, guilt-free, once you have covered your essentials.</p><p>When you do not have a budget, every purchase comes with a small background worry: "Can I afford this? Am I spending too much?" That constant uncertainty is exhausting. A budget removes that uncertainty. You know your numbers. You feel in control.</p><p>Start with just three categories: Needs, Wants, and Savings. Use the 50/30/20 rule as a guide — 50% for needs, 30% for wants, 20% for savings. Adjust based on your reality. The exact percentages matter less than the habit of planning.</p>'
    },
    '3': {
      tag: 'Lifestyle', tagClass: 'tag-lifestyle',
      title: 'The connection between sleep and good financial decisions',
      readTime: '4 min read', date: 'Published 5 days ago',
      body: '<p>Research consistently shows that sleep-deprived people make worse financial decisions. They are more impulsive, less able to evaluate long-term consequences, and more susceptible to emotional spending.</p><p>One study found that people who slept less than 6 hours a night spent an average of 20% more on impulse purchases than those who slept 8 hours. The brain, when tired, defaults to short-term reward over long-term planning.</p><p>The practical implication is simple: if you are going to make an important financial decision — a big purchase, a savings commitment, a budget review — do it when you are rested. Never when you are tired, hungry, or stressed.</p>'
    },
    '4': {
      tag: 'Lifestyle', tagClass: 'tag-lifestyle',
      title: 'Five free things to do when you feel overwhelmed',
      readTime: '3 min read', date: 'Published 1 week ago',
      body: '<p>When everything feels like too much, the instinct is often to spend — on food, entertainment, or comfort shopping. But you do not need to spend money to feel better. Here are five things that actually work.</p><p><strong>1. Walk for 10 minutes.</strong> Outside if possible. Movement shifts your brain chemistry in minutes.</p><p><strong>2. Write three things that went well today.</strong> Even small ones. This retrains your brain to notice the positive.</p><p><strong>3. Call or message a friend.</strong> Not to vent — just to connect. Human contact is one of the fastest mood-shifters.</p><p><strong>4. Tidy one small space.</strong> A desk, a drawer, a corner. External order creates internal calm.</p><p><strong>5. Do nothing for five minutes.</strong> No phone, no music. Just sit. It feels uncomfortable at first, then restorative.</p>'
    },
    '5': {
      tag: 'Stress', tagClass: 'tag-stress',
      title: 'Why talking about money is not embarrassing',
      readTime: '4 min read', date: 'Published 2 weeks ago',
      body: '<p>In most cultures, money is a taboo topic. We are taught not to ask how much someone earns, not to talk about debt, not to admit we are struggling. This silence causes enormous harm — because it means people deal with financial stress alone, without support or information.</p><p>The truth is that almost everyone worries about money at some point. The students who seem most confident about finances are often the ones who had conversations about money at home — not because they are naturally better with money, but because they had more practice talking about it.</p><p>Start small. Talk to a trusted friend about one financial concern. Ask your tutor a question about something you do not understand. Read one article about personal finance. Every conversation makes the next one easier.</p>'
    },
  };

  function openArticle(id) {
    const data = articleData[id];
    if (!data) return;
    document.getElementById('modalTag').textContent    = data.tag;
    document.getElementById('modalTag').className      = 'featured-tag ' + data.tagClass;
    document.getElementById('modalTitle').textContent  = data.title;
    document.getElementById('modalReadTime').innerHTML = '<i class="ti ti-clock" style="font-size:12px;vertical-align:-1px;" aria-hidden="true"></i> ' + data.readTime;
    document.getElementById('modalDate').textContent   = data.date;
    document.getElementById('modalBody').innerHTML     = data.body;
    document.getElementById('articleModal').classList.add('open');
    document.body.style.overflow = 'hidden';

    // IT TEAM: mark as seen
    // fetch('/city-hall/wellbeing/' + id + '/seen', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } });
  }

  function closeModal() {
    document.getElementById('articleModal').classList.remove('open');
    document.body.style.overflow = '';
  }

  // Close modal on overlay click
  document.getElementById('articleModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
  });

  // Close modal on Escape key
  document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

  // ── OPEN VIDEO ──
  // IT TEAM: replace URL with actual video_url from DB
  function openVideo(url) {
    if (confirm('This will open an external video. Continue?')) {
      window.open(url, '_blank', 'noopener');
      // IT TEAM: also mark as seen
      // fetch('/city-hall/wellbeing/' + id + '/seen', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } });
    }
  }
</script>
@endsection