<?php
/**
 * mutu-v2
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 */
/**
 * Class IK9DirectoryHelper
 * @package common\helpers\kriteria9
 */


namespace common\helpers\kriteria9;


interface IK9DirectoryHelper
{

    public static function getDokumenLedPath($akreditasi);
    public static function getDokumenLedUrl($akreditasi);
    public static function getDetailLedPath($akreditasi);
    public static function getDetailLedUrl($akreditasi);
    public static function getDokumenLkPath($akreditasi);
    public static function getDokumenLkUrl($akreditasi);
    public static function getDetailLkPath($akreditasi);
    public static function getDetailLkUrl($akreditasi);
    public static function getKuantitatifPath($akreditasi);
    public static function getKuantitatifUrl($akreditasi);
    public static function getTemplateLkPath();
}