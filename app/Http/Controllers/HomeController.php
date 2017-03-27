<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

class HomeController extends Controller
{
  // GET: {slug?}
  public function index() {
    $email=$this->_getsection('email');
    return view('pages.welcome')
    ->with('page',['home','Bashir Patel (Web developer/programmer) London-based'])
    ->with('pagecontent', [
      'travelodge'=>$this->_getsection('travelodge'),
      'aboutme'=>$this->_getsection('about'),
      'email'=>(!filter_var($email, FILTER_VALIDATE_EMAIL)===false)?$email:'',
      'skills'=>\App\Skill::get(['skill','content']),
      'recent'=>$this->_getsection('recent')
      ])
    ->with('images',\App\Image::get(['filename']))
    ;
  }

  // POST: email/send
  public function sendEmail() {
    $this->validate(request(),['email'=>'email','message'=>'required|min:5|max:300',]);
    $email=\App\Content::where('name','email')->get(['content']);
    if(!empty($email[0]->content)) {
      \Mail::to($email[0]->content)->send(new ContactMail(request('name'),request('email'),request('message')));
      session()->flash('successmessage','Thank you for your message!');
    } else {
      session()->flash('failuremessage','Your message could not be sent');
    }

    return redirect('home');
  }

  // GET: projects
  public function projects() {
    return view('pages.projects')->with('page',['projects','Projects']);
  }

  // GET: content/update
  public function update() {
    //if(\Auth::check()){
      return view('pages.update')->with('page',['update','Update'])
      ->with('content',
        ['travelodge'=>$this->_getsection('travelodge'),
         'about'=>$this->_getsection('about'),
         'email'=>$this->_getsection('email'),
         'skills'=>\App\Skill::get(['id','skill','content']),
         'recent'=>$this->_getsection('recent')]
        )
      ->with('images',\App\Image::get(['id','filename']))
      ;
    //} else {abort(404);}
  }

  // Used by index() and content/update.
  private function _getsection($section) {
    $about=\App\Content::where('name',$section)->get();
    return $about[0]->content;
  }

  // Used by updatecontent.
  private function _updatesection($section, Request $request) {
    if(\App\Content::where('name',$section)->get()->count()==0) {
      $create=new \App\Content;
      $create->name = $section;
      $create->content = '';
      $create->save();
    }
    $input=$request->all();
    $update=\App\Content::where('name',$section)->update(['content'=>$input[$section]]);
  }

  // POST: content/update
  public function updatecontent(Request $request) {
    $this->validate(request(), ['email'=>'required']);
    $this->_updatesection('travelodge', $request);
    $this->_updatesection('about', $request);
    $this->_updatesection('recent', $request);
    $this->_updatesection('email', $request);

    if ($file=$request->file('image')) {
      // Upload image.
      $filename=$file->getClientOriginalName();
      $file->move('img/uploaded',$filename);
      $image=\App\Image::where('filename',$filename)->get();
      if(!$image->count()) { # Create new row if image filename is not present.
        $image=new \App\Image;
        $image->filename=$filename;
        $image->save();
      }
    }
    if(count(request('del'))) {
      foreach(request('del') as $imgid) { # Delete any selected images.
        $image=\App\Image::where('id',$imgid)->get(['filename']);
        \File::delete(public_path().'/img/uploaded/'.$image[0]->filename);
        $image=\App\Image::where('id',$imgid)->delete();
      }
    }

    $input=$request->all();
    if(!empty($input['skillname'])) {
      // Add new skill record.
      $skill=new \App\Skill;
      $skill->skill=empty($input['skillname'])?'':$input['skillname'];
      $skill->content='';
      $skill->save();
    }

    // Update existing skill records.
    foreach($input as $k=>$v) {
      if(substr($k, 0,strlen('skillname'))=='skillname') {
        $skillid=substr($k,strpos($k,'_')+1);
        if (is_numeric($skillid)) {
          $skill=(empty($v))?'':$v;
          $skillcontent=(empty($input["skillcontent_{$skillid}"]))?'':$input["skillcontent_{$skillid}"];
          $update=\App\Skill::where('id',$skillid)->update(['skill'=>$skill,'content'=>$skillcontent]);
        }
      }
    }

    session()->flash('message','Content was updated');

    return redirect('content/update');
  }

  // GET: login
  // Show login page.
  public function getlogin(){return view('pages.login')->with('page',['login','Login']);}

  // POST: login
  // Validates login form, redirect back to form if required fields not filled correctly, 
  // If validation passes, attempt login. If login succeeds redirect to home page, 
  // otherwise redirect back to login page again.
  public function postlogin() {
    $this->validate(request(), ['username'=>'required','password'=>'required']);
    $rememberme=(request('rememberme'))?true:false;
    if (\Auth::attempt(['username'=>request('username'),'password'=>request('password')],$rememberme))
      {return redirect('content/update');} # Log user in and redirect to update page.
    else {
      return view('pages/login')
      ->with('page',['login','Login failed'])
      ->with('message','Login failed')
      ;
    }

  }

  // GET: logout
  // Log user out and redirect to home page with success message.
  public function getlogout() {
    \Auth::logout(); // Log the user out of our application
    return redirect('home')->with('message','You are now logged out'); # redirect the user.
  }


}
