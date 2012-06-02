<?php
namespace FormKit;
use CascadingAttribute;
use DOMDocument;
use DOMNode;
use DOMText;

abstract class Element extends CascadingAttribute
{
    public $tagName;

    /**
     * @var array class name
     */
    public $class = array();



    /**
     * Children elements
     */
    public $children = array();


    /**
     * @var array id field
     */
    public $id = array();

    public $standardAttributes = array( 
        /* core attributes */
        'class','id','style','title',

        /* language attributes */
        'dir', 'lang', 'xml:lang',

        /* keyboard attributes */
        'accesskey', 'tabindex',
    );


    public function __construct($tagName = null)
    {
        if( $tagName )
            $this->tagName = $tagName;
    }


    public function addClass($class)
    {
        if( is_array($class) ) {
            foreach( $class as $c ) {
                $this->class[] = $c;
            }
        } else {
            $this->class[] = $class;
        }
        return $this;
    }

    public function hasClass($class) 
    {
        return array_search($class,$this->class) !== false;
    }

    public function removeClass($class)
    {
        $index = array_search( $class, $this->class );
        array_splice( $this->class, $index , 1 );
        return $this;
    }

    public function addId($id)
    {
        $this->id[] = $id;
        return $this;
    }

    public function addChild($child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function hasChildren()
    {
        return ! empty($this->children);
    }

    protected function _renderChildren()
    {
        return join("\n",array_map(function($child) { 

            if( $child instanceof DOMText || $child instanceof DOMNode ) {
                // to use C14N(), the DOMNode must be belongs to an instance of DOMDocument.
                $dom = new DOMDocument;
                $dom->appendChild($child);
                return $child->C14N() . PHP_EOL;
            } else {
                return $child->render() . PHP_EOL;
            }
        }, $this->children ));
    }



    /**
     * Render standard attributes
     *
     * @return string Standard Attribute string
     */
    public function _renderStandardAttributes()
    {
        return $this->_renderAttributes($this->standardAttributes);
    }


    /**
     * Render attributes
     *
     * @param array $keys
     * @return string 
     */
    protected function _renderAttributes($keys) 
    {
        $html = '';
        foreach( $keys as $key ) {
            if( $val = $this->$key ) {
                if( is_array($val) ) {

                    // check if array is a indexed array, check keys of array[0..cnt] 
                    //
                    // if it's an indexed array
                    // for attributes like "class", which the parameter can be array('class1','class2')
                    // this render the attribute as "class1 class2"
                    //
                    // if it's an associative array
                    // for attribute "style", which the parameter can be array( 'border' => '1px solid #ccc' )
                    // this render the attribute as "border: 1px solid #ccc;"
                    if( array_keys($val) === range(0, count($val)-1) ) {
                        $val = join(' ', $val);
                    } else {
                        $val0 = $val;
                        $val = '';
                        foreach( $val0 as $name => $data ) {
                            $val .= "$name:$data;";
                        }
                    }
                }
                elseif ( is_bool($val) ) {
                    $val = $key;
                }

                // for boolean values like readonly attribute, 
                // we render it as readonly="readonly".
                $html .= sprintf(' %s="%s"', 
                        $key, 
                        htmlspecialchars( $val )
                );
            }
        }
        return $html;
    }

    abstract public function render( $attributes = array() );

    public function __toString()
    {
        return $this->render();
    }
}

