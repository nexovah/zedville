

<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

.page {
  padding: 2.5rem 1rem 3rem;
  max-width: 680px;
  margin: 0 auto;
  font-family: var(--font-sans);
}

/* Header */
.page-header {
  text-align: center;
  margin-bottom: 2rem;
  position: relative;
}

.page-header::before,
.page-header::after {
  content: '';
  position: absolute;
  top: 50%;
  width: 60px;
  height: 0.5px;
  background: var(--color-border-tertiary);
}

.page-header::before { left: 50%; transform: translateX(-130px); }
.page-header::after  { right: 50%; transform: translateX(130px); }

.page-title {
  font-size: 11px;
  font-weight: 500;
  color: var(--color-text-tertiary);
  letter-spacing: 0.18em;
  text-transform: uppercase;
  display: inline-block;
}

/* Hero row */
.hero-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 14px;
  margin-bottom: 2rem;
}

.hero-card {
  background: var(--color-background-primary);
  border: 0.5px solid var(--color-border-tertiary);
  border-radius: var(--border-radius-lg);
  padding: 1.5rem 1.25rem 1.25rem;
  text-align: center;
  position: relative;
  overflow: hidden;
}

/* Subtle decorative corner element */
.hero-card::before {
  content: '';
  position: absolute;
  top: 12px;
  left: 12px;
  width: 14px;
  height: 14px;
  border-top: 0.5px solid var(--color-border-secondary);
  border-left: 0.5px solid var(--color-border-secondary);
}
.hero-card::after {
  content: '';
  position: absolute;
  top: 12px;
  right: 12px;
  width: 14px;
  height: 14px;
  border-top: 0.5px solid var(--color-border-secondary);
  border-right: 0.5px solid var(--color-border-secondary);
}

.hero-label {
  font-size: 10px;
  font-weight: 500;
  color: var(--color-text-tertiary);
  letter-spacing: 0.16em;
  text-transform: uppercase;
  margin-bottom: 1.5rem;
}

