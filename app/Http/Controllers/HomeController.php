<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ContactMail;

use \Carbon\Carbon;

class HomeController extends Controller
{

  private function _getDB($date) {
    return \App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',Carbon::parse($date)->format('Y-m-d'))
      //->where('price','>',0)
      ->orderBy('price','asc')
      ->orderBy( 'h.name' )
      ->get();
  }

  // GET: {slug?}
  public function index() {
    $arr=[];
    $arr['lead']    =$this->_getsection('travelodge');
    $arr['today']   =$this->_getDB(Carbon::now()->format('Y-m-d'));
    $arr['tomorrow']=$this->_getDB(Carbon::now()->addDay());
    $arr['dayafter']=$this->_getDB(Carbon::now()->addDay(2));

    $arr['frinext']=$this->_getDB(Carbon::parse('next friday'));
    $arr['satnext']=$this->_getDB(Carbon::parse('next friday')->addDay());
    $arr['sunnext']=$this->_getDB(Carbon::parse('next friday')->addDay(2));
    for($i=1;$i<12;$i++) {
      $arr["frinext{$i}"]=$this->_getDB(Carbon::parse('next friday')->addWeek($i));
      $arr["satnext{$i}"]=$this->_getDB(Carbon::parse('next friday')->addDay()->addWeek($i));
      $arr["sunnext{$i}"]=$this->_getDB(Carbon::parse('next friday')->addDay(2)->addWeek($i));
    }
    $email=$this->_getsection('email');

    return view('pages.welcome')
    ->with('page',['home','Bashir Patel (Web developer/programmer) London-based'])
    ->with('pagecontent', [
      'aboutme'=>$this->_getsection('about'),
      'email'  =>(!filter_var($email, FILTER_VALIDATE_EMAIL)===false)?$email:'',
      'skills' =>\App\Skill::get(['skill','content']),
      'recent' =>$this->_getsection('recent')
      ])
    ->with('travelodge', $arr)
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
    $hotels=[''=>'Select'];foreach(\App\TravelodgeHotel::orderBy('name')->get(['hotel_id','name']) as $hotel){$hotels[$hotel->hotel_id]=$hotel->name;}

    $arr=[];
    $arr['lead']    =$this->_getsection('travelodge');
    $arr['today']   =$this->_getDB(Carbon::now()->format('Y-m-d'));
    $arr['tomorrow']=$this->_getDB(Carbon::now()->addDay());
    $arr['dayafter']=$this->_getDB(Carbon::now()->addDay(2));

    $arr['frinext']=$this->_getDB(Carbon::parse('next friday'));
    $arr['satnext']=$this->_getDB(Carbon::parse('next friday')->addDay());
    $arr['sunnext']=$this->_getDB(Carbon::parse('next friday')->addDay(2));
    for($i=1;$i<13;$i++) {
      $arr["frinext{$i}"]=$this->_getDB(Carbon::parse('next friday')->addWeek($i));
      $arr["satnext{$i}"]=$this->_getDB(Carbon::parse('next friday')->addDay()->addWeek($i));
      $arr["sunnext{$i}"]=$this->_getDB(Carbon::parse('next friday')->addDay(2)->addWeek($i));
    }
    $arr['dates']=\App\TravelodgeDate::where('date','>=',Carbon::now()->format('Y-m-d'))->orderBy('date')->get();
    $arr['hotels']=$hotels;
    $arr['newrowdate']=$this->_getsection('newrowdate');

    return view('pages.update')->with('page',['update','Update'])
    ->with('content',
      [
       'about' =>$this->_getsection('about'),
       'email' =>$this->_getsection('email'),
       'skills'=>\App\Skill::get(['id','skill','content']),
       'recent'=>$this->_getsection('recent')]
      )
    ->with('images',\App\Image::get(['id','filename']))
    ->with('travelodge', $arr)
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

    $input=$request->all();

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

  public function postUpdateTravToday(Request $request) {
    $hotels=[''=>'Select'];foreach(\App\TravelodgeHotel::orderBy('name')->get(['hotel_id','name']) as $hotel){$hotels[$hotel->hotel_id]=$hotel->name;}

    $input=$request->all();
    foreach($input as $k=>$v) {
      if ($k!='update') {
        $hotel_id=substr($k, strlen('hotel_price')+1);
        if ($v==0) {
          $delete=\App\TravelodgeDate::where('date_id',$hotel_id)->delete();
        } else {
          $update=\App\TravelodgeDate::where('date_id',$hotel_id)->update(['price'=>$v]);
        }
      }
    }
          
    if($input['newdaterow']) {
      $insert=new \App\TravelodgeDate;
      $insert->price=$input['newpricerow'];
      $insert->date=$input['date'];
      $insert->hotelid=$input['newdaterow'];
      $insert->save();
      //$update=\App\Content::where('name','price')->update(['content'=>$input['newpricerow']]);
    }
    $theday='Today';$thecdate=Carbon::parse($input['date'])->format('Y-m-d');
    if($thecdate==Carbon::now()->addDay()->format('Y-m-d')) {$theday='Tomorrow';}
    if($thecdate==Carbon::now()->addDay(2)->format('Y-m-d')) {$theday='Day after';}
    if($thecdate==Carbon::parse('next friday')->format('Y-m-d')) {$theday='Fri next';}
    if($thecdate==Carbon::parse('next friday')->addDay()->format('Y-m-d')) {$theday='Sat next';}
    if($thecdate==Carbon::parse('next friday')->addDay(2)->format('Y-m-d')) {$theday='Sun next';}
    
    for($i=1;$i<13;$i++) {
      if($thecdate==Carbon::parse('next friday')
        ->addWeek($i)->format('Y-m-d')){$theday="Fri next{$i}";}
      if($thecdate==Carbon::parse('next friday')
        ->addDay()->addWeek($i)->format('Y-m-d')){$theday="Sat next{$i}";}
      if($thecdate==Carbon::parse('next friday')
        ->addDay(2)->addWeek($i)->format('Y-m-d')){$theday="Sun next{$i}";}
    }

    $arr=[];
    $arr['today']   =$this->_getDB(Carbon::now()->format('Y-m-d'));
    $arr['tomorrow']=$this->_getDB(Carbon::now()->addDay());
    $arr['dayafter']=$this->_getDB(Carbon::now()->addDay(2));
    $arr['frinext'] =$this->_getDB(Carbon::parse('next friday'));
    $arr['satnext'] =$this->_getDB(Carbon::parse('next friday')->addDay());
    $arr['sunnext'] =$this->_getDB(Carbon::parse('next friday')->addDay(2));
    for($i=1;$i<13;$i++) {
      $arr["frinext{$i}"]=$this->_getDB(Carbon::parse('next friday')
        ->addWeek($i));
      $arr["satnext{$i}"]=$this->_getDB(Carbon::parse('next friday')
        ->addDay()->addWeek($i));
      $arr["sunnext{$i}"]=$this->_getDB(Carbon::parse('next friday')
        ->addDay(2)->addWeek($i));
    }
    $arr['hotels']=$hotels;

    return view('includes.travday')
    ->with('travelodge', $arr)
    ->with(['text'=>$theday, 
    'date2'=>Carbon::parse($input['date']),
    'price'=>(isset($input['newpricerow'])?$input['newpricerow']:39),
    'order'=>$request['orderby'],
    'dontshowtabs'=>1,
    ])
    ;
  }

  // GET: travelodge/getday
  public function getday($theday, Request $request) {
    $hotels=[''=>'Select'];foreach(\App\TravelodgeHotel::orderBy('name')->get(['hotel_id','name']) as $hotel){$hotels[$hotel->hotel_id]=$hotel->name;}
    $arr=[];
    $arr[strtolower(str_replace(' ','',$request['text']))]=$this->_getDB($theday);
    $arr['hotels']=$hotels;

    return view('includes.travday')
    ->with('travelodge', $arr)
    ->with(['text'=>$request['text'], 
    'date2'=>Carbon::parse($theday),
    'order'=>$request['orderby'],
    'dontshowtabs'=>1,
    ])
    ;
  }

  // GET: travelodge/hotel/{id}/notes
  public function getnotes($id) {
    return $hotelnotes=\App\TravelodgeHotel::where('hotel_id',$id)->get(['notes'])[0]->notes;
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

