@extends('layouts.profile')

@section('title', 'City Hall - Educational Finance Department')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/front/css/efd.css') }}?ver={{ rand(111, 999) }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    .shop-front-card {
        background: white;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 196, 180, 0.15);
        width: 100%;
        max-width: 450px;
        border: 1px solid white;
        margin: 0 auto;
        text-align: center;
        font-family: 'Poppins', sans-serif;
    }

    .shop-image-placeholder {
        width: 100%;
        height: 250px;
        background: #b2dfdb;
        border-radius: 16px;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 60px;
        color: #009e91;
        position: relative;
        overflow: hidden;
    }

    .shop-image-placeholder::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 40px;
        background: repeating-linear-gradient(
            45deg,
            #00c4b4,
            #00c4b4 20px,
            white 20px,
            white 40px
        );
    }

    .shop-title {
        color: #2d3436;
        margin-bottom: 10px;
        font-weight: 800;
        font-size: 24px;
    }

    .shop-desc {
        color: #636e72;
        margin-bottom: 30px;
        font-size: 14px;
    }

    .btn-large-enter {
        background: #00c4b4;
        color: white;
        font-size: 18px;
        font-weight: 700;
        padding: 16px 40px;
        border-radius: 50px;
        border: none;
        cursor: pointer;
        box-shadow: 0 10px 25px rgba(0, 196, 180, 0.4);
        transition: 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-large-enter:hover {
        transform: translateY(-3px) scale(1.02);
        background: #009e91;
        box-shadow: 0 15px 35px rgba(0, 196, 180, 0.5);
    }
    
.mall-map {
  position: relative;
  width: 100%;
}

.mall-img {
  width: 100%;
  display: block;
  pointer-events: none;
}

/* main store hit containers */
.city-map {
    position: relative;
    width: 100%;
}

.city-img {
    width: 100%;
    display: block;
}

.hotspot {
    position: absolute;
    display: block;
    /*border: 2px dashed red; /* Remove after testing */
}

/* Dashboard Board */
.board {
    left: 31%;
    top: 25%;
    width: 38%;
    height: 20%;
}

/* Left Room */
.left-room {
    left: 30%;
    top: 47%;
    width: 10%;
    height: 31%;
}

/* Right Room */
.right-room {
    left: 60%;
    top: 47%;
    width: 10%;
    height: 31%;
}

/* Reception Girl */
.girl {
    left: 12%;
    top: 58%;
    width: 12%;
    height: 20%;
}
    </style>
  @endpush
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">City Hall</h1>
</div>
<div class="grid grid-cols-1 gap-5 ">
    <div class="themeTabspills">
        <div class="w-full " style="position: relative;">
            <div class="city-map">
                <img src="{{ asset('asset/front/images/city-hall.png') }}"
                    alt="City Hall"
                    class="city-img rounded-lg">

                <a href="{{ route('education.main-hall') }}"
                class="hotspot board" title="Board"></a>

                <a href="{{ route('education.civic-chamber') }}"
                class="hotspot left-room" title="Left Room"></a>

                <a href="{{ route('education.well-being-room') }}"
                class="hotspot right-room" title="Right Room"></a>

                <!-- <a href="#"
                class="hotspot girl" title="Reception"></a> -->
            </div>
        </div>
    </div>
</div>
@endsection