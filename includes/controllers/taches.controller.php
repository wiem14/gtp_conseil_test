<?php

/* This controller renders the home page */

class TachesController extends Controller
{


    public function handleRequest()
    {
        $this::beforeAction('taches');

        $action = $_REQUEST['action'];
        if ($action == 'DELETE'){
            Tache::deleteTache($_REQUEST['idTache']);
            return;
        }

        // Fetch all the categories:
        $taches = Tache::findAll();


        $error = null;
        render('taches', array(
            'title' => 'Liste des tâches',
            'error' => $error,
            'taches' => $taches
        ));
    }
}

?>