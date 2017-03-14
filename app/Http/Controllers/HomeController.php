<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

class HomeController extends Controller
{
  public function index() {
    $skills_list=[
    'PHP'               =>'I have been using PHP since the year 2000. I am therefore knowledgable with this scripting language. I use OOP extensively and have recently started using the <a href="https://laravel.com/">Laravel</a> PHP framework.',
    'MySQL'             =>'Like PHP, I have been using this database system since 2000.',
    'HTML'              =>'I have been using HTML since 1999.',
    'CSS'               =>'I quickly picked up on the benefits of CSS quite soon after learning to code HTML.',
    'Jquery'            =>'I recently started using this in favour of plain Javascript in the last few years.',
    'Linux server admin'=>'Since electing to use Ubuntu instead of Windows as my chosen desktop OS, I have developed a liking for the Linux operating system. My domain bashir.biz was hosted on a CentOS server on which I had configured web, mail and database servers.',
    ];
    $images=['hcdsite','hcdbooking2','hcdbooking','hcdcapp','hcdapp2'];
    return view('pages.welcome')
    ->with('page',['home','Bashir Patel (Web developer/programmer) London-based'])
    ->with('pagecontent',
      ['aboutme'=>$this->getsection('about'),'skill'=>$skills_list,'recent'=>$this->getsection('recent')])
    ->with('images',$images);
  }

  public function sendEmail() {
    $this->validate(request(), [
      'message'=>'required|min:5|max:300',
    ]);
    \Mail::to('mail3@bashir.biz')->send(new ContactMail(request('message')));
    session()->flash('message','Thank you for your message!');

    return redirect()->home();
  }

  public function projects() {
    return view('pages.projects')->with('page',['projects','Projects']);
  }

  public function update() {
    $about=\App\Content::where('name','about')->get();
    $recent=\App\Content::where('name','recent')->get();
    $recent=($recent->count()==1) ? $recent[0]->content : '' ;
    return view('pages.update')->with('page',['update','Update'])
    ->with('content',['about'=>$about[0]->content,'recent'=>$recent])
    ;
  }

  private function getsection($section) {
    $about=\App\Content::where('name',$section)->get();
    return $about[0]->content;
  }

  private function updatesection($section, Request $request) {
    $about=\App\Content::where('name',$section)->get();
    if($about->count()==0) {
      $create= new \App\Content;
      $create->name = $section;
      $create->content = '';
      $create->save();
    }
    $input=$request->all();
    $update=\App\Content::where('name',$section)->update(['content'=>$input[$section]]);
  }

  public function updatecontent(Request $request) {
    $this->updatesection('about', $request);
    $this->updatesection('recent', $request);



    return redirect('home');
  }

}
