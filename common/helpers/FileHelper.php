<?php


namespace common\helpers;


class FileHelper extends \yii\helpers\FileHelper
{

    public static function createSymlink($links)
    {
        foreach ($links as $link => $target) {
            //first removing folders to avoid errors if the folder already exists
            @rmdir($link);
            //next removing existing symlink in order to update the target
            if (is_link($link)) {
                @unlink($link);
            }
            if (@symlink($target, $link)) {
                echo "      symlink $target $link\n";
            } else {
                printError("Cannot create symlink $target $link.");
            }
        }
    }
}
