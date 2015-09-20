<?php

/* This controller renders the home page */

class LoginController extends Controller
{
    const CORRECT_USERNAME = 'admin';
    const CORRECT_PASSWORD = 'demo';



    public function handleRequest()
    {
        session_start();
        $_SESSION["admin"]=null;
        //Fetching variables of the form which travels in URL

        $username = $_POST['username'];
        $password = $_POST['password'];

        $error = false;

        if (null != $username) {//Cas d'un submit post
            if ($username == self::CORRECT_USERNAME && $password == self::CORRECT_PASSWORD) {
                self::openAdminSession();
                //redirection saisie tache
                $error = false;
                $this->redirect("/index.php?saisie=1");
                // return;
            } else {
                $error = true;
            }
        }

        // Select all the categories:
        //$content = Login::find();

        render('login', array(
            'title' => 'Veuillez vous connecter',
            'error' => $error
        ));
    }
}

?>