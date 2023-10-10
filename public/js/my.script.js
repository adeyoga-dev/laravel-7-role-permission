function printErrorMsg(msg,selector){
    //inisialisasi variabel
    var message = "",html;
    //mengosongkan pesan error
    $("#"+selector).empty();
    //melooping pesan error dan disimpan di variabel
    $.each( msg, function( key, value ) {
        message += "<li>"+value+"</li>";
    });
    //membuat ulang pesan error di html
    message = "<ul>"+message+"</ul";
    html = '<div class="alert alert-danger" role="alert">'+message+'</div';
    // membuat pesan error di moda
    $("#"+selector).append(html);
}
