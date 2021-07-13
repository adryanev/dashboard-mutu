<?php
/**
 * Project: kriteria.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 7/26/2019
 * Time: 2:10 AM
 */

namespace common\widgets;


use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn
{

    public $template = '{view} {update} {delete}';
    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'information',['class'=>' btn btn-sm btn-pill btn-elevate btn-elevate-air btn-info']);
        $this->initDefaultButton('update', 'edit',['class'=>'btn btn-sm btn-pill btn-elevate btn-elevate-air btn-warning']);
        $this->initDefaultButton('delete', 'delete', [
            'class'=>' btn btn-sm btn-pill btn-elevate btn-elevate-air btn-danger',
            'data-confirm' => Yii::t('yii', 'Apakah anda yakin untuk menghapus item ini?'),
            'data-method' => 'post',
        ]);
    }

    /**
     * Initializes the default button rendering callback for single button.
     * @param string $name Button name as it's written in template
     * @param string $iconName The part of Bootstrap glyphicon class that makes it unique
     * @param array $additionalOptions Array of additional options
     * @since 2.0.11
     */
    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'Lihat');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Ubah');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Hapus');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
                $icon = Html::tag('i', '', ['class' => "flaticon2-$iconName"]);
                return Html::a($icon. ' '.$title, $url, $options);
            };
        }
    }

}