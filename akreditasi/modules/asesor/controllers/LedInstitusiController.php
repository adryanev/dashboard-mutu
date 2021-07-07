<?php


namespace akreditasi\modules\asesor\controllers;


class LedInstitusiController extends \monitoring\modules\eksekutif\modules\institusi\controllers\LedInstitusiController
{
    protected $lihatLedView = '@akreditasi/modules/asesor/views/led-institusi/led';
    protected $lihatKriteriaView = '@akreditasi/modules/asesor/views/led-institusi/isi-kriteria';
    protected $lihatNonKriteriaView = '@akreditasi/modules/asesor/views/led-institusi/isi-non_kriteria';

}
