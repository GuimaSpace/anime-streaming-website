<?php
session_start();
include_once("./conexao.php");
$auth = $_SESSION['auth'];
$verificacao = "SELECT * FROM usuarios WHERE auth = '$auth'";
$verificacao2 = mysqli_query($conn, $verificacao);
$row_usuariov = mysqli_fetch_assoc($verificacao2);

if ($_SESSION['nome_logado'] == "") {
    $_SESSION['erro']="É necessário fazer login para assistir";
    header("Location: login.php");
}elseif ($_COOKIE['nome_logado'] == "") {
    $_SESSION['erro']="É necessário fazer login para assistir";
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="Pt-Br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="imgs/icon.png" type="image/x-icon">
    <title><?php echo ($nome_site); ?> | Perfil</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Wruczek/Bootstrap-Cookie-Alert@gh-pages/cookiealert.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/catalogo.css">
    <link rel="stylesheet" href="css/perfil.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" defer integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid fundo-nav-catalogo">
        <div class="row">
            <div class="col-xl-2 col-md-2 col-sm-12 catalogo-icon-col d-flex justify-content-center">
                <a href="index.php"><img src="imgs/icon.png" alt="" class="catalogo-icon"></a>
            </div>
            <div class="col-xl-10 col-md-10 col-sm-12">
                <div class="nav-catalogo">
                    <a href="lancamentos.php">Lançamentos</a>
                    <a href="perfil.php">Perfil</a>
                    <a href="categorias.php">Categorias</a>
                    <a href="pedido.php">Pedir Animes</a>
                    <a href="contato.php">Contato</a>
                    <a href="logout.php">logout</a>
                    <?php
                    if ($row_usuariov['staff'] == "1") {
                        echo "
                        <a href='painel-adm.php'>Painel adm</a>
                        ";
                    }else {
                    }
                    ?>
                    <?php
                    if ($discord == "1") {
                        echo "
                        <a href='" . $link_discord . "'><img src='./imgs/discord-icon.png' class='discord-icon'></a>";
                        
                    }else {
                        
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container perfil">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="d-flex justify-content-center">
            <img src="<?php echo($row_usuariov['img']); ?>" alt="" class="icon-perfil" style="border-image: linear-gradient(to right, <?php echo($row_usuariov['cor_aura']); ?>, <?php echo($row_usuariov['cor_aura2']); ?>) 1;?>">
            </div>
            <div class="d-flex justify-content-center">
            <?php    
            if ($row_usuariov['staff'] == "1") {
                echo "
                <img src='imgs/staff-icon.png' height='25' width='150'>
                ";
            }else {
                
            }
            ?>
            </div>

            </div>
            <div class="col-xl-12 col-md-12 col-sm-12 form-edicao">
            <div class="d-flex justify-content-center">
                <form action="proc_edit_usuario.php" method="POST">
                <?php
                                if (isset($_SESSION['erro'])) {
                                    echo "
                                    <div class='erro-registro'>
                                    " . $_SESSION['erro'] . "
                                    </div>
                                    ";
                                    
                                    
                                    unset($_SESSION['erro']);
                                }
                            ?>
                                            <?php
                                if (isset($_SESSION['certo'])) {
                                    echo "
                                    <div class='certo'>
                                    " . $_SESSION['certo'] . "
                                    </div>
                                    ";
                                    
                                    
                                    unset($_SESSION['certo']);
                                }
                            ?>
      
                    Id:<input type="text" class="form-control" name="id" value="<?php echo ($row_usuariov['id']); ?>" disabled="true"><br>

                    Nome:<input type="text" class="form-control" name="nome" value="<?php echo ($row_usuariov['nome']); ?>"><br>
                    Email:<input type="text" class="form-control" name="email" value="<?php echo ($row_usuariov['email']); ?>"><br>
                    Descricao:<input type="text" class="form-control" name="descricao" value="<?php echo ($row_usuariov['descricao']); ?>"><br>
                    Link foto perfil:<input type="text" class="form-control" name="img" value="<?php echo ($row_usuariov['img']); ?>"><br>
                    <?php
                    if ($row_usuariov['vip'] == 1) {
                       echo "
                       Cor da aura:<input type='color' name='cor-aura' value=" . $row_usuariov['cor_aura'] ."><br>
                       ";
                       echo "
                       Cor da aura 2:<input type='color' name='cor-aura2' value=" . $row_usuariov['cor_aura2'] ."><br>
                       ";
                    }else {
                        echo "

                        <p class='vermelho'>Cor da aura *Somente Vip:<input type='color' name='cor-aura' disabled='true' value='" . $row_usuariov['cor_aura'] ."'><br>
                        </p>";
                        echo "

                        <p class='vermelho'>Cor da aura 2 *Somente Vip:<input type='color' name='cor-aura' disabled='true' value='" . $row_usuariov['cor_aura2'] ."'><br>
                        </p>";
                    }
                    ?>


                    <button type="submit" class="btn btn-success">Confirmar edição</button>
                </div>
                </form>
                <button type="submit" class="btn btn-danger">Mudar senha</button>
            </div>
        </div>
    </div>
   

    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 footer">
                <p>Nome seu site | Foi criado de 💖 por <a href="https://github.com/GuimaSpace">Guimaraes</a> | 2022</p>
            </div>
        </div>
    </div>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
 
