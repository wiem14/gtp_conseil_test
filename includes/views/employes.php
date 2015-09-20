<?php render('_header', array('title' => $title)) ?>
<?php if ($error) { ?>
    <div class="bg-danger"><?php echo $error ?></div>
<?php } ?>
    <script>
        $(document).ready(function () {
            var table = $('#listEmployes').DataTable();


            $('#listEmployes tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#button').click(function () {
            var idemp = $('tr.selected').attr('id');
            if(undefined==idemp)
                alert("Veuillez sélectionner un employé d'abord.");
            else{
                var idTache =$('.selectpicker option:selected').val();//$('#tasks').val();
                res = simpleAjaxCall('/index.php?employes=1&action=AFFECTER&idTache='+ idTache+'&idEmploye='+ idemp);
                if(res != 'SUCCESS') alert("Un employé ne pouvant traiter qu'une tâche à la fois. Un employé ne travaille pas plus de 8h dans sa journée.");
                else location.reload();
                //window.location.reload();
                    //table.row('.selected').remove().draw(false);
           }
           });
        });

    </script>


    <div class="row">
    <div class="col-lg-4">
            <select class="selectpicker show-tick form-control" data-live-search="true" id="tasks">
            <?php foreach ($tachesNotAffected as $tache) {
                $sTache = 'De '. $tache->heureDebut.' à '.$tache->heureFin.' '.$tache->libelle;

             ?>

                <option value="<?php echo  $tache->id ?>"><?php echo  $sTache ?></option>
<?php } ?>
            </select>
        </div>
        <div class="col-lg-4">
            <button id="button" type="button" class="btn btn-primary btn-sm">Affecter une tâche</button>
        </div>
        </div>
        <br>
       <p>
        <table id="listEmployes" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Code Employé</th>
                <th>Tâches affectées</th>



            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>Code Employé</th>
                <th>Tâches affectées</th>
            </tr>
            </tfoot>

            <tbody>
            <?php foreach ($employes as $emp) {
             $taches = Employe::findAffectedTaches($emp->id);
             $sTaches = '';
             $i=0;
            foreach($taches as $tache){
                $i++;
                $sTaches .= $i.'. De '. $tache->heureDebut.' à '.$tache->heureFin.' : '.$tache->libelle.'<br>';
            }
             ?>
                <tr id="<?php echo $emp->id ?>">

                    <td><?php echo $emp->code ?></td>
                    <td><?php echo $sTaches?></td>



                </tr>
            <?php } ?>


            </tbody>

        </table>
        </p>


<?php render('_footer') ?>