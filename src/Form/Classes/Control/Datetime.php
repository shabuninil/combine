<?php

namespace Combine\Form\Classes\Control;
use Combine\Form\Classes\Control;

require_once __DIR__ . '/../Control.php';


/**
 * Class Datetime
 * @package Combine\Form\Control
 */
class Datetime extends Control {

    protected $attributes = array(
        'type' => 'hidden'
    );


    /**
     * @return string
     */
    protected function makeControl() {

        $tpl = file_get_contents($this->theme_location . '/html/form/controls/datetime.html');

        $id = uniqid('ck');
        $attributes = array(
            "id=\"{$id}\""
        );

        if ( ! empty($this->attributes)) {
            foreach ($this->attributes as $attr_name => $value) {
                if (trim($attr_name) != 'id') {
                    $attributes[] = "$attr_name=\"$value\"";
                }
            }
        }

        if ($this->required) {
            $attributes[] = 'required="required"';

            if ($this->required_message) {
                $attributes[] = "data-required-message=\"{$this->required_message}\"";
            }
        }


        $tpl = str_replace('[ATTRIBUTES]', implode(' ', $attributes), $tpl);
        $tpl = str_replace('[TPL_DIR]',    $this->theme_src,          $tpl);
        $tpl = str_replace('[ID]',         $id,                       $tpl);

        return $tpl;
    }
}