.medal-stage {
  position: relative;
  width: 140px;
  height: 140px;
  margin: 0 auto 1rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Soft radial backdrop behind medal */
.medal-stage::before {
  content: '';
  position: absolute;
  inset: 0;
  border-radius: 50%;
  background: var(--color-background-secondary);
  opacity: 0.6;
}

.medal {
  position: relative;
  width: 120px;
  height: 130px;
}

.medal svg { width: 100%; height: 100%; display: block; }

.badge-name {
  font-size: 18px;
  font-weight: 500;
  color: var(--color-text-primary);
  margin-bottom: 0.35rem;
  letter-spacing: -0.01em;
}

.badge-month {
  font-size: 10px;
  color: var(--color-text-tertiary);
  margin-bottom: 1rem;
  letter-spacing: 0.14em;
  text-transform: uppercase;
}

.divider-dot {
  width: 4px;
  height: 4px;
  border-radius: 50%;
  background: var(--color-border-secondary);
  margin: 0 auto 0.85rem;
}

.praise {
  font-size: 13px;
  color: var(--color-text-secondary);
  line-height: 1.6;
  font-style: italic;
  padding: 0 0.5rem;
  min-height: 65px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-family: var(--font-serif);
}

.year-bar {
  display: flex;
  align-items: center;
  background: var(--color-background-secondary);
  border-radius: var(--border-radius-md);
  padding: 9px 12px;
  margin-top: 1.25rem;
  gap: 10px;
}

.year-mini { width: 28px; height: 30px; flex-shrink: 0; }
.year-mini svg { width: 100%; height: 100%; }

.year-text { font-size: 11px; text-align: left; flex: 1; min-width: 0; }

.year-name {
  font-weight: 500;
  color: var(--color-text-primary);
  display: block;
  line-height: 1.3;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.year-sub {
  color: var(--color-text-tertiary);
  font-size: 9px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
}

/* History */
.history-header {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  margin: 1.5rem 0 1rem;
}

.history-title {
  font-size: 11px;
  font-weight: 500;
  color: var(--color-text-tertiary);
  letter-spacing: 0.16em;
  text-transform: uppercase;
}

.history-year {
  font-size: 11px;
  color: var(--color-text-tertiary);
  font-family: var(--font-serif);
  font-style: italic;
}

.history-grid {
  background: var(--color-background-primary);
  border: 0.5px solid var(--color-border-tertiary);
  border-radius: var(--border-radius-lg);
  overflow: hidden;
}

.month-row-header {
  display: grid;
  grid-template-columns: 88px 1fr;
  background: var(--color-background-secondary);
  border-bottom: 0.5px solid var(--color-border-tertiary);
}

.row-header-label {
  padding: 10px 0 10px 16px;
  font-size: 10px;
  color: var(--color-text-tertiary);
  letter-spacing: 0.1em;
  text-transform: uppercase;
}

.month-headers {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
}

.month-header-cell {
  padding: 10px 4px;
  font-size: 10px;
  color: var(--color-text-tertiary);
  text-align: center;
  border-left: 0.5px solid var(--color-border-tertiary);
  letter-spacing: 0.06em;
  text-transform: uppercase;
}

.month-header-cell:first-child { border-left: none; }
.month-header-cell.current-h { color: var(--color-text-primary); font-weight: 500; }
.month-header-cell.future-h { opacity: 0.35; }

.row-wrap {
  display: grid;
  grid-template-columns: 88px 1fr;
  border-bottom: 0.5px solid var(--color-border-tertiary);
}

.row-wrap:last-of-type { border-bottom: none; }

.row-label {
  display: flex;
  align-items: center;
  padding: 16px 0 16px 16px;
  font-size: 12px;
  font-weight: 500;
  color: var(--color-text-primary);
  letter-spacing: 0.01em;
}

.month-row {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
}

.month-cell {
  padding: 12px 4px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 3px;
  border-left: 0.5px solid var(--color-border-tertiary);
  min-height: 64px;
}

.month-cell:first-child { border-left: none; }

.month-cell.future { background: var(--color-background-secondary); }

.month-cell.current {
  background: var(--color-background-secondary);
  position: relative;
}

.month-cell.current::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: var(--color-text-primary);
}

.month-medal {
  width: 32px;
  height: 34px;
}

.month-medal svg { width: 100%; height: 100%; }

.month-badge-label {
  font-size: 9px;
  color: var(--color-text-tertiary);
  font-weight: 500;
  text-align: center;
  line-height: 1.2;
  margin-top: 1px;
}

.empty-medal {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--color-border-tertiary);
}

/* Hover micro-interaction */
.month-cell:not(.future) { transition: background 0.15s ease; }
.month-cell:not(.future):hover { background: var(--color-background-secondary); }
</style>

