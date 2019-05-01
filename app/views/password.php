<div class="container main-content">
    <div class="row justify-content-center">
        <form enctype="multipart/form-data" action="/<?=$_SESSION['f_name']?>" method="post">
            <div class="form-group">
                <label>
                    This file protected with password.<br>
                    Input password to download the file.
                    <input id="pass" class="form-control" name="password" type="password" value="<?=$_POST['password'] ?>" />
                </label>
            </div>
            <button type="submit" class="btn btn-success">Download</button>
        </form>
    </div>
    <div class="row justify-content-center">
        <div class="errors"><?php
            if($_SESSION['errors']){
                foreach ($_SESSION['errors'] as $error){
                    echo '<p>' . $error . '</p>';
                }
            }
            ?></div>
    </div>
</div>