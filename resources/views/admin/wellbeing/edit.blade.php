@extends('layouts.admin')

@section('title','Edit Wellbeing Post')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">

        <div class="col-md-6">
            <h3>Edit Wellbeing Post</h3>
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

    <form action="{{ url('admin/wellbeing/update',$post->id) }}" method="POST">

        @csrf
        @method('PUT')

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
                            value="{{ old('title',$post->title) }}"
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
                            required>{{ old('short_description',$post->short_description) }}</textarea>

                    </div>

                    <!-- Content -->

                    <div class="col-md-12 mb-3">

                        <label class="form-label">

                            Full Content

                        </label>

                        <textarea
                            name="content"
                            class="form-control"
                            rows="10">{{ old('content',$post->content) }}</textarea>

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

                            <option value="article"
                                {{ $post->type=='article' ? 'selected' : '' }}>
                                Article
                            </option>

                            <option value="video"
                                {{ $post->type=='video' ? 'selected' : '' }}>
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

                            <option value="financial"
                                {{ $post->category=='financial' ? 'selected' : '' }}>
                                Financial
                            </option>

                            <option value="stress"
                                {{ $post->category=='stress' ? 'selected' : '' }}>
                                Stress
                            </option>

                            <option value="lifestyle"
                                {{ $post->category=='lifestyle' ? 'selected' : '' }}>
                                Lifestyle
                            </option>

                            <option value="general"
                                {{ $post->category=='general' ? 'selected' : '' }}>
                                General
                            </option>

                        </select>

                    </div>

                    <!-- Youtube URL -->

                    <div
                        class="col-md-12 mb-3"
                        id="youtube_div"
                        style="{{ $post->type=='video' ? '' : 'display:none;' }}">

                        <label class="form-label">

                            Youtube URL

                        </label>

                        <input
                            type="text"
                            name="youtube_url"
                            class="form-control"
                            value="{{ old('youtube_url',$post->youtube_url) }}">

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
                            value="{{ old('read_time',$post->read_time) }}">

                    </div>

                    <!-- Featured -->

                    <div class="col-md-3 mb-3">

                        <label class="form-label">

                            Featured

                        </label>

                        <select
                            name="featured"
                            class="form-control">

                            <option value="0"
                                {{ $post->featured==0 ? 'selected' : '' }}>
                                No
                            </option>

                            <option value="1"
                                {{ $post->featured==1 ? 'selected' : '' }}>
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

                            <option value="1"
                                {{ $post->status==1 ? 'selected' : '' }}>
                                Published
                            </option>

                            <option value="0"
                                {{ $post->status==0 ? 'selected' : '' }}>
                                Draft
                            </option>

                        </select>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <button
                    type="submit"
                    class="btn btn-primary">

                    Update

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

</script>
@endsection