<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <defs>
    <!-- Gradients for depth -->
    <radialGradient id="g-platinum" cx="35%" cy="30%" r="75%">
      <stop offset="0%" stop-color="#FAFAFB"/>
      <stop offset="50%" stop-color="#E2E2E6"/>
      <stop offset="100%" stop-color="#A8A8B0"/>
    </radialGradient>
    <radialGradient id="g-gold" cx="35%" cy="30%" r="75%">
      <stop offset="0%" stop-color="#FFE89C"/>
      <stop offset="50%" stop-color="#F5C742"/>
      <stop offset="100%" stop-color="#A88838"/>
    </radialGradient>
    <radialGradient id="g-silver" cx="35%" cy="30%" r="75%">
      <stop offset="0%" stop-color="#EEEEEE"/>
      <stop offset="50%" stop-color="#C8C8C8"/>
      <stop offset="100%" stop-color="#888888"/>
    </radialGradient>
    <radialGradient id="g-bronze" cx="35%" cy="30%" r="75%">
      <stop offset="0%" stop-color="#E8B894"/>
      <stop offset="50%" stop-color="#C7805A"/>
      <stop offset="100%" stop-color="#7A4A28"/>
    </radialGradient>

    <linearGradient id="g-legend-shield" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#FFE076"/>
      <stop offset="60%" stop-color="#F5C742"/>
      <stop offset="100%" stop-color="#B8861F"/>
    </linearGradient>
    <linearGradient id="g-champion-shield" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#85B7EB"/>
      <stop offset="60%" stop-color="#5BA3F5"/>
      <stop offset="100%" stop-color="#1F5F9F"/>
    </linearGradient>
    <linearGradient id="g-finhero-shield" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#9FE1CB"/>
      <stop offset="60%" stop-color="#5DCAA5"/>
      <stop offset="100%" stop-color="#0F6E56"/>
    </linearGradient>
    <linearGradient id="g-rookie-shield" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#E8E6DC"/>
      <stop offset="60%" stop-color="#C8C5BA"/>
      <stop offset="100%" stop-color="#7A7975"/>
    </linearGradient>

    <!-- Ribbon gradients -->
    <linearGradient id="ribbon-eng" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#5C7A9A"/>
      <stop offset="100%" stop-color="#2A4060"/>
    </linearGradient>

    <!-- ================================================== -->
    <!-- ENGAGEMENT MEDALS — circular with ribbon -->
    <!-- ================================================== -->
    <symbol id="m-platinum" viewBox="0 0 120 130">
      <!-- Ribbons -->
      <path d="M 42 6 L 36 30 L 60 38 L 84 30 L 78 6 Z" fill="url(#ribbon-eng)" opacity="0.9"/>
      <path d="M 36 30 L 44 38 L 60 32 Z" fill="#1A2A40"/>
      <path d="M 84 30 L 76 38 L 60 32 Z" fill="#1A2A40"/>
      <!-- Outer ring (rope effect) -->
      <circle cx="60" cy="72" r="40" fill="#9A9AA0"/>
      <circle cx="60" cy="72" r="38" fill="url(#g-platinum)"/>
      <!-- Decorative inner border -->
      <circle cx="60" cy="72" r="33" fill="none" stroke="#FFFFFF" stroke-width="0.6" opacity="0.6"/>
      <circle cx="60" cy="72" r="30" fill="none" stroke="#7A7A82" stroke-width="0.4" opacity="0.5"/>
      <!-- Laurel wreath -->
      <g opacity="0.4" fill="#5A5A60">
        <ellipse cx="32" cy="72" rx="3" ry="6" transform="rotate(-30 32 72)"/>
        <ellipse cx="34" cy="86" rx="3" ry="6" transform="rotate(-50 34 86)"/>
        <ellipse cx="88" cy="72" rx="3" ry="6" transform="rotate(30 88 72)"/>
        <ellipse cx="86" cy="86" rx="3" ry="6" transform="rotate(50 86 86)"/>
      </g>
      <!-- Letter -->
      <text x="60" y="82" text-anchor="middle" font-size="28" font-weight="500" fill="#3A3A42" font-family="serif" font-style="italic">P</text>
    </symbol>

    <symbol id="m-gold" viewBox="0 0 120 130">
      <path d="M 42 6 L 36 30 L 60 38 L 84 30 L 78 6 Z" fill="url(#ribbon-eng)" opacity="0.9"/>
      <path d="M 36 30 L 44 38 L 60 32 Z" fill="#1A2A40"/>
      <path d="M 84 30 L 76 38 L 60 32 Z" fill="#1A2A40"/>
      <circle cx="60" cy="72" r="40" fill="#A88838"/>
      <circle cx="60" cy="72" r="38" fill="url(#g-gold)"/>
      <circle cx="60" cy="72" r="33" fill="none" stroke="#FFE89C" stroke-width="0.6" opacity="0.7"/>
      <circle cx="60" cy="72" r="30" fill="none" stroke="#8B681F" stroke-width="0.4" opacity="0.5"/>
      <g opacity="0.45" fill="#7A5C00">
        <ellipse cx="32" cy="72" rx="3" ry="6" transform="rotate(-30 32 72)"/>
        <ellipse cx="34" cy="86" rx="3" ry="6" transform="rotate(-50 34 86)"/>
        <ellipse cx="88" cy="72" rx="3" ry="6" transform="rotate(30 88 72)"/>
        <ellipse cx="86" cy="86" rx="3" ry="6" transform="rotate(50 86 86)"/>
      </g>
      <text x="60" y="82" text-anchor="middle" font-size="28" font-weight="500" fill="#5C4500" font-family="serif" font-style="italic">G</text>
    </symbol>

    <symbol id="m-silver" viewBox="0 0 120 130">
      <path d="M 42 6 L 36 30 L 60 38 L 84 30 L 78 6 Z" fill="url(#ribbon-eng)" opacity="0.9"/>
      <path d="M 36 30 L 44 38 L 60 32 Z" fill="#1A2A40"/>
      <path d="M 84 30 L 76 38 L 60 32 Z" fill="#1A2A40"/>
      <circle cx="60" cy="72" r="40" fill="#888888"/>
      <circle cx="60" cy="72" r="38" fill="url(#g-silver)"/>
      <circle cx="60" cy="72" r="33" fill="none" stroke="#FFFFFF" stroke-width="0.6" opacity="0.7"/>
      <circle cx="60" cy="72" r="30" fill="none" stroke="#6A6A6A" stroke-width="0.4" opacity="0.5"/>
      <g opacity="0.4" fill="#444">
        <ellipse cx="32" cy="72" rx="3" ry="6" transform="rotate(-30 32 72)"/>
        <ellipse cx="34" cy="86" rx="3" ry="6" transform="rotate(-50 34 86)"/>
        <ellipse cx="88" cy="72" rx="3" ry="6" transform="rotate(30 88 72)"/>
        <ellipse cx="86" cy="86" rx="3" ry="6" transform="rotate(50 86 86)"/>
      </g>
      <text x="60" y="82" text-anchor="middle" font-size="28" font-weight="500" fill="#333" font-family="serif" font-style="italic">S</text>
    </symbol>

    <symbol id="m-bronze" viewBox="0 0 120 130">
      <path d="M 42 6 L 36 30 L 60 38 L 84 30 L 78 6 Z" fill="url(#ribbon-eng)" opacity="0.9"/>
      <path d="M 36 30 L 44 38 L 60 32 Z" fill="#1A2A40"/>
      <path d="M 84 30 L 76 38 L 60 32 Z" fill="#1A2A40"/>
      <circle cx="60" cy="72" r="40" fill="#7A4A28"/>
      <circle cx="60" cy="72" r="38" fill="url(#g-bronze)"/>
      <circle cx="60" cy="72" r="33" fill="none" stroke="#F5D5B0" stroke-width="0.6" opacity="0.7"/>
      <circle cx="60" cy="72" r="30" fill="none" stroke="#5C3A1A" stroke-width="0.4" opacity="0.5"/>
      <g opacity="0.4" fill="#4A2A0F">
        <ellipse cx="32" cy="72" rx="3" ry="6" transform="rotate(-30 32 72)"/>
        <ellipse cx="34" cy="86" rx="3" ry="6" transform="rotate(-50 34 86)"/>
        <ellipse cx="88" cy="72" rx="3" ry="6" transform="rotate(30 88 72)"/>
        <ellipse cx="86" cy="86" rx="3" ry="6" transform="rotate(50 86 86)"/>
      </g>
      <text x="60" y="82" text-anchor="middle" font-size="28" font-weight="500" fill="#3A1F0A" font-family="serif" font-style="italic">B</text>
    </symbol>

    <symbol id="m-eng-none" viewBox="0 0 120 130">
      <circle cx="60" cy="72" r="38" fill="#F5F5F5" stroke="#D0D0D0" stroke-width="0.8" stroke-dasharray="3 3"/>
      <text x="60" y="82" text-anchor="middle" font-size="24" font-weight="400" fill="#B8B8B8" font-family="serif">·</text>
    </symbol>

    <!-- ================================================== -->
    <!-- FINHERO SHIELDS -->
    <!-- ================================================== -->
    <symbol id="m-legend" viewBox="0 0 120 130">
      <!-- Crown rays at top -->
      <g fill="#D4A82A">
        <path d="M 60 4 L 64 18 L 60 16 L 56 18 Z"/>
        <path d="M 40 10 L 48 22 L 42 22 Z"/>
        <path d="M 80 10 L 72 22 L 78 22 Z"/>
        <path d="M 28 18 L 38 28 L 32 30 Z" opacity="0.7"/>
        <path d="M 92 18 L 82 28 L 88 30 Z" opacity="0.7"/>
      </g>
      <!-- Shield outer (darker rim) -->
      <path d="M 60 22 L 96 32 L 96 64 Q 96 92 60 110 Q 24 92 24 64 L 24 32 Z"
            fill="#A8801C"/>
      <!-- Shield body with gradient -->
      <path d="M 60 24 L 94 33 L 94 64 Q 94 90 60 107 Q 26 90 26 64 L 26 33 Z"
            fill="url(#g-legend-shield)"/>
      <!-- Inner border -->
      <path d="M 60 30 L 88 38 L 88 63 Q 88 85 60 100 Q 32 85 32 63 L 32 38 Z"
            fill="none" stroke="#FFE89C" stroke-width="0.8" opacity="0.7"/>
      <!-- 5-point star, more elegant -->
      <path d="M 60 44 L 64.5 58 L 79 58 L 67.5 67 L 71.5 80 L 60 71.5 L 48.5 80 L 52.5 67 L 41 58 L 55.5 58 Z"
            fill="#5C4500" opacity="0.9"/>
      <!-- Star highlight -->
      <path d="M 60 46 L 63.5 57.5 L 75 57.5 L 67 65 Z"
            fill="#FFE89C" opacity="0.4"/>
    </symbol>

    <symbol id="m-champion" viewBox="0 0 120 130">
      <path d="M 60 14 L 96 24 L 96 56 Q 96 84 60 102 Q 24 84 24 56 L 24 24 Z"
            fill="#1F5F9F"/>
      <path d="M 60 16 L 94 25 L 94 56 Q 94 82 60 99 Q 26 82 26 56 L 26 25 Z"
            fill="url(#g-champion-shield)"/>
      <path d="M 60 22 L 88 30 L 88 55 Q 88 77 60 92 Q 32 77 32 55 L 32 30 Z"
            fill="none" stroke="#A8D0F5" stroke-width="0.8" opacity="0.6"/>
      <!-- 4-point star (compass-like) -->
      <path d="M 60 38 L 67 56 L 84 60 L 67 64 L 60 82 L 53 64 L 36 60 L 53 56 Z"
            fill="#0C447C" opacity="0.85"/>
      <path d="M 60 38 L 64 56 L 76 60 Z" fill="#FFFFFF" opacity="0.25"/>
      <!-- Center jewel -->
      <circle cx="60" cy="60" r="3" fill="#FFFFFF" opacity="0.6"/>
      <circle cx="60" cy="60" r="1.5" fill="#0C447C"/>
    </symbol>

    <symbol id="m-finhero" viewBox="0 0 120 130">
      <path d="M 60 14 L 96 24 L 96 56 Q 96 84 60 102 Q 24 84 24 56 L 24 24 Z"
            fill="#0F6E56"/>
      <path d="M 60 16 L 94 25 L 94 56 Q 94 82 60 99 Q 26 82 26 56 L 26 25 Z"
            fill="url(#g-finhero-shield)"/>
      <path d="M 60 22 L 88 30 L 88 55 Q 88 77 60 92 Q 32 77 32 55 L 32 30 Z"
            fill="none" stroke="#A8E5CC" stroke-width="0.8" opacity="0.6"/>
      <!-- Coin design with Z -->
      <circle cx="60" cy="60" r="20" fill="#04342C" opacity="0.18"/>
      <circle cx="60" cy="60" r="18" fill="none" stroke="#04342C" stroke-width="1.5" opacity="0.85"/>
      <circle cx="60" cy="60" r="15" fill="none" stroke="#04342C" stroke-width="0.5" opacity="0.4"/>
      <text x="60" y="68" text-anchor="middle" font-size="22" font-weight="500" fill="#04342C" font-family="serif" font-style="italic">z</text>
      <!-- Highlight on coin -->
      <ellipse cx="54" cy="52" rx="6" ry="4" fill="#FFFFFF" opacity="0.3" transform="rotate(-30 54 52)"/>
    </symbol>

    <symbol id="m-rookie" viewBox="0 0 120 130">
      <path d="M 60 14 L 96 24 L 96 56 Q 96 84 60 102 Q 24 84 24 56 L 24 24 Z"
            fill="#7A7975"/>
      <path d="M 60 16 L 94 25 L 94 56 Q 94 82 60 99 Q 26 82 26 56 L 26 25 Z"
            fill="url(#g-rookie-shield)"/>
      <path d="M 60 22 L 88 30 L 88 55 Q 88 77 60 92 Q 32 77 32 55 L 32 30 Z"
            fill="none" stroke="#FFFFFF" stroke-width="0.8" opacity="0.6"/>
      <!-- Sprout / new beginning -->
      <g transform="translate(60 70)">
        <ellipse cx="0" cy="2" rx="8" ry="2" fill="#5F5E5A" opacity="0.4"/>
        <path d="M 0 0 Q 0 -8 0 -18" stroke="#444441" stroke-width="1.8" fill="none" stroke-linecap="round"/>
        <path d="M 0 -10 Q -8 -14 -10 -22" stroke="#444441" stroke-width="1.4" fill="none" stroke-linecap="round"/>
        <path d="M 0 -10 Q 8 -14 10 -22" stroke="#444441" stroke-width="1.4" fill="none" stroke-linecap="round"/>
        <ellipse cx="-10" cy="-22" rx="3.5" ry="5" fill="#5F5E5A" transform="rotate(-30 -10 -22)"/>
        <ellipse cx="10" cy="-22" rx="3.5" ry="5" fill="#5F5E5A" transform="rotate(30 10 -22)"/>
        <ellipse cx="0" cy="-20" rx="3" ry="4" fill="#444441"/>
      </g>
    </symbol>

    <symbol id="m-fh-none" viewBox="0 0 120 130">
      <path d="M 60 14 L 96 24 L 96 56 Q 96 84 60 102 Q 24 84 24 56 L 24 24 Z"
            fill="#F5F5F5" stroke="#D0D0D0" stroke-width="0.8" stroke-dasharray="3 3"/>
      <text x="60" y="68" text-anchor="middle" font-size="24" font-weight="400" fill="#B8B8B8" font-family="serif">·</text>
    </symbol>
  </defs>
