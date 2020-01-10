//= libs/owlCarousel/owl.carousel.min.js

$(document).ready(function($) {

  carousel();
  forms();
});

function carousel() {
  // Owl Carousel
  var cardOwl = $(".card-carousel");
  var owl = $(".owl-carousel")
  cardOwl.owlCarousel({
    items: 1,
    margin: 10,
    loop: true,
    nav: true
  });

  owl.owlCarousel({
    margin: 30,
    loop: true,
    nav: true,
    dots: true,
    autoplay: true,
    autoplayHoverPause: true,
    stagePadding: 5,
    responsive : {
      // breakpoint from 0 up
      0 : {
        items : 1
      },
      // breakpoint from 576 up
      540 : {
        items : 2
      },
      // breakpoint from 768 up
      750 : {
        items : 3
      },
      960 : {
        items : 4
      }
    }
  });
}

// Формы
function forms(){
  $("form").each(function () {
    var sform = $(this);

    var valsform = sform.validate({
      rules: {
        agreement: {
          required: true
        }
      },
      messages: {},
      submitHandler: function(form) {

        switch ( sform.attr('id') ){

          default:

            var data;
            data = new FormData( sform[0] );

            $.ajax({
              type : "post",
              dataType : "json",
              url : '/wp-admin/admin-ajax.php?action=feedback',
              data : data,
              processData: false,
              contentType: false,
              success: function(response) {
                if ( response.status == 'success' ){
                  sform.find("input[type='text'],input[type='tel'], textarea").val("");
                  openeOverlay("#overlay-modal-success");
                }
              }
            });
            break;
        }

        return false;
      },
    });
  });
}
