function notificacao(messagem,tipo){

    if(!tipo){
        tipo = "success";
    }

    noty({
        text        : '<div class="alert alert-'+tipo+' fade in"><p><strong>Menssagem!</strong> '+messagem+'</p></div>',
        dismissQueue: true,
        layout      : 'topRight',
        closeWith   : ['click'],
        theme       : 'made',
        maxVisible  : 10,

        animation   : {
            open  : 'animated bounceIn',
            close : 'animated bounceOut'
        },
        timeout: 3000,

    });

}

    

