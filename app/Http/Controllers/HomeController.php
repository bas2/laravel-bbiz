<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

class HomeController extends Controller
{
    public function sendEmail() {
      $this->validate(request(), [
        'message'=>'required|min:5|max:300',
      ]);
      \Mail::to('mail3@bashir.biz')->send(new ContactMail(request('message')));
      session()->flash('message','Thank you for your message!');

      return redirect()->home();
    }
}
