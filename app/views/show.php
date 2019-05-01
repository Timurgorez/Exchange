<?php
$model = $_SESSION['model'];
?>
<div class="container main-content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3>Your file successfully upload</h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <ul class="list-group list-group-horizontal-lg">
                <li class="list-group-item link_file">
                    <a id="url_with_file" href="<?=$_SERVER['HTTP_REFERER'] . $model->getFileName()?>">
                        <?=$_SERVER['HTTP_REFERER'] . $model->getFileName()?></a>
                </li>
                <li class="list-group-item"><button class="btn btn-success" onclick="setClipboard()">Copy</button></li>
            </ul>
        </div>
    </div>
</div>
