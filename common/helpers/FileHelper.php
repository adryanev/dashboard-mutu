<?php


namespace common\helpers;


class FileHelper extends \yii\helpers\FileHelper
{

    public static function createSymlink($root, $links)
    {
        foreach ($links as $link => $target) {
            //first removing folders to avoid errors if the folder already exists
            @rmdir($root . "/" . $link);
            //next removing existing symlink in order to update the target
            if (is_link($root . "/" . $link)) {
                @unlink($root . "/" . $link);
            }
            if (@symlink($root . "/" . $target, $root . "/" . $link)) {
                echo "      symlink $root/$target $root/$link\n";
            } else {
                printError("Cannot create symlink $root/$target $root/$link.");
            }
        }
    }
}
