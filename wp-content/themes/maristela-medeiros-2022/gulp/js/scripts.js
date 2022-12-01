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

const btnContatoModal = document.querySelector('.btn-contato a')
btnContatoModal.addEventListener('click', function () {
  $('#SolicitaContato').modal('toggle')
})
