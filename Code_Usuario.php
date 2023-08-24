<?php
session_start();
require 'conexao.php';


        // comando para salvar funcionário
if (isset($_POST['save_funcionario'])){
         
    $nome = mysqli_real_escape_string($con, $_POST['nomeFuncionario']);
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $senha = mysqli_real_escape_string($con, $_POST['senha']);

    if ($nome == ""){ 
        $_SESSION['message'] = "Nome do funcionário não inserido!";
        header("location: V_cadastraUsuario.php");
        exit(0);
    }
    elseif ($usuario == ""){
        $_SESSION['message'] = "Usuário do funcionário não inserido!";
        header("location: V_cadastraUsuario.php");
        exit(0);
    }
    elseif ($senha == ""){
        $_SESSION['message'] = "Senha do funcionário não inserido!";
        header("location: V_cadastraUsuario.php");
        exit(0);
    }
    else{
        $query = "INSERT INTO usuario (Nome, Usuario, Senha) 
                VALUES ('$nome', '$usuario', md5('$senha'))";
    
        $query_run = mysqli_query($con, $query);

        if ($query_run){

            $_SESSION['message'] = "Funcionario cadastrado com sucesso!";
            header("location: V_cadastraUsuario.php");
            exit(0);
        }
        else {
            $_SESSION['message'] = "Funcionário não cadastrado";
            header("location: V_cadastraUsuario.php");
            exit(0);
        }

    }
    
}


if (isset($_POST['delete_funcionario'])){

    $funcionario_id = mysqli_real_escape_string($con, $_POST['delete_funcionario']);

    $query = "UPDATE usuario SET status = 'D' WHERE idUsuario = '$funcionario_id'";
    $query_run = mysqli_query($con, $query);

    if ($query_run){
        $_SESSION['message'] = "funcionário excluído com sucesso.";
        header("location: V_VisualizaUsuarios.php");
        exit(0);
    }
    else{
        $_SESSION['message'] = "Não foi possivel excluir o funcionário";
        header("location: V_VisualizaUsuarios.php");
        exit(0);
    }
}


if (isset($_POST['update_funcionario'])){

    $funcionario_id = mysqli_real_escape_string($con, $_POST['funcionario_id']);


    $nome = mysqli_real_escape_string($con, $_POST['nomeFuncionario']);
    $usuario = mysqli_real_escape_string($con, $_POST['usuario']);
    $senha = mysqli_real_escape_string($con, $_POST['senha']);

    $query = "UPDATE usuario SET Nome='$nome', Usuario = '$usuario', Senha = md5('$senha')
     WHERE idUsuario = '$funcionario_id' ";
     $query_run = mysqli_query($con, $query);

     if($query_run){
        $_SESSION['message'] = 'Funcionário atualizado com sucesso';
        header("location: V_VisualizaUsuarios.php");
        exit(0);
     }
     else{
        $_SESSION['message'] = "Não foi possivel atualizar o funcionário";
        header("location: V_EditaUsuario.php");
        exit(0);
    }
}
   
    


?>