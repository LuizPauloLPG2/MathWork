<?php include_once("../include/_header.php"); ?>
<div class="container border p-2 mt-5 mb-5">
    <div class="container">
        <div class="form-row">
            <div class="form-group col-md-12">
                <form id="form_put_peca">
                    <input type="hidden" name="id_peca" id="id_peca" value="<?php echo $_GET['piece']; ?>">
                    <div class="form-row">
                        <?php $peca = Db::init()->query("SELECT * FROM table_peca WHERE id_peca = " . $_GET['piece'])->fetch(PDO::FETCH_ASSOC); ?>
                        <div class="form-group col-md-4">
                            <label for="nome">NOME</label>
                            <input type="text" name="nome" value="<?php echo $peca['nome_peca']; ?>" id="nome" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="descricao">DESCRIÇÃO</label>
                            <input type="text" name="descricao" value="<?php echo $peca['descricao']; ?>" id="descricao" class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="preco">PREÇO</label>
                            <input type="text" name="preco" value="<?php echo $peca['preco']; ?>" id="preco" class="form-control mask_preco">
                        </div>
                        <div class="form-group col-md-4">
                            <img id="imagem_put_peca" src="../img/<?php echo $peca['_codigo']; ?>" class="img-thumbnail" alt="<?php echo $peca['nome_peca']; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="imagem">ALTERAR IMAGEM</label>
                            <input type="file" name="imagem" id="imagem" class="form-control-file">
                        </div>
                        <div class="form-group col-md-12 text-right">
                            <button class="btn btn-danger" type="reset">CANCELAR</button>
                            <button class="btn btn-success" type="submit">SALVAR ALTERAÇÕES</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include_once("../include/_footer.php"); ?>
