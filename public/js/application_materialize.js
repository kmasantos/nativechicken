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

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false, // Close upon selecting a date,
        container: undefined, // ex. 'body' will append picker to body
        format: 'yyyy-mm-dd',
    });

    $('#pheno_morpho').modal({
        dismissible: false
    });

    $('#feeding').modal({
        dismissible: false
    });

    $('#pen_modal').modal({
        dismissible: false
    });

    $('#add_generation').modal({
        dismissible : false,
    });

    $('#add_line').modal({
        dismissible : false,
    });

    $('#add_family').modal({
        dismissible : false,
    });

    $('#add_breeder_modal').modal({
        dismissible : false,
    });

});
