@extends('layouts.admin')

@section('title','Add Wellbeing Post')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">
            <h3>Add Wellbeing Post</h3>
        </div>

        <div class="col-md-6 text-end">

            <a href="{{ url('admin/wellbeing') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>

        </div>

    </div>

    @if ($errors->any())

        <div class="alert alert-danger">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form action="{{ url('admin/wellbeing/store') }}" method="POST">

        @csrf

        <div class="card">

            <div class="card-body">

                <div class="row">

                    <!-- Title -->
                    <div class="col-md-12 mb-3">

                        <label class="form-label">
                            Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control"
                            value="{{ old('title') }}"
                            required>

                    </div>

                    <!-- Short Description -->

                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Short Description

                        </label>

                        <textarea
                            name="short_description"
                            class="form-control"
                            rows="3"
                            required>{{ old('short_description') }}</textarea>

                    </div>

                    <!-- Content -->

                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Full Content

                        </label>

                        <textarea
                            name="content"
                            class="form-control"
                            rows="10">{{ old('content') }}</textarea>

                    </div>

                    <!-- Type -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Type

                        </label>

                        <select
                            name="type"
                            id="type"
                            class="form-control">

                            <option value="article">

                                Article

                            </option>

                            <option value="video">

                                Video

                            </option>

                        </select>

                    </div>

                    <!-- Category -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Category

                        </label>

                        <select
                            name="category"
                            class="form-control">

                            <option value="financial">

                                Financial

                            </option>

                            <option value="stress">

                                Stress

                            </option>

                            <option value="lifestyle">

                                Lifestyle

                            </option>

                            <option value="general">

                                General

                            </option>

                        </select>

                    </div>

                    <!-- Youtube -->

                    <div class="col-md-12 mb-3"
                         id="youtube_div"
                         style="display:none;">

                        <label class="form-label">

                            Youtube URL

                        </label>

                        <input
                            type="text"
                            name="youtube_url"
                            class="form-control"
                            value="{{ old('youtube_url') }}">

                    </div>

                    <!-- Read Time -->

                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Read Time

                        </label>

                        <input
                            type="text"
                            name="read_time"
                            class="form-control"
                            placeholder="Example : 5 min"
                            value="{{ old('read_time') }}">

                    </div>

                    <!-- Featured -->

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Featured

                        </label>

                        <select
                            name="featured"
                            class="form-control">

                            <option value="0">

                                No

                            </option>

                            <option value="1">

                                Yes

                            </option>

                        </select>

                    </div>

                    <!-- Status -->

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Status

                        </label>

                        <select
                            name="status"
                            class="form-control">

                            <option value="1">

                                Published

                            </option>

                            <option value="0">

                                Draft

                            </option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <button
                    class="btn btn-primary">

                    Save

                </button>

                <a
                    href="{{ url('admin/wellbeing') }}"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </div>

    </form>

</div>
<script>

document.getElementById('type').addEventListener('change', function(){

    if(this.value=="video"){

        document.getElementById('youtube_div').style.display="block";

    }else{

        document.getElementById('youtube_div').style.display="none";

    }

});

window.onload=function(){

    if(document.getElementById('type').value=="video"){

        document.getElementById('youtube_div').style.display="block";

    }

}

</script>
@endsection