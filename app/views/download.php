<div class="container main-content">
    <?php if($_SESSION['model']['is_media']): ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="preview">
                <img src="<?=$_SESSION['model']['file_path'] ?>" width="100%" height="auto">
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-6 download-btn">
            <a onclick="checkCountDownload('<?=$_SESSION['model']['file_name']?>')" href="/load.php?file_n=<?=$_SESSION['model']['file_name'].'-'.$_SESSION['model']['original_name'] ?>">Download
                <span><?= $_SESSION['model']['original_name']?></span>
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="desc">
                <p class="">Size: <span><?= round($_SESSION['model']['size']/1024, 2) ?> kb</span></p>
                <?php if($_SESSION['model']['is_media']): ?>
                <p class="">Resolution: <span><?=$_SESSION['model']['resolution'] ?></span></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