</svg>

<div class="page">
  <div class="page-header">
    <p class="page-title">My badges</p>
  </div>

  <div class="hero-row">

    <div class="hero-card">
      <p class="hero-label">Engagement</p>
      <div class="medal-stage">
        <div class="medal" id="eng-medal"></div>
      </div>
      <p class="badge-name" id="eng-name"></p>
      <p class="badge-month" id="eng-month"></p>
      <div class="divider-dot"></div>
      <p class="praise" id="eng-praise"></p>

      <div class="year-bar">
        <div class="year-mini" id="eng-year-medal"></div>
        <div class="year-text">
          <span class="year-name" id="eng-year-name"></span>
          <span class="year-sub">academic year</span>
        </div>
      </div>
    </div>

    <div class="hero-card">
      <p class="hero-label">FinHero</p>
      <div class="medal-stage">
        <div class="medal" id="fh-medal"></div>
      </div>
      <p class="badge-name" id="fh-name"></p>
      <p class="badge-month" id="fh-month"></p>
      <div class="divider-dot"></div>
      <p class="praise" id="fh-praise"></p>

      <div class="year-bar">
        <div class="year-mini" id="fh-year-medal"></div>
        <div class="year-text">
          <span class="year-name" id="fh-year-name"></span>
          <span class="year-sub">academic year</span>
        </div>
      </div>
    </div>

  </div>

  <div class="history-header">
    <p class="history-title">Month by month</p>
    <p class="history-year" id="history-year"></p>
  </div>

  <div class="history-grid">
    <div class="month-row-header">
      <div class="row-header-label"></div>
      <div class="month-headers" id="month-headers"></div>
    </div>

    <div class="row-wrap">
      <div class="row-label">Engagement</div>
      <div class="month-row" id="eng-row"></div>
    </div>

    <div class="row-wrap">
      <div class="row-label">FinHero</div>
      <div class="month-row" id="fh-row"></div>
    </div>
  </div>
