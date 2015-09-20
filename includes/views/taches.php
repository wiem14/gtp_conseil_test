<?php render('_header', array('title' => $title)) ?>
<?php if ($error) { ?>
    <div class="bg-danger"><?php echo $error ?></div>
<?php } ?>
    <script>
        $(document).ready(function () {
            var table = $('#listTasks').DataTable();


            $('#listTasks tbody').on('click', 'tr', function () {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#button').click(function () {
            var idTache=$('tr.selected').attr('id');
            simpleAjaxCall('/index.php?taches=1&action=DELETE&idTache='+ idTache);
                table.row('.selected').remove().draw(false);
            });
        });

    </script>



        <p>
            <button id="button" type="button" class="btn btn-primary btn-sm">Supprimer la ligne séléctionnée</button>
        </p>

        <p>
        <table id="listTasks" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Libellé Tâche</th>
                <th>Heure début</th>
                <th>Heure fin</th>

            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>Libellé Tâche</th>
                <th>Heure début</th>
                <th>Heure fin</th>
            </tr>
            </tfoot>

            <tbody>
            <?php foreach ($taches as $tache) { ?>
                <tr id="<?php echo $tache->id ?>">

                    <td><?php echo $tache->libelle ?></td>
                    <td><?php echo $tache->heureDebut?></td>
                    <td><?php echo $tache->heureFin ?></td>

                </tr>
            <?php } ?>


            </tbody>

        </table>
        </p>


<?php render('_footer') ?>