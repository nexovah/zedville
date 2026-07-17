@extends('layouts.admin')

@section('title', 'Email Template')

@section('content')
<div class="adminHeading">
    <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">Email Template</h1>
</div>
<!-- Body Widget -->
<div class="row">
    <div class="col-12">
        <div class="haveSidenav">
            <div class="leftInnernavSec innpageSidenav">
                <h4 class="fs-14 fw-500 theme-text-color mab-15 border-bottom-1 pab-15 border-color">Template List</h4>
                <ul class="navItems">
                    <li class="has-children">
                        <a href="javasctipt:void(0);" aria-expanded="false" class="havChild">
                            <span class="navTxt">Account</span>
                        </a>
                        <ul class="subNav collasped">
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=1' }}">
                                    <span class="navTxt">Welcome</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=2' }}">
                                    <span class="navTxt">Citizen ID</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="javasctipt:void(0);" aria-expanded="false" class="havChild">
                            <span class="navTxt">City Mall</span>
                        </a>
                        <ul class="subNav collasped">
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=3' }}">
                                    <span class="navTxt">City Bank</span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="has-children">
                        <a href="javasctipt:void(0);" aria-expanded="false" class="havChild">
                            <span class="navTxt">Bank Transaction</span>
                        </a>
                        <ul class="subNav collasped">
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=4' }}">
                                    <span class="navTxt">Account ready</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=5' }}">
                                    <span class="navTxt">FIRST SALARY NOTIFICATION</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=6' }}">
                                    <span class="navTxt">Direct Deposit</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=7' }}">
                                    <span class="navTxt">School Auto Debit</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=8' }}">
                                    <span class="navTxt">Internet provider Auto Debit</span>
                                </a>
                            </li>
                            <li>
                                <a href="#{{ url('admin/email-template') .'?id=9' }}">
                                    <span class="navTxt">Electricity Auto Debit</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/email-template') .'?id=10' }}">
                                    <span class="navTxt">Water Auto Debit</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li class="has-children">
                        <a href="#">
                            <span class="navTxt">Menu Items 5</span>
                        </a>
                    </li> -->
                </ul>
            </div>
            <div class="innerContentSec">
                <nav class="themeBreadcrumb mab-30 d-flex align-items-center gap-2">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">All</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{!! $emailTemplate->store_name !!}</li>
                    </ol>
                    <div class="info-icon-wrapper position-relative">
                        <i class="fas fa-info-circle theme-text-color" style="cursor: pointer; font-size: 16px;"></i>
                        <div class="info-tooltip">
                            {!! $emailTemplate->subTitle !!}
                        </div>
                    </div>
                </nav>
                <style>
                    .info-icon-wrapper {
                        display: inline-block;
                    }
                    .info-tooltip {
                        position: absolute;
                        left: 25px;
                        top: 50%;
                        transform: translateY(-50%);
                        background: #333;
                        color: white;
                        padding: 8px 12px;
                        border-radius: 6px;
                        font-size: 13px;
                        white-space: nowrap;
                        opacity: 0;
                        visibility: hidden;
                        transition: opacity 0.3s, visibility 0.3s;
                        z-index: 1000;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                    }
                    .info-tooltip::before {
                        content: '';
                        position: absolute;
                        left: -5px;
                        top: 50%;
                        transform: translateY(-50%);
                        border-width: 5px 5px 5px 0;
                        border-style: solid;
                        border-color: transparent #333 transparent transparent;
                    }
                    .info-icon-wrapper:hover .info-tooltip {
                        opacity: 1;
                        visibility: visible;
                    }
                </style>
                <div class="innerPageContent minh-450px border-1 border-color pall-30">
                     <form action="{{ url('admin/email-template') .'/'.$emailTemplate->id }}" class="themeForm" method="POST">
                        @csrf
                        <input type="text" class="form-control mb-4" placeholder="Please enter" name="subject" value="{!! $emailTemplate->subject !!}">
                        <textarea class="form-control longheight" placeholder="Please enter" name="content" id="emilnote">{!! $emailTemplate->content !!}</textarea>
                        <button type="submit" class="themeBtn text-white mt-4">Update</button>
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
</script>
@endpush


