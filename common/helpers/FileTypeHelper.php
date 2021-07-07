<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/26/2019
 * Time: 9:34 PM
 */

namespace common\helpers;


class FileTypeHelper
{

    const TYPE_WORD = 'word';
    const TYPE_EXCEL = 'excel';
    const TYPE_POWERPOINT = 'powerpoint';
    const TYPE_PDF = 'pdf';
    const TYPE_ARCHIVE = 'archive';
    const TYPE_CODE = 'code';
    const TYPE_VIDEO = 'video';
    const TYPE_AUDIO = 'audio';
    const TYPE_OBJECT = 'object';
    const TYPE_IMAGE = 'image';
    const TYPE_TEXT = 'text';
    const TYPE_STATIC_TEXT = 'static_text';
    const TYPE_LINK = 'link';

    public static function getType($extension)
    {

        if (preg_match('/(doc|docx)$/i', $extension)) {
            return self::TYPE_WORD;
        } elseif (preg_match('/(xls|xlsx)$/i', $extension)) {
            return self::TYPE_EXCEL;
        } elseif (preg_match('/(ppt|pptx)$/i', $extension)) {
            return self::TYPE_POWERPOINT;
        } elseif (preg_match('/(zip|rar|tar|gzip|gz|7z)$/i', $extension)) {
            return self::TYPE_ARCHIVE;
        } elseif (preg_match('/(htm|html|ini|csv|java|php|js|css)$/i', $extension)) {
            return self::TYPE_CODE;
        }elseif (preg_match('/(txt)$/i', $extension)) {
            return self::TYPE_TEXT;
        }elseif (preg_match('/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i', $extension)) {
            return self::TYPE_VIDEO;
        } elseif (preg_match('/(mp3|wav)$/i', $extension)) {
            return self::TYPE_VIDEO;
        } elseif(preg_match('/(jpg|jpeg|gif|png|webp|bmp)$/i',$extension)) {
            return self::TYPE_IMAGE;
        } elseif(preg_match('/(pdf)$/i',$extension)) {
            return self::TYPE_PDF;
        } elseif(preg_match('/(link)$/i',$extension)) {
            return self::TYPE_LINK;
        }
        elseif(preg_match('/(text)$/i',$extension)) {
            return self::TYPE_STATIC_TEXT;
        }

        return self::TYPE_OBJECT;
    }
}