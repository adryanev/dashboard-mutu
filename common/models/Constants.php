<?php
/**
 * Project: mutu-v2.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 8/21/2019
 * Time: 10:50 AM
 */

namespace common\models;

class Constants
{

    const JENIS_AKREDITASI =[
        'prodi'=>'Program Studi',
        'institusi'=> 'Perguruan Tinggi'
    ];

    const LED = 'led';
    const LK = 'lk';
    const STANDAR7 = '7standar';
    const KRITERIA9 = '9kriteria';

    const SUMBER = 'sumber';
    const PENDUKUNG = 'pendukung';
    const LAINNYA = 'lainnya';
    const TEMPLATE = 'template';

    const LINK = 'link';
    const TEXT = 'text';

    const BORANG = [
        self::STANDAR7 => '7 Standar',
        self::KRITERIA9 => '9 Kriteria'
    ];

    const PRODI = 'prodi';
    const INSTITUSI = 'institusi';
    const FAKULTAS = 'fakultas';

    const ALLOWED_EXTENSIONS = ['jpg','jpeg','png','pdf','docx','doc','gif','ppt','pptx','xls','xlsx', 'zip','txt','csv','odt','ods'];
    const IMAGE_EXTENSIONS = ['jpg','jpeg','png','gif','bmp','tiff'];

    public static function MAX_UPLOAD_SIZE()
    {
        return self::file_upload_max_size();
    }

    // Returns a file size limit in bytes based on the PHP upload_max_filesize
// and post_max_size
    private static function file_upload_max_size()
    {
        static $max_size = -1;

        if ($max_size < 0) {
            // Start with post_max_size.
            $post_max_size = self::parse_size(ini_get('post_max_size'));
            if ($post_max_size > 0) {
                $max_size = $post_max_size;
            }

            // If upload_max_size is less, then reduce. Except if upload_max_size is
            // zero, which indicates no limit.
            $upload_max = self::parse_size(ini_get('upload_max_filesize'));
            if ($upload_max > 0 && $upload_max < $max_size) {
                $max_size = $upload_max;
            }
        }
        return $max_size;
    }

    private static function parse_size($size)
    {
        $unit = preg_replace('/[^bkmgtpezy]/i', '', $size); // Remove the non-unit characters from the size.
        $size = preg_replace('/[^0-9.]/', '', $size); // Remove the non-numeric characters from the size.
        if ($unit) {
            // Find the position of the unit in the ordered string which is the power of magnitude to multiply a kilobyte by.
            return round($size * (1024 ** stripos('bkmgtpezy', $unit[0])));
        }

        return round($size);
    }
}
