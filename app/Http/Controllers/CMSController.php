<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CMSController extends Controller
{
   public function howItWork()
    {
        return view('cms.how-it-work');
    }
    public function faq()
    {
        return view('cms.faq');
    }
    public function contact()
    {
        return view('cms.contact');
    }
    public function privacyPolicy()
    {
        return view('cms.privacy-policy');
    }
    public function termsConditions()
    {
        return view('cms.terms-conditions');
    }
    public function thankYou()
    {
        return view('cms.thankyou');
    }
}
