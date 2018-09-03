$( document ).ready(function() {
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, 
        hover: false,
        gutter: 0,
        belowOrigin: true,
        alignment: 'left',
        stopPropagation: false
    });

    $(".button-collapse").sideNav();

    $('.modal').modal();
});
