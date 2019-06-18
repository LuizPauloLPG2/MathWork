<?php include_once("../include/_header.php"); ?>
<div class="container border p-2 mt-5 mb-2">
    <div class="container">
        <div class="form-row">
            <!-- LISTA -->
            <div class="form-group col-md-8">
                <div class="container">
                    <div class="form-row mt-2">
                        <div class="text-center form-group bg-success border col-md-12"><strong class="text-white">COMPUTADORES</strong></div>
                        <?php
                            $computadores = Db::init()
                                    ->query("SELECT * FROM table_computador")
                                    ->fetchAll(PDO::FETCH_ASSOC);

                        ?>
                        <?php foreach($computadores as $computador){ ?>
                        <div class="form-group col-md-6 computador-content">
                            <div class="container mb-5">
                                <div class="card-group">
                                    <div class="card">
                                        <img src="../img/computador/<?php echo $computador['_codigo']; ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                        <h5><?php echo $computador['nome_computador']; ?></h5>
                                        <p class="card-text"><?php echo $computador['descricao']; ?><hr></p>
                                        <p><strong class="text-primary">R$ <?php echo Config::convertNumberToFormatBr($computador['preco']); ?></strong></p>
                                        <p><button class="btn btn-danger btn-sm btn-block"><i class="fas fa-shopping-cart"></i> COMPRAR</button></p>
                                        </div>
                                        <div class="card-footer text-right">
                                            <small class="text-muted"><strong><i class="text-primary fas fa-thumbs-up fa-2x"></i> 100 </strong></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="form-row mt-2">
                        <div class="text-center form-group bg-success border col-md-12"><strong class="text-white">PEÇAS</strong></div>
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
                                            <p class="card-text"><small class="text-muted"><button data-id="<?php echo $peca['id_peca']; ?>" class="btn btn-sm btn-danger btn-block buttonAddCarrinho"><i class="fas fa-shopping-cart"></i> ADICIONAR AO CARRINHO</button></small></p>
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
            <!-- CARRINHO -->
            <div id="content-carrinho" class="form-group col-md-4">
                <div class="container mt-2">
                <div class="text-center form-group bg-success border col-md-12"><strong class="text-white">CARRINHO</strong></div>
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
                                    ->query("SELECT table_peca.*, table_carrinho.* FROM table_peca 
                                            INNER JOIN table_carrinho ON table_carrinho.id_peca = table_peca.id_peca")
                                    ->fetchAll(PDO::FETCH_ASSOC); 
                            
                            $vlTotal = 0;
                            ?>
                            <?php foreach($itens as $item){ ?>
                            <tr>
                                <td>
                                    <i data-id="<?php echo $item['id_carrinho']; ?>" class="fas fa-plus-circle text-success button_add_item"></i>
                                    <strong><?php echo $item['quantidade']; ?></strong>
                                    <i data-id="<?php echo $item['id_carrinho']; ?>" class="fas fa-minus-circle text-danger button_del_item"></i>
                                </td>
                                <td class="text-uppercase"><strong><?php echo $item['nome_peca']; ?></strong></td>
                                <td><strong><?php echo Config::convertNumberToFormatBr($item['preco_total']); ?></strong></td>
                            </tr>
                            <?php $vlTotal = $vlTotal + $item['preco_total']; ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="border p-2">
                        <strong>TOTAL <?php echo Config::convertNumberToFormatBr($vlTotal); ?> </strong>
                    </div>
                </div>
            </div>
            <!-- /CARRINHO -->
        </div>
    </div>
</div>
<?php include_once("../include/_footer.php"); ?>