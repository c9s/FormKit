<?php
namespace FormKit\Widget;

class DateInput extends TextInput
{
    public $type = 'text';
    public $js = array( 'js/jsdate/jsdate.js' );
    public $class = array('formkit-widget','formkit-widget-date');

    /**
     * show change month option
     */
    public $change_month = true;
    public $change_year = true;

    public function render( $attributes = array() )
    {
        $this->setAttributes($attributes);
        $dateFormat = '';

        $format = $this->format ?: 'Y-m-d';
        for($i=0; $i<strlen($format); ++$i)
            switch($format[$i]) {
                case 'd':
                    $dateFormat .= 'dd';
                    break;
                case 'j':
                    $dateFormat .= 'd';
                    break;
                case 'D':
                    $dateFormat .= 'D';
                    break;
                case 'l':
                    $dateFormat .= 'DD';
                    break;
                case 'z':
                    $dateFormat .= 'o';
                    break;
                case 'F':
                    $dateFormat .= 'MM';
                    break;
                case 'M':
                    $dateFormat .= 'M';
                    break;
                case 'm':
                    $dateFormat .= 'mm';
                    break;
                case 'n':
                    $dateFormat .= 'm';
                    break;
                case 'Y':
                    $dateFormat .= 'yy';
                    break;
                case 'y':
                    $dateFormat .= 'y';
                    break;
                default:
                    $dateFormat .= $format[$i];
            }

        $this->dataDateFormat = $dateFormat;
        $this->dataChangeMonth = $this->change_month;
        $this->dataChangeYear  = $this->change_year;

        if( $this->value instanceof \DateTime )
            $this->value = $this->value->format($format);
        return parent::render();
    }
}

