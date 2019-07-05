<?php include_once("../include/_header.php"); ?>
<div class="container p-2 border">
    <div class="container">
        <div class="text-center form-group bg-dark border col-md-12"><strong class="text-white">RELATÓRIO DE COMPRAS</strong></div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <!-- <form method="post">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <input type="date" name="s" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary">PESQUISAR</button>
                        </div>
                    </div>
                </form> -->
                <?php $params = !empty($_POST['s']) ? " AND data_cadastro = '" . $_POST['s'] . "'" : ''; ?>
                <?php $compras = Db::init()->query("SELECT table_finalizacompra.*, table_usuario.nome FROM table_finalizacompra 
                                                        INNER JOIN table_usuario ON table_usuario.id_usuario = table_finalizacompra.id_usuario
                                                        WHERE (1 = 1)" . $params)->fetchAll(PDO::FETCH_ASSOC); ?>
                <table class="table table-sm table-hover table-striped border table-datatable">
                    <thead class="thead-dark">
                        <tr>
                            <th>CLIENTE</th>
                            <th>VALOR</th>
                            <th>DATA</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $vlTotal = 0; ?>
                        <?php foreach ($compras as $compra) { ?>
                            <tr>
                                <td><strong> <?php echo $compra['nome']; ?></strong></td>
                                <td><strong>R$ <?php echo Config::convertNumberToFormatBr($compra['valor_total']); ?></strong></td>
                                <td><strong><?php echo Config::convertDateToFormatBr($compra['data_cadastro']); ?></strong></td>
                                <td class="text-right"> <button data-id="<?php echo $compra['id_finalizacompra']; ?>" class="btn btn-sm btn-danger buttonDeleteCompra">APAGAR</button> </td>
                            </tr>
                            <?php $vlTotal = $vlTotal + $compra['valor_total']; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once("../include/_footer.php"); ?>