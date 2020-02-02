/*$(function() {
  $('.dropdown').hover(
    function() { $(this).addClass('show'); $(this).find('[data-toggle="dropdown"]').attr('aria-expanded', true); $(this).find('.dropdown-menu').addClass('show'); },
    function() { $(this).removeClass('show'); $(this).find('[data-toggle="dropdown"]').attr('aria-expanded',false); $(this).find('.dropdown-menu').removeClass('show'); }
  );
});

*/

$(function() {

  // The viewport is less than 768 pixels wide so it's mobile resolution
  if(window.matchMedia("(max-width: 767px)").matches){
    // je désactive le comportement par défaut des liens qui est de s'ouvrir
    $('a.dropdown-toggle').click(function() {
      event.preventDefault();
    });

    $('.dropdown').click(function () {
      $(this).find(".dropdown-menu").toggleClass('show');
    });

  } 
  else
  {
    // The viewport is at least 768 pixels wide
    $('.dropdown').hover(
      function() {
        $(this).find(".dropdown-menu").addClass('show');
      },
      function() {
        $(this).find(".dropdown-menu").removeClass('show');
      }
    );
  
  }
  
});