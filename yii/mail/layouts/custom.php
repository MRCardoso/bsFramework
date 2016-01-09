<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
<div style="background: #fbfbfb;  border-radius: 5px;">
    <div style="border: 1px solid #EFEFEF;padding: 1%;">
        <strong><?php echo $title; ?></strong>
    </div>
    <div style="text-align: left;  padding: 0.5% 2%;  width: 89%;  word-wrap: break-word">
        <?php
            if( is_array($content) )
            {
                echo "<div style='width: 500px;'>";
                foreach($content as $key => $row)
                {
                    echo "<div style='border-radius: 5px; box-shadow: 0 1px 1px 3px #000'><strong style='font-weight: bold; width: 180px; text-align: right'>{$key}</strong>: {$row}</div>";
                }
                echo "</div>";
            }
            else{
                echo $content;
            }
            if( isset($dump) && count($dump) > 0)
            {
                echo "<div>";
                    echo "<pre>";
                        print_r($dump);
                    echo "</pre>";
                echo "</div>";
            }
            echo "<p><strong>IP: ";
                if (!empty($_SERVER['HTTP_CLIENT_IP']))
                    echo  $_SERVER['HTTP_CLIENT_IP'];
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
                    echo $_SERVER['HTTP_X_FORWARDED_FOR'];
                else
                    echo $_SERVER['REMOTE_ADDR'];

            echo "</strong></p>";
        ?>
    </div>
    <div style="border: 1px solid #EFEFEF;padding: 1%;text-align: center">
        <small>
            &copy; MRC - system - @development with Framework Yii on your version 2
        </small>
    </div>
</div>
</body>
</html>