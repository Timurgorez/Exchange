<div class="container main-content">
    <div class="row justify-content-center">
        <h1>File Exchange System</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form class="" enctype="multipart/form-data" action="/" method="post">
                <div class="form-row">
                    <div class="col-md-8 mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"
                                   id="validatedCustomFile" name="user_file">
                            <label class="custom-file-label
                                <?= $_SESSION['errors']['required'] || $_SESSION['errors']['type'] ? 'invalid' : ''?>"
                                for="validatedCustomFile">Choose file...</label>
                            <div class="invalid-feedback"><?= $_SESSION['errors']['required']?><?= $_SESSION['errors']['type']?></div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="use_pass" name="use_pass"
                                   value="1" <?= $_POST['use_pass'] ? "checked" : ''?> >
                            <label class="form-check-label" for="use_pass">
                                Password protected
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <input name="password" type="password"
                               class="form-control <?= $_SESSION['errors']['password'] ? 'invalid' : ''?>"
                               value="<?=$_POST['password']?>"
                               id="pass" placeholder="Password" disabled >
                        <div class="invalid-feedback"><?= $_SESSION['errors']['password']?></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input class="form-check-input" name="once_download" type="checkbox" id="invalidCheck3"  value="1"
                                <?= $_POST['once_download'] ? "checked" : ''?> >
                            <label class="form-check-label" for="invalidCheck3">
                                Delete after first download
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3"></div>
                </div>
                <div class="form-row">
                    <button class="btn btn-outline-success" type="submit">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
