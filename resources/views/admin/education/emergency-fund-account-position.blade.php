@extends('layouts.admin')

@section('title', 'Emergency Fund Account')

@section('content')
<div class="adminHeading">
    <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">Emergency Fund Account</h1>
</div>
<div class="row">
    <div class="themeCard card card-custom card-stretch gutter-b mab-15">
        <div class="card-body pall-30">
            <form action="{{ url('admin/education/emergency-fund-position') }}" method="post">
                @csrf
                <div class="row justify-content-center">
                    {{-- Class List --}}
                    <div class="col-12 col-lg-6">
                        <div class="form-group mab-25">
                            <label class="form-label">Class</label>

                            <select class="form-select" name="cid">
                                <option value="">Select Class</option>

                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}"
                                        {{ isset($position) && $position->cid == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-group mab-25">
                            <label  class="form-label">Position</label>
                            <select class="form-select" aria-label="Default select example" name="position">
                                <option value="" disabled {{ empty($position) ? 'selected' : '' }}>Select Position</option>
                                <option value="required" 
                                    {{ isset($position) && $position->required == 1 ? 'selected' : '' }}>
                                    Required
                                </option>
                                <option value="optional" 
                                    {{ isset($position) && $position->optional == 1 ? 'selected' : '' }}>
                                    Optional
                                </option>
                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-lg-6 text-end">
                        <input type="submit" class="themeBtn text-white" value="Save">
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection