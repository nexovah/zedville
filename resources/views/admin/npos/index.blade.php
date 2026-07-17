@extends('layouts.admin')

@section('title', 'NPOs')

@section('content')
<div class="adminHeading">
    <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">NPOs</h1>
</div>
<!-- Body Widget -->
<div class="themeCard card card-custom card-stretch gutter-b mab-15">
    <div class="card-body pall-30">
        <div class="tableHeadAdvance themeForm">
            <div class="dataTableAdvan">
                <div class="tableHeadAdvance mab-15">
                    <div class="row gap-2 justify-content-between">
                        <div class="form-group gap-2 d-flex justify-content-between">
                            <form method="GET" action="{{ url('admin/npos') }}" class="mb-0">
                            <div class="leftpanel d-flex gap-2">
                                 
                                <div class="input-group w-300px custom-input">
                                    <span class="input-group-text bg-transparent border-0 theme-text-mute pe-1">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <input type="text" class="form-control fs-14" placeholder="Please enter NPOs name" name="search" value="{{ request('search') }}" />
                                </div>
                                <button type="submit" class="themeBtn text-white">Search</button>
                               
                                <!-- <div class="daterangePickerField rangePicker haveicon text-nowrap" style="display: flex;">12 May 2025 - 24 May 2025</div> -->
                            </div>
                              </form>
                            <div class="rightpanel d-flex gap-2">
                                <button class="themeBtnGray theme-text-dark" data-bs-toggle="modal" data-bs-target="#addstudent">Add NPOs</button>
                            </div>
                        </div>
                    </div>
                    <div class="row gap-2 justify-content-between filterSection mat-15 d-none">
                        <div class="col-auto">
                            <div class="topField">
                                <div class="filterSection">
                                    <div class="btn-group">
                                        <button class="addFilterBtn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="icon"></span>
                                            <span class="txt">Add Filters</span>
                                        </button>
                                        <ul class="dropdown-menu filterDropdown themeForm">
                                            <li>
                                                <a href="javascript:void(0);" id="date-wrp1">
                                                    <div class="notInput customChekbox">
                                                        <label class="form-check-label lh-14">Order time</label>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" id="date-wrp2">
                                                    <div class="notInput customChekbox">
                                                        <label class="form-check-label lh-14">Shop</label>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearBtn" style="display: block;"><a href="javascript:void(0);">Clear</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="themeTable">
            <div class="table-responsive">
                <table class="table w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Content</th>
                            <th class="rightText">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse ($npos as $npo)

                        <tr>
                            <td>{{ $npo->id }}</td>

                            <td>{{ $npo->name }}</td>

                            <td>
                                @if($npo->image)
                                    <img src="{{ asset('public/uploads/npos/'.$npo->image) }}" width="50">
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ Str::limit($npo->content, 60) }}</td>

                            <td valign="middle">
                                <div class="actionBtns d-flex align-items-center justify-content-end">

                                    <!-- EDIT BUTTON -->
                                    <a href="javascript:void(0)"
                                        class="tableActionBtn me-3"
                                        onclick='openEditModal(@json($npo))'
                                        data-bs-toggle="modal"
                                        data-bs-target="#addstudent"
                                        title="Edit">

                                        <!-- EDIT ICON -->
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none">
                                            <path d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213 3 20l.787-4.5L16.862 3.487z"
                                            stroke="currentColor"
                                            stroke-width="1.4"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                        </svg>

                                    </a>


                                    <!-- DELETE BUTTON -->
                                    <a href="{{ url('admin/npo/delete/'.$npo->id) }}"
                                        class="deleteBtn"
                                        data-url="{{ url('admin/npo/delete/'.$npo->id) }}"
                                        onclick="confirmDelete(event, this)"
                                        data-bs-toggle="tooltip"
                                        title="Delete">

                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M4 5.5H20" stroke="currentColor" stroke-width="1.4"/>
                                                <path d="M9 2.5H15" stroke="currentColor" stroke-width="1.4"/>
                                                <path d="M6 8.5H18V20C18 20.8285 17.3285 21.5 16.5 21.5H7.5C6.67155 21.5 6 20.8285 6 20V8.5Z"
                                                stroke="currentColor"
                                                stroke-width="1.4"/>
                                            </svg>

                                        </a>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">No NPO found</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper d-none">
                <div class="container-fluid p-0">
                    <div class="row gap-2 g-0 justify-content-end align-items-center">
                        <div class="col-auto total-wrp">
                            <span>Total 4</span>
                        </div>
                        <div class="col-auto">
                            <ul class="list-pagination">
                                <li class="pagbtn prev dissable"><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">...</a></li>
                                <li><a href="#">10</a></li>
                                <li class="pagbtn next"><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        <div class="col-auto">
                            <div class="pagination-box">
                                <div class="row g-0 gap-3">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Go to</label>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <input type="text" id="inputnumber" class="form-control" placeholder="1">
                                    </div>
                                    <div class="col-auto page-panel align-self-center pal-0">
                                        <select class="form-select">
                                            <option value="">15 / page</option>
                                            <option value="">30 / page</option>
                                            <option value="">45 / page</option>
                                            <option value="">60 / page</option>
                                            <option value="">75 / page</option>
                                            <option value="">100 / page</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="themeModal rightSide rightsideSticky">