</div>

<script>
(function() {
const MONTH_NAMES = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

/* ============================
   ENGAGEMENT CONFIG
============================ */
const ENG_MEDALS = {
  PLATINUM: { id: '#m-platinum', label: 'Platinum' },
  GOLD:     { id: '#m-gold',     label: 'Gold' },
  SILVER:   { id: '#m-silver',   label: 'Silver' },
  BRONZE:   { id: '#m-bronze',   label: 'Bronze' },
  NONE:     { id: '#m-eng-none', label: 'No badge yet' },
};

const ENG_PRAISE = {
  PLATINUM: '"You showed up, joined in, and gave it everything. Truly inspiring."',
  GOLD:     '"Your dedication shines — you are part of what makes this city alive."',
  SILVER:   '"You stayed engaged and made things happen. Solid effort all month."',
  BRONZE:   '"You took your first steps. Every adventure begins right here."',
  NONE:     '"Your story is just beginning. Step into the city and make your mark."',
};

/* ============================
   FINHERO CONFIG
============================ */
const FH_MEDALS = {
  LEGEND:   { id: '#m-legend',   label: 'Legend' },
  CHAMPION: { id: '#m-champion', label: 'Champion' },
  FINHERO:  { id: '#m-finhero',  label: 'FinHero' },
  ROOKIE:   { id: '#m-rookie',   label: 'Rookie' },
  NONE:     { id: '#m-fh-none',  label: 'No badge yet' },
};

const FH_PRAISE = {
  LEGEND:   '"Outstanding mastery — you are among the best."',
  CHAMPION: '"Strong performance — you are leading."',
  FINHERO:  '"Great progress — keep growing."',
  ROOKIE:   '"Good start — keep learning."',
  NONE:     '"Start your FinHero journey today."',
};

/* ============================
   🔥 DYNAMIC DATA FROM LARAVEL
============================ */
const engData = @json($engagement);
const fhData  = @json($finhero);

/* Fix history keys */
Object.keys(engData.history).forEach(k => {
  if (!engData.history[k]) engData.history[k] = null;
});
Object.keys(fhData.history).forEach(k => {
  if (!fhData.history[k]) fhData.history[k] = null;
});

/* ============================
   DATE LOGIC
============================ */
const now = new Date();
const currentMonth = now.getMonth();
const currentYear  = now.getFullYear();

const academicStartMonth = 8; // September
const academicStartYear  = engData.academicStartYear;

/* ============================
   BUILD MONTHS
============================ */
function buildMonths() {
  const arr = [];
  let m = academicStartMonth, y = academicStartYear;

  for (let i = 0; i < 10; i++) {
    arr.push({ month: m, year: y });
    m++;
    if (m > 11) { m = 0; y++; }
  }
  return arr;
}
const months = buildMonths();

/* ============================
   SVG RENDER
============================ */
function useSvg(elementId, symbolId) {
  document.getElementById(elementId).innerHTML =
    '<svg viewBox="0 0 120 130"><use href="' + symbolId + '"/></svg>';
}

/* ============================
   HERO SECTION
============================ */
function renderHero() {

  // 🔹 Engagement
  const e = ENG_MEDALS[engData.monthly] || ENG_MEDALS.NONE;
  useSvg('eng-medal', e.id);
  document.getElementById('eng-name').textContent  = e.label;
  document.getElementById('eng-month').textContent = MONTH_NAMES[currentMonth] + ' ' + currentYear;
  document.getElementById('eng-praise').textContent = ENG_PRAISE[engData.monthly] || ENG_PRAISE.NONE;

  const ey = ENG_MEDALS[engData.yearly] || ENG_MEDALS.NONE;
  useSvg('eng-year-medal', ey.id);
  document.getElementById('eng-year-name').textContent = ey.label;

  // 🔹 FinHero
  const f = FH_MEDALS[fhData.monthly] || FH_MEDALS.NONE;
  useSvg('fh-medal', f.id);
  document.getElementById('fh-name').textContent  = f.label;
  document.getElementById('fh-month').textContent = MONTH_NAMES[currentMonth] + ' ' + currentYear;
  document.getElementById('fh-praise').textContent = FH_PRAISE[fhData.monthly] || FH_PRAISE.NONE;

  const fy = FH_MEDALS[fhData.yearly] || FH_MEDALS.NONE;
  useSvg('fh-year-medal', fy.id);
  document.getElementById('fh-year-name').textContent = fy.label;
}

/* ============================
   HISTORY GRID
============================ */
function renderHistory() {

  document.getElementById('history-year').textContent =
    academicStartYear + '–' + (academicStartYear + 1);

  const headers = document.getElementById('month-headers');
  headers.innerHTML = '';

  months.forEach(({ month, year }) => {
    const isPast    = year < currentYear || (year === currentYear && month < currentMonth);
    const isCurrent = month === currentMonth && year === currentYear;
    const isFuture  = !isPast && !isCurrent;

    const cell = document.createElement('div');
    cell.className =
      'month-header-cell' +
      (isCurrent ? ' current-h' : '') +
      (isFuture ? ' future-h' : '');

    cell.textContent = MONTH_NAMES[month];
    headers.appendChild(cell);
  });

  function renderRow(rowId, data, medals) {
    const row = document.getElementById(rowId);
    row.innerHTML = '';

    months.forEach(({ month, year }) => {
      const isPast    = year < currentYear || (year === currentYear && month < currentMonth);
      const isCurrent = month === currentMonth && year === currentYear;
      const isFuture  = !isPast && !isCurrent;

      const cell = document.createElement('div');
      cell.className =
        'month-cell' +
        (isCurrent ? ' current' : '') +
        (isFuture ? ' future' : '');

      const badge = data.history[String(month)] || (isCurrent ? data.monthly : null);

      if (badge) {
        const meta = medals[badge];

        cell.innerHTML =
          '<div class="month-medal">' +
            '<svg viewBox="0 0 120 130"><use href="' + meta.id + '"/></svg>' +
          '</div>' +
          '<div class="month-badge-label">' + meta.label + '</div>';
      } else {
        cell.innerHTML = '<div class="empty-medal"></div>';
      }

      row.appendChild(cell);
    });
  }

  renderRow('eng-row', engData, ENG_MEDALS);
  renderRow('fh-row', fhData, FH_MEDALS); // ✅ ADDED
}

/* ============================
   INIT
============================ */
renderHero();
renderHistory();
})();
</script>