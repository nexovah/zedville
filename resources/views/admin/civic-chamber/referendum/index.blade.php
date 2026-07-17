@extends('layouts.admin')

@section('title','Referendums')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">

            <h3 class="mb-0">
                Referendums
            </h3>

            <small class="text-muted">
                Manage Civic Chamber Referendums
            </small>

        </div>

        <div class="col-md-6 text-end">

            <a href="{{ url('admin/referendum/create') }}"
               class="btn btn-primary">

                <i class="fa fa-plus"></i>

                Add Referendum

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

                        <th width="60">
                            ID
                        </th>

                        <th>
                            Question
                        </th>

                        <th width="120">
                            Status
                        </th>

                        <th width="120">
                            Start Date
                        </th>

                        <th width="120">
                            End Date
                        </th>

                        <th width="180">
                            Created
                        </th>

                        <th width="180" class="text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($referendums as $referendum)

                    <tr>

                        <td>

                            {{ $referendum->id }}

                        </td>

                        <td>

                            <strong>

                                {{ $referendum->question }}

                            </strong>

                            @if($referendum->description)

                                <br>

                                <small class="text-muted">

                                    {{ Str::limit($referendum->description,80) }}

                                </small>

                            @endif

                        </td>

                        <td>

                            @if($referendum->status=='open')

                                <span class="badge bg-success">

                                    Open

                                </span>

                            @else

                                <span class="badge bg-danger">

                                    Closed

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $referendum->start_date ?? '-' }}

                        </td>

                        <td>

                            {{ $referendum->end_date ?? '-' }}

                        </td>

                        <td>

                            {{ $referendum->created_at->format('d M Y') }}

                            <br>

                            <small class="text-muted">

                                {{ $referendum->created_at->format('h:i A') }}

                            </small>

                        </td>

                        <td class="text-center">

                            <a href="{{ url('admin/referendum/edit/'.$referendum->id) }}"
                               class="btn btn-warning btn-sm">

                                <i class="fa fa-edit"></i>

                            </a>

                            <form
                                action="{{ url('admin/referendum/delete/'.$referendum->id) }}"
                                method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Delete this referendum?')">

                                @csrf

                                @method('DELETE')

                                <button class="btn btn-danger btn-sm">

                                    <i class="fa fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            No Referendums Found

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

            <div class="mt-3">

                {{ $referendums->links() }}

            </div>

        </div>

    </div>

</div>

@endsection