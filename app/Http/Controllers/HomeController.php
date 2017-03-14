<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

class HomeController extends Controller
{
  public function index() {
    return view('pages.welcome')
    ->with('page',['home','Bashir Patel (Web developer/programmer) London-based'])
    ->with('pagecontent', [
      'aboutme'=>$this->getsection('about'),
      'skills'=>\App\Skill::get(['skill','content']),
      'recent'=>$this->getsection('recent')
      ])
    ->with('images',\App\Image::get(['filename']));
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
    $skills=\App\Skill::get(['id','skill','content']);
    $recent=\App\Content::where('name','recent')->get();
    $recent=($recent->count()==1) ? $recent[0]->content : '' ;
    return view('pages.update')->with('page',['update','Update'])
    ->with('content',
      ['about'=>$about[0]->content,'skills'=>$skills,'recent'=>$recent]
      )
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

    if ($file=$request->file('image')) {
      $filename=$file->getClientOriginalName();
      $file->move('img',$filename);
      $image=\App\Image::where('filename',$filename)->get();
      if(!$image->count()) {
        $image=new \App\Image;
        $image->filename=$filename;
        $image->save();
      }
    }
    $input=$request->all();
    if(!empty($input['skillname'])) {
      $skill=new \App\Skill;
      $skill->skill=$input['skillname'];
      $skill->save();
    }

    foreach($input as $k=>$v) {
      if(substr($k, 0,strlen('skillname'))=='skillname') {
        $skillid=substr($k,strpos($k,'_')+1);
        if (is_numeric($skillid)) { 
          echo $update=\App\Skill::where('id',$skillid)->update(['skill'=>$v,'content'=>$input["skillcontent_{$skillid}"]]);
        }
      }
    }

    return redirect('content/update');
  }





}
