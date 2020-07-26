console.log('%c Zeus. For Lazy Programmer ', 'background: #222; color: #bada55; font-size:40px');

function overlay_show() {
    $(".m-overlay").show()
}

function overlay_hide() {
    setTimeout(function () {
        $(".m-overlay").hide()
    }, 500)
}
