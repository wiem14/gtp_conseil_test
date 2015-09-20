<?php

class Employe
{

    // The find static method returns an array
    // with tache objects from the database.

    /**
     * @param
     * @return array
     */
    public static function findAll()
    {
        global $db;


        $st = $db->prepare("SELECT id,code FROM employe ORDER BY code");


        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS, "Employe");
    }



    /**
     * @param $id à supprimer
     * @return bool
     */
    public function delete($id)
    {
        global $db;
        if ($id != null) {
            $st = $db->prepare("DELETE FROM employe WHERE id = :id");
            return $st->execute(['id' => $id]);

        }else
            return false;
    }

    public static function findAffectedTaches($idEmp)
    {
        global $db;
        if ($idEmp != null) {
            $st = $db->prepare("select libelle,heureDebut, heureFin from tache  WHERE employe_id = :id order by heureDebut");
            $st->execute(['id' => $idEmp]);


            return $st->fetchAll(PDO::FETCH_CLASS, "Tache"); //ceci retourne un tableau de taches

        }else
            return false;
    }


}

?>