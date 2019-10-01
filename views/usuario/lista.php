<div id="section-container">
    <div class="row" >
        <div class="col-sm-12 col-md-12 col-lg-12" id="pagina-header">
            <h2>Listar de Usuários</h2>
            <ol class="breadcrumb">
                <li><a href="<?php echo BASE_URL ?>/home"><i class="fa fa-tachometer-alt"></i> Inicial</a></li>
                <li class="active"><i class="fa fa-users "></i> Listar de usuários</li>
            </ol>
        </div>
    </div>
    <!--FIM pagina-header-->
    <div class="row" id="container-usuario">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading"><p class="panel-title"><i class="fa fa-search"></i> Painel de Busca</p></div>
                <div class="panel-body">
                    <form method="POST" autocomplete="off">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="iSelectBuscar">Por:</label>
                                    <select class="form-control" name="nSelectBuscar" id="iSelectBuscar">
                                        <option value="E-mail">Email</option>
                                        <option value="Nome">Nome</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="iCampo">Campo:  </label>
                                    <input type="text" class="form-control" name="nCampo" id="iCampo"/>
                                </div>
                            </div>
                            <div class="col-md-2"><br/>
                                <button type="submit" class="btn btn-warning" name="nBuscar" value="Buscar"><i class=" fa fa-search"></i>  Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!--FIM .PANEL-->
        </div>
        <!--thumbnal usuario-->
        <?php
        if (isset($usuarios) && is_array($usuarios)) {
            foreach ($usuarios as $usuario):
                ?>
                <div class="col-sm-6 col-md-4 col-lg-4">                            
                    <div class=" thumbnail">
                        <img src="<?php echo BASE_URL . '/' . $usuario['imagem'] ?>" alt="SGL - Usuáio" class="img-responsive img-circle"/>
                        <p class="text-center text-uppercase font-bold"><?php echo $usuario['nome'] . ' ' . $usuario['sobrenome'] ?></p>
                        <p class="text-center text-lowercase"><?php echo $usuario['email'] ?></p>
                        <p class="text-center text-capitalize"><?php echo $usuario['cargo'] ?></p>
                        <div class="caption text-center">
                            <button type="button" class="btn btn-success btn-block btn-sm" data-toggle="modal" data-target="#modal_recupera_senha_<?php echo md5($usuario['cod']) ?>" title="Recupera Senha"><i class="fa fa-sign-out-alt"></i> Recupera Senha</button> 
                            <a href="<?php echo BASE_URL . '/editar/usuario/' . md5($usuario['cod']) ?>" class="btn btn-primary btn-block btn-sm" title="Editar"><i class="fa fa-pencil-alt"></i> Editar</a> 
                            <button type="button"  class="btn btn-danger btn-block btn-sm" data-toggle="modal" data-target="#modal_excluir_<?php echo md5($usuario['cod']) ?>" title="Excluir"> <i class="fa fa-trash"></i> Excluir</button>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
        }else {
            echo '<div class="col-xs-12"><div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    Desculpe, não foi possível localizar nenhum registro !
                    </div></div>';
        }
        ?>

    </div>
    <!--FIM .ROW-->


</div>
<!-- /#section-container -->
<?php
if (isset($_SESSION['usuario_siasif']['nivel']) && $_SESSION['usuario_siasif']['nivel'] >= 3):
    if (isset($usuarios) && is_array($usuarios)) :
        foreach ($usuarios as $usuario):
            ?>
            <!--MODAL - ESTRUTURA BÁSICA-->
            <section class="modal fade" id="modal_recupera_senha_<?php echo md5($usuario['cod']) ?>" tabindex="-1" role="dialog">
                <article class="modal-dialog modal-md" role="document">
                    <section class="modal-content">
                        <header class="modal-header bg-primary">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4>Esqueceu a senha?</h4>
                        </header>
                        <article class="modal-body">
                            <ul class="list-unstyled">
                                <li><b class="font-bold">Nome: </b> <?php echo $usuario['nome'] . ' ' . $usuario['sobrenome'] ?>;</li>
                                <li><b class="font-bold">E-mail: </b> <?php echo $usuario['email'] ?>;</li>
                                <?php if (isset($usuario['cargo'])) : ?>
                                    <li><b class="font-bold">Cargo: </b> <?php echo $usuario['cargo'] ?>.</li>
                                <?php endif; ?>
                            </ul>
                            <form method="POST">
                                <input type="hidden" name="nEmail" value="<?php echo $usuario['email'] ?>"/>
                                <button type="submit" value="Enviar" name="nEnviar" class=" btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i> Enviar nova senha</button>
                            </form>
                        </article>
                        <footer class="modal-footer">
                            <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                        </footer>
                    </section>
                </article>
            </section>

            <section class="modal fade" id="modal_excluir_<?php echo md5($usuario['cod']) ?>" tabindex="-1" role="dialog">
                <article class="modal-dialog modal-md" role="document">
                    <section class="modal-content">
                        <header class="modal-header bg-primary">
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4>Deseja remover este registro?</h4>
                        </header>
                        <article class="modal-body">
                            <ul class="list-unstyled">
                                <li><b class="font-bold">Nome: </b> <?php echo $usuario['nome'] . ' ' . $usuario['sobrenome'] ?>;</li>
                                <li><b class="font-bold">E-mail: </b> <?php echo $usuario['email'] ?>;</li>
                                <?php if (isset($usuario['cargo'])) : ?>
                                    <li><b class="font-bold">Cargo: </b> <?php echo $usuario['cargo'] ?>.</li>
                                <?php endif; ?>
                            </ul>
                            <p class="text-justify text-danger"><span class="font-bold">OBS : </span> Se você remove este usuário, será removido não só o usuário, como também todos históricos registrados por este usuário.</p>

                        </article>
                        <footer class="modal-footer">
                            <a class="btn btn-danger pull-left" href="<?php echo BASE_URL . '/excluir/usuario/' . md5($usuario['cod']) ?>"> <i class="fa fa-trash"></i> Excluir</a> 
                            <button class="btn btn-default" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                        </footer>
                    </section>
                </article>
            </section>
            <?php
        endforeach;
    endif;
endif;
?>

<!--div model-->
<div class="modal fade" id="modal_confirmacao_email" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4>Confirmação de e-mail</h4>
            </div>
            <div class="modal-body">
                <p>Será enviado um e-mail com uma nova senha.</p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-right"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>       
<!--/div model-->

<!--div model-->
<div class="modal fade" id="modal_invalido_email" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4>Atenção</h4>
            </div>
            <div class="modal-body">
                <p>Você informou um e-mail inválido ou não é permitido alterar a senha deste usuário.</p>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default pull-right"><i class="fa fa-times"></i> Fechar</button>
            </div>
        </div>
    </div>
</div>       
<!--/div model-->