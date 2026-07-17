@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
    <div class="adminHeading">
        <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">Profile</h1>
    </div>
    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger mt-2">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Body Widget -->
    <div class="row">
        <div class="col-12">
            <div class="themeCard card card-custom mab-20">
                <div class="card-body pt-2 pb-2 px-0 pb-0">
                    <ul class="nav nav-tabs customTabBg customTabs" id="settingsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="home" aria-selected="true">Account Information</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="balance-tab" data-bs-toggle="tab" data-bs-target="#balance" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Payment Details</button>
                        </li> -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Change Password</button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content" id="settingsTab">
                <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="themeCard card themeForm card-custom card-stretch gutter-b mab-15">
                        <div class="card-body pall-30">
                            <form action="{{ url('admin/profile') }}" method="post">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group mab-25">
                                            <label for="" class="form-label">Name <span class="redText fs-16 fw-600">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Please enter Name" value="{{ Auth::user()->name }}">
                                        </div>
                                        <div class="form-group mab-25">
                                            <label for="" class="form-label">Email <span class="redText fs-16 fw-600">*</span></label>
                                            <input type="email" name="email" class="form-control" placeholder="Please enter Emial" value="{{ Auth::user()->email }}">
                                        </div>
                                        <div class="form-group mab-25">
                                            <label for="" class="form-label">Phone</label>
                                            <input type="tel" name="phone" class="form-control" placeholder="Please enter Phone Number">
                                        </div>
                                        <div class="text-end">
                                            <input type="submit" class="themeBtn text-white" value="Save">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                    <div class="themeCard card themeForm card-custom card-stretch gutter-b mab-15">
                        <div class="card-body pall-30">
                            <div class="row justify-content-center">
                                <div class="col-12 col-lg-6">
                                    <form action="{{ url('admin/profile/password') }}" method="post">
                                        @csrf
                                        <div class="themealert fs-14 lh-20 alert alert-warning-border mab-20 fade show" role="alert">
                                            Once password has been changed, all other devices will be log out except yours
                                        </div>
                                        <div class="themeForm">
                                            <div class="form-group mab-20">
                                                <label for="newpassword" class="form-label">Cuurrent password</label>
                                                <input class="form-control password" id="current_password" name="current_password" type="password" placeholder="Please enter" name="newpsw" value="" required="">
                                            </div>
                                            <div class="form-group mab-20">
                                                <label for="newpassword" class="form-label">New password</label>
                                                <input class="form-control password" id="newpassword" name="password" type="password" placeholder="Please enter" name="newpsw" value="" required="">
                                            </div>
                                            <div class="form-group mab-20">
                                                <label for="" class="form-label">Confirm Password</label>
                                                <input class="form-control password" id="conpassword" name="confirm_password" type="password" placeholder="Please enter" name="conpassword" required="">
                                            </div>
                                            <div class="form-group mab-20 text-end">
                                                <button class="themeBtn text-white" type="submit">Submit</button>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
@endsection