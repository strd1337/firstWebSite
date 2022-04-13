/* burger */
function openNav() {
    document.getElementById("burger__id").style.width = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("burger__id").style.width = "0";
    document.body.style.backgroundColor = "white";
}

$(function () {

    /* filter */
    let filter = $("[data-filter]");
    filter.on("click", function (event) {
            event.preventDefault();
            let cat = $(this).data('filter');
            if (cat == 'All') {
                $("[data-cat]").removeClass('hide');
            }
            else {
                $("[data-cat]").each(function () {
                    let item = $(this).data('cat');
                    if (item != cat) {
                        $(this).addClass('hide');
                    }
                    else {
                        $(this).removeClass('hide');
                    }
                });
            }
        })

    /* modal */
    const modalCall = $("[data-modal]");
    const modalClose = $("[data-close]");

    modalCall.on("click", function (event) {
        event.preventDefault();
        let modalId = $(this).data('modal');
        console.log(modalId);
        $(modalId).addClass('show');
        $("body").addClass('no-scroll');
        setTimeout(function () {
            $(modalId).find(".modal__dialog").css({
                transform: "rotateX(0)"
            });
        }, 200);
    });

    modalClose.on("click", function (event) {
        event.preventDefault();
        let modalParent = $(this).parents('.modal');
        modalParent.find(".modal__dialog").css({
            transform: "rotateX(90deg)"
        });
        setTimeout(function () {
            modalParent.removeClass('show');
            $("body").removeClass('no-scroll');
        }, 200);
    });

    $(".modal").on("click", function (event) {
        let $this = $(this);

        $(this).find(".modal__dialog").css({
            transform: "rotateX(90deg)"
        });
        setTimeout(function () {
            $this.removeClass('show');
            $("body").removeClass('no-scroll');
        }, 200);
    });

    $(".modal__dialog").on("click", function (event) {
        event.stopPropagation();
    });


    /* reviews */
    $('.reviews__inner').slick({
        dots: true,
        arrows: true,
        infinite: true,
        speed: 2000,
        slidesToShow: 1,
        adaptiveHeight: true,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
        {
          breakpoint: 1024,
          settings: {
            arrows: false
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false
          }
        }
      ]
    })

    /* scroll slowly */
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();

        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 1000);
    });
});



