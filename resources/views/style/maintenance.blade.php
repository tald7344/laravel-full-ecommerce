<!doctype html>
<title>{{ trans('home.site-maintenance') }}</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
<style>
  html, body { padding: 0; margin: 0; width: 100%; height: 100%; }
  /** {box-sizing: border-box;}*/
  /*body { text-align: center; padding: 0; color: #999; font-family: Open Sans; }*/
  /*h1 { font-size: 60px; font-weight: 100; text-align: center;}*/
  body { font-family: Open Sans; font-weight: 100; font-size: 20px; color: #999; text-align: center; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; align-items: center;}
  /*article { display: block; width: 700px; padding: 50px; margin: 0 auto; }*/
  article p { font-size: clamp(1.8rem, 1.2324375rem + 1.5135vw, 3.2rem); margin-top: 20px; }  */
  a { color: #fff; font-weight: bold; }
  a:hover { text-decoration: none; }
  /*svg { width: 75px; margin-top: 1em; }*/
</style>

<article>
  <img width="550" src="{{ asset('images/under-maintenance.jpg') }}" class="" />
{{--  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 202.24 202.24"><defs><style>.cls-1{fill:#fff;}</style></defs><title>Asset 3</title><g id="Layer_2" data-name="Layer 2"><g id="Capa_1" data-name="Capa 1"><path class="cls-1" d="M101.12,0A101.12,101.12,0,1,0,202.24,101.12,101.12,101.12,0,0,0,101.12,0ZM159,148.76H43.28a11.57,11.57,0,0,1-10-17.34L91.09,31.16a11.57,11.57,0,0,1,20.06,0L169,131.43a11.57,11.57,0,0,1-10,17.34Z"/><path class="cls-1" d="M101.12,36.93h0L43.27,137.21H159L101.13,36.94Zm0,88.7a7.71,7.71,0,1,1,7.71-7.71A7.71,7.71,0,0,1,101.12,125.63Zm7.71-50.13a7.56,7.56,0,0,1-.11,1.3l-3.8,22.49a3.86,3.86,0,0,1-7.61,0l-3.8-22.49a8,8,0,0,1-.11-1.3,7.71,7.71,0,1,1,15.43,0Z"/></g></g></svg>--}}
  <br>
  <p>{{ setting()->message_maintenance }}</p>
</article>
