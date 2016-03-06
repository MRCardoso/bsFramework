<?php
if ( file_exists('../script/data.json')) :
    $dataModule = \yii\helpers\Json::decode(file_get_contents('../script/data.json'));
?>
<div class="text-center">
    <div class="image-home"></div>
    <div class="content">
        <ul class="list-libraries">
            <?php foreach($dataModule as $data): ?>
            <li>
                <div role="button" data-toggle="popover" data-placement="top"
                   title="<?php echo $data["name"]; ?>" data-content="<?php echo $data["text"]; ?>" data-trigger="hover">
                    <div class="box image-<?php echo $data["module"]; ?>"></div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>