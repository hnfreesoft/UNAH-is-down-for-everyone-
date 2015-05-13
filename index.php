<?php

/*
 * index.php
 * 
 * Copyright 2015 Josue Ramos <josuevc2@openmailbox.org>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

if ($_GET['url']){
	$domain1 = $_GET['url'];
}else{
	$domain1 = 'http://registro.unah.edu.hn';
}

if (substr($domain1, 0, 4) === 'http'){
	$domain1 = $domain1;
}else{
	$domain1 = "http://".$domain1;
}

function checkOnline($domain) {
   $curlInit = curl_init($domain);
   curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
   curl_setopt($curlInit,CURLOPT_HEADER,true);
   curl_setopt($curlInit,CURLOPT_NOBODY,true);
   curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

   //get answer
   $response = curl_exec($curlInit);

   curl_close($curlInit);
   if ($response) return true;
   return false;
}


function get_http_response_code($domain1) {
	$headers = @get_headers($domain1);
	return substr($headers[0], 9, 3);

}

if (get_http_response_code($domain1)){

if ($get_http_response_code == 500 ) {
  $error = "<font color='red'>500 <h4>Internal Server Error</h4></font>";
}
if ($get_http_response_code == 404 ) {
  $error = "<font color='red'>404 <h4>Not Found</h4></font>";
}
if ($get_http_response_code == 502 ) {
  $error = "<font color='red'>502 <h4>Bad Gateway</h4></font>";
}
if ($get_http_response_code == 503 ) {
  $error = "</font>503 <h4>Service Unavailable</h4></font>";
}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>UNAH is Down for everyone?</title>
	<link rel="stylesheet" type="text/css" href="css.css" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.22" />
	<meta name="description" content="UNAH is Down for everyone? es una pagina creada para verificar el estatus de las paginas de la UNAH">
	<meta name="apple-mobile-web-app-capable" content="no" />
	<meta property="og:title" content="UNAH is Down for everyone?"/>
	<meta property="og:url" content="http://unahisdownforeveryone.tk/"/>
	<meta property="og:site_name" content="UNAH is Down for everyone?"/>
	<meta property="og:type" content="website"/>
	<meta property="og:description" content="UNAH is Down for everyone? es una pagina creada para verificar el estatus de las paginas de la UNAH"/>

<script>
var fadeEffect=function() {
  return{
    init:function(id, flag, target){
      this.elem = document.getElementById(id);
      clearInterval(this.elem.si);
      this.target = target ? target : flag ? 100 : 0;
      this.flag = flag || -1;
      this.alpha = this.elem.style.opacity ? parseFloat(this.elem.style.opacity) * 100 : 0;
      this.si = setInterval(function(){fadeEffect.tween()}, 20);
    },
    tween:function() {
      if(this.alpha == this.target){
        clearInterval(this.si);
      } else {
        var value = Math.round(this.alpha + ((this.target - this.alpha) * .05)) + (1 * this.flag);
        this.elem.style.opacity = value / 100;
        this.elem.style.filter = 'alpha(opacity=' + value + ')';
        this.alpha = value
      }
    }
  }
}();
</script>
</head>

<body>

<div id="left"></div>
<div id="right"></div>
<div id="middle">
<h1>UNAH is down for everyone?</h1>
<form action="index.php" method="get">
<input name="url" type="text" style=" border-radius:7px; border-style:solid; border-width:4px; padding:11px; font-size:25px; box-shadow: 0px 2px 8px 0px rgba(153,153,153,.6); font-weight:normal; font-style:none; font-family:sans-serif; background-color:#ffffff; border-color:#5c5c5c; color:#000000;  " value="<?php if ($domain1){ echo $domain1;} else {echo $_GET['url'];} ?>">

<input type="submit" class="btn-style" value="Try" />
</form>

<?php
if ($error){
	echo "<h2>ERROR</h2>". $error;
}elseif(checkOnline($domain1)){
	echo "<font color='green'><h2>It's just you</h2></font> ";
}elseif (!filter_var($domain1, FILTER_VALIDATE_URL) === false){
	print "<font color='red'><h2>URL MAL</h2></font> ";
}else{
	print "<font color='red'><h2>IS DOWN</h2></font> ";
}


?>
<div class="divbotones">
  <div class="elboton" onclick="fadeEffect.init('demoFADE', 1)" style="float:left">Iframe in</div>
  <div class="elboton" onclick="fadeEffect.init('demoFADE',0)" style="float:right">Iframe Out</div>
</div>
</div>

<div id="demoFADE" class="sinodemos" style="background: #00000; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;"> <iframe height="100%" width="100%" src="<?php echo $domain1; ?>"></iframe> </div>

<div id="footer"><a href="GPL.txt">Copyright (C) 2015 Josue Ramos</a> | <a href="https://github.com/hnfreesoft/UNAH-is-down-for-everyone-">GITHUB</a></div>
</body>

</html>



