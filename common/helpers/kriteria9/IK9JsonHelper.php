<?php
/**
 * Project: kriteria.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/4/2019
 * Time: 9:24 AM
 */

namespace common\helpers\kriteria9;


interface IK9JsonHelper
{

    public static function getAllJsonLk(string $jenis);

    public static function getJsonKriteriaLk(int $kriteria, string $jenis);

    public static function getAllJsonLed(string $jenis);

    public static function getJsonKriteriaLed(int $kriteria);

    public static function getJson($tipe, $jenis);

    public static function getJsonLedKondisiEksternal();
    public static function getJsonLedProfil();
    public static function getJsonLedAnalisis();

    public static function getJsonPenilaianKondisiEksternal($jenis);
    public static function getJsonPenilaianProfil($jenis);
    public static function getJsonPenilaianKriteria($jenis);
    public static function getJsonPenilaianAnalisis($jenis);

    static function provideMapper();
}
