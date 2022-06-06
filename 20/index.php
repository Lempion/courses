<?php
session_start();

require '../database/ConnectionDB.php';

$database = new ConnectionDB();

$images = $database->getImages();

$message = $_SESSION['ANSWER'];

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Подготовительные задания к курсу
        </title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="/css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="/css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="/css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="/css/statistics/chartist/chartist.css">
        <link rel="stylesheet" media="screen, print" href="/css/miscellaneous/lightgallery/lightgallery.bundle.css">
        <link rel="stylesheet" media="screen, print" href="/css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="/css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="/css/fa-regular.css">
    </head>
    <body class="mod-bg-1 mod-nav-link ">
    <main id="js-page-content" role="main" class="page-content">
        <div class="row" style="flex-direction: column;">
            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Задание
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                    data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                    data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <div class="panel-content">
                                <?php if ($message && $message['ACCEPT']): ?>
                                    <div class="alert alert-success fade show" role="alert">
                                        <i><?php echo $message['ACCEPT']; ?></i>
                                    </div>
                                <?php elseif ($message && $message['ERROR']): ?>
                                    <div class="alert alert-danger fade show" role="alert">
                                        <i><?php echo $message['ERROR']; ?></i>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <form action="uploadImg.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="form-label" for="simpleinput">Image</label>
                                            <input multiple type="file" id="simpleinput" class="form-control" name="imagesdb[]">
                                        </div>
                                        <button class="btn btn-success mt-3">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Загруженные картинки
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse"
                                    data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen"
                                    data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                        </div>
                    </div>
                    <?php if ($images['ERROR']): ?>
                        <h1><?php echo $images['ERROR']; ?></h1>
                    <?php else: ?>
                        <div class="panel-container show">
                            <div class="panel-content">
                                <div class="panel-content image-gallery">
                                    <div class="row">
                                        <?php foreach ($images as $key => $dataImage): ?>
                                            <div class="col-md-3 image">
                                                <img style="width: 250px;height: 150px;"
                                                     src="../images/<?php echo $dataImage['label']; ?>">
                                                <a class="btn btn-danger" href="removeImg.php?id=<?php echo $dataImage['id']?>" onclick="confirm('Вы уверены?');">Удалить</a>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>


    </main>


    <script src="/js/vendors.bundle.js"></script>
    <script src="/js/app.bundle.js"></script>
    <script>
        // default list filter
        initApp.listFilter($('#js_default_list'), $('#js_default_list_filter'));
        // custom response message
        initApp.listFilter($('#js-list-msg'), $('#js-list-msg-filter'));
    </script>
    </body>
    </html>
<?php
$_SESSION['ANSWER'] = '';
?>