<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {

        $website_info = Setting::find(1);

        return view('user.contact', ['website_info' => $website_info]);
    }
}
