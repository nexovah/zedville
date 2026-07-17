@extends('layouts.profile')

@section('title', 'Calendar ')

@section('content')
@push('styles')
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
<style>
:root {
    --primary-color: #6b7280;
    --primary-dark: #4b5563;
}

.calendar-container {
    /* background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    padding: 20px; */
}

.fc {
    font-family: 'Arial', sans-serif;
}

.fc-button-primary {
    background-color: var(--primary-color) !important;
    border-color: var(--primary-color) !important;
}

.fc-button-primary:hover {
    background-color: var(--primary-dark) !important;
    border-color: var(--primary-dark) !important;
}

.fc-button-primary:not(:disabled).fc-button-active {
    background-color: var(--primary-dark) !important;
}

.fc-event {
    cursor: pointer;
    border: none;
    padding: 2px 4px;
    border-radius: 4px;
    position: relative;
}

.fc-event::before {
    content: '';
    position: absolute;
    left: 4px;
    top: 50%;
    transform: translateY(-50%);
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: inherit;
    border: 2px solid rgba(255, 255, 255, 0.9);
    box-shadow: 0 0 3px rgba(0,0,0,0.3);
}

.fc-event .fc-event-title {
    padding-left: 16px;
}

/* Modal Styles */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.modal-overlay.show {
    display: flex;
}

.modal-content {
    background: #fff;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    padding: 20px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 20px;
}

.modal-body {
    padding: 20px;
}

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #333;
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 14px;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
}

.btn {
    padding: 10px 20px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
}

.btn-primary {
    background: var(--primary-color);
    color: #fff;
}

.btn-primary:hover {
    background: var(--primary-dark);
}

.btn-secondary {
    background: #6b7280;
    color: #fff;
}

.btn-secondary:hover {
    background: #4b5563;
}

.btn-danger {
    background: #ef4444;
    color: #fff;
}

.btn-danger:hover {
    background: #dc2626;
}

.close-btn {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #6b7280;
    padding: 0;
    width: 30px;
    height: 30px;
}

.modal-footer {
    padding: 15px 20px;
    border-top: 1px solid #e5e7eb;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.event-detail {
    margin-bottom: 12px;
}

.event-detail strong {
    display: block;
    margin-bottom: 4px;
    color: #6b7280;
    font-size: 12px;
    text-transform: uppercase;
}
</style>
@endpush
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Calendar</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="calendar-container">
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- View Activity Modal -->
<div class="modal-overlay" id="viewModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Activity Details</h3>
            <button class="close-btn" onclick="closeViewModal()">&times;</button>
        </div>
        <div class="modal-body" id="eventDetails">
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeViewModal()">Close</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
<script>

let calendar;
let currentEvent = null;
let events = [];

// API Configuration
const API_BASE_URL = '{{ url('/api/admin/calendar-events') }}';

// Clear any old localStorage data from previous implementation
localStorage.removeItem('calendarEvents');



// Load events from localStorage or dummy data (NOT USED - Using API instead)
// function loadEvents() {
//     const stored = localStorage.getItem('calendarEvents');
//     if (stored) {
//         events = JSON.parse(stored);
//     } else {
//         // Load dummy data on first load
//         events = dummyEvents;
//         saveEvents();
//     }
//     return events;
// }

// Save events to localStorage (NOT USED - Using API instead)
// function saveEvents() {
//     localStorage.setItem('calendarEvents', JSON.stringify(events));
// }

// Initialize Calendar
document.addEventListener('DOMContentLoaded', async function() {
    const calendarEl = document.getElementById('calendar');
    
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        editable: false,
        selectable: false,
        selectMirror: false,
        dayMaxEvents: true,
        
        // Load events from API
        events: async function (info, successCallback, failureCallback) {
            try {
                const response = await fetch(API_BASE_URL, {
                    headers: {
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]')
                            ?.content
                    }
                });

                if (!response.ok) {
                    throw new Error('Failed to load events');
                }

                const data = await response.json();
                successCallback(data);
            } catch (error) {
                console.error('Error fetching events:', error);
                failureCallback(error);
            }
        },
        
        // Apply custom styling after event is mounted
        eventDidMount: function(info) {
            const color = info.event.backgroundColor || '#6b7280';
            const textColor = getContrastColor(color);
            
            // Apply background color and text color
            info.el.style.backgroundColor = color;
            info.el.style.borderColor = color;
            
            // Set text color for better contrast
            const titleEl = info.el.querySelector('.fc-event-title, .fc-event-main, .fc-list-event-title');
            if (titleEl) {
                titleEl.style.color = textColor;
            }
            
            // Also set color for all text elements within the event
            info.el.style.color = textColor;
        },
        
        // Click on event to view
        eventClick: function(info) {
            currentEvent = info.event;
            showEventDetails(info.event);
        }
    });
    
    calendar.render();
});



// Show Activity Details
function showEventDetails(event) {
    const details = `
        <div class="event-detail">
            <strong>Title</strong>
            <div>${event.title}</div>
        </div>
        ${event.extendedProps.class ? `
            <div class="event-detail">
                <strong>Class</strong>
                <div>${event.extendedProps.class}</div>
            </div>
        ` : ''}
        ${event.extendedProps.position ? `
            <div class="event-detail">
                <strong>Position</strong>
                <div>${event.extendedProps.position}</div>
            </div>
        ` : ''}
        <div class="event-detail">
            <strong>Start Date</strong>
            <div>${formatDate(event.start)}</div>
        </div>
        ${event.extendedProps.repeat_activity ? `
            <div class="event-detail">
                <strong>End Date</strong>
                <div>${formatDate(event.end || event.start)}</div>
            </div>
            <div class="event-detail">
                <strong>Repeat Activity Monthly</strong>
                <div>Yes</div>
            </div>
        ` : ''}
        ${event.extendedProps.description ? `
            <div class="event-detail">
                <strong>Description</strong>
                <div>${event.extendedProps.description}</div>
            </div>
        ` : ''}
    `;
    
    document.getElementById('eventDetails').innerHTML = details;
    document.getElementById('viewModal').classList.add('show');
}

// Close View Modal
function closeViewModal() {
    document.getElementById('viewModal').classList.remove('show');
    currentEvent = null;
}



// Format date for date input (YYYY-MM-DD)
function formatDateOnly(date) {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}`;
}

// Format date for datetime-local input
function formatDateTimeLocal(date) {
    const d = new Date(date);
    const year = d.getFullYear();
    const month = String(d.getMonth() + 1).padStart(2, '0');
    const day = String(d.getDate()).padStart(2, '0');
    const hours = String(d.getHours()).padStart(2, '0');
    const minutes = String(d.getMinutes()).padStart(2, '0');
    return `${year}-${month}-${day}T${hours}:${minutes}`;
}

// Format date for display
function formatDate(date) {
    if (!date) return '';
    const d = new Date(date);
    return d.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric'
    });
}

// Format date for display with time
function formatDateTime(date) {
    if (!date) return '';
    const d = new Date(date);
    return d.toLocaleString('en-US', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

// Get contrast color for text based on background
function getContrastColor(hexColor) {
    // Convert hex to RGB
    const r = parseInt(hexColor.substr(1, 2), 16);
    const g = parseInt(hexColor.substr(3, 2), 16);
    const b = parseInt(hexColor.substr(5, 2), 16);
    
    // Calculate luminance
    const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
    
    // Return white for dark backgrounds, black for light backgrounds
    return luminance > 0.5 ? '#000000' : '#ffffff';
}

// Close modals on outside click
document.getElementById('viewModal').addEventListener('click', function(e) {
    if (e.target === this) closeViewModal();
});
</script>
@endpush