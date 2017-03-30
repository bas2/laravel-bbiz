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
      'aboutme'=>$this->_getsection('about'),
      'email'=>(!filter_var($email, FILTER_VALIDATE_EMAIL)===false)?$email:'',
      'skills'=>\App\Skill::get(['skill','content']),
      'recent'=>$this->_getsection('recent')
      ])
    ->with('travelodge',
      [
      'lead'=>$this->_getsection('travelodge'),
      'today'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->format('Y-m-d'))
      ->where('price','>',0)
      ->orderBy('price','asc')
      ->orderBy( 'h.name' )
      ->get(),
      'tomorrow'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->addDay()->format('Y-m-d'))
      ->where('price','>',0)
      ->orderBy('price','asc')
      ->orderBy( 'h.name' )
      ->get(),


      'sat'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::parse('next saturday')->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),
      'sun'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),


      'sat1'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next saturday')->addWeek()->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),
      'sun1'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next sunday')->addWeek()->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),


      'sat2'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next saturday')
        ->addWeek(2)->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),
      'sun2'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next sunday')
        ->addWeek(2)->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),


      'sat3'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next saturday')
        ->addWeek(3)->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),
      'sun3'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next sunday')
        ->addWeek(3)->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),


      'sat4'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next saturday')
        ->addWeek(4)->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),
      'sun4'=>\App\TravelodgeDate::where('date',\Carbon\Carbon::parse('next sunday')
        ->addWeek(4)->format('Y-m-d'))
        ->orderBy('date','asc')
        ->orderBy('price','asc')
        ->get(),


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
    $hotels=[''=>'Select'];foreach(\App\TravelodgeHotel::orderBy('name')->get(['hotel_id','name']) as $hotel){$hotels[$hotel->hotel_id]=$hotel->name;}
    return view('pages.update')->with('page',['update','Update'])
    ->with('content',
      [
       'about'=>$this->_getsection('about'),
       'email'=>$this->_getsection('email'),
       'skills'=>\App\Skill::get(['id','skill','content']),
       'recent'=>$this->_getsection('recent')]
      )
    ->with('travelodge', [
      'lead'=>$this->_getsection('travelodge'),
      'today'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->format('Y-m-d'))
      ->orderBy( 'price','asc' )
      ->orderBy( 'h.name' )
      ->get(),
      'tomorrow'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->addDay()->format('Y-m-d'))
      ->orderBy( 'price','asc' )
      ->orderBy( 'h.name' )
      ->get(),
      'dayafter'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->addDay(2)->format('Y-m-d'))
      ->orderBy( 'price','asc' )
      ->orderBy( 'h.name' )
      ->get(),

      'satnext'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),
      'sunnext'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext1'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(1)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),
      'sunnext1'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(1)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext2'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(2)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),
      'sunnext2'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(2)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext3'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(3)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),
      'sunnext3'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(3)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext4'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(4)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),
      'sunnext4'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(4)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),



      'dates'=>\App\TravelodgeDate::where('date','>=',\Carbon\Carbon::now()->format('Y-m-d'))->orderBy('date')->get(),
      'hotels'=>$hotels,
      'newrowdate'=>$this->_getsection('newrowdate'),
      ])
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

    // Add new travelodge hotel date.
    $input=$request->all();
    if(!empty($input['hotel'])) {
      // Add new record only if hotel does not already exist.
      $hotel=new \App\TravelodgeDate;
      $hotel->hotelid=empty($input['hotel'])?'':$input['hotel'];
      $date=\Carbon\Carbon::createFromFormat('D M d Y',$input['date'])->format('Y-m-d');
      $price=empty($input['price'])?'':$input['price'];
      $hotel->date=empty($date)?'':$date;
      $hotel->price=$price;
      $hotel->hide=(isset($input['hide']))?1:0;
      $hotel->save();
      $update=\App\Content::where('name','price')->update(['content'=>$price]);
    }
    // Update existing.
    foreach($input as $k=>$v) {
      if(substr($k, 0,strlen('date_'))=='date_') {
        $id=substr($k, strpos($k, '_')+1);
        $price=$input["price_{$id}"];
        if($price==0) {
          $delete=\App\TravelodgeDate::where('date_id',$id)->delete();
        } else {
          $update=\App\TravelodgeDate::where('date_id',$id)
          ->update(['price'=>$price,'hide'=>0]);
        }
      }
    }


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

    //$input=$request->all();
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
    $theday='Today';
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::now()->addDay()->format('Y-m-d')) {$theday='Tomorrow';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::now()->addDay(2)->format('Y-m-d')) {$theday='Day after';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next saturday')->format('Y-m-d')) {$theday='Sat next';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next sunday')->format('Y-m-d')) {$theday='Sun next';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next saturday')->addWeek()->format('Y-m-d')) {$theday='Sat next1';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next sunday')->addWeek()->format('Y-m-d')) {$theday='Sun next1';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next saturday')->addWeek(2)->format('Y-m-d')) {$theday='Sat next2';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next sunday')->addWeek(2)->format('Y-m-d')) {$theday='Sun next2';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next saturday')->addWeek(3)->format('Y-m-d')) {$theday='Sat next3';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next sunday')->addWeek(3)->format('Y-m-d')) {$theday='Sun next3';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next saturday')->addWeek(4)->format('Y-m-d')) {$theday='Sat next4';}
    if(\Carbon\Carbon::parse($input['date'])->format('Y-m-d')==\Carbon\Carbon::parse('next sunday')->addWeek(4)->format('Y-m-d')) {$theday='Sun next4';}

    return view('includes.travday')
    ->with('travelodge', [
      'today'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->format('Y-m-d'))
      ->orderBy('price','asc')
      ->orderBy( 'h.name' )
      ->get(),
      'tomorrow'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->addDay()->format('Y-m-d'))
      ->orderBy('price','asc')
      ->orderBy( 'h.name' )
      ->get(),
      'dayafter'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
      ->where('date',\Carbon\Carbon::now()->addDay(2)->format('Y-m-d'))
      ->orderBy('price','asc')
      ->orderBy( 'h.name' )
      ->get(),

      'satnext'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'sunnext'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext1'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(1)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'sunnext1'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(1)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext1'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(1)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'sunnext2'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(2)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext3'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(3)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'sunnext3'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(3)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'satnext4'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next saturday')->addWeek(4)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'sunnext4'=>\App\TravelodgeDate::join('travelodge_hotels AS h','h.hotel_id','=','travelodge_dates.hotelid')
        ->where('date',\Carbon\Carbon::parse('next sunday')->addWeek(4)->format('Y-m-d'))
        ->orderBy('price','asc')
        ->orderBy( 'h.name' )
        ->get(),

      'hotels'=>$hotels,
    ])
    ->with(['text'=>$theday, 
    'date2'=>\Carbon\Carbon::parse($input['date']),
    'price'=>(isset($input['newpricerow'])?$input['newpricerow']:39),
    ])
    ;
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
