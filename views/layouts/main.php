<?php

use yii\helpers\Html;
use yii\helpers\BaseUrl;
/* @var $this \yii\web\View */
/* @var $content string */



dmstr\web\AdminLteAsset::register($this);
app\assets\AppAsset::register($this);

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script>
            var baseUrl = '<?php echo BaseUrl::home(); ?>'; 
            var _csrf = '<?php echo Yii::$app->request->getCsrfToken() ?>';
        </script>
    </head>
    <body class="hold-transition skin-purple sidebar-mini">
        <?php $this->beginBody() ?>
        <div class="wrapper">

            <?=
            $this->render(
                    'header.php', ['directoryAsset' => $directoryAsset]
            )
            ?>

            <?=
            $this->render(
                    'left.php', ['directoryAsset' => $directoryAsset]
            )
            ?>

            <?=
            $this->render(
                    'content.php', ['content' => $content, 'directoryAsset' => $directoryAsset]
            )
            ?>

        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
