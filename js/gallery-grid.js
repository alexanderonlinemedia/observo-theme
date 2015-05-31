/**
 * Gallery Grid
 *
 */

jQuery(function ($) {

    $(window).load(resizeGrid);
    $(window).resize(resizeGrid);

    function resizeGrid () {

        var cardFronts = $('.card-front', '#card-gallery');

        cardFronts.each(function(i) {
            var cardFront = this;
            cardContainerHeight = $(cardFront).width();

            var image_url = $(cardFront).css('background-image'),
                image;

            // Remove url() or in case of Chrome url("")
            image_url = image_url.match(/^url\("?(.+?)"?\)$/);

            if (image_url[1]) {
                image_url = image_url[1];
                image = new Image();

                // just in case it is not already loaded
                $(image).load(function () {
                    var imageWidth = image.width;
                    var imageHeight = image.height;
                    var ratio = imageWidth / imageHeight;
                    if (imageWidth >= imageHeight) { //Landscape
                        var cardHeight = cardContainerHeight;
                        var cardWidth = (cardContainerHeight * ratio) + 2;
                    } else { //Portrait
                        var cardWidth = cardContainerHeight + 2;
                        var cardHeight = cardContainerHeight / ratio;
                    }
                    $(cardFront).css({
                        "height" : cardContainerHeight + "px",
                        "background-size" : cardWidth + "px " + cardHeight + "px"
                    });

                    $('.card', '#card-gallery').css({
                        "height" : cardContainerHeight + "px"
                    });
                });
                image.src = image_url;
            }
        });
    }

    $(document).ready(

      function() { 

        $("html").niceScroll();
        $("#site-header").niceScroll({
            cursoropacitymax: 0
        });
      }

    );

});