<?php
include_once 'app/models/auth.models.php';
include_once 'app/views/usuarios.views.php';
class authcontrollers
{

    private $views;
    private $model;

    public function __construct()
    {

        $this->views = new usuariosviews();
        $this->model = new authmodels();
    }
    public function iniciosesion()
    {
        $this->views->authviews();

    }

    public function loginusuario()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            $this->views->authviews('Faltan datos');
            return;

        }
        //aca obtinen los datos del usuario
        $usuario = $this->model->usuariosporemail($email);
        //si el usuario existes
        if ($usuario && password_verify($password, $usuario->password)) {


            //armo la session del usuario

            session_start();
            $_SESSION['ID_USUARIO'] = $usuario->id;
            $_SESSION['EMAIL_USUARIO'] = $usuario->email;

            header("Location:" . BASE_URL . "listar");
        } else {
            $this->views->authviews('acceso denegado');
        }

    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . "login");
    }
}