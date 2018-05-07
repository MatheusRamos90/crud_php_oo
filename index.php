<?php

//faço requisições através da classe CRUD dos Produtos
require_once 'app/CrudProdutos.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP OO - CRUD 3</title>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

    <!-- jQuery 3.3.1 -->
    <script src="js/jquery.min.js"></script>
</head>
<body>

<div class="container">

    <header>
        <h3>PHP OO - CRUD 3</h3>
    </header>

    <?php

    $produto = new CrudProdutos();

    //salvar novo
    if(isset($_POST['btn-salvar'])){

        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];

        if(empty($nome) || empty($categoria)){

            echo "<p class='alert alert-danger alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Erro!</b> Os campos são obrigatórios.</p>";

        }else{
            $produto->setNome($nome);
            $produto->setCategoria($categoria);

            if($produto->create()){
                echo "<p class='alert alert-success alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Sucesso!</b> Cadastro efetuado.</p>";
            }else{
                echo "<p class='alert alert-danger alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Erro!</b> Houve um problema no cadastro.</p>";
            }
        }
    }

    //excluir
    if(isset($_POST['btn-excluir'])){

        $id = $_POST['id'];

        if($produto->delete($id)){
            echo "<p class='alert alert-success alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Sucesso!</b> Produto excluído.</p>";
        }else{
            echo "<p class='alert alert-danger alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Erro!</b> Houve um problema na exclusão.</p>";
        }
    }

    //excluir
    if(isset($_POST['btn-salvar-prod'])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $categoria = $_POST['categoria'];

        if(empty($nome) || empty($categoria)){

            echo "<p class='alert alert-danger alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Erro!</b> Os campos são obrigatórios.</p>";

        }else{
            $produto->setNome($nome);
            $produto->setCategoria($categoria);

            if($produto->edit($id)){
                echo "<p class='alert alert-success alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Sucesso!</b> Atualização efetuada.</p>";
            }else{
                echo "<p class='alert alert-danger alert-dismissible col-lg-5 col-md-5' style='float: none;margin: auto' role='alert'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                  <b>Erro!</b> Houve um problema na atualização.</p>";
            }
        }
    }



    ?>

    <br/>

    <!-- cadastro -->
    <div class="row">
        <h4 style="text-align: center">Cadastro de Produtos</h4>
        <hr>
        <div class="col-lg-5 col-md-5" style="float: none;margin: auto">
            <div class="center-div">
                <form method="post" id="form-produto">
                    <p><b>Nome:</b></p>
                    <p><input type="text" name="nome" class="form-control" maxlength="100"></p>
                    <br/>
                    <p><b>Categoria:</b></p>
                    <select name="categoria" class="form-control">
                        <option value="">Selecione</option>
                        <option value="Bebidas">Bebidas</option>
                        <option value="Comida">Comida</option>
                        <option value="Eletrônico">Eletrônico</option>
                        <option value="Eletrodoméstico">Eletrodoméstico</option>
                        <option value="Jogos">Jogos</option>
                    </select>
                    <br/>
                    <button type="submit" name="btn-salvar" class="btn btn-success">Salvar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- fim cadastro -->

    <br/><br/>

    <!-- cadastrados -->
    <div class="row">
        <h4 style="text-align: center">Produtos cadastrados</h4>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($produto->getAll() as $key => $item): ?>
                        <tr>
                            <td><?php echo $item->nome; ?></td>
                            <td><?php echo $item->categoria; ?></td>
                            <td><?php echo $item->data_; ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-edit" data-url="/includes/modal-produto.php" data-nome="<?php echo $item->nome;?>" data-categoria="<?php echo $item->categoria;?>" data-id="<?php echo $item->id;?>" style="float: left;margin: auto;margin: 0 5px 5px 0">Editar</button>
                                <form method="post" style="float: left;margin: auto">
                                    <input type="hidden" name="id" value="<?php echo $item->id;?>">
                                    <button type="submit" name="btn-excluir" class="btn btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- fim cadastrados -->

</div> <!-- fim container -->

<!-- modal de edição -->
<!-- Modal -->
<div class="modal fade" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="form-edit" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edição do produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="btn-salvar-prod" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $(function () {

        var url = '/crud_oo_3';

        $('.btn-edit').on('click', function (ev) {
            ev.preventDefault();

            var btn = $(this);
            var modal = btn.data('url');

            $('.modal .modal-body').load(url + modal, function () {

                $('#form-edit #id').val(btn.data('id'));
                $('#form-edit #nome').val(btn.data('nome'));
                $('#form-edit #categoria').val(btn.data('categoria'));

                $('.modal').modal('show');
            })
        })

    })
</script>

</body>
</html>