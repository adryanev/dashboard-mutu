<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/26/2019
 * Time: 9:50 PM
 */

namespace common\helpers;


class FileIconHelper
{

    const WORD = '<i class="fas fa-file-word fa-3x text-primary"></i>';
    const FILE = '<i class="fas fa-file fa-3x"></i>';
    const EXCEL = '<i class="fas fa-file-excel fa-3x text-success"></i>';
    const PPT = '<i class="fas fa-file-powerpoint fa-3x text-danger"></i>';
    const PDF = '<i class="fas fa-file-pdf fa-3x text-danger"></i>';
    const ZIP = '<i class="fas fa-file-archive fa-3x text-muted"></i>';
    const CODE = '<i class="fas fa-file-code fa-3x text-info"></i>';
    const TXT = '<i class="fas fa-file-text fa-3x text-info"></i>';
    const VIDEO = '<i class="fas fa-file-video fa-3x text-warning"></i>';
    const AUDIO = '<i class="fas fa-file-audio fa-3x  text-warning"></i>';
    const IMAGE = '<i class="fas fa-file-image fa-3x text-danger"></i>';
    const LINK = '<i class="fas fa-link fa-3x text-info"></i>';
    const STATIC_TEXT = '<i class="fas fa-font fa-3x text-info"></i>';

    public static function getIconByExtension($extension){
        switch (FileTypeHelper::getType($extension)){
            case FileTypeHelper::TYPE_PDF: return self::PDF;
            case FileTypeHelper::TYPE_EXCEL: return self::EXCEL;
            case FileTypeHelper::TYPE_WORD: return self::WORD;
            case FileTypeHelper::TYPE_POWERPOINT: return self::PPT;
            case FileTypeHelper::TYPE_ARCHIVE: return self::ZIP;
            case FileTypeHelper::TYPE_CODE: return self::CODE;
            case FileTypeHelper::TYPE_VIDEO: return self::VIDEO;
            case FileTypeHelper::TYPE_AUDIO: return self::AUDIO;
            case FileTypeHelper::TYPE_IMAGE: return self::IMAGE;
            case FileTypeHelper::TYPE_TEXT: return self::TXT;
            case FileTypeHelper::TYPE_LINK: return self::LINK;
            case FileTypeHelper::TYPE_STATIC_TEXT: return self::STATIC_TEXT;
        }


        return self::FILE;
    }

}