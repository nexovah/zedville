@extends('layouts.admin')

@section('title', 'Sent Emails')

@section('content')
<div class="adminHeading">
    <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">Communication</h1>
</div>

<div class="row">
    <div class="col-12">
        <div class="haveSidenav">
            {{-- LEFT SIDE NAV --}}
            <div class="leftInnernavSec innpageSidenav">
               <ul class="navItems mt-5">
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

            {{-- RIGHT SIDE CONTENT --}}
            <div class="innerContentSec">
                <nav class="themeBreadcrumb mab-30">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Communication</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sent Emails</li>
                    </ol>
                </nav>

                <div class="innerPageContent border-1 border-color rounded pall-30">
                    <div class="row minh-450px ">
                        {{-- LEFT: Sent Emails List --}}
                        <div class="col-md-4 pe-3" style="max-height:450px; overflow-y:auto;">
                            <h5 class="mb-3">Sent Emails</h5>
                            @forelse ($emails as $email)
                            @php 
                                $isFirst = $loop->first;
                            @endphp
                            <div 
                                data-subject="{{ $email->subject }}"
                                data-content="{{ $email->content }}"
                                data-created-time="{{ $email->created_at->format('h:i A') }}"
                                data-created-date="{{ $email->created_at->format('jS M Y') }}"
                                data-recipient-name="{{ $email->student->name ?? 'All Users' }}"
                                data-recipient-email="{{ $email->student->email ?? 'All Users' }}"
                                class="email-item border rounded p-3 mb-2 {{ $isFirst ? 'active' : '' }}"
                                style="cursor: pointer;"
                            >
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 text-truncate fw-semibold">{{ $email->subject }}</h6>
                                        <small class="text-muted d-block text-truncate">To: {{ $email->student->name ?? 'All Users' }}</small>
                                    </div>
                                    <div class="text-end ms-2">
                                        <small class="d-block">{{ $email->created_at->format('h:i A') }}</small>
                                        <small class="d-block text-muted">{{ $email->created_at->format('jS M') }}</small>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-center p-4 text-muted">
                                No sent emails found
                            </div>
                            @endforelse
                        </div>

                        {{-- RIGHT: Email Content --}}
                        <div class="col-md-8 p-3 border rounded" style="max-height:450px; overflow-y:auto;">
                            @if($emails->first())
                            <div>
                                <h5 class="mb-3" id="emailSubject">{{ $emails->first()->subject }}</h5>
                                <div class="mb-3">
                                    <p class="mb-1"><strong>To:</strong> <span id="recipientName">{{ $emails->first()->student->name ?? 'All Users' }}</span> (<span id="recipientEmail">{{ $emails->first()->student->email ?? 'All Users' }}</span>)</p>
                                    <p class="mb-1"><strong>Sent:</strong> <span id="emailTime">{{ $emails->first()->created_at->format('h:i A') }}</span> - <span id="emailDate">{{ $emails->first()->created_at->format('jS M Y') }}</span></p>
                                </div>
                                <hr>
                                <div id="emailContent">
                                    {!! $emails->first()->content !!}
                                </div>
                            </div>
                            @else
                            <div class="text-center p-4 text-muted">
                                <p>Select an email to view its content</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const emailItems = document.querySelectorAll('.email-item');
    
    // Click event to switch emails
    emailItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active from all
            emailItems.forEach(i => i.classList.remove('active'));

            // Add active to clicked
            this.classList.add('active');

            // Show content
            document.getElementById('emailSubject').innerText = this.dataset.subject;
            document.getElementById('emailContent').innerHTML = this.dataset.content;
            document.getElementById('emailTime').innerText = this.dataset.createdTime;
            document.getElementById('emailDate').innerText = this.dataset.createdDate;
            document.getElementById('recipientName').innerText = this.dataset.recipientName;
            document.getElementById('recipientEmail').innerText = this.dataset.recipientEmail;
        });
    });
});
</script>

<style>
.email-item {
    cursor: pointer;
    transition: all 0.3s ease;
    background-color: #fff;
}

.email-item:hover {
    background-color: #f0f8f6;
    border-color: #00A47D !important;
}

.email-item.active {
    background-color: #00A47D;
    border-color: #016950 !important;
    color: #fff !important;
}

.email-item.active h6,
.email-item.active small,
.email-item.active .text-muted {
    color: #fff !important;
}
</style>
@endpush
