@extends('layouts.admin')

@section('title', 'Role')

@section('content')
@push('styles')
<style>
    :root {
      --bg: #f7f8fa;
      --drawer: #ffffff;
      --text: #101828;
      --muted: #667085;
      --line: #d9dee7;
      --soft-line: #e7ebf0;
      --section: #eef3f9;
      --field: #ffffff;
      --field-fill: #eaf2ff;
      --primary: #009879;
      --primary-dark: #007f66;
      --blue: #2563eb;
      --check: #667085;
      --shadow: 0 20px 50px rgba(16, 24, 40, 0.18);
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    * {
      box-sizing: border-box;
    }

   

    .app-shell {
      min-height: 100vh;
      display: grid;
      grid-template-columns: 72px 1fr;
      background: #f4f6f8;
    }

    .sidebar {
      border-right: 1px solid #d5dbe4;
      background: #eef1f4;
      padding: 16px 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 22px;
    }

    .logo {
      width: 26px;
      height: 26px;
      border-radius: 5px;
      background: #101828;
      color: #fff;
      display: grid;
      place-items: center;
      font-weight: 800;
      transform: skew(-10deg);
    }

    .nav-icon {
      width: 38px;
      height: 38px;
      display: grid;
      place-items: center;
      color: #1f2937;
      font-size: 17px;
      border-left: 3px solid transparent;
    }

    .nav-icon.active {
      color: #00856d;
      border-left-color: #00856d;
      background: rgba(0, 152, 121, 0.08);
    }

    .page {
      padding: 30px;
    }

    .page h1 {
      margin: 0 0 22px;
      font-size: 18px;
      font-weight: 700;
    }

    .table-card {
      max-width: 720px;
      border: 1px solid #d5dbe4;
      border-radius: 4px;
      background: #fff;
      padding: 30px;
    }

    .search-row {
      display: flex;
      gap: 8px;
      margin-bottom: 22px;
    }

    .search-row input {
      width: 300px;
      height: 44px;
      border: 1px solid #bfc7d3;
      border-radius: 4px;
      padding: 0 14px;
      color: #667085;
    }

    .search-row button {
      border: 0;
      border-radius: 4px;
      background: #006b5a;
      color: #fff;
      padding: 0 22px;
      font-weight: 600;
    }

    .fake-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 14px;
    }

    .fake-table th,
    .fake-table td {
      padding: 13px 8px;
      border-bottom: 1px solid #dfe4ea;
      text-align: left;
      font-weight: 500;
    }

    .overlay {
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.48);
      display: flex;
      justify-content: flex-end;
      align-items: stretch;
    }

    .drawer {
      width: min(760px, 100vw);
      background: var(--drawer);
      box-shadow: var(--shadow);
      display: grid;
      grid-template-rows: auto 1fr auto;
      min-height: 100vh;
    }

    .drawer-header {
      height: 62px;
      border-bottom: 1px solid var(--line);
      padding: 0 28px 0 24px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .drawer-title {
      margin: 0;
      font-size: 17px;
      line-height: 1;
      font-weight: 800;
      color: #050b18;
    }

    .close {
      border: 0;
      background: transparent;
      color: #9a9a9a;
      font-size: 30px;
      line-height: 1;
      cursor: pointer;
      padding: 2px;
    }

    .drawer-body {
      overflow: auto;
      padding: 28px 30px 0 24px;
      scrollbar-color: #9ea3aa #f1f3f5;
      display: flex;
      min-height: 0;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 22px 24px;
      margin-bottom: 24px;
    }

    .field.full {
      grid-column: 1 / -1;
    }

    label {
      display: block;
      margin-bottom: 9px;
      font-size: 14px;
      font-weight: 500;
      color: #050b18;
    }

    input[type="text"],
    select,
    textarea {
      width: 100%;
      min-height: 42px;
      border: 1px solid #bfc7d3;
      border-radius: 4px;
      background: var(--field);
      padding: 0 12px;
      font: inherit;
      font-size: 14px;
      color: #111827;
      outline: none;
    }

    select {
      appearance: none;
      background-image:
        linear-gradient(45deg, transparent 50%, #374151 50%),
        linear-gradient(135deg, #374151 50%, transparent 50%);
      background-position:
        calc(100% - 18px) 18px,
        calc(100% - 12px) 18px;
      background-size: 6px 6px, 6px 6px;
      background-repeat: no-repeat;
      padding-right: 34px;
    }

    .role-help {
      margin: -2px 0 24px;
      color: var(--muted);
      font-size: 13px;
      line-height: 1.45;
    }

    .permission-card {
      border: 1px solid var(--line);
      border-radius: 4px;
      overflow: hidden;
      background: #fff;
      display: flex;
      flex: 1;
      min-height: 0;
      flex-direction: column;
    }

    .permission-top {
      min-height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 22px;
      border-bottom: 1px solid var(--line);
      background: #fff;
    }

    .permission-top h2 {
      margin: 0;
      font-size: 22px;
      line-height: 1;
      font-weight: 700;
      color: #101828;
    }

    .permission-top p {
      margin: 7px 0 0;
      font-size: 14px;
      color: #374151;
    }

    .permission-label {
      height: 45px;
      padding: 0 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #f8fafc;
      border-bottom: 1px solid var(--line);
      color: #667085;
      font-size: 13px;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }

    .permission-list {
      flex: 1;
      min-height: 0;
      overflow: auto;
      scrollbar-color: #b6b8bd #f2f4f7;
    }

    .perm-row {
      min-height: 40px;
      display: grid;
      grid-template-columns: 34px 1fr auto;
      align-items: center;
      gap: 0;
      padding: 0 14px;
      border-bottom: 1px solid var(--soft-line);
      font-size: 16px;
      color: #111827;
    }

    .perm-row.child {
      font-weight: 400;
    }

    .perm-row.group {
      min-height: 44px;
      background: var(--section);
      font-weight: 600;
      cursor: pointer;
    }

    .perm-row.child.indent .perm-name {
      padding-left: 22px;
    }

    .perm-row.child.is-hidden {
      display: none;
    }

    .group-title {
      display: flex;
      align-items: center;
      gap: 10px;
      min-width: 0;
    }

    .chevron {
      color: #667085;
      font-size: 15px;
      transition: transform 0.16s ease;
    }

    .perm-row.group.is-collapsed .chevron {
      transform: rotate(-90deg);
    }

    .count {
      color: #667085;
      font-weight: 500;
      font-size: 16px;
    }

    input[type="checkbox"] {
      width: 16px;
      height: 16px;
      margin: 0;
      accent-color: var(--check);
      cursor: pointer;
    }

    .drawer-footer {
      height: 74px;
      border-top: 1px solid var(--line);
      display: flex;
      justify-content: flex-end;
      align-items: center;
      gap: 8px;
      padding: 0 30px;
      background: #fff;
    }

    .footer-btn {
      height: 32px;
      padding: 0 17px;
      border-radius: 4px;
      font-weight: 600;
      cursor: pointer;
    }

    .footer-btn.close-btn {
      border: 1px solid #c8d0dc;
      background: #fff;
      color: #6b7280;
    }

    .footer-btn.save-btn {
      border: 1px solid var(--primary);
      background: var(--primary);
      color: #fff;
    }

    .footer-btn.save-btn:hover {
      background: var(--primary-dark);
    }

    @media (max-width: 760px) {
      .drawer {
        width: 100vw;
      }

      .drawer-body {
        padding: 22px 16px 0;
      }

      .form-grid {
        grid-template-columns: 1fr;
      }

      .permission-top {
        min-height: 82px;
        align-items: center;
        padding: 18px;
      }
    }
  </style>
@endpush
    <div class="adminHeading">
        <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">Role</h1>
    </div>
    <!-- Body Widget -->
    <div class="row">
        <div class="themeCard card card-custom card-stretch gutter-b mab-15">
            <div class="card-body pall-30">
                @if(session('success'))
                    <div id="success-message" class="alert alert-success" style="margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="tableHeadAdvance themeForm">
                    <div class="dataTableAdvan">
                        <div class="tableHeadAdvance mab-15">
                            <div class="row gap-2 justify-content-between">
                                <div class="form-group gap-2 d-flex justify-content-between">
                                    <form method="GET" action="{{ url('admin/role') }}" class="mb-0">
                                    <div class="leftpanel d-flex gap-2">
                                        
                                            <div class="input-group w-300px custom-input">
                                                <span class="input-group-text bg-transparent border-0 theme-text-mute pe-1">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                                <input type="text" class="form-control fs-14" name="search" value="{{ request('search') }}" placeholder="Search Role Name" />
                                            </div>
                                            <button type="submit" class="themeBtn text-white">Search</button>
                                        
                                    </div>
                                    </form>
                                    <div class="rightpanel d-flex gap-2">
                                        <button class="themeBtnGray theme-text-dark" data-bs-toggle="modal" data-bs-target="#addmodel">Add Role</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="themeTable">
                    <div class="table-responsive">
                        @if($roles->isEmpty())
                            <p>No roles available.</p>
                        @else
                        <table class="table w-100">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Role</th>
                                    <th class="rightText">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($roles as $role)
                                @php
                                $i++;
                                @endphp
                                <tr>
                                    <td valign="middle"><a class="theme-text-dark">{{$i}}</a></td>
                                    <td valign="middle">{{ $role->name }}</td>
                                    <td valign="middle">
                                        <div class="actionBtns d-flex align-items-center justify-content-end">
                                            <a href="#" class="tableActionBtn me-3 edit-role-btn" data-bs-toggle="modal" data-bs-target="#editmodel" data-id="{{ $role->id }}" data-name="{{ $role->name }}">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit">
                                                    <path d="M16 4.99994L19 7.99994" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M4.50001 16.4994L18.4999 2.49994L21.5004 5.49994L7.50041 19.4999L3 20.9995L4.50001 16.4994Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M5 16.9999L7 18.9999" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>    
                                            <!-- <a href="{{ url('admin/role/details', $role->id) }}" class="tableActionBtn me-3" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Details" data-bs-original-title="Detail"> -->
                                                <a href="{{ url('admin/role/details', $role->id) }}" class="tableActionBtn me-3" data-bs-toggle="modal" data-bs-target="#addstudent">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19 2H5C4.44772 2 4 2.44772 4 3V21C4 21.5523 4.44772 22 5 22H19C19.5523 22 20 21.5523 20 21V3C20 2.44772 19.5523 2 19 2Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"></path>
                                                    <path d="M10.5 7H16.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M10.5 12H16.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M10.5 17H16.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 8C8.0523 8 8.5 7.5523 8.5 7C8.5 6.4477 8.0523 6 7.5 6C6.9477 6 6.5 6.4477 6.5 7C6.5 7.5523 6.9477 8 7.5 8Z" fill="currentColor"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 13C8.0523 13 8.5 12.5523 8.5 12C8.5 11.4477 8.0523 11 7.5 11C6.9477 11 6.5 11.4477 6.5 12C6.5 12.5523 6.9477 13 7.5 13Z" fill="currentColor"></path>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5 18C8.0523 18 8.5 17.5523 8.5 17C8.5 16.4477 8.0523 16 7.5 16C6.9477 16 6.5 16.4477 6.5 17C6.5 17.5523 6.9477 18 7.5 18Z" fill="currentColor"></path>
                                                </svg>
                                            </a>
                                            <a href="#" class="deleteBtn" data-bs-toggle="modal" data-bs-target="#confirmModal" data-url="{{ url('admin/role/delete', $role->id) }}">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete">
                                                    <path d="M4 5.5H20" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M9 2.5H15" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M6 8.5H18V20C18 20.8285 17.3285 21.5 16.5 21.5H7.5C6.67155 21.5 6 20.8285 6 20V8.5Z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>  
<!-- Add Model -->
<section class="themeModal">
    <form action="{{ url('admin/role/add') }}" method="post">
         @csrf
        <div class="modal fade" id="addmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-460px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-16 fw-700 theme-text-dark" id="exampleModalLabel">Add Role</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pall-30">
                        <div class="themeForm">
                            <div class="form-group mab-20">
                                <label for="" class="form-label">Role Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Please Role Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center justify-content-center">
                        <button type="button" class="secondaryBtn theme-text-mute" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="themeBtn text-white">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<!-- Edit Model -->
 <section class="themeModal">
    <form id="editRoleForm" method="post">
         @csrf
          @method('PUT')
        <div class="modal fade" id="editmodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-460px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title fs-16 fw-700 theme-text-dark" id="exampleModalLabel">Edit Role</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pall-30">
                        <div class="themeForm">
                            <input type="hidden" name="role_id" id="role_id" />
                            <div class="form-group mab-20">
                                <label for="" class="form-label">Role Name</label>
                                <input class="form-control" type="text" name="name" id="role_name" placeholder="Please Role Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer text-center justify-content-center">
                        <button type="button" class="secondaryBtn theme-text-mute" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="themeBtn text-white">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
 <!-- Delete Model -->
<section class="themeModal">
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-350px">
            <form id="modalDeleteForm" method="POST">
                @csrf
                @method('DELETE')

                <input type="hidden" id="delete_code" name="delete_code">

                <div class="modal-content">
                    <div class="modal-body text-center pall-60">
                        <h4 class="fs-18 fw-700 mab-20">Are you sure?</h4>
                        <p>You won't be able to revert this!</p>

                        <div class="alert alert-warning">
                            Please enter this number to confirm deletion:
                            <h3 id="randomNumber" class="mt-2"></h3>
                        </div>

                        <div class="mb-3">
                            <input type="text"
                                name="confirm_code"
                                class="form-control"
                                placeholder="Enter the number shown above"
                                required>
                        </div>

                        <div class="text-center mat-40">
                            <button type="submit" class="themeBtn text-white">
                                Yes Delete it!
                            </button>

                            <button type="button"
                                    class="secondaryBtn theme-text-mute"
                                    data-bs-dismiss="modal">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<section class="themeModal rightSide rightsideSticky">

    <form action="#" method="post">
        @csrf
        <div class="modal fade" id="addstudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px w-100 m-0 h-100">
                <div class="modal-content h-100">
                    

                <div class="overlay">
                    <aside class="drawer" aria-label="Role permission drawer">
                    <header class="drawer-header">
                        <h1 class="drawer-title">Role Permission</h1>
                        <button class="close" type="button" aria-label="Close drawer" data-bs-dismiss="modal">&times;</button>
                    </header>

                    <section class="drawer-body">
                        <section class="permission-card">
                        <div class="permission-top">
                            <div>
                            <h2 id="permissionTitle">CRM Admin</h2>
                            <p id="permissionSubtitle">See and edit all CRM data, manage workspace-level setup and settings</p>
                            </div>
                        </div>

                        <div class="permission-label">
                            <span>Permissions</span>
                            <span id="overallCount">0/0</span>
                        </div>

                        <div class="permission-list" id="permissionList">
                            <div class="perm-row group" data-group="deals">
                            <input type="checkbox" data-group-toggle="deals" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Deals</span></span>
                            <span class="count" data-count="deals">6/6</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="deals" data-feature="add-deals" checked />
                            <span class="perm-name">Add deals</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="deals" data-feature="edit-deals" checked />
                            <span class="perm-name">Edit deals</span>
                            <span></span>
                            </label>
                            <label class="perm-row child indent">
                            <input type="checkbox" data-group="deals" data-feature="edit-deals-other" checked />
                            <span class="perm-name">Edit deals owned by other users</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="deals" data-feature="delete-deals" checked />
                            <span class="perm-name">Delete deals</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="deals" data-feature="convert-deals" checked />
                            <span class="perm-name">Convert deals to leads</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="deals" data-feature="merge-deals" checked />
                            <span class="perm-name">Merge deals</span>
                            <span></span>
                            </label>

                            <div class="perm-row group" data-group="leads">
                            <input type="checkbox" data-group-toggle="leads" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Leads</span></span>
                            <span class="count" data-count="leads">5/5</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="leads" data-feature="add-leads" checked />
                            <span class="perm-name">Add leads</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="leads" data-feature="edit-leads" checked />
                            <span class="perm-name">Edit leads</span>
                            <span></span>
                            </label>
                            <label class="perm-row child indent">
                            <input type="checkbox" data-group="leads" data-feature="edit-leads-other" checked />
                            <span class="perm-name">Edit leads owned by other users</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="leads" data-feature="delete-leads" checked />
                            <span class="perm-name">Delete leads</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="leads" data-feature="convert-leads" checked />
                            <span class="perm-name">Convert leads to deals</span>
                            <span></span>
                            </label>

                            <div class="perm-row group" data-group="clients">
                            <input type="checkbox" data-group-toggle="clients" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Clients &amp; Contacts</span></span>
                            <span class="count" data-count="clients">5/5</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="clients" data-feature="add-clients" checked />
                            <span class="perm-name">Add clients &amp; contacts</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="clients" data-feature="edit-clients" checked />
                            <span class="perm-name">Edit clients</span>
                            <span></span>
                            </label>
                            <label class="perm-row child indent">
                            <input type="checkbox" data-group="clients" data-feature="edit-contacts-other" checked />
                            <span class="perm-name">Edit contacts owned by other users</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="clients" data-feature="delete-clients" checked />
                            <span class="perm-name">Delete clients</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="clients" data-feature="merge-contacts" checked />
                            <span class="perm-name">Merge duplicate contacts</span>
                            <span></span>
                            </label>

                            <div class="perm-row group" data-group="activities">
                            <input type="checkbox" data-group-toggle="activities" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Activities</span></span>
                            <span class="count" data-count="activities">4/4</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="activities" data-feature="add-activities" checked />
                            <span class="perm-name">Add activities</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="activities" data-feature="edit-activities" checked />
                            <span class="perm-name">Edit activities</span>
                            <span></span>
                            </label>
                            <label class="perm-row child indent">
                            <input type="checkbox" data-group="activities" data-feature="edit-activities-other" checked />
                            <span class="perm-name">Edit activities of other users</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="activities" data-feature="delete-activities" checked />
                            <span class="perm-name">Delete activities</span>
                            <span></span>
                            </label>

                            <div class="perm-row group" data-group="invoices">
                            <input type="checkbox" data-group-toggle="invoices" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Invoices</span></span>
                            <span class="count" data-count="invoices">5/5</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="invoices" data-feature="create-invoices" checked />
                            <span class="perm-name">Create invoices</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="invoices" data-feature="edit-invoices" checked />
                            <span class="perm-name">Edit invoices</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="invoices" data-feature="delete-invoices" checked />
                            <span class="perm-name">Delete invoices</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="invoices" data-feature="send-invoices" checked />
                            <span class="perm-name">Send invoices to clients</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="invoices" data-feature="record-payments" checked />
                            <span class="perm-name">Record payments</span>
                            <span></span>
                            </label>

                            <div class="perm-row group" data-group="documents">
                            <input type="checkbox" data-group-toggle="documents" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Proposals &amp; Documents</span></span>
                            <span class="count" data-count="documents">5/5</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="documents" data-feature="create-documents" checked />
                            <span class="perm-name">Create proposals &amp; documents</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="documents" data-feature="edit-proposals" checked />
                            <span class="perm-name">Edit proposals</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="documents" data-feature="delete-proposals" checked />
                            <span class="perm-name">Delete proposals</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="documents" data-feature="share-proposals" checked />
                            <span class="perm-name">Share proposals externally</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="documents" data-feature="request-signatures" checked />
                            <span class="perm-name">Request e-signatures</span>
                            <span></span>
                            </label>

                            <div class="perm-row group" data-group="campaigns">
                            <input type="checkbox" data-group-toggle="campaigns" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Campaigns</span></span>
                            <span class="count" data-count="campaigns">3/3</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="campaigns" data-feature="view-campaigns" checked />
                            <span class="perm-name">View campaigns</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="campaigns" data-feature="create-campaigns" checked />
                            <span class="perm-name">Create &amp; send campaigns</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="campaigns" data-feature="delete-campaigns" checked />
                            <span class="perm-name">Delete campaigns</span>
                            <span></span>
                            </label>

                            <div class="perm-row group" data-group="data">
                            <input type="checkbox" data-group-toggle="data" checked />
                            <span class="group-title"><span class="chevron">▾</span><span class="perm-name">Data Management</span></span>
                            <span class="count" data-count="data">5/5</span>
                            </div>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="data" data-feature="import-data" checked />
                            <span class="perm-name">Import data from spreadsheets</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="data" data-feature="export-data" checked />
                            <span class="perm-name">Export CRM data</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="data" data-feature="restore-data" checked />
                            <span class="perm-name">Restore deleted records</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="data" data-feature="manage-fields" checked />
                            <span class="perm-name">Manage custom fields</span>
                            <span></span>
                            </label>
                            <label class="perm-row child">
                            <input type="checkbox" data-group="data" data-feature="workspace-settings" checked />
                            <span class="perm-name">Workspace settings</span>
                            <span></span>
                            </label>
                        </div>
                        </section>
                    </section>

                    <footer class="drawer-footer">
                        <button class="footer-btn close-btn" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="footer-btn save-btn" type="button">Save changes</button>
                    </footer>
                    </aside>
                </div>
                </div>
            </div>
        </div>
    </form>
</section>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    // Populate modal when edit button is clicked
    $('.edit-role-btn').on('click', function() {
        var roleId = $(this).data('id');
        var roleName = $(this).data('name');

        $('#role_id').val(roleId);
        $('#role_name').val(roleName);
    });

    // AJAX form submit
    $('#editRoleForm').on('submit', function(e) {
        e.preventDefault();

        var roleId = $('#role_id').val();
        var formData = {
            _token: $('input[name="_token"]').val(),
            _method: 'PUT',
            name: $('#role_name').val()
        };
        var baseUrl = "{{ url('admin/role/edit') }}/";
        $.ajax({
            //url: '/admin/role/edit/' + roleId,
            url: baseUrl + roleId,
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#editmodel').modal('hide');
                //alert('Role updated successfully!');
                location.reload(); // Or update the row dynamically
            },
            error: function(xhr) {
                alert('Failed to update role.');
                console.log(xhr.responseText);
            }
        });
    });
    //Delete security
    $('.deleteBtn').on('click', function() {
    let randomNumber = Math.floor(1000 + Math.random() * 9000);

    $('#randomNumber').text(randomNumber);
    $('#delete_code').val(randomNumber);
});
});
//For role
const featureChecks = [...document.querySelectorAll("[data-feature]")];
    const groupToggles = [...document.querySelectorAll("[data-group-toggle]")];
    const groupRows = [...document.querySelectorAll(".perm-row.group")];
    const overallCount = document.querySelector("#overallCount");

    function updateCounts() {
      let selectedTotal = 0;
      let total = 0;

      groupToggles.forEach((toggle) => {
        const group = toggle.dataset.groupToggle;
        const children = featureChecks.filter((check) => check.dataset.group === group);
        const selected = children.filter((check) => check.checked).length;
        const count = document.querySelector(`[data-count="${group}"]`);

        total += children.length;
        selectedTotal += selected;
        toggle.checked = selected === children.length;
        toggle.indeterminate = selected > 0 && selected < children.length;
        count.textContent = `${selected}/${children.length}`;
      });

      overallCount.textContent = `${selectedTotal}/${total}`;
    }

    groupToggles.forEach((toggle) => {
      toggle.addEventListener("click", (event) => {
        event.stopPropagation();
      });

      toggle.addEventListener("change", () => {
        const group = toggle.dataset.groupToggle;
        featureChecks
          .filter((check) => check.dataset.group === group)
          .forEach((check) => {
            check.checked = toggle.checked;
          });
        updateCounts();
      });
    });

    groupRows.forEach((row) => {
      row.addEventListener("click", () => {
        const group = row.dataset.group;
        row.classList.toggle("is-collapsed");
        featureChecks
          .filter((check) => check.dataset.group === group)
          .forEach((check) => {
            check.closest(".perm-row").classList.toggle("is-hidden", row.classList.contains("is-collapsed"));
          });
      });
    });

    featureChecks.forEach((check) => {
      check.addEventListener("change", updateCounts);
    });

    updateCounts();
</script>

@endpush







