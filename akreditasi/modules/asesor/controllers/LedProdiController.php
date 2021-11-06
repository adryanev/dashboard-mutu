<?php


namespace akreditasi\modules\asesor\controllers;

use akreditasi\modules\kriteria9\modules\prodi\controllers\LedController;
class LedProdiController extends LedController
{

    protected $lihatLedView = '@akreditasi/modules/asesor/views/led-prodi/led';
    protected $lihatKriteriaView = '@akreditasi/modules/asesor/views/led-prodi/isi-kriteria';
    protected $lihatNonKriteriaView = '@akreditasi/modules/asesor/views/led-prodi/isi-non_kriteria';
}
