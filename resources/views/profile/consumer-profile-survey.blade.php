@extends('layouts.profile')

@section('title', 'Dashboard')

@section('content')
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Account Settings</h1>
</div>
<div class="grid grid-cols-1 gap-5 mt-6">
    <div class="themeTabspills">
        <div class="w-full">
            <!-- Tabs Header -->
            <div class="flex menus overborderleftright border-b border-[#D2DDDB]">
                <button class="tabitems tab-button" data-tab="tab1">
                    Profile
                </button>
                <button class="tabitems tab-button" data-tab="tab2">
                    Password
                </button>
                <button class="tabitems tab-button active" data-tab="tab3">
                    Consumer Profile
                </button>
                <button class="tabitems tab-button" data-tab="tab4">
                    Closet
                </button>
                <button class="tabitems tab-button" data-tab="tab5">
                    Badges
                </button>
                <button class="tabitems tab-button" data-tab="tab6">
                    My Mood
                </button>
            </div>

            <!-- Tabs Content -->
            <div class="tailCard py-6 lg:py-10 px-6 lg:px-8 max-w-[900px] w-full mt-4 border border-[#D2DDDB] rounded-lg" x-data="{ changeImageModal: false, moodMeater: false }">
                <div id="tab1" class="tab-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div id="tab2" class="tab-content">
                    @include('profile.partials.update-password-form')
                </div>
                <div id="tab3" class="tab-content active">
                    @include('profile.partials.surveys')
                </div>
                <div id="tab4" class="tab-content">
                    <p>Closet Not available</p>
                </div>
                <div id="tab5" class="tab-content">
                    <p>Badges Not available</p>
                </div>
                <div id="tab6" class="tab-content" data-tab="tab6">
                    <p>My Mood Not available</p>
                </div>
                
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener("DOMContentLoaded", function () {
    document.querySelector('[data-tab="tab3"]').click();
});
</script>
@endsection