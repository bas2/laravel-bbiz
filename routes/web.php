<?php
Route::get('/', function () {return view('welcome');});

Route::get('/home', function () {
  $pagetitle='Bashir Patel (Web developer/programmer) London-based';
  $aboutme='<p>I am a Web developer based in London, UK. I am passionate about developing for the Web. I have spent a significant period of time learning the tools of the web to a high standard.</p>
    <!--<p><a href="#">Contact me</a>-->';

  $skills_list=[
  'PHP'               =>'I have been using PHP since the year 2000. I am therefore knowledgable with this scripting language. I use OOP extensively and have recently started using the <a href="https://laravel.com/">Laravel</a> PHP framework.',
  'MySQL'             =>'Like PHP, I have been using this database system since 2000.',
  'HTML'              =>'I have been using HTML since 1999.',
  'CSS'               =>'I quickly picked up on the benefits of CSS quite soon after learning to code HTML.',
  'Jquery'            =>'I recently started using this in favour of plain Javascript in the last few years.',
  'Linux server admin'=>'Since electing to use Ubuntu instead of Windows as my chosen desktop OS, I have developed a liking for the Linux operating system. My domain bashir.biz was hosted on a CentOS server on which I had configured web, mail and database servers.',
  ];
  $recent='I have just completed work on the website and web applications at <a href="http://www.hcdchauffeurdrive.com/">HCD Chauffeur drive</a>. They are a chauffeur company based in London. I was asked to redevelop their web site and to build their online booking system and controller/driver systems.';
  $images=['hcdsite','hcdbooking2','hcdbooking','hcdcapp','hcdapp2'];
  return view('welcome')
  ->with('pagetitle',$pagetitle)
  ->with('pagecontent',['aboutme'=>$aboutme,'skill'=>$skills_list,'recent'=>$recent])
  ->with('images',$images);
})->name('home');

// Send email.
Route::post('/home', 'HomeController@sendEmail');
