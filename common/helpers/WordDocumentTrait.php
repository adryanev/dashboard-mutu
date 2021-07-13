<?php


namespace common\helpers;


trait WordDocumentTrait
{

    private $heading1 = [
        'fontSize' => 14,
        'spacing' => 180,
        'bold' => true,

    ];
    private $heading2 = [
        'fontSize' => 12,
        'spacing' => 180,
        'bold' => true,

    ];
    private $heading3 = [
        'fontSize' => 11,
        'spacing' => 120,
        'bold' => true,
    ];

    private $normal = [
        'fontSize' => 11,
        'spacing' => 120
    ];

    public function prepareDocument($docx)
    {
        $docx->setDefaultFont('Arial');

    }

    private function generateMargin()
    {

    }

    private function generateHeading()
    {
    }
}
