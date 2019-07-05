<?php include_once("../include/_header.php"); ?>
<div class="container border p-2 mb-5">
    <div class="container">
        <div class="form-row">
            <div class="form-group col-md-12">
                <form id="form_put_peca">
                    <input type="hidden" name="id_peca" id="id_peca" value="<?php echo $_GET['piece']; ?>">
                    <div class="form-row">
                        <div class="form-row col-md-6">
                            <?php $peca = Db::init()
                                ->query("SELECT table_peca.*, table_fornecedor.nome_fornecedor, table_fornecedor.id_fornecedor FROM table_peca 
                                                INNER JOIN table_fornecedor ON table_fornecedor.id_fornecedor = table_peca.id_fornecedor 
                                                WHERE 
                                                    table_peca.id_peca = " . $_GET['piece'])
                                ->fetch(PDO::FETCH_ASSOC); ?>
                            <div class="form-group col-md-12">
                                <label for="nome"><strong>NOME</strong></label>
                                <input type="text" name="nome" value="<?php echo $peca['nome_peca']; ?>" id="nome" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nome"><strong>FORNECEDOR</strong></label>
                                <input type="text" disabled value="<?php echo $peca['nome_fornecedor']; ?>" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nome"><strong>ALTERAR FORNECEDOR</strong></label>
                                <select name="id_fornecedor" value="<?php echo $peca['nome_fornecedor']; ?>" id="id_fornecedor" class="form-control">
                                    <option value="<?php echo $peca['id_fornecedor']; ?>"><?php echo $peca['nome_fornecedor']; ?></option>
                                    <?php $fornecedores = Db::init()->query("SELECT * FROM table_fornecedor WHERE id_fornecedor != " . $peca['id_fornecedor'])->fetchAll(PDO::FETCH_ASSOC); ?>
                                    <?php foreach ($fornecedores as $fornecedor) { ?>
                                        <option value="<?php echo $fornecedor['id_fornecedor']; ?>"><?php echo $fornecedor['nome_fornecedor']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-10">
                                <label for="descricao"><strong>DESCRIÇÃO</strong></label>
                                <input type="text" name="descricao" value="<?php echo $peca['descricao']; ?>" id="descricao" class="form-control">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="estoque"><strong>ESTOQUE</strong></label>
                                <input type="number" name="estoque" value="<?php echo $peca['estoque']; ?>" id="estoque" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="custo"><strong>PREÇO CUSTO</strong></label>
                                <input type="text" name="custo" value="<?php echo $peca['custo']; ?>" id="custo" class="form-control mask_preco">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="preco"><strong>PREÇO VENDA</strong></label>
                                <input type="text" name="preco" value="<?php echo $peca['preco']; ?>" id="preco" class="form-control mask_preco">
                            </div>
                        </div>
                        <div class="form-row col-md-6">
                            <div class="form-group col-md-6">
                                <label><strong>IMAGEM</strong></label>
                                <img id="imagem_put_peca" src="../img/<?php echo $peca['_codigo']; ?>" class="img-thumbnail" alt="<?php echo $peca['nome_peca']; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="imagem"><strong>ALTERAR IMAGEM</strong></label>
                                <input type="file" name="imagem" id="imagem" class="form-control-file">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-12 mt-2 text-right">
                        <a href="company.php" class="btn btn-dark">VOLTAR</a>
                        <button class="btn btn-danger" type="reset">CANCELAR</button>
                        <button class="btn btn-success" type="submit">SALVAR ALTERAÇÕES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once("../include/_footer.php"); ?>