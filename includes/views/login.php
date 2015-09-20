<?php render('_header', array('title' => $title)) ?>

<?php if ($error) { ?>
    <div class="bg-danger">Login/password incorrect</div>
<?php } ?>


    <form id="loginForm" method="post" class="form-horizontal" action="/index.php?login=1" style="margin-top:50px;">
        <div class="form-group">
            <label class="col-xs-3 control-label">Username</label>

            <div class="col-xs-5">
                <input type="text" class="form-control" name="username" value="admin"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-3 control-label">Password</label>

            <div class="col-xs-5">
                <input type="password" class="form-control" name="password" value="demo"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-9 col-xs-offset-3">
                <button type="submit" class="btn btn-primary">Sign in</button>
            </div>
        </div>
    </form>

<?php render('_footer') ?>