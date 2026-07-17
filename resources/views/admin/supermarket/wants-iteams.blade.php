@extends('layouts.admin')

@section('title', 'Wants Iteams')

@section('content')

@push('styles')
<style>
    :root {
        --primary: #00c4b4;
        --danger: #ff7675;
        --border: #e2e8f0;
        --bg: #f8f9fa;
    }

    .upload-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 20px rgba(0,0,0,.05);
        overflow: hidden;
        margin-bottom: 20px;
    }

    .card-header {
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border);
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 12px 14px;
        border-bottom: 1px solid #f1f2f6;
        text-align: left;
    }

    th {
        background: var(--bg);
        font-size: 12px;
        text-transform: uppercase;
        color: #555;
    }

    .grid-input {
        width: 100%;
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    .btn {
        padding: 8px 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
    }

    .btn-primary {
        background: var(--primary);
        color: #fff;
    }

    .btn-secondary {
        /*background: #fff;*/
        border: 1px solid var(--border);
    }

    .btn-icon {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    .btn-icon.delete {
        color: var(--danger);
    }

    #ajaxLoader {
        position: fixed;
        inset: 0;
        background: rgba(255,255,255,.7);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    #ajaxLoader.show {
        display: flex;
    }
</style>
@endpush

{{-- ================= LOADER ================= --}}
<div id="ajaxLoader">
    <div>Processing…</div>
</div>

<div class="adminHeading">
    <h1>Wants Iteams</h1>
    <p>Only item name and price</p>
</div>

{{-- ================= PRODUCT LIST ================= --}}
<div id="productListView">
    <div class="upload-card">
        <div class="card-header">
            <h3>Product List</h3>
            <button class="btn btn-primary" onclick="showAddProduct()">+ Add Product</button>
        </div>

        <div style="padding:15px;">
            <input id="searchInput" class="grid-input" placeholder="Search product…" onkeyup="filterProducts()">
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productListBody"></tbody>
        </table>
    </div>
</div>

{{-- ================= ADD PRODUCT ================= --}}
<div id="addProductView" style="display:none;">
    <div class="upload-card">
        <div class="card-header">
            <h3>Add Products</h3>
            <button class="btn btn-secondary" onclick="showProductList()">← Back</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>

        <div style="padding:15px; text-align:right;">
            <button class="btn btn-secondary" onclick="addEmptyRow()">+ Add Row</button>
            <button class="btn btn-primary" onclick="submitBatch()">Save</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
let allProducts = [];

/* ---------- VIEW SWITCH ---------- */
function showAddProduct() {
    productListView.style.display = 'none';
    addProductView.style.display = 'block';
    tableBody.innerHTML = '';
    addEmptyRow();
}

function showProductList() {
    addProductView.style.display = 'none';
    productListView.style.display = 'block';
    loadProductList();
}

/* ---------- ADD ROW ---------- */
function addEmptyRow() {
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td><input class="grid-input" placeholder="Product name"></td>
        <td><input type="number" class="grid-input" placeholder="Price"></td>
        <td><button class="btn-icon delete" onclick="this.closest('tr').remove()">×</button></td>
    `;
    tableBody.appendChild(tr);
}

/* ---------- SUBMIT ---------- */
function submitBatch() {
    let fd = new FormData();

    document.querySelectorAll('#tableBody tr').forEach((r, i) => {
        const inputs = r.querySelectorAll('.grid-input');
        if (!inputs[0].value.trim()) return;

        fd.append(`products[${i}][product_name]`, inputs[0].value);
        fd.append(`products[${i}][price]`, inputs[1].value || 0);
    });

    showLoader();

    fetch("{{ url('admin/education/wants-iteams-store') }}", {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: fd
    })
    .then(() => {
        hideLoader();
        showProductList();
    });
}

/* ---------- LIST ---------- */
function loadProductList() {
    fetch("{{ url('admin/education/wants-iteams-list') }}")
        .then(r => r.json())
        .then(d => {
            allProducts = d;
            renderProducts();
        });
}

function renderProducts() {
    productListBody.innerHTML = '';

    allProducts.forEach(p => {
        productListBody.innerHTML += `
        <tr data-id="${p.id}">
            <td>${p.id}</td>
            <td><input class="grid-input" value="${p.item_name}" disabled></td>
            <td><input class="grid-input" value="${p.price}" disabled></td>
            <td>
                <button class="btn-icon" onclick="editRow(this)">✎</button>
                <button class="btn-icon delete" onclick="deleteProduct(this)">🗑</button>
            </td>
        </tr>`;
    });
}

/* ---------- EDIT ---------- */
function editRow(btn) {
    const r = btn.closest('tr');
    r.querySelectorAll('input').forEach(i => i.disabled = false);
    btn.textContent = '💾';
    btn.onclick = () => saveRow(r);
}

function saveRow(r) {
    const id = r.dataset.id;
    const inputs = r.querySelectorAll('.grid-input');

    let fd = new FormData();
    fd.append('product_name', inputs[0].value);
    fd.append('price', inputs[1].value);

    showLoader();

    fetch(`/zedville/admin/education/wants-iteams-update/${id}`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: fd
    }).then(() => {
        hideLoader();
        loadProductList();
    });
}

/* ---------- DELETE ---------- */
/*function deleteProduct(btn) {
    if (!confirm('Delete product?')) return;

    const id = btn.closest('tr').dataset.id;
    showLoader();

    fetch(`/zedville/admin/education/wants-iteams-delete/${id}`, {
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    }).then(() => {
        hideLoader();
        loadProductList();
    });
}*/
function deleteProduct(btn) {

    const id = btn.closest('tr').dataset.id;
    const randomNumber = Math.floor(1000 + Math.random() * 9000);

    Swal.fire({
        title: 'Delete Product?',
        html: `
            <p>This action cannot be undone.</p>
            <p>Please enter the following number to confirm deletion:</p>

            <h2 style="color:#ff7675;font-weight:bold;">
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
        confirmButtonColor: '#ff7675',

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

            showLoader();

            fetch(`/zedville/admin/education/wants-iteams-delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                hideLoader();

                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Product deleted successfully.',
                    timer: 1500,
                    showConfirmButton: false
                });

                loadProductList();
            })
            .catch(() => {
                hideLoader();

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unable to delete product.'
                });
            });
        }
    });
}
/* ---------- SEARCH ---------- */
function filterProducts() {
    const q = searchInput.value.toLowerCase();
    productListBody.innerHTML = '';

    allProducts
        .filter(p => p.item_name.toLowerCase().includes(q))
        .forEach(p => {
            productListBody.innerHTML += `
            <tr>
                <td>${p.id}</td>
                <td>${p.item_name}</td>
                <td>${p.price}</td>
                <td></td>
            </tr>`;
        });
}

/* ---------- HELPERS ---------- */
function showLoader(){ ajaxLoader.classList.add('show'); }
function hideLoader(){ ajaxLoader.classList.remove('show'); }

/* INIT */
loadProductList();
</script>
@endpush
