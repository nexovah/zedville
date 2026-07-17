@extends('layouts.admin')

@section('title', 'Communication')

@section('content')
<style>
.multi-select-dropdown {
    position: relative;
    margin-bottom: 1rem;
}

.multi-select-dropdown #multiSelectButton {
    background-color: #fff;
    cursor: pointer;
    padding: 0.5rem 0.75rem;
}

.multi-select-dropdown #multiSelectButton:hover {
    background-color: #f8f9fa;
}

.dropdown-menu-custom {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 0.375rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    z-index: 1000;
    margin-top: 0.25rem;
}

.user-list-scroll {
    max-height: 250px;
    overflow-y: auto;
    overflow-x: hidden;
}

.user-item {
    padding: 0.5rem 0.75rem;
    cursor: pointer;
    transition: background-color 0.2s;
    border-bottom: 1px solid #f0f0f0;
}

.user-item:last-child {
    border-bottom: none;
}

.user-item:hover {
    background-color: #f8f9fa;
}

.user-item .form-check {
    margin-bottom: 0;
    display: flex;
    align-items: center;
}

.user-item .form-check-input {
    margin-top: 0;
    flex-shrink: 0;
    width: 18px;
    height: 18px;
    cursor: pointer;
    border: 2px solid #d1d5db;
    background-color: #fff;
}

.user-item .form-check-input:checked {
    background-color: #00c4b4;
    border-color: #00c4b4;
}

.user-item .form-check-input:focus {
    border-color: #00c4b4;
    box-shadow: 0 0 0 0.25rem rgba(0, 196, 180, 0.25);
}

.user-item label {
    cursor: pointer;
    margin-bottom: 0;
    margin-left: 0.5rem;
    flex-grow: 1;
}
</style>
<div class="adminHeading">
    <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">Communication</h1>
</div>
<!-- Body Widget -->
<div class="row">
    <div class="col-12">
        <div class="haveSidenav">
            <div class="leftInnernavSec innpageSidenav">
                <!-- <h4 class="fs-14 fw-500 theme-text-color mab-15 border-bottom-1 pab-15 border-color">Communication</h4> -->
                <ul class="navItems  mt-5">
                  <li class="border-bottom-1 py-15 border-color">
                        <a href="{{ url('admin/email/communication') }}">
                            <span class="navTxt">Compose Email</span>
                        </a>
                    </li>
                   <li class=" py-15 border-color">
                        <a href="{{ url('admin/email/sent-email')}}">
                            <span class="navTxt">Sent Emails</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="innerContentSec">
                <nav class="themeBreadcrumb mab-30">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Compose</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Email</li>
                    </ol>
                </nav>
                <div class="innerPageContent minh-450px border-1 border-color pall-30">
                     <form action="{{ url('admin/email/send') }}" class="themeForm" method="POST">
                        @csrf
                        {{-- Select Mode --}}
                        <select class="form-control mb-3" name="send_type" id="sendType">
                            <option value="" disabled selected>Select Recipient Type</option>
                            <option value="all">All Users</option>
                            <option value="selected">Selected Users</option>
                        </select>

                        {{-- Checkbox List --}}
                        {{-- Checkbox List --}}
                        <div id="userCheckboxes" style="display:none;">
                            <label class="mb-2 d-block fw-bold">Select Users</label>

                            {{-- Multi-Select Dropdown --}}
                            <div class="multi-select-dropdown">
                                <button type="button" class="form-control text-start d-flex justify-content-between align-items-center" id="multiSelectButton">
                                    <span id="selectedCount">Select users...</span>
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                                
                                <div class="dropdown-menu-custom" id="dropdownMenu" style="display:none;">
                                    {{-- Search --}}
                                    <div class="p-2 border-bottom">
                                        <input type="text"
                                            class="form-control form-control-sm"
                                            placeholder="Search user by name or email..."
                                            id="userSearch">
                                    </div>
                                    
                                    {{-- Select All / Deselect All --}}
                                    <div class="p-2 border-bottom d-flex gap-2">
                                        <button type="button" class="themeBtnGray theme-text-dark" id="selectAll" style="padding: 0.375rem 0.75rem; font-size: 0.875rem;">Select All</button>
                                        <button type="button" class="secondaryBtn theme-text-mute" id="deselectAll" style="padding: 0.375rem 0.75rem; font-size: 0.875rem;">Deselect All</button>
                                    </div>
                                    
                                    {{-- User List --}}
                                    <div class="user-list-scroll" id="userList">
                                        @foreach ($users as $user)
                                            <div class="user-item" data-user-id="{{ $user->id }}">
                                                <div class="form-check">
                                                    <input class="form-check-input user-checkbox"
                                                        type="checkbox"
                                                        name="user_ids[]"
                                                        value="{{ $user->id }}"
                                                        id="user{{ $user->id }}">

                                                    <label class="form-check-label" for="user{{ $user->id }}">
                                                        {{ $user->name }} <small class="text-muted">({{ $user->email }})</small>
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
  
                        <input type="text" class="form-control mb-4" placeholder="Please enter subject" name="subject" value="">
                        <textarea class="form-control longheight" placeholder="Please enter content" name="content" id="emilnote"></textarea>
                        <button type="submit" class="themeBtn text-white mt-4">Sent</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        ClassicEditor
            .create(document.querySelector('#emilnote'), {
                toolbar: [
                    'bold', 'italic',
                    '|', 'bulletedList', 'numberedList',
                    '|', 'link', 'undo', 'redo'
                ]
            })
            .then(editor => {
                console.log('Editor initialized', editor);
            })
            .catch(error => {
                console.error(error);
            });
    });
   document.getElementById('sendType').addEventListener('change', function () {
    document.getElementById('userCheckboxes').style.display =
        this.value === 'selected' ? 'block' : 'none';
});

