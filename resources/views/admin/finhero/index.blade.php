{{--
    ZEDVILLE — FinHero Badge
    View: Admin Activity Manager + Badge Settings
    Place in: resources/views/admin/finhero/index.blade.php
    Extend your existing admin layout.
--}}
@extends('layouts.admin') {{-- TODO: replace with your admin layout --}}
@section('title', 'FinHero Badge — Admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8 space-y-10">

  {{-- Header --}}
  <div>
    <h1 class="text-2xl font-bold text-gray-800">FinHero Badge</h1>
    <p class="text-gray-400 text-sm mt-1">Manage activities, settings, and monthly controls</p>
  </div>

  {{-- TABS --}}
  <div class="flex gap-2 border-b border-gray-200">
    <button onclick="showTab('settings')" id="tab-settings"
      class="tab-btn px-5 py-2 text-sm font-semibold border-b-2 border-green-600 text-green-700">
      Badge Settings
    </button>
    <button onclick="showTab('activities')" id="tab-activities"
      class="tab-btn px-5 py-2 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-green-700">
      Activity Manager
    </button>
    <button onclick="showTab('reports')" id="tab-reports"
      class="tab-btn px-5 py-2 text-sm font-semibold border-b-2 border-transparent text-gray-500 hover:text-green-700">
      Reports
    </button>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- TAB 1: BADGE SETTINGS --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div id="tab-settings-content" class="space-y-8">

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-6">
      <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Monthly Settings</h2>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-xs text-gray-500 font-semibold">Month</label>
          <select id="settings-month" class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
            @foreach(range(1,12) as $m)
              <option value="{{ $m }}" {{ $m == now()->month ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
              </option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="text-xs text-gray-500 font-semibold">Year</label>
          <input id="settings-year" type="number" value="{{ now()->year }}"
            class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
        </div>
      </div>

      <div>
        <label class="text-xs text-gray-500 font-semibold">Active Library Module (for FinHero points this month)</label>
        <select id="settings-module" class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
          <option value="">— None —</option>
          {{-- TODO: replace with your actual library modules query --}}
          {{-- @foreach($libraryModules as $module) --}}
          {{--   <option value="{{ $module->id }}">{{ $module->title }}</option> --}}
          {{-- @endforeach --}}
          <option value="1">Module 1 — Introduction to Budget</option>
          <option value="2">Module 2 — Tracking Income & Expenses</option>
          <option value="3">Module 3 — Savings: Why Save?</option>
          <option value="4">Module 4 — Emergency Fund</option>
          <option value="5">Module 5 — Introduction to Banking</option>
          <option value="6">Module 6 — Simple Interest</option>
          <option value="7">Module 7 — Fixed vs Variable Expenses</option>
        </select>
      </div>

      <div class="flex items-center gap-3">
        <input type="checkbox" id="settings-active" checked class="w-4 h-4 accent-green-600">
        <label for="settings-active" class="text-sm text-gray-700">Badge active this month</label>
      </div>

      <div>
        <p class="text-xs text-gray-500 font-semibold mb-3">Badge Level Thresholds (%)</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
          @foreach(['legend' => ['label'=>'Legend','color'=>'#FFF9E6'], 'champion' => ['label'=>'Champion','color'=>'#F0F8FF'], 'finhero' => ['label'=>'FinHero','color'=>'#E8F5EE'], 'rookie' => ['label'=>'Rookie','color'=>'#F5F5F5']] as $key => $meta)
          <div class="rounded-xl p-3 border" style="background:{{ $meta['color'] }}">
            <label class="text-xs text-gray-500">{{ $meta['label'] }} (%)</label>
            <input id="threshold-{{ $key }}" type="number" min="1" max="100"
              value="{{ ['legend'=>90,'champion'=>70,'finhero'=>50,'rookie'=>25][$key] }}"
              class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm bg-white">
          </div>
          @endforeach
        </div>
      </div>

      <button onclick="saveSettings()"
        class="px-6 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition">
        Save Settings
      </button>
      <div id="settings-msg" class="text-xs text-green-600 mt-2 hidden"></div>
    </div>

    {{-- Academic Year Reset --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
      <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-widest mb-4">Academic Year</h2>
      <div class="flex gap-3 items-end">
        <div>
          <label class="text-xs text-gray-500 font-semibold">New Academic Year</label>
          <input id="new-academic-year" type="text" placeholder="e.g. 2026-2027"
            class="w-48 mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
        </div>
        <button onclick="resetYear()"
          class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg hover:bg-red-600 transition">
          Reset Year
        </button>
      </div>
      <p class="text-xs text-gray-400 mt-2">Historical records are kept. Accumulated points restart from 0.</p>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- TAB 2: ACTIVITY MANAGER --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div id="tab-activities-content" class="hidden space-y-6">

    <div class="flex justify-between items-center">
      <p class="text-sm text-gray-500">All registered FinHero activities. Toggle active/inactive each month.</p>
      <button onclick="openAddActivity()"
        class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition">
        + Add Activity
      </button>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
      <table class="w-full text-sm">
        <thead class="bg-green-700 text-white">
          <tr>
            <th class="text-left px-4 py-3">Activity Name</th>
            <th class="text-center px-4 py-3">Max Points</th>
            <th class="text-center px-4 py-3">Position</th>
            <th class="text-center px-4 py-3">Active This Month</th>
            <th class="text-center px-4 py-3">Activity Key</th>
            <th class="text-center px-4 py-3">Actions</th>
          </tr>
        </thead>
        <tbody id="activities-table-body">
          <tr><td colspan="6" class="text-center py-8 text-gray-400">Loading activities...</td></tr>
        </tbody>
      </table>
    </div>

    {{-- Add/Edit Activity Modal --}}
    <div id="activity-modal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
      <div class="bg-white rounded-2xl shadow-xl p-6 w-full max-w-md space-y-4">
        <h3 id="modal-title" class="font-bold text-gray-800">Add Activity</h3>

        <input type="hidden" id="modal-id">
        <div>
          <label class="text-xs text-gray-500 font-semibold">Activity Name</label>
          <input id="modal-name" type="text" placeholder="e.g. Task 1 — Salary Classification"
            class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
        </div>
        <div>
          <label class="text-xs text-gray-500 font-semibold">Activity Key (set by IT — do not change after creation)</label>
          <input id="modal-key" type="text" placeholder="e.g. task_1"
            class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm font-mono">
          <p class="text-xs text-gray-400 mt-1">IT uses this key in their code. Must be unique.</p>
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="text-xs text-gray-500 font-semibold">Max Points</label>
            <input id="modal-points" type="number" value="1" min="1"
              class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
          </div>
          <div>
            <label class="text-xs text-gray-500 font-semibold">Position</label>
            <select id="modal-position" class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
              <option value="optional">Optional</option>
              <option value="required">Required</option>
              <option value="free">Free</option>
            </select>
          </div>
        </div>
        <div>
          <label class="text-xs text-gray-500 font-semibold">Description (optional)</label>
          <textarea id="modal-description" rows="2"
            class="w-full mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm"></textarea>
        </div>
        <div class="flex gap-3 justify-end">
          <button onclick="closeModal()" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-800">Cancel</button>
          <button onclick="saveActivity()" class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700">Save</button>
        </div>
      </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════════════════ --}}
  {{-- TAB 3: REPORTS --}}
  {{-- ═══════════════════════════════════════════════════════ --}}
  <div id="tab-reports-content" class="hidden space-y-6">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 space-y-4">
      <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-widest">Class Summary</h2>
      <div class="flex gap-3 items-end">
        <div>
          <label class="text-xs text-gray-500 font-semibold">Month</label>
          <select id="report-month" class="w-40 mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
            @foreach(range(1,12) as $m)
              <option value="{{ $m }}" {{ $m == now()->month ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
              </option>
            @endforeach
          </select>
        </div>
        <div>
          <label class="text-xs text-gray-500 font-semibold">Year</label>
          <input id="report-year" type="number" value="{{ now()->year }}"
            class="w-28 mt-1 border border-gray-200 rounded-lg px-3 py-2 text-sm">
        </div>
        <button onclick="loadClassSummary()"
          class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700">Load</button>
      </div>
      <div id="class-summary-display" class="grid grid-cols-5 gap-3 mt-4">
        @foreach(['LEGEND'=>['🏆','#FFF9E6','#7A5C00'],'CHAMPION'=>['⭐','#F0F8FF','#1F3864'],'FINHERO'=>['💪','#E8F5EE','#1B6B3A'],'ROOKIE'=>['🌱','#F5F5F5','#555'],'NONE'=>['—','#FFE8E8','#AA0000']] as $level => $meta)
        <div class="rounded-xl p-4 text-center border" style="background:{{ $meta[1] }}">
          <div class="text-2xl mb-1">{{ $meta[0] }}</div>
          <div class="text-xs font-semibold" style="color:{{ $meta[2] }}">{{ $level }}</div>
          <div id="summary-{{ $level }}" class="text-2xl font-bold mt-1" style="color:{{ $meta[2] }}">—</div>
          <div class="text-xs text-gray-400">students</div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
      <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-widest mb-4">Student Lookup</h2>
      <div class="flex gap-3">
        <input id="lookup-student-id" type="number" placeholder="Student ID"
          class="w-40 border border-gray-200 rounded-lg px-3 py-2 text-sm">
        <button onclick="lookupStudent()"
          class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700">View Badges</button>
      </div>
      <div id="student-lookup-result" class="mt-4 text-sm text-gray-400">Enter a student ID above.</div>
    </div>
  </div>

</div>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
const MONTH_NAMES = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

// ── Tabs ──────────────────────────────────────────────────
function showTab(tab) {
  ['settings','activities','reports'].forEach(t => {
    document.getElementById(`tab-${t}-content`).classList.toggle('hidden', t !== tab);
    const btn = document.getElementById(`tab-${t}`);
    btn.classList.toggle('border-green-600', t === tab);
    btn.classList.toggle('text-green-700', t === tab);
    btn.classList.toggle('border-transparent', t !== tab);
    btn.classList.toggle('text-gray-500', t !== tab);
  });
  if (tab === 'activities') loadActivities();
}

// ── Settings ──────────────────────────────────────────────
async function saveSettings() {
  const body = {
    month:              parseInt(document.getElementById('settings-month').value),
    year:               parseInt(document.getElementById('settings-year').value),
    active_library_module_id: document.getElementById('settings-module').value || null,
    badge_active:       document.getElementById('settings-active').checked,
    threshold_legend:   parseInt(document.getElementById('threshold-legend').value),
    threshold_champion: parseInt(document.getElementById('threshold-champion').value),
    threshold_finhero:  parseInt(document.getElementById('threshold-finhero').value),
    threshold_rookie:   parseInt(document.getElementById('threshold-rookie').value),
  };
  const res  = await fetch('/admin/finhero/settings', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify(body) });
  const data = await res.json();
  const msg  = document.getElementById('settings-msg');
  msg.textContent = data.message;
  msg.classList.remove('hidden');
  setTimeout(() => msg.classList.add('hidden'), 3000);
}

async function resetYear() {
  const val = document.getElementById('new-academic-year').value;
  if (!val.match(/^\d{4}-\d{4}$/)) return alert('Format must be YYYY-YYYY e.g. 2026-2027');
  if (!confirm(`Reset academic year to ${val}? This will restart accumulated points.`)) return;
  const res  = await fetch('/admin/finhero/reset-year', { method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify({new_academic_year:val}) });
  const data = await res.json();
  alert(data.message);
}

// ── Activity Manager ───────────────────────────────────────
async function loadActivities() {
  const res  = await fetch('/admin/finhero/activities');
  const data = await res.json();
  const tbody = document.getElementById('activities-table-body');
  if (!data.length) { tbody.innerHTML = '<tr><td colspan="6" class="text-center py-8 text-gray-400">No activities registered yet. Click "+ Add Activity" to start.</td></tr>'; return; }

  tbody.innerHTML = data.map((a, i) => `
    <tr class="${i%2===0?'bg-white':'bg-gray-50'} border-b border-gray-50 hover:bg-green-50">
      <td class="px-4 py-3 font-medium text-gray-700">${a.activity_name}</td>
      <td class="px-4 py-3 text-center">
        <input type="number" value="${a.max_points}" min="1"
          onchange="quickUpdatePoints(${a.id}, this.value)"
          class="w-16 border border-gray-200 rounded px-2 py-1 text-sm text-center">
      </td>
      <td class="px-4 py-3 text-center">
        <select onchange="quickUpdatePosition(${a.id}, this.value)"
          class="border border-gray-200 rounded px-2 py-1 text-xs">
          <option value="required" ${a.position==='required'?'selected':''}>Required</option>
          <option value="optional" ${a.position==='optional'?'selected':''}>Optional</option>
          <option value="free"     ${a.position==='free'?'selected':''}>Free</option>
        </select>
      </td>
      <td class="px-4 py-3 text-center">
        <input type="checkbox" ${a.is_active?'checked':''}
          onchange="quickToggleActive(${a.id}, this.checked)"
          class="w-4 h-4 accent-green-600">
      </td>
      <td class="px-4 py-3 text-center font-mono text-xs text-gray-400">${a.activity_key}</td>
      <td class="px-4 py-3 text-center">
        <button onclick="editActivity(${JSON.stringify(a).replace(/"/g,'&quot;')})"
          class="text-xs text-blue-500 hover:underline mr-3">Edit</button>
        <button onclick="deleteActivity(${a.id})"
          class="text-xs text-red-400 hover:underline">Delete</button>
      </td>
    </tr>
  `).join('');
}

async function quickUpdatePoints(id, points) {
  await fetch(`/admin/finhero/activities/${id}`, { method:'PUT', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify({max_points:parseInt(points)}) });
}
async function quickUpdatePosition(id, position) {
  await fetch(`/admin/finhero/activities/${id}`, { method:'PUT', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify({position}) });
}
async function quickToggleActive(id, is_active) {
  await fetch(`/admin/finhero/activities/${id}`, { method:'PUT', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify({is_active}) });
}
async function deleteActivity(id) {
  if (!confirm('Remove this activity from the FinHero badge?')) return;
  await fetch(`/admin/finhero/activities/${id}`, { method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF} });
  loadActivities();
}

function openAddActivity() {
  document.getElementById('modal-title').textContent = 'Add Activity';
  document.getElementById('modal-id').value = '';
  document.getElementById('modal-name').value = '';
  document.getElementById('modal-key').value = '';
  document.getElementById('modal-key').disabled = false;
  document.getElementById('modal-points').value = 1;
  document.getElementById('modal-position').value = 'optional';
  document.getElementById('modal-description').value = '';
  document.getElementById('activity-modal').classList.remove('hidden');
}

function editActivity(a) {
  document.getElementById('modal-title').textContent = 'Edit Activity';
  document.getElementById('modal-id').value = a.id;
  document.getElementById('modal-name').value = a.activity_name;
  document.getElementById('modal-key').value = a.activity_key;
  document.getElementById('modal-key').disabled = true; // key is immutable after creation
  document.getElementById('modal-points').value = a.max_points;
  document.getElementById('modal-position').value = a.position;
  document.getElementById('modal-description').value = a.description || '';
  document.getElementById('activity-modal').classList.remove('hidden');
}

function closeModal() { document.getElementById('activity-modal').classList.add('hidden'); }

async function saveActivity() {
  const id   = document.getElementById('modal-id').value;
  const body = {
    activity_key:  document.getElementById('modal-key').value.trim(),
    activity_name: document.getElementById('modal-name').value.trim(),
    max_points:    parseInt(document.getElementById('modal-points').value),
    position:      document.getElementById('modal-position').value,
    description:   document.getElementById('modal-description').value,
  };
  const url    = id ? `/admin/finhero/activities/${id}` : '/admin/finhero/activities';
  const method = id ? 'PUT' : 'POST';
  const res    = await fetch(url, { method, headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF}, body:JSON.stringify(body) });
  const data   = await res.json();
  if (data.success) { closeModal(); loadActivities(); }
  else alert(data.message || 'Error saving activity.');
}

// ── Reports ───────────────────────────────────────────────
async function loadClassSummary() {
  const month = document.getElementById('report-month').value;
  const year  = document.getElementById('report-year').value;
  const res   = await fetch(`/admin/finhero/class-summary?month=${month}&year=${year}`);
  const data  = await res.json();
  ['LEGEND','CHAMPION','FINHERO','ROOKIE','NONE'].forEach(level => {
    document.getElementById(`summary-${level}`).textContent = data.summary[level] ?? 0;
  });
}

async function lookupStudent() {
  const id  = document.getElementById('lookup-student-id').value;
  if (!id)  return;
  const res  = await fetch(`/admin/finhero/student/${id}`);
  const data = await res.json();
  const el   = document.getElementById('student-lookup-result');

  if (!data.history?.length) { el.innerHTML = '<p class="text-gray-400">No FinHero badge data for this student yet.</p>'; return; }

  const current = data.current_month;
  const meta    = {LEGEND:{e:'🏆'},CHAMPION:{e:'⭐'},FINHERO:{e:'💪'},ROOKIE:{e:'🌱'},NONE:{e:'—'}};

  el.innerHTML = `
    <div class="space-y-4">
      <div class="grid grid-cols-2 gap-4">
        <div class="bg-gray-50 rounded-xl p-4">
          <p class="text-xs text-gray-400 mb-1">This Month</p>
          <p class="text-xl font-bold text-gray-800">${meta[current?.monthly_badge||'NONE'].e} ${current?.monthly_badge||'NONE'}</p>
          <p class="text-xs text-gray-500">${current?.total_earned||0} / ${current?.total_available||0} pts (${current?.monthly_pct||0}%)</p>
          <p class="text-xs text-gray-400 mt-2">Quiz: ${current?.quiz_pts||0} | Library: ${current?.library_pts||0} | Activities: ${current?.activity_pts||0}</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-4">
          <p class="text-xs text-gray-400 mb-1">Accumulated (${data.academic_year})</p>
          <p class="text-xl font-bold text-gray-800">${meta[data.accumulated_badge||'NONE'].e} ${data.accumulated_badge||'NONE'}</p>
          <p class="text-xs text-gray-500">${data.accumulated_points} / 40 pts</p>
        </div>
      </div>
      <div class="flex flex-wrap gap-2">
        ${data.history.map(r => `
          <div class="text-center rounded-lg p-2 border bg-white w-20">
            <div class="text-lg">${meta[r.monthly_badge||'NONE'].e}</div>
            <div class="text-xs text-gray-500">${MONTH_NAMES[r.month-1]} ${r.year}</div>
            ${r.is_overridden ? '<div class="text-xs text-orange-400">★</div>' : ''}
          </div>
        `).join('')}
      </div>
    </div>
  `;
}
</script>
@endsection
