<?php

class Tache
{
    const MAX_HOURS = 8;

    // The find static method returns an array
    // with tache objects from the database.

    /**
     * @param
     * @return array
     */
    public static function findAll()
    {
        global $db;


        $st = $db->prepare("SELECT id,libelle, heureDebut, heureFin FROM tache ORDER BY libelle");


        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS, "Tache");
    }

    /**
     * @param $arr
     * @return bool success or no
     * @throws Exception
     */
    public static function save($arr)
    {
        $heureDebut = $arr['houreDebut'];
        $heureFin = $arr['heureFin'];

        if (!self::validateTimes($heureDebut, $heureFin)) return false;

        global $db;

        if ($arr['libelle'] && $arr['heureDebut'] && $arr['heureFin']) {
            $st = $db->prepare("INSERT INTO tache (libelle, heureDebut,heureFin) VALUES (:libelle, :heureDebut, :heureFin) ");
        } else {
            throw new Exception("Unsupported property!");
        }

        return $st->execute($arr);
    }

    /**
     * @param $heureDebut
     * @param $heureFin
     * @return bool if dateDebut < dateFin
     * * @throws Exception
     */
    public function validateTimes($heureDebut, $heureFin)
    {
        try {
            $debut = date_parse($heureDebut);
            $fin = date_parse($heureFin);
            if ($debut['hour'] == $fin['hour'])
                return $debut['minute'] < $fin['minutes'];
            else return $debut['hour'] < $fin['hour'];
        } catch (Exception $e) {
            return false;
        }
    }

    private static function find($idTache)
    {
        global $db;
        if ($idTache != null) {
            $st = $db->prepare("SELECT id,libelle, heureDebut, heureFin FROM tache WHERE id=:id LIMIT 1");


            $st->execute(['id' => $idTache]);


            return $st->fetchAll(PDO::FETCH_CLASS, "Tache");
        } else
            return null;
    }

    /**
     * Cette méthode retourne true si l'employé $idEmploye, avec le nouveau créneau horaire à affecter, ne va pas dépassé self::MAX_HOURS
     * Ceci est assuré par cette requete mysql : select TIME(TIME(sum(TIMEDIFF(heureFin,heureDebut)))+TIMEDIFF(<$heureFin>,<$heureDebut>))< '08:00:00' from tache where employe_id=<$idEmploye>
     * on calcule la somme du temps déjà affecté et on ajoute la durée de la nouvelle tache à affecter. Et la compare avec la valeur self::MAX_HOURS
     *
     * @param $heureDebut : Heure de début de la nouvelle tache à affecter
     * @param $heureFin : Heure de fin de la nouvelle tache à affecter
     * @param $idEmploye : id de l'employé
     * @return bool
     */
    private static function confirmMaxTimeNotReached($heureDebut, $heureFin, $idEmploye)
    {
        //select TIME(TIME(sum(TIMEDIFF(heureFin,heureDebut)))+TIMEDIFF('15:00','14:30'))< '08:00:00' from tache where employe_id=1
        global $db;
        $st = $db->prepare("select (TIME(TIME(sum(TIMEDIFF(heureFin,heureDebut)))+TIMEDIFF(:heureFin,:heureDebut)) < '" . self::MAX_HOURS . ":00:00') as ok from tache where employe_id=:idEmploye");

        $st->execute(['idEmploye' => $idEmploye, 'heureDebut' => $heureDebut, 'heureFin' => $heureFin]);
        $res = $st->fetchAll();
        if (array_keys($res[0])[1] != 1) return true; else return false;
    }

    /**
     * @param $idTache à supprimer
     * @return bool
     */
    public function deleteTache($idTache)
    {
        global $db;
        if ($idTache != null) {
            $st = $db->prepare("DELETE FROM tache WHERE id = :id");
            return $st->execute(['id' => $idTache]);

        } else
            return false;
    }

    /**
     * @param
     * @return array taches non affectées
     */
    public static function findAllNotAffected()
    {
        global $db;


        $st = $db->prepare("SELECT t.id, t.libelle,t.heureDebut, t.heureFin from tache t
                                    left join employe e on t.employe_id=e.id
                                    where e.id is null ORDER BY t.heureDebut");


        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS, "Tache");
    }

    public static function affectTaskToEmploye($idTache, $idEmploye)
    {
        global $db;

        $tache = Tache::find($idTache);

        if ($tache != null) {
            if (self::confirmNoConflict($tache[0]->heureDebut, $tache[0]->heureFin, $idEmploye) && self::confirmMaxTimeNotReached($tache[0]->heureDebut, $tache[0]->heureFin, $idEmploye)) {
                $st = $db->prepare("UPDATE tache SET employe_id = :idEmploye WHERE id= :idTache");
                $st->execute(['idEmploye' => $idEmploye, 'idTache' => $idTache]);
                return true;
            }
        }
        return false;
    }

    /**
     * Cette méthode retourne true/false pour indiquer si oui ou non, on peut assigner à l'employe avec l'id $idEmploye une tache qui se déroule de $heureDebut à $heureFin
     * Test cases : conflit si l'employe a déjà une tache qui :
     *   - commence avant $heureDebut et fini après $heureDebut
     *   - commence avant $heureDebut et fini après $heureFin
     *   - commence avant $heureFin et fini avant $heureFin
     *   - commence avant $heureFin et fini après $heureFin
     *   - commence avant $heureDébut et fini après $heureFin
     *   - fini après $heureDébut et fini après $heureFin
     * @param $heureDebut
     * @param $heureFin
     * @param $idEmploye
     * @return bool
     */
    public static function confirmNoConflict($heureDebut, $heureFin, $idEmploye)
    {
        global $db;

        $st = $db->prepare(" select * from tache where employe_id=:idEmploye
                                and
                                (
            (heureDebut > :heureDebut AND heureDebut < :heureFin)
            OR
            (heureFin > :heureDebut AND heureFin < :heureFin)
            OR
            (heureDebut <  :heureDebut AND heureFin >:heureFin)) LIMIT 1");

        $st->execute(['idEmploye' => $idEmploye, 'heureDebut' => $heureDebut, 'heureFin' => $heureFin]);

        return sizeof($st->fetchAll()) == 0;


    }


}

?>