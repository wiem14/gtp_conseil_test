<?php render('_header',array('title'=>$title))?>
<?php if($error){ ?>
    <div class="bg-danger"><?php echo $error ?></div>
<?php } ?>
    <form id="saisieForm" method="post" class="form-horizontal" action="/index.php?saisie=1">
        <div class="form-group">
            <label class="col-xs-3 control-label">Libellé Tâche</label>
            <div class="col-xs-5">
                <input type="text" class="form-control" name="libelle" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">Heure début</label>
            <div class="col-xs-5">
                <input type="time" class="form-control" name="heureDebut" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-3 control-label">Heure fin</label>
            <div class="col-xs-5">
                <input type="time" class="form-control" name="heureFin" />
            </div>
        </div>
        <div class=" form-group bg-info">
            <b>Note:</b>
                Ce formulaire est optimisé pour le navigateur chrome, et notament pour la prise en compte du champs html5 input de type "time".

        </div>



        <div class="form-group">
            <div class="col-xs-9 col-xs-offset-3">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </div>
    </form>


<?php render('_footer')?>