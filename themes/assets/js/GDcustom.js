function getCookie(cname) {
   let name = cname + "=";
   let decodedCookie = decodeURIComponent(document.cookie);
   let ca = decodedCookie.split(';');
   for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
         c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
         return c.substring(name.length, c.length);
      }
   }
   return "";
}


$('.consent-cookie button').on('click', function () {
   $(this).parent().remove();
});
function gtag() {
   dataLayer.push(arguments);
}
$('.consent-cookie button:not(.refus)').on('click', function () {
   gtag('consent', 'update', {
      'ad_storage': 'granted',
      'analytics_storage': 'granted'
   });
   document.cookie = 'cookie=true';
});
if(getCookie("cookie") != ""){
   gtag('consent', 'update', {
      'ad_storage': 'granted',
      'analytics_storage': 'granted'
   });
}else{
   $('.consent-cookie').addClass("active");
}
