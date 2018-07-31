$(document).ready(function(){
    $('.inactive_button').each(function(){
            $(this).click(function(){
            $('#gen_confirmation').attr('value', $(this).attr('data-generation'));
            $('#confirmation_title').text($(this).attr('data-gennum'));
        });
    });
    $('.edit_button').each(function(){
        $(this).click(function(){
            $('#generation_edit').attr('value', $(this).attr('data-generation'));
            $('#edit_title').text('Edit Generation ' + $(this).attr('data-gennum'));
        });
    });
    $('#add_line_button').click(function(){
        $('#line_div').append('\
            <div class="col s12 m12 l12">\
                <input placeholder="Enter line number" id="line" type="text" name="line[]">\
            </div>\
        ');
    });
    $('#edit_line_button').click(function(){
        $('#line_edit_div').append('\
            <div class="input-field col s12 m6 l6">\
                <input type="text" name="line_edit[]">\
            </div>\
        ');
    });
});