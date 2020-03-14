<?php

namespace App\Http\Controllers\Web\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller {
    public function index() {
        return view('profile.index');
    }
}
