<?php
namespace FormKit\Widget;
use CascadingAttribute;

abstract class BaseWidget extends CascadingAttribute
{

    /**
     * @var string field name
     */
    public $name;

    /**
     * @var array class name
     */
    public $class = array();


    /**
     * @var array id field
     */
    public $id = array();

    public function __construct($name, $attributes = array() )
    {
        $this->name = $name;
        $this->attributes += $attributes;
        $this->init();
    }

    public function init()
    {
        $this->setAttributeType( 'class', self::ATTR_ARRAY );
        $this->setAttributeType( 'id', self::ATTR_ARRAY );
        $this->setAttributeType( 'name', self::ATTR_STRING );
        $this->setAttributeType( 'type', self::ATTR_STRING );
        $this->setAttributeType( 'value', self::ATTR_STRING );

        // virtual attribute (not for rendering widget elements )
        $this->setAttributeType( 'label', self::ATTR_STRING );
        $this->setAttributeType( 'hint', self::ATTR_STRING );
        $this->setAttributeType( 'tooltip', self::ATTR_STRING );
    }

    abstract public function render();

    public function __toString()
    {
        return $this->render();
    }

}

