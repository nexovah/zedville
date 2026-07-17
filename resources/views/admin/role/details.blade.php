@extends('layouts.admin')

@section('title', 'Role')

@section('content')
<div class="adminHeading">
    <h1 class="d-flex align-items-center theme-text-dark fw-500 fs-16 mab-20">Edit Role</h1>
</div>
@if(session('success'))
        <div id="success-message" class="alert alert-success" style="margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif
<!-- Body Widget -->
<div class="themeCard card card-custom mab-20">
    
    <div class="card-body pt-2 pb-2 px-0 pb-0">
        <ul class="nav nav-tabs customTabBg customTabs" id="settingsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="home" aria-selected="true">Role Information</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="balance-tab" data-bs-toggle="tab" data-bs-target="#balance" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Payment Details</button>
            </li> -->
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" type="button" role="tab" aria-controls="contact" aria-selected="false" tabindex="-1">Role Permission</button>
            </li>
            <!-- <li class="nav-item" role="presentation">
                <button class="nav-link" id="integrate-tab" data-bs-toggle="tab" data-bs-target="#integrate" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Danger Zone</button>
            </li> -->
        </ul>
    </div>
</div>
<div class="tab-content" id="settingsTab">
    <div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="themeCard card themeForm card-custom card-stretch gutter-b mab-15">
            <div class="card-body pall-30">
                <div class="settingHeadingPart pab-20">
                    <div class="userProfile">
                        <div class="d-flex justify-content-between">
                            <!-- <div class="userImgBadge">
                                <div class="userLogo">
                                    <a href="membership-privileges.php">
                                        
                                        <img src="images/favicon.png" class="img-fluid" alt="">
                                    </a>
                                </div>
                                <a href="#"><span class="userName fs-20 fw-bold theme-text-dark">Daniel</span></a>
                            </div> 
                            <div class="headBtnSec">
                                <a href="#" class="secondaryBtn theme-text-mute" data-bs-toggle="modal" data-bs-target="#editprofile">
                                    <span class="theme-text-dark fs-14 fw-500">Edit Profile</span>
                                </a>
                            </div>-->
                        </div>
                    </div>
                </div>
                <div class="settingBody settingWidgetsSmall">
                    <div class="settingItems">
                        <div class="settingInner">
                            <div class="itemsIcon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M24 0H0V24H24V0Z" fill="white" fill-opacity="0.01"></path>
                                    <path d="M12 10C13.933 10 15.5 8.433 15.5 6.5C15.5 4.567 13.933 3 12 3C10.067 3 8.5 4.567 8.5 6.5C8.5 8.433 10.067 10 12 10Z" stroke="#222222" stroke-width="1.41" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M3 20.4V21H21V20.4C21 18.1598 21 17.0397 20.5641 16.184C20.1806 15.4314 19.5686 14.8195 18.816 14.436C17.9603 14 16.8402 14 14.6 14H9.4C7.1598 14 6.0397 14 5.18405 14.436C4.43139 14.8195 3.81947 15.4314 3.43598 16.184C3 17.0397 3 18.1598 3 20.4Z" stroke="#222222" stroke-width="1.41" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div class="itemsTxt">
                                <span class="fs-14 theme-text-mute d-block lh-20">{{ $role->name }}</span>
                                <!-- <span class="fs-14 theme-text-dark d-block lh-20">#000888666</span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="billing" role="tabpanel" aria-labelledby="billing-tab">
        <div class="themeCard card themeForm card-custom card-stretch gutter-b mab-15">
            <div class="card-body pall-30">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-6">
                        <form action="#" method="post">
                            <div class="themealert fs-14 lh-20 alert alert-warning-border mab-20 fade show" role="alert">
                                Once password has been changed, all other devices will be log out except yours
                            </div>
                            <div class="themeForm">
                                
                                <div class="form-group mab-20">
                                    <label for="newpassword" class="form-label">New password</label>
                                    <input class="form-control password" id="newpassword" type="password" placeholder="Please enter" name="newpsw" value="" required="">
                                </div>
                                <div class="form-group mab-20">
                                    <label for="" class="form-label">Confirm Password</label>
                                    <input class="form-control password" id="conpassword" type="password" placeholder="Please enter" name="conpassword" required="">
                                </div>
                                <div class="form-group mab-20 text-end">
                                    <button class="themeBtn text-white" type="submit">Reset</button>
                                </div>
                                <div class="divider mab-20"><span>Or</span></div>
                                <div class="form-group mab-20 justify-content-center d-flex gap-3 align-items-center">
                                    <h4 class="fs-16 fw-400 mb-0">Send password reset link via email.</h4>
                                    <button class="secondaryBtn">Send</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="tab-pane" id="integrate" role="tabpanel" aria-labelledby="billing-tab">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="themeCard card themeForm card-custom card-stretch gutter-b mab-15">
                    <div class="card-body pall-30">
                        <h4 class="fs-16 fw-700 theme-text-dark mab-20">Deactivate Account</h4>
                        <div class="fs-14 mab-30 lh-21">You will not be able to receive messages, notifications for up to 24 hours.</div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="rules1">
                            <label class="form-check-label" for="rules1">&nbsp;</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="themeCard card themeForm card-custom card-stretch gutter-b mab-15">
                    <div class="card-body pall-30">
                        <h4 class="fs-16 fw-700 theme-text-dark mab-20">Delete Account</h4>
                        <div class="fs-14 mab-30 lh-21">Once you delete the account, there is no going back. Please be certain.</div>
                        <button class="themeBtn text-white" data-bs-toggle="modal" data-bs-target="#confirmModal">Delete my account</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</div>
@endsection
<!-- <section class="themeModal">
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-350px">
            <div class="modal-content">
                <div class="modal-body text-center pall-60">
                    <h4 class="fs-18 fw-700 mab-20">Are you sure?</h4>
                    <p>You won't be able to revert this!</p>
                    <div class="text-center mat-40">
                        
                        <button type="button" class="themeBtn text-white">Yes Delete it!</button>
                        <button type="button" class="secondaryBtn theme-text-mute" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

