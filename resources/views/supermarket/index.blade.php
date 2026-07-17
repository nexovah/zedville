@extends('layouts.profile')

@section('title', 'Supermarket ')

@section('content')
@push('styles')
<style>
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
.store {
  position: absolute;
  inset: 0;
  pointer-events: none; /* important fix */
}
.store span{
    display: none;
}
/* polygon area + clickable event lives here */
.store::before {
  content: "";
  position: absolute;
  inset: 0;
  pointer-events: auto; /* click allowed only inside polygon */
  clip-path: var(--poly);
  background: rgba(0, 0, 0, .6);
 
  /* Debug (Option B) */
  outline: 1px dashed rgba(255,0,0,.7);
}
/* Top row */
.s1 { --poly: polygon(0% 6%, 16% 27%, 16% 53%, 0% 43%); }
.s2 { --poly: polygon(19% 12%, 32% 25%, 32% 48%, 19% 42%); top: 21%; }
.s3 { --poly: polygon(33% 26%, 44% 37%, 44% 54%, 33% 49%); top: 20%; }
.s4 { --poly: polygon(69% 10%, 80% -2%, 80% 32%, 69% 38%) ;top: 33%;; }
.s5 { --poly: polygon(83% 28%,  100% 6%,  100% 43%, 83% 53%); }

/* Bottom row */
.s6 { --poly: polygon(0% 30%, 16% 40%, 16% 85%, 0% 96%);      top: 31%;}
.s7 { --poly: polygon(19% 27%, 31% 33%, 31% 71%, 19% 77%); top: 43%; }
.s8 { --poly: polygon(59% 28%, 67% 22%, 67% 64%, 59% 61%);  top: 51%;}
.s9 { --poly: polygon(68% 31%, 80% 25%, 80% 77%, 68% 71%); top: 45%; }
.s10 { --poly: polygon(83% 48%, 100% 39%, 100% 98%, 83% 87%); top: 20%;}
</style>
@endpush
<div class="flex flex-col items-start justify-between pb-6 space-y-4 lg:items-center lg:space-y-0 lg:flex-row">
    <h1 class="text-xl font-bold whitespace-nowrap ">Supermarket</h1>
</div>
<div class="grid grid-cols-1 gap-5 ">
    <div class="themeTabspills">
        <div class="w-full " style="position: relative;">
            <div class="mall-map">
                <a href="{{ route('supermarket.market-list') }}"><img src="{{ asset('asset/front/images/supermarket.png') }}" alt="City Mall" class="mall-img rounded-lg "></a>
            
            </div>
      </div>
    </div>
</div>
@endsection