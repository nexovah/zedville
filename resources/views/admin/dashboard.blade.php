@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="adminHeading">
    <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">
        Home
    </h1>
</div>

<div class="row">
    <div class="themeCard card card-custom card-stretch gutter-b mab-15">
        <div class="card-body pall-30">

            <div class="tableHeadAdvance themeForm">
                <div class="dataTableAdvan">

                    {{-- CENTERED SEARCH --}}
                    <div class="row justify-content-center mab-15">
                        <div class="col-md-6">

                             <form action="{{ url('admin/school') }}" method="POST">
                                        @csrf
                                <div class="input-group">
                                    {{-- DROPDOWN onchange="this.form.submit()" --}}
                                   
                                        <select name="school_id" class="form-control form-select fs-14" >
                                            <option value="">Select School User</option>
                                            @foreach ($schools as $school)
                                                <option value="{{ $school->id }}" {{ session('selected_school') == $school->id ? 'selected' : '' }}>
                                                    {{ $school->school_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    


                                    <button type="submit" class="btn themeBtn text-white">
                                        Submit
                                    </button>
                                    

                                </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
