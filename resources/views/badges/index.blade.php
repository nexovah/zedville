{{--
    ZEDVILLE — Engagement Badge
    View: Student Badges Section

    INSTRUCTIONS FOR IT:
    1. Place this file in: resources/views/badges/index.blade.php
    2. Extend your existing layout — replace 'layouts.app' with your layout name
    3. The page fetches badge data from: GET /badges/data
       (served by BadgeStudentController@data — see file 8)
--}}

@extends('layouts.profile')

@section('title', 'My Badges — Zedville')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Page Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">My Badges</h1>
        <p class="text-gray-500 mt-1">Track your monthly and yearly engagement</p>
    </div>

    {{-- Loading state --}}
    <div id="badges-loading" class="text-center py-16 text-gray-400">
        <div class="text-4xl mb-3">⏳</div>
        <p>Loading your badges...</p>
    </div>

    {{-- Main content (hidden until data loads) --}}
    <div id="badges-content" class="hidden space-y-8">

        {{-- Top row: Monthly + Accumulated --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Monthly Badge Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">This Month</div>
                <div id="monthly-badge-display" class="flex items-center gap-4 mb-6">
                    <div id="monthly-badge-emoji" class="text-5xl"></div>
                    <div>
                        <div id="monthly-badge-label" class="text-2xl font-bold text-gray-800"></div>
                        <div id="monthly-badge-month" class="text-sm text-gray-400"></div>
                    </div>
                </div>

                {{-- Progress toward next level --}}
                <div id="monthly-progress-section" class="space-y-3">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-widest">Progress to Next Level</div>

                    {{-- Required --}}
                    <div>
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Required Activities</span>
                            <span id="prog-required-label"></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div id="prog-required-bar" class="bg-blue-500 h-2 rounded-full transition-all duration-500" style="width:0%"></div>
                        </div>
                    </div>

                    {{-- Optional --}}
                    <div>
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Optional Activities</span>
                            <span id="prog-optional-label"></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div id="prog-optional-bar" class="bg-purple-500 h-2 rounded-full transition-all duration-500" style="width:0%"></div>
                        </div>
                    </div>

                    {{-- Participation --}}
                    <div>
                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                            <span>Participation</span>
                            <span id="prog-participation-label"></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div id="prog-participation-bar" class="bg-green-500 h-2 rounded-full transition-all duration-500" style="width:0%"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Accumulated Badge Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-4">This Academic Year</div>
                <div id="accumulated-badge-display" class="flex items-center gap-4 mb-6">
                    <div id="accumulated-badge-emoji" class="text-5xl"></div>
                    <div>
                        <div id="accumulated-badge-label" class="text-2xl font-bold text-gray-800"></div>
                        <div id="accumulated-badge-year" class="text-sm text-gray-400"></div>
                    </div>
                </div>

                {{-- Year points bar --}}
                <div>
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Year-to-date points</span>
                        <span id="accumulated-pts-label"></span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-3">
                        <div id="accumulated-pts-bar" class="bg-indigo-500 h-3 rounded-full transition-all duration-700" style="width:0%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-300 mt-1">
                        <span>0</span>
                        <span>Bronze (8)</span>
                        <span>Silver (16)</span>
                        <span>Gold (24)</span>
                        <span>Platinum (32)</span>
                        <span>40</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Month-by-month History --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-5">Month-by-Month History</div>
            <div id="badge-history" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                {{-- Filled by JS --}}
            </div>
        </div>

    </div>{{-- end badges-content --}}
</div>

<script>
const MONTH_NAMES = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

const BADGE_META = {
    PLATINUM: { label: 'Platinum', emoji: '🏅', color: '#E8E8E8', text: '#333' },
    GOLD:     { label: 'Gold',     emoji: '🥇', color: '#FFF8DC', text: '#7A5C00' },
    SILVER:   { label: 'Silver',   emoji: '🥈', color: '#F0F0F0', text: '#555' },
    BRONZE:   { label: 'Bronze',   emoji: '🥉', color: '#FDF0E6', text: '#7A3B00' },
    NONE:     { label: 'No Badge', emoji: '—',  color: '#FFE8E8', text: '#AA0000' },
};

// Next-level thresholds for progress bars
const NEXT_LEVEL = {
    NONE:     { optional: 1,  participation: 5  },
    BRONZE:   { optional: 2,  participation: 7  },
    SILVER:   { optional: 3,  participation: 10 },
    GOLD:     { optional: 4,  participation: 15 },
    PLATINUM: { optional: 4,  participation: 15 },
};

async function loadBadgeData() {
    try {
        const res  = await fetch('/badges/data');
        const data = await res.json();
        renderBadges(data);
    } catch (e) {
        document.getElementById('badges-loading').innerHTML =
            '<p class="text-red-400">Could not load badge data. Please try again later.</p>';
    }
}

function renderBadges(data) {
    const current     = data.current_month;
    const accumulated = data.accumulated_badge;
    const accPts      = data.accumulated_points;
    const history     = data.history;

    // --- Monthly Badge ---
    const meta = BADGE_META[current?.monthly_badge || 'NONE'];
    document.getElementById('monthly-badge-emoji').textContent = meta.emoji;
    document.getElementById('monthly-badge-label').textContent = meta.label;
    document.getElementById('monthly-badge-month').textContent =
        current ? `${MONTH_NAMES[current.month - 1]} ${current.year}` : 'No data yet';

    // Progress bars
    if (current) {
        const reqPct  = current.required_assigned > 0
            ? Math.min(100, Math.round(current.required_completed / current.required_assigned * 100))
            : 0;
        const next    = NEXT_LEVEL[current.monthly_badge] || NEXT_LEVEL['NONE'];
        const optPct  = Math.min(100, Math.round(current.optional_completed / next.optional * 100));
        const partPct = Math.min(100, Math.round(current.participation_points / next.participation * 100));

        setBar('prog-required',     reqPct,  `${current.required_completed}/${current.required_assigned}`);
        setBar('prog-optional',     optPct,  `${current.optional_completed}/${next.optional}`);
        setBar('prog-participation',partPct, `${current.participation_points}/15 pts`);
    }

    // --- Accumulated Badge ---
    const accMeta = BADGE_META[accumulated || 'NONE'];
    document.getElementById('accumulated-badge-emoji').textContent = accMeta.emoji;
    document.getElementById('accumulated-badge-label').textContent = accMeta.label;
    document.getElementById('accumulated-badge-year').textContent  = data.academic_year || '';
    document.getElementById('accumulated-pts-label').textContent   = `${accPts} / 40 pts`;
    document.getElementById('accumulated-pts-bar').style.width     = `${Math.min(100, Math.round(accPts / 40 * 100))}%`;

    // --- History ---
    const historyEl = document.getElementById('badge-history');
    historyEl.innerHTML = '';

    if (!history || history.length === 0) {
        historyEl.innerHTML = '<p class="col-span-5 text-gray-400 text-sm">No badge history yet this year.</p>';
    } else {
        history.forEach(record => {
            const m    = BADGE_META[record.monthly_badge];
            const card = document.createElement('div');
            card.className = 'rounded-xl p-3 text-center border';
            card.style.backgroundColor = m.color;
            card.style.borderColor     = '#e5e7eb';
            card.innerHTML = `
                <div class="text-2xl mb-1">${m.emoji}</div>
                <div class="text-xs font-semibold" style="color:${m.text}">${m.label}</div>
                <div class="text-xs text-gray-400 mt-1">${MONTH_NAMES[record.month - 1]} ${record.year}</div>
                ${record.is_overridden ? '<div class="text-xs text-orange-400 mt-1">★ Adjusted</div>' : ''}
            `;
            historyEl.appendChild(card);
        });
    }

    // Show content
    document.getElementById('badges-loading').classList.add('hidden');
    document.getElementById('badges-content').classList.remove('hidden');
}

function setBar(id, pct, label) {
    document.getElementById(`${id}-bar`).style.width   = `${pct}%`;
    document.getElementById(`${id}-label`).textContent = label;
}

loadBadgeData();
</script>
@endsection
