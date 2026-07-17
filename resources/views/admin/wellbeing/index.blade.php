@extends('layouts.admin')

@section('title','Wellbeing Room')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">
            <h3 class="mb-0">Wellbeing Room</h3>
            <small class="text-muted">
                Manage Articles & Videos
            </small>
        </div>

        <div class="col-md-6 text-end">

            <a href="{{ url('admin/wellbeing/create') }}"
               class="btn btn-primary">

                <i class="fa fa-plus"></i>

                Add New

            </a>

        </div>

    </div>

    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <div class="card">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped align-middle">

                <thead class="table-dark">

                    <tr>

                        <th width="60">ID</th>

                        <th>Title</th>

                        <th width="100">Type</th>

                        <th width="120">Category</th>

                        <th width="90">Read Time</th>

                        <th width="90">Featured</th>

                        <th width="90">Status</th>

                        <th width="160">Published</th>

                        <th width="180" class="text-center">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($posts as $post)

                    <tr>

                        <td>

                            {{ $post->id }}

                        </td>

                        <td>

                            <strong>

                                {{ $post->title }}

                            </strong>

                            <br>

                            <small class="text-muted">

                                {{ Str::limit($post->short_description,80) }}

                            </small>

                        </td>

                        <td>

                            @if($post->type=='article')

                                <span class="badge bg-primary">

                                    Article

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Video

                                </span>

                            @endif

                        </td>

                        <td>

                            @switch($post->category)

                                @case('financial')

                                    <span class="badge bg-warning text-dark">

                                        Financial

                                    </span>

                                    @break

                                @case('stress')

                                    <span class="badge bg-danger">

                                        Stress

                                    </span>

                                    @break

                                @case('lifestyle')

                                    <span class="badge bg-success">

                                        Lifestyle

                                    </span>

                                    @break

                                @default

                                    <span class="badge bg-secondary">

                                        General

                                    </span>

                            @endswitch

                        </td>

                        <td>

                            {{ $post->read_time }}

                        </td>

                        <td>

                            @if($post->featured)

                                <span class="badge bg-success">

                                    Yes

                                </span>

                            @else

                                <span class="badge bg-secondary">

                                    No

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($post->status)

                                <span class="badge bg-success">

                                    Published

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    Draft

                                </span>

                            @endif

                        </td>

                        <td>

                            @if($post->published_at)

                                {{ $post->published_at->format('d M Y') }}

                                <br>

                                <small class="text-muted">

                                    {{ $post->published_at->format('h:i A') }}

                                </small>

                            @else

                                -

                            @endif

                        </td>

                        <td class="text-center">

                            <a href="{{ url('admin/wellbeing/edit',$post->id) }}"

                               class="btn btn-sm btn-warning">

                                <i class="fa fa-edit"></i>

                            </a>

                            <form
                                action="{{ url('admin/wellbeing/delete',$post->id) }}"
                                method="POST"
                                class="delete-form"
                                style="display:inline-block">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9" class="text-center">

                            No Records Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $posts->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-form').forEach(form => {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        const currentForm = this;
        const randomNumber = Math.floor(1000 + Math.random() * 9000);

        Swal.fire({
            title: 'Delete Record?',
            html: `
                <p>This action cannot be undone.</p>
                <p>Please enter the following number to confirm deletion:</p>

                <h2 style="color:#dc3545;font-weight:bold;">
                    ${randomNumber}
                </h2>

                <input
                    type="text"
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

                const enteredCode = document.getElementById('confirmCode').value;

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

                currentForm.submit();

            }

        });

    });

});
</script>
@endpush