<?php

/* This controller renders the home page */

class EmployesController extends Controller
{


    public function handleRequest()
    {
        $this::beforeAction('taches');
        $error=null;
        $action = $_REQUEST['action'];
        if ($action == 'AFFECTER') {
            $res = Tache::affectTaskToEmploye($_REQUEST['idTache'], $_REQUEST['idEmploye']);
            echo($res?'SUCCESS':'ERROR');
            exit();


        }

        // Fetch all the employees with tasks:
        $employes = Employe::findAll();
        // Fetch all tasks not yet affected
        $tachesNotAffected = Tache::findAllNotAffected();


        $error = null;
        render('employes', array(
            'title' => 'Liste des Employés',
            'error' => $error,
            'employes' => $employes,
            'tachesNotAffected' => $tachesNotAffected
        ));
    }
}

?>