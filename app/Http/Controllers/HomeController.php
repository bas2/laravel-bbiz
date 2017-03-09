<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function sendEmail() {
        $this->validate(request(), [
    'text'=>'required',
  ]);
    }
}
