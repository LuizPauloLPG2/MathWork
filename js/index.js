$(".mask_preco").mask('#.##0,00', { reverse: true });
$(".buttonAddCarrinhoPeca").on('click', function() {
    var id_peca = this.dataset.id;
    $.confirm({
        title: 'Confirmação!',
        content: 'Deseja adicionar o produto ao carrinho?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Adicionar ao carrinho',
                btnClass: 'btn-success',
                action: function() {
                    $.ajax({
                        url: '../model/addItemPecaCarrinho.php',
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
    var id_carrinhopeca = this.dataset.id;
    $.ajax({
        url: '../model/addItemPeca.php',
        type: 'POST',
        data: {
            id_carrinhopeca: id_carrinhopeca
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
});
$(".button_del_item").on('click', function() {
    var id_carrinhopeca = this.dataset.id;
    $.ajax({
        url: '../model/delItemPeca.php',
        type: 'POST',
        data: {
            id_carrinhopeca: id_carrinhopeca
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
});

$("#form_post_peca").on('submit', function(e) {
    e.preventDefault();
    var fd = $("#form_post_peca")[0];

    var nome = form_post_peca.nome.value;
    var preco = form_post_peca.preco.value.replace('.', '').replace('.', '').replace(',', '.');
    var img = form_post_peca.imagem.value;
    var estoque = form_post_peca.estoque.value;

    if (estoque < 0) {
        alert("VALOR DO ESTOQUE DEVE SER MAIOR OU IGUAL 0!");
        return false;
    }

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

$("#form_put_peca").on('submit', function(e) {
    e.preventDefault();
    var fd = $("#form_put_peca")[0];

    var nome = form_put_peca.nome.value;
    var custo = form_put_peca.custo.value.replace('.', '').replace('.', '').replace(',', '.');
    var preco = form_put_peca.preco.value.replace('.', '').replace('.', '').replace(',', '.');
    var estoque = form_put_peca.estoque.value;

    if (estoque < 0) {
        alert("VALOR DO ESTOQUE DEVE SER MAIOR OU IGUAL 0!");
        return false;
    }

    if (nome === "") {
        alert("INFORME O NOME POR FAVOR!");
        return false;
    }

    if (preco === "") {
        alert("INFORME O PREÇO POR FAVOR!");
        return false;
    }

    var newFd = new FormData(fd);
    newFd.set('custo', custo);
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

$("#form_post_finaliza_compra").on('submit', function(e) {
    e.preventDefault();
    var fd = $("#form_post_finaliza_compra")[0];
    var id_usuario = $("#id_usuario").val();
    var valor_total = form_post_finaliza_compra.valor_total.value.replace('.', '').replace('.', '').replace(',', '.');

    if (valor_total === '0.00') {
        alert("Realize a compra de algum produto, por favor!");
        return false;
    }

    var newFd = new FormData(fd);
    newFd.set('valor_total', valor_total);
    $.ajax({
        url: '../model/postFinalizaCompra.php',
        type: 'POST',
        data: {
            id_usuario: id_usuario,
            valor_total: valor_total
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
});

$("#form_put_custo_empresa").on('submit', function(e) {
    e.preventDefault();
    var fd = $("#form_put_custo_empresa")[0];

    var aluguel = form_put_custo_empresa.aluguel.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var agua = form_put_custo_empresa.agua.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var energia = form_put_custo_empresa.energia.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var internet = form_put_custo_empresa.internet.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var telefone = form_put_custo_empresa.telefone.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var custo_fixo = form_put_custo_empresa.custo_fixo.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var impostos = form_put_custo_empresa.impostos.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var transportes = form_put_custo_empresa.transportes.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');
    var funcionarios = form_put_custo_empresa.funcionarios.value.replace('.', '').replace('.', '').replace('.', '').replace(',', '.');

    var newFd = new FormData(fd);
    newFd.set('aluguel', aluguel);
    newFd.set('agua', agua);
    newFd.set('energia', energia);
    newFd.set('internet', internet);
    newFd.set('telefone', telefone);
    newFd.set('custo_fixo', custo_fixo);
    newFd.set('impostos', impostos);
    newFd.set('transportes', transportes);
    newFd.set('funcionarios', funcionarios);

    $.ajax({
        url: '../model/putCustoEmpresa.php',
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

$(document).off('click.deleteCompra').on('click.deleteCompra', '.buttonDeleteCompra', function() {
    var id_finalizacompra = this.dataset.id;
    $.confirm({
        title: 'Confirmação!',
        content: 'Deseja apagar a compra?',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            tryAgain: {
                text: 'Apagar',
                btnClass: 'btn-success',
                action: function() {
                    $.ajax({
                        url: '../model/deleteCompra.php',
                        type: 'POST',
                        data: {
                            id_finalizacompra: id_finalizacompra
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

$("#frm_login").on('submit', function (e) {
    e.preventDefault();
    var fd = $("#frm_login")[0];
    var newFd = new FormData(fd);

    $.ajax({
        url: '../model/login.php',
        type: 'POST',
        processData: false,
        dataTypeIn: 'plain',
        contentType: false,
        data: newFd
    }).done(function (response) {
        var r = JSON.parse(response);
        if (r._err === 0) {
            location.replace("../src/");
        } else {
            alert("DADOS INVÁLIDOS!");
            return false;
        }
    });
});

$("#button_logout").on('click', function () {
    $.ajax({
        url: '../model/logout.php',
    }).done(function (response) {
        var r = JSON.parse(response);
        if (r._err === 0) {
            location.replace("../src/");
        } else {
            alert("ERRO!"); 
            return false;
        }
    });
});

$("#frm_cadastro_login").on('submit', function(e){
    e.preventDefault();
    var fd = $("#frm_cadastro_login")[0];
    // insertProduto
    var nome = frm_cadastro_login.nome.value;
    var email = frm_cadastro_login.email.value;
    var senha = frm_cadastro_login.senha.value;

    if (nome === "") {
        alert("INFORME O NOME POR FAVOR!");
        return false;
    }

    if (email === "") {
        alert("INFORME O EMAIl POR FAVOR!");
        return false;
    }
    
    if (senha === "") {
        alert("INFORME A SENHA POR FAVOR!");
        return false;
    }

    var newFd = new FormData(fd);
    $.ajax({
        url: '../model/postUsuario.php',
        type: 'POST',
        processData: false,
        dataTypeIn: 'plain',
        contentType: false,
        data: newFd
    }).done((response) => {
        var r = JSON.parse(response);
        if (r._err === 0) {
            location.reload();
        } else {
            alert("ERRO");
            return false;
        }
    });
});