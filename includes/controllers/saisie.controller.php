<?php

/* This controller renders the home page */

class SaisieController extends Controller
{


    public function handleRequest()
    {
        $this::beforeAction('taches');


        $libelle = $_POST['libelle'];
        $heureDebut = $_POST['heureDebut'];
        $heureFin = $_POST['heureFin'];

        $error = false;

        if (null != $libelle && null != $heureDebut && null != $heureFin) {//Cas d'un submit post

            if (Tache::save(array('libelle' => $libelle, 'heureDebut' => $heureDebut, 'heureFin' => $heureFin)))
                $this->redirect("/index.php?taches=1");
            else $error = "A unexpected orror occured. Make sure that task start is less than end.";
        }

        render('saisie', array(
            'title' => 'Saisie',
            'error' => $error
        ));
    }
}

?>