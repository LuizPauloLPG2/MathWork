<?php include_once("../include/_header.php"); ?>
<div class="container border p-2 mt-5 mb-5">
<!-- CADASTRO PRODUTO -->
<div class="modal fade" id="postProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CADASTRAR PEÇA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_post_peca">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nome">NOME</label>
                            <input type="text" name="nome" id="nome" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="descricao">DESCRIÇÃO</label>
                            <input type="text" name="descricao" id="descricao" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="preco">PREÇO</label>
                            <input type="text" name="preco" id="preco" class="form-control mask_preco">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="imagem">IMAGEM</label>
                            <input type="file" name="imagem" id="imagem" class="form-control-file">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                <button form="form_post_peca" type="submit" class="btn btn-success">CADASTRAR</button>
            </div>
        </div>
    </div>
</div>
<!-- /CADASTRO PRODUTO -->

    <div class="container">
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="container text-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#postProduto">CADASTRAR NOVA PEÇA</button>
                </div>
            </div>
            <!-- LISTA -->
            <div class="form-group col-md-12">
                <div class="container">
                    <div class="form-row mt-2">
                        <div class="text-center form-group bg-success border col-md-12"><h1 class="text-white">PEÇAS</h1></div>
                        <?php 
                        
                        $pagina = (isset($_GET["p"])) ? $_GET["p"] : 1;
                        $max_linhas = 4;
                        $inicio = ($max_linhas * $pagina) - $max_linhas;
                        
                        $pecas = Db::init()->query("SELECT SQL_CALC_FOUND_ROWS * FROM table_peca LIMIT $inicio, $max_linhas")->fetchAll(PDO::FETCH_ASSOC); 
                        
                        $sql = ("SELECT FOUND_ROWS()");
                        $stmt = Db::init()->prepare($sql);
                        $stmt->execute();
                        $contador = $stmt->fetch();

                        $numero_paginas = ceil($contador[0] / $max_linhas);
                        ?>
                        <?php foreach($pecas as $peca){  ?>
                        <div class="form-group col-md-6">
                            <div class="card mb-3 card-peca">
                                <div class="row no-gutters">
                                    <div class="col-md-4 p-2">
                                        <img src="../img/<?php echo $peca['_codigo']; ?>" class="card-img" alt="<?php echo $peca['nome_peca']; ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title text-uppercase"><?php echo $peca['nome_peca']; ?></h5>
                                            <span class="card-text">Preço unitário</span>
                                            <p class="card-text"><strong>R$ <?php echo Config::convertNumberToFormatBr($peca['preco']); ?></strong></p>
                                            <p class="card-text"><small class="text-muted"><a href="piece.php?piece=<?php echo $peca['id_peca']; ?>" class="btn btn-sm btn-success">EDITAR</a></small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="container">
                            <nav id="content-paginacao" aria-label="...">
                                <ul class="pagination justify-content-center">
                                    <?php
                                        $lim = 5;
                                        $inicio = ((($pagina - $lim) > 1) ? $pagina - $lim : 1);
                                        $fim = ((($pagina + $lim) < $numero_paginas) ? $pagina + $lim : $numero_paginas);

                                        if ($numero_paginas > 1 && $pagina <= $numero_paginas) {
                                            for ($i = $inicio; $i <= $fim; $i++) {
                                                if ($i == $pagina) {
                                                    ?>
                                                    <li class="page-item" aria-current="page">
                                                        <span class="page-link bg-success text-white">
                                                        <?php echo $i; ?>
                                                        </span>
                                                    </li>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <li class="page-item"><a class="page-link" href="?<?php echo 'p='; ?><?php echo $i ?>"><?php echo $i ?></a></li>
                                                    <?php
                                                }
                                            }
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /LISTA -->
        </div>
    </div>
</div>
<?php include_once("../include/_footer.php"); ?>
