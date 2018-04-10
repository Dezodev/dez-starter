# out: ../js/main.min.js, compress: true, sourcemap: true

## Feather icons
feather.replace()

## Smooth scroll
@smScroll = new SmoothScroll('a.smooth-scroll', {
    header: '.navbar.fixed-top'
});

## Back to top button
$(window).scroll ->
    if ($(this).scrollTop() >= 100)          ## If page is scrolled more than 50px
        $('#bck-top-btn').fadeIn(500)       ## Fade in the arrow
    else
        $('#bck-top-btn').fadeOut(500)      ## Else fade out the arrow
