$(".mask_preco").mask('#.##0,00', {reverse: true});

$(".buttonAddCarrinho").on('click', function() {
    var id_peca = this.dataset.id;
    $.confirm({
        title: 'Confirmação!',
        content: 'Deseja adicionar o produto ao carrinho?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Adicionar',
                btnClass: 'btn-success',
                action: function(){
                    $.ajax({
                        url: '../model/addItemCarrinho.php',
                        type: 'POST',
                         data: {
                            id_peca: id_peca 
                         }
                    }).done((response) => {
                        var r = JSON.parse(response);
                        if (r.erro === 0) {
                            location.reload();
                        } else {
                            alert(r.msg);
                            return false;
                        }
                    });
                }
            },
            close: {
                text: 'Cancelar',
                btnClass: 'btn-red',
            }
        }
    });
});

$(".button_add_item").on('click', function() {
    var id_carrinho = this.dataset.id;
    $.ajax({
        url: '../model/add.php',
        type: 'POST',
         data: {
            id_carrinho: id_carrinho 
         }
    }).done((response) => {
        var r = JSON.parse(response);
        if (r.erro === 0) {
            location.reload();
        } else {
            alert(r.msg);
            return false;
        }
    })
});
$(".button_del_item").on('click', function() {
    var id_carrinho = this.dataset.id;
    $.ajax({
        url: '../model/del.php',
        type: 'POST',
         data: {
            id_carrinho: id_carrinho 
         }
    }).done((response) => {
        var r = JSON.parse(response);
        if (r.erro === 0) {
            location.reload();
        } else {
            alert(r.msg);
            return false;
        }
    })
});

$("#form_post_peca").on('submit', function(e){
    e.preventDefault();
    var fd = $("#form_post_peca")[0];

    var nome = form_post_peca.nome.value;
    var preco = form_post_peca.preco.value.replace('.', '').replace('.', '').replace(',', '.');
    var img = form_post_peca.imagem.value;

    if (nome === "") {
        alert("INFORME O NOME POR FAVOR!");
        return false;
    }

    if (preco === "") {
        alert("INFORME O PREÇO POR FAVOR!");
        return false;
    }
    
    if (img === "") {
        alert("SELECIONE UMA IMAGEM POR FAVOR!");
        return false;
    }

    var newFd = new FormData(fd);
    newFd.set('preco', preco);
    $.ajax({
        url: '../model/postPeca.php',
        type: 'POST',
        processData: false,
        dataTypeIn: 'plain',
        contentType: false,
        data: newFd
    }).done((response) => {
        var r = JSON.parse(response);
        if (r.erro === 0) {
            location.reload();
        } else {
            alert(r.msg);
            return false;
        }
    });
});

$("#form_put_peca").on('submit', function(e){
    e.preventDefault();
    var fd = $("#form_put_peca")[0];

    var nome = form_put_peca.nome.value;
    var preco = form_put_peca.preco.value.replace('.', '').replace('.', '').replace(',', '.');

    if (nome === "") {
        alert("INFORME O NOME POR FAVOR!");
        return false;
    }

    if (preco === "") {
        alert("INFORME O PREÇO POR FAVOR!");
        return false;
    }

    var newFd = new FormData(fd);
    newFd.set('preco', preco);
    $.ajax({
        url: '../model/putPeca.php',
        type: 'POST',
        processData: false,
        dataTypeIn: 'plain',
        contentType: false,
        data: newFd
    }).done((response) => {
        var r = JSON.parse(response);
        if (r.erro === 0) {
            location.reload();
        } else {
            alert(r.msg);
            return false;
        }
    });
});