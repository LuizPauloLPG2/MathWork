<?php include_once("../include/_header.php"); ?>
<div class="container-fluid p-2 mb-5">
    <!-- CADASTRO PEÇA -->
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
                                <label for="nome"><strong>NOME</strong></label>
                                <input type="text" name="nome" autocomplete="off" id="nome" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nome"><strong>FORNECEDOR</strong></label>
                                <select name="id_fornecedor" value="<?php echo $peca['nome_fornecedor']; ?>" id="id_fornecedor" class="form-control">
                                    <option value="">SELECIONE...</option>
                                    <?php $fornecedores = Db::init()->query("SELECT * FROM table_fornecedor")->fetchAll(PDO::FETCH_ASSOC); ?>
                                    <?php foreach ($fornecedores as $fornecedor) { ?>
                                        <option value="<?php echo $fornecedor['id_fornecedor']; ?>"><?php echo $fornecedor['nome_fornecedor']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="descricao"><strong>DESCRIÇÃO</strong></label>
                                <input type="text" name="descricao" autocomplete="off" id="descricao" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="estoque"><strong>ESTOQUE</strong></label>
                                <input type="number" name="estoque" id="estoque" class="form-control">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="custo"><strong>PREÇO CUSTO</strong></label>
                                <input type="text" name="custo" id="custo" class="form-control mask_preco">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="preco"><strong>PREÇO VENDA</strong></label>
                                <input type="text" name="preco" id="preco" class="form-control mask_preco">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="imagem"><strong>IMAGEM</strong></label>
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
    <!-- /CADASTRO PEÇA -->
    <div class="container-fluid">
        <div class="form-row">
            <div class="form-group col-md-12">
                <div class="container text-center">
                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#postProduto">CADASTRAR NOVA PEÇA</button>
                </div>
                <?php $pecas = Db::init()->query("SELECT * FROM table_peca")->fetchAll(PDO::FETCH_ASSOC); ?>
            </div>
        </div>
        <div class="form-group col-md-12">
            <div class="container-fluid">
                <div class="text-center form-group bg-dark border col-md-12"><strong class="text-white">CUSTOS DA EMPRESA</strong></div>
                <?php $custos = Db::init()->query("SELECT * FROM table_custoempresa")->fetchAll(PDO::FETCH_ASSOC); ?>
                <form id="form_put_custo_empresa">
                    <div class="form-row">
                        <?php $vlTotalCustoEmpresa = 0; ?>
                        <?php foreach ($custos as $custo) { ?>
                            <div class="form-group col-md-2">
                                <label><strong class="text-uppercase"><?php echo $custo['nome']; ?></strong></label>
                                <input type="text" autocomplete="off" value="<?php echo $custo['valor']; ?>" name="<?php echo $custo['nome']; ?>" id="<?php echo $custo['nome']; ?>" class="form-control mask_preco">
                            </div>
                            <?php $vlTotalCustoEmpresa = $vlTotalCustoEmpresa + $custo['valor']; ?>
                        <?php } ?>
                        <div class="form-group col-md-2 text-center">
                            <label>-</label>
                            <a href="" class="btn btn-block btn-danger">CANCELAR</a>
                        </div>
                        <div class="form-group col-md-2 text-center">
                            <label>-</label>
                            <button type="submit" class="btn btn-block btn-success">ATUALIZAR</button>
                        </div>
                        <div class="form-group col-md-12">
                            <table class="table table-sm table-datatable border table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>NOME</th>
                                        <th>PREÇO DE CUSTO</th>
                                        <th>PREÇO DE VENDA</th>
                                        <th>ESTOQUE</th>
                                        <th>TOTAL CUSTO</th>
                                        <th>TOTAL VENDA</th>
                                        <th>LUCRO</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalPrecoCusto = 0; ?>
                                    <?php $totalPrecoVenda = 0; ?>
                                    <?php $totalEstoque = 0; ?>
                                    <?php $vlTotalCusto = 0; ?>
                                    <?php $vlTotalVenda = 0; ?>
                                    <?php $lucroTotal = 0; ?>
                                    <?php foreach ($pecas as $peca) {  ?>
                                        <tr class="tr-content-peca">
                                            <td> <strong> <?php echo $peca['id_peca']; ?> </strong> </td>
                                            <td> <strong> <?php echo $peca['nome_peca']; ?> </strong> </td>
                                            <td> <strong class="text-secondary"> R$ <?php echo Config::convertNumberToFormatBr($peca['custo']); ?> </strong> </td>
                                            <td> <strong class="text-secondary"> R$ <?php echo Config::convertNumberToFormatBr($peca['preco']); ?> </strong> </td>
                                            <?php $textEstoque = $peca['estoque'] == 0 ? 'text-danger' : 'text-primary'; ?>
                                            <?php $verificaEstoque = $peca['estoque'] < 2 ? '<labael class="badge badge-warning">ADICIONAR + ESTOQUE</label>' : null; ?>
                                            <td> <strong class="<?php echo $textEstoque; ?>"> <?php echo $peca['estoque']; ?> <?php echo $verificaEstoque; ?> </strong> </td>
                                            <?php $totalCusto = $peca['estoque'] * $peca['custo']; ?>
                                            <?php $totalPreco = $peca['estoque'] * $peca['preco']; ?>
                                            <?php $lucro = $totalPreco - $totalCusto; ?>
                                            <td> <strong class="text-secondary"> R$ <?php echo Config::convertNumberToFormatBr($totalCusto); ?> </strong> </td>
                                            <td> <strong class="text-secondary"> R$ <?php echo Config::convertNumberToFormatBr($totalPreco); ?> </strong> </td>
                                            <td> <strong class="text-primary"> R$ <?php echo Config::convertNumberToFormatBr($lucro); ?> </strong></td>
                                            <td class="text-right"> <a href="piece.php?piece=<?php echo $peca['id_peca']; ?>" class="btn btn-sm btn-success"> EDITAR</a> </td>
                                        </tr>
                                        <?php $totalPrecoCusto = $totalPrecoCusto + $totalCusto; ?>
                                        <?php $totalPrecoVenda = $totalPrecoVenda + $totalPreco; ?>
                                        <?php $totalEstoque = $totalEstoque + $peca['estoque']; ?>
                                        <?php $vlTotalCusto = $vlTotalCusto + $totalCusto; ?>
                                        <?php $vlTotalVenda = $vlTotalVenda + $totalPreco; ?>
                                        <?php $lucroTotal = $lucroTotal + $lucro; ?>
                                    <?php } ?>
                                </tbody>
                                <tfoot id="footer-table-pecas-empresa">
                                    <tr>
                                        <td><strong>TOTAL</strong></td>
                                        <td><strong></strong></td>
                                        <td><strong></strong></td>
                                        <td><strong></strong></td>
                                        <td><strong><?php echo $totalEstoque; ?></strong></td>
                                        <td><strong>R$ <?php echo Config::convertNumberToFormatBr($vlTotalCusto); ?></strong></td>
                                        <td><strong>R$ <?php echo Config::convertNumberToFormatBr($vlTotalVenda); ?></strong></td>
                                        <td><strong>R$ <?php echo Config::convertNumberToFormatBr($lucroTotal); ?></strong></td>
                                        <td><strong></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- <hr> -->
                        </div>
                        <div class="form-group col-md-12">
                            <?php $params = !empty($_POST['s']) ? " AND data_cadastro = '" . $_POST['s'] . "'" : ''; ?>
                            <?php $compras = Db::init()->query("SELECT * FROM table_finalizacompra WHERE (1 = 1)" . $params)->fetchAll(PDO::FETCH_ASSOC); ?>
                            <?php
                            $vlTotalCompra = 0;
                            foreach ($compras as $compra) {
                                $vlTotalCompra = $vlTotalCompra + $compra['valor_total'];
                            }
                            $vlRestanteAbateCustoEmpresa = $vlTotalCustoEmpresa;
                            // $vlRestanteAbateCustoEmpresa = $vlTotalCustoEmpresa - ($vlTotalCompra + $lucroTotal);
                            $comissao = Db::init()->query("SELECT * FROM table_comissao")->fetch(PDO::FETCH_ASSOC);
                            $capital = $comissao['valor'] + $vlTotalCompra;
                            $vlAbate = $vlRestanteAbateCustoEmpresa;
                            $vlTotalAbateCusto = $vlTotalCustoEmpresa + $vlTotalCusto;
                            $vlTotalAbateCustoFinal = ($vlTotalCustoEmpresa + $vlTotalCusto) - $capital;
                            $vlTotalAbateCustoFinal = $vlTotalAbateCustoFinal < 0 ? 0 : $vlTotalAbateCustoFinal;
                            $vlEstoque = Db::init()
                                ->query("SELECT SUM(estoque) AS sum_estoque FROM table_peca")
                                ->fetch(PDO::FETCH_ASSOC);

                            ?>
                            <table class="table table-sm border table-finally-empresa">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>INFORMAÇÃO</th>
                                        <th>VALOR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong class="text-success">COMISSÃO</strong></td>
                                        <td class="text-success"><strong>R$ <?php echo Config::convertNumberToFormatBr($comissao['valor']); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-success">CAPITAL</strong></td>
                                        <td class="text-success"><strong>R$ <?php echo Config::convertNumberToFormatBr($capital); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-danger">TOTAL DO CUSTO DA EMPRESA</strong></td>
                                        <td class="text-danger"><strong>R$ <?php echo Config::convertNumberToFormatBr($vlTotalCustoEmpresa); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-success">TOTAL DE VENDAS EFETUADAS</strong></td>
                                        <td class="text-success"><strong>R$ <?php echo Config::convertNumberToFormatBr($vlTotalCompra); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-success">TOTAL DE LUCRO DAS PEÇAS</strong></td>
                                        <td class="text-success"><strong>R$ <?php echo Config::convertNumberToFormatBr($lucroTotal); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-danger">TOTAL CUSTO PARA ABATER</strong></td>
                                        <td class="text-danger"><strong>R$ <?php echo Config::convertNumberToFormatBr($vlTotalAbateCustoFinal); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-secondary">QUANTIDADE TOTAL DAS PEÇAS</strong></td>
                                        <td class="text-secondary"><strong><?php echo $vlEstoque['sum_estoque']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-secondary">TOTAL PREÇO DE CUSTO DAS PEÇAS</strong></td>
                                        <td class="text-secondary"><strong>R$ <?php echo Config::convertNumberToFormatBr($vlTotalCusto); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-secondary">TOTAL PREÇO DE VENDA DAS PEÇAS</strong></td>
                                        <td class="text-secondary"><strong>R$ <?php echo Config::convertNumberToFormatBr($vlTotalVenda); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-success">CAPITAL FINAL</strong></td>
                                        <?php $capitalRestante = $capital - $vlTotalAbateCusto; ?>
                                        <td class="text-success"><strong>R$ <?php echo Config::convertNumberToFormatBr($capitalRestante); ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong class="text-success">LUCRO</strong></td>
                                        <?php $vlLucro = $capital - $vlTotalAbateCusto; ?>
                                        <?php $vlLucro  = $vlLucro  < 0 ? 0 : $vlLucro; ?>
                                        <?php $textVlSubtrai = $vlLucro > 0 ? 'text-success' : 'text-secondary'; ?>
                                        <td class="<?php echo $textVlSubtrai; ?>"><strong>R$ <?php echo Config::convertNumberToFormatBr($vlLucro); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_once("../include/_footer.php"); ?>