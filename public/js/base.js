$(function() {
    $('.dropdown').hover(
      function() { $(this).addClass('show'); $(this).find('[data-toggle="dropdown"]').attr('aria-expanded', true); $(this).find('.dropdown-menu').addClass('show'); },
      function() { $(this).removeClass('show'); $(this).find('[data-toggle="dropdown"]').attr('aria-expanded',false); $(this).find('.dropdown-menu').removeClass('show'); }
    );
});