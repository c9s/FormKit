<?php
namespace FormKit\Element;
use FormKit\Element;
use DOMText;

class Legend extends Element
{

    function __construct($text = null) {
        if( $text && is_string($text) ) {
            $textNode = new DOMText($text);
            $this->addChild($textNode);
        }
        parent::__construct();
    }


    function render($attributes = array() ) {
        $this->setAttributes( $attributes );
        return '<legend' . $this->_renderAttributes(array('id','class','style','align','title')) . '>'
                . $this->_renderChildren()
                . '</legend>';
    }
}


