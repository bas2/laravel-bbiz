<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bashir Patel (Web developer/programmer) London-based</title>
  <link rel="stylesheet" href="/bbiz/public/css/styles.css">
</head>
<body>
<div class="topdiv">
<fieldset class="intro">
<legend>About me</legend>
<p>I am a Web developer based in London, UK. I am passionate about developing for the Web. I have spent a significant period of time learning the tools of the web to a high standard.</p>
</fieldset>
<div class="sep"></div>
<fieldset class="skills">
<legend>Skills</legend>
<ul>
<li><i>PHP</i> &rarr; I have been using PHP since the year 2000.</li>
<li><i>MySQL</i> &rarr; Like PHP, I have been using this database system since 2000.</li>
<li><i>HTML</i> &rarr; I have using HTML since 1999.</li>
<li><i>CSS</i> &rarr; I quickly picked up on the benefits of CSS quite soon after learning to code HTML.</li>
<li><i>Jquery</i> &rarr; I recently started using this in favour of plain Javascript in the last few years.</li>
<li><i>Linux server admin</i> &rarr; Since electing to use Ubuntu instead of Windows as my chosen desktop OS, I have developed a liking for the Linux operating system. My domain bashir.biz is hosted on a CentOS server on which I have configured my own web, mail and database servers.</li>
</ul>
</fieldset>
</div>

<fieldset class="recent">
<legend>Recent work</legend>
<p>I have just completed work on the website and web applications at <a href="http://www.hcdchauffeurdrive.com/">HCD Chauffeur drive</a>. They are a chauffeur company based in London. I was asked to redevelop their web site and to build their online booking system and controller/driver systems.</p>
<ul>
@foreach($images as $image)<li><a href="img/{{ $image }}.png" rel="lightbox"><img src="img/{{ $image }}.png" alt="" width="200"></a></li>@endforeach
</ul>

</fieldset>

</body>
</html>