// Multi-select dropdown functionality
const multiSelectButton = document.getElementById('multiSelectButton');
const dropdownMenu = document.getElementById('dropdownMenu');
const userCheckboxes = document.querySelectorAll('.user-checkbox');
const selectedCountSpan = document.getElementById('selectedCount');
const userSearch = document.getElementById('userSearch');
const selectAllBtn = document.getElementById('selectAll');
const deselectAllBtn = document.getElementById('deselectAll');

// Toggle dropdown
multiSelectButton.addEventListener('click', function(e) {
    e.stopPropagation();
    dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
});

// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.multi-select-dropdown')) {
        dropdownMenu.style.display = 'none';
    }
});

// Prevent dropdown close when clicking inside
dropdownMenu.addEventListener('click', function(e) {
    e.stopPropagation();
});

// Update selected count
function updateSelectedCount() {
    const checkedCount = document.querySelectorAll('.user-checkbox:checked').length;
    if (checkedCount === 0) {
        selectedCountSpan.textContent = 'Select users...';
    } else if (checkedCount === 1) {
        selectedCountSpan.textContent = '1 user selected';
    } else {
        selectedCountSpan.textContent = checkedCount + ' users selected';
    }
}

// Listen to checkbox changes
userCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateSelectedCount);
});

// Select All
selectAllBtn.addEventListener('click', function() {
    const visibleCheckboxes = document.querySelectorAll('.user-item:not([style*="display: none"]) .user-checkbox');
    visibleCheckboxes.forEach(cb => cb.checked = true);
    updateSelectedCount();
});

// Deselect All
deselectAllBtn.addEventListener('click', function() {
    const visibleCheckboxes = document.querySelectorAll('.user-item:not([style*="display: none"]) .user-checkbox');
    visibleCheckboxes.forEach(cb => cb.checked = false);
    updateSelectedCount();
});

// Live search
userSearch.addEventListener('keyup', function () {
    const search = this.value.toLowerCase();
    const users = document.querySelectorAll('.user-item');

    users.forEach(function (user) {
        const text = user.textContent.toLowerCase();
        user.style.display = text.includes(search) ? 'block' : 'none';
    });
});
</script>
@endpush


