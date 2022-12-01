// Incluir fixed no header
function navbarFixed() {
  if ($('header').length) {
    $(window).on('scroll', function () {
      var scroll = $(window).scrollTop();
      if (scroll) {
        $("header").addClass("fixed");
      } else {
        $("header").removeClass("fixed");
      }
    });
  };
};
navbarFixed()

$(document).ready(function () {
  // Registro do carousel
  $(".owl-carousel").owlCarousel();

  // Máscara de telefone
  $('#telefone').mask('(00) 00000-0000');

  // Abrir modal
  // if (window.location.href.indexOf('#SolicitaContato') != -1) {
  //   $('#SolicitaContato').modal('show');
  // }
});

// active modal menu
const btnContatoModal = document.querySelector('.btn-contato a')
btnContatoModal.addEventListener('click', function () {
  $('#SolicitaContato').modal('toggle')
})

// passive events
const events = ['touchstart', 'touchmove', 'wheel', 'mousewheel']
function passiveEvent(events) {
  events.forEach(mineEvent => {
    jQuery.event.special.mineEvent = {
      setup: function (_, ns, handle) {
        this.addEventListener(mineEvent, handle, {
          passive: true
        });
      }
    }
  })
}
passiveEvent(events)