<form id="npoForm" action="{{ url('admin/npo/add-npo') }}" method="POST" enctype="multipart/form-data">
@csrf

<div class="modal fade" id="addstudent" tabindex="-1">

<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable mw-750px w-100 m-0 h-100">
<div class="modal-content h-100">

<div class="modal-header">
<h4 class="modal-title fs-16 fw-700 theme-text-dark" id="modalTitle">
Add NPOs
</h4>

<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

<div class="row">

<div class="col-lg-6 mb-3">
<label>Category</label>
<input type="text" class="form-control" name="category" id="category">
</div>

<div class="col-lg-6 mb-3">
<label>Name</label>
<input type="text" class="form-control" name="name" id="name">
</div>

<div class="col-lg-6 mb-3">
<label>Slug</label>
<input type="text" class="form-control" name="slug" id="slug">
</div>

<div class="col-lg-6 mb-3">
<label>Sort Order</label>
<input type="number" class="form-control" name="sort_order" id="sort_order">
</div>

<div class="col-lg-12 mb-3">
<label>Content</label>
<textarea class="form-control" name="content" id="content"></textarea>
</div>

<div class="col-lg-6 mb-3">
<label>Image</label>
<input type="file" class="form-control" name="image">
<img id="imagePreview" src="" width="80" class="mt-2 d-none">
</div>

<div class="col-lg-6 mb-3">
<label>Bank Name</label>
<input type="text" class="form-control" name="bank_name" id="bank_name">
</div>

<div class="col-lg-6 mb-3">
<label>Account Number</label>
<input type="text" class="form-control" name="account_number" id="account_number">
</div>

<div class="col-lg-6 mb-3">
<label>Status</label>
<select class="form-select" name="status" id="status">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

</div>

</div>

<div class="modal-footer">
<button type="button" class="secondaryBtn" data-bs-dismiss="modal">Close</button>
<button type="submit" class="themeBtn text-white" id="submitBtn">
Save NPO
</button>
</div>

</div>
</div>
</div>

</form>

</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
   function openAddModal(){

document.getElementById('modalTitle').innerText = "Add NPOs";
document.getElementById('submitBtn').innerText = "Save NPO";

document.getElementById('npoForm').action = "/admin/npo/add-npo";

document.getElementById("npoForm").reset();

document.getElementById("imagePreview").src = "";
document.getElementById("imagePreview").classList.add("d-none");

}

function openEditModal(npo){

document.getElementById('modalTitle').innerText="Edit NPO";
document.getElementById('submitBtn').innerText="Update NPO";

document.getElementById('npoForm').action = "{{ url('admin/npo/update') }}/" + npo.id;

document.getElementById('category').value=npo.category ?? "";
document.getElementById('name').value=npo.name ?? "";
document.getElementById('slug').value=npo.slug ?? "";
document.getElementById('sort_order').value=npo.sort_order ?? "";
document.getElementById('content').value=npo.content ?? "";
document.getElementById('bank_name').value=npo.bank_name ?? "";
document.getElementById('account_number').value=npo.account_number ?? "";
document.getElementById('status').value=npo.status ?? "1";

if(npo.image){
document.getElementById("imagePreview").src="{{ url('public/uploads/npos') }}/"+npo.image;
document.getElementById("imagePreview").classList.remove("d-none");
}

}
document.getElementById('addstudent').addEventListener('hidden.bs.modal', function () {

    document.getElementById("npoForm").reset();

    document.getElementById('modalTitle').innerText = "Add NPOs";
    document.getElementById('submitBtn').innerText = "Save NPO";

    document.getElementById('npoForm').action = "/admin/npo/add-npo";

    document.getElementById("imagePreview").src = "";
    document.getElementById("imagePreview").classList.add("d-none");

});
//Delete Confirmation
function confirmDelete(event, element) {

    event.preventDefault();

    const deleteUrl = element.dataset.url;
    const randomNumber = Math.floor(1000 + Math.random() * 9000);

    Swal.fire({
        title: 'Delete NPO?',
        html: `
            <p>This action cannot be undone.</p>
            <p>Please enter the following number to confirm deletion:</p>

            <h2 style="color:#dc3545;font-weight:bold;">
                ${randomNumber}
            </h2>

            <input type="text"
                   id="confirmCode"
                   class="swal2-input"
                   placeholder="Enter the number">
        `,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#dc3545',

        preConfirm: () => {

            const enteredCode =
                document.getElementById('confirmCode').value;

            if (enteredCode != randomNumber) {
                Swal.showValidationMessage(
                    'Confirmation number does not match'
                );
                return false;
            }

            return true;
        }

    }).then((result) => {

        if (result.isConfirmed) {

            Swal.fire({
                icon: 'success',
                title: 'Deleting...',
                timer: 1000,
                showConfirmButton: false
            });

            window.location.href = deleteUrl;
        }
    });
}
</script>
@endsection