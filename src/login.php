<?php include_once("../include/_header.php"); ?>
<div class="container p-2 mb-2">
    <div id="content-login">
        <div class="form-row">
            <div class="form-group col-md-6"> <a class="btn btn-block btn-success" href="?login">LOGAR</a> </div>
            <div class="form-group col-md-6"> <a class="btn btn-block btn-primary" href="?cadastrar">CADASTRAR</a> </div>
        </div>
        <hr>
        <?php if (isset($_GET['login'])) { ?>
            <form id="frm_login">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="email_login"><strong>EMAIL</strong></label>
                        <input type="email" name="email_login" id="email_login" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="senha_login"><strong>SENHA</strong></label>
                        <input type="password" name="senha_login" id="senha_login" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success btn-sm btn-block" type="submit">ENTRAR</button>
                    </div>
                </div>
            </form>
        <?php } if (isset($_GET['cadastrar'])) { ?>
            <form id="frm_cadastro_login">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nome"><strong>NOME</strong></label>
                        <input type="text" name="nome" id="nome" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="email"><strong>EMAIL</strong></label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="senha"><strong>SENHA</strong></label>
                        <input type="password" name="senha" id="senha" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <button class="btn btn-success btn-sm btn-block" type="submit">CADASTRAR</button>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<?php include_once("../include/_footer.php"); ?>