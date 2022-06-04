<?php
$arrGraphs =
    [
        [
            'label' => 'My Tasks',
            'text' => '130 / 500',
            'classLine' => 'bg-fusion-400',
            'role' => 'progressbar',
            'width' => '65%',
            'valuenow' => '65',
        ],
        [
            'label' => 'Transfered',
            'text' => '440 TB',
            'classLine' => 'bg-success-500',
            'role' => 'progressbar',
            'width' => '34%',
            'valuenow' => '34',
        ],
        [
            'label' => 'Bugs Squashed',
            'text' => '77%',
            'classLine' => 'bg-info-400',
            'role' => 'progressbar',
            'width' => '77%',
            'valuenow' => '77',
        ],
        [
            'label' => 'User Testing',
            'text' => '7 days',
            'classLine' => 'bg-primary-300',
            'role' => 'progressbar',
            'width' => '84%',
            'valuenow' => '84',
        ],
    ];
$countGraphs = count($arrGraphs) - 1;
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

                    <?php foreach ($arrGraphs as $key => $dataGraph): ?>
                        <div class="d-flex <?php echo($key == 0 ? 'mt-2' : ''); ?>">
                            <?php echo $dataGraph['label']; ?>
                            <span class="d-inline-block ml-auto"><?php echo $dataGraph['text']; ?></span>
                        </div>
                        <div class="progress progress-sm <?php echo($key == $countGraphs ? 'mb-g' : 'mb-3'); ?>">
                            <div class="progress-bar <?php echo $dataGraph['classLine']; ?>"
                                 role="<?php echo $dataGraph['role']; ?>"
                                 style="width:<?php echo $dataGraph['width']; ?>"
                                <?php echo $dataGraph['valuenow']; ?>
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
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
