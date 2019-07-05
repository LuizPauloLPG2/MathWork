<?php include_once("../include/_header.php"); ?>
<?php $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null; ?>
<input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $id_usuario; ?>">
<div class="container-fluid p-2 mb-2">
    <div class="form-row">
        <!-- LISTA -->
        <div class="form-group col-md-9">
            <div class="container">
                <div class="form-row">
                    <!-- <div class="text-center form-group bg-dark border col-md-12"><strong class="text-white">PEÇAS</strong></div> -->
                    <?php $pecas = Db::init()->query("SELECT * FROM table_peca WHERE estoque > 0")->fetchAll(PDO::FETCH_ASSOC); ?>
                    <div class="form-group col-md-12">
                        <div class="form-row">
                            <?php foreach ($pecas as $peca) {  ?>
                                <div class="form-group col-md-4">
                                    <div class="card card-peca m-1">
                                        <div class="card-body">
                                            <img src="../img/<?php echo $peca['_codigo']; ?>" class="image-lista-peca" alt="<?php echo $peca['nome_peca']; ?>">
                                            <h5 class="card-title text-uppercase"><?php echo $peca['nome_peca']; ?></h5>
                                            <p class="card-text"><strong class="text-primary"> R$ <?php echo Config::convertNumberToFormatBr($peca['preco']); ?> </strong></p>
                                            <p class="card-text"><strong class="text-secondary">ESTOQUE: <?php echo $peca['estoque']; ?> </strong></p>
                                            <?php if (isset($_SESSION['id_usuario'])) { ?>
                                                <button data-id="<?php echo $peca['id_peca']; ?>" class="btn btn-sm btn-success buttonAddCarrinhoPeca">COMPRAR</button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /LISTA -->
        <!-- CARRINHO -->
        <div id="content-carrinho" class="form-group col-md-3 carrinho-menu">
            <div class="container mt-2">
                <div class="text-center form-group bg-dark border col-md-12"><strong class="text-white">CARRINHO DE PEÇAS</strong></div>
                <table class="table table-sm table-striped table-hover border">
                    <thead>
                        <tr>
                            <th></th>
                            <th>PRODUTO</th>
                            <th>VALOR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $itens = Db::init()
                            ->query("SELECT table_peca.*, table_carrinhopeca.* FROM table_peca 
                                            INNER JOIN table_carrinhopeca ON table_carrinhopeca.id_peca = table_peca.id_peca")
                            ->fetchAll(PDO::FETCH_ASSOC);

                        $vlTotalPeca = 0;
                        ?>
                        <?php foreach ($itens as $item) { ?>
                            <tr>
                                <td>
                                    <label title="REMOVER PEÇA DO CARRINHO!" data-id="<?php echo $item['id_carrinhopeca']; ?>" class="button-remove-peca-carrinho badge badge-danger button_del_item">X</label>
                                </td>
                                <td class="text-uppercase"><strong><?php echo $item['nome_peca']; ?></strong></td>
                                <td><strong class="text-primary"> R$ <?php echo Config::convertNumberToFormatBr($item['preco_total']); ?></strong></td>
                            </tr>
                            <?php $vlTotalPeca = $vlTotalPeca + $item['preco_total']; ?>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="border bg-danger p-2 text-center">
                    <strong class="text-white">TOTAL <?php echo Config::convertNumberToFormatBr($vlTotalPeca); ?> </strong>
                </div>
            </div>
            <div class="container mt-2 mb-2">
                <hr>
                <!-- FINALIZA COMPRA -->
                <div class="modal fade" id="buttonFinalizaCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">FINALIZAR COMPRA</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form_post_finaliza_compra">
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label> <strong>VALOR TOTAL</strong></label>
                                            <input name="valor_total" id="valor_total" class="form-control" type="text" disabled value="<?php echo Config::convertNumberToFormatBr($vlTotalPeca); ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                                <button form="form_post_finaliza_compra" type="submit" class="btn btn-success">FINALIZAR</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /FINALIZA COMPRA -->
                <?php if (isset($_SESSION['id_usuario'])) { ?>
                    <button type="button" class="btn btn-success btn-block button-finaliza-compra" data-toggle="modal" data-target="#buttonFinalizaCompra">FINALIZAR COMPRA</button>
                <?php } ?>
            </div>
        </div>
        <!-- /CARRINHO -->
    </div>
</div>
<?php include_once("../include/_footer.php"); ?>