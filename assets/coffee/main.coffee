# out: ../js/main.min.js, compress: true, sourcemap: true

## Feather icons
feather.replace()

## Smooth scroll
@smScroll = new SmoothScroll('a.smooth-scroll', {
    header: '.navbar.fixed-top'
})

## Back to top button
$(window).scroll ->
    if ($(this).scrollTop() >= 100)          ## If page is scrolled more than 50px
        $('#bck-top-btn').fadeIn(500)       ## Fade in the arrow
    else
        $('#bck-top-btn').fadeOut(500)      ## Else fade out the arrow

## Sticky header
stickyOffset = $('.navbar.fixed-top').offset().top + $('.navbar.fixed-top').height()

menuPosition = () ->
    el_sticky = $('.navbar.fixed-top')
    scroll = $(window).scrollTop()

    if (scroll >= stickyOffset)
        el_sticky.addClass('dez-fixed')
    else
        el_sticky.removeClass('dez-fixed')

menuPosition()
$(window).scroll(menuPosition)
