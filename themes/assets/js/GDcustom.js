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

$(document).ready(function () {
   // Fonction pour déplacer le carousel vers la gauche
   function moveCarouselLeft() {
      var $currentAct = $(".list .act");
      var $nextAct = $currentAct.next().length ? $currentAct.next() : $(".list li").first();
      var $prevAct = $currentAct.prev().length ? $currentAct.prev() : $(".list li").last();

      $(".list li").removeClass("act prev next");

      $currentAct.removeClass("act").addClass("prev");
      $nextAct.removeClass("prev next").addClass("act");
      $prevAct.removeClass("prev next").addClass("next");

      $(".list li").not(".act").css("opacity", "0.25");
      $(".list .act").css("opacity", "1");

      $(".swipe").animate({left: '-=220px'}, 500, function () {
         $(".swipe").css("left", "-=220px");
      });
   }

   // Déplacement automatique du carrousel toutes les 15 secondes
   var interval = setInterval(function () {
      moveCarouselLeft();
   }, 5000);

   // Clic sur une carte du carrousel (désactivé)
   $(".list li").click(function () {
      // Désactiver les clics pendant le déplacement automatique
      return false;
   });
});
