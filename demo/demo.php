<?php
require '../tests/bootstrap.php';
FormKit\FormKit::setAssetPath('../static');

$text = new FormKit\Widget\TextInput('username', array( 'label' => 'Username' ));
$text->value( 'default' )
    ->maxlength(10)
    ->minlength(3)
    ->size(20);

$textarea = new FormKit\Widget\TextareaInput('description', array( 'label' => _('Description') ));
$textarea->value( '說明文字' )
    ->cols(50)
    ->rows(5);

$password = new FormKit\Widget\PasswordInput('password', array( 'label' => 'Password' ));

$remember = new FormKit\Widget\CheckboxInput('remember', array( 'label' => 'Remember me' ));
$remember->value(12);
$remember->check();

$ajaxComplete = new FormKit\Widget\AjaxCompleteInput('names', array( 
    'label' => 'names',
    'source' => 'tests/ajax_complete.php',
));

$file = new FormKit\Widget\FileInput('file', array( 'label' => _('File'), 'style' => array( 'background-color' => '#ccc' ) ));

$canvas = new FormKit\Widget\CanvasInput('canvas', array(
    'id' => 'canvas',
    'label' => _('Canvas'),
    'width' => 385,
    'height' => 480,
    'background' => 'face.jpg',
    'value' => 'draw.png'
));

$role = new FormKit\Widget\SelectInput('role' , array( 
    'label' => 'Role',
    'options' => array(
        _('Admin')     => 'admin',
        _('User')      => 'user',
        _('Anonymous') => 'anonymous',
    )
));

/* selector with group options */
$countries = new FormKit\Widget\SelectInput( 'country' , array(
    'label' => 'Country',
    'options' => array(
        'Test' => 'Test',
        'Asia' => array( 
            'Taiwan',
            'Taipei',
            'Tainan',
            'Tokyo',
            'Korea',
        )
    )
));

$color = new FormKit\Widget\ColorInput('color', array(
    'label' => _('Color')
));

$radio = new FormKit\Widget\RadioInput('type' , array( 
    'label' => 'Size',
    'value' => 'Two',
    'options' => array( 'One', 'Two' , 'Three' ),
));


$size = new FormKit\Widget\SelectInput( 'size' , array( 
    'label' => 'Size',
    'options' => array(
        '1' => 'foo',
        '2' => 'bar',
        '3' => 'zxx',

        // test integer index
        4 => 'zzz',
    )
));

$submit = new FormKit\Widget\SubmitInput;

$layout = new FormKit\Layout\GenericLayout;
$layout->width(400);
$layout->addWidget( $text )
    ->addWidget( $password )
    ->addWidget( $remember )
    ->addWidget( $role )
    ->addWidget( $size )
    ->addWidget( $countries )
    ->cellpadding(6)
    ->cellspacing(6)
    ->border(0);

$layout->addWidget( $color );
$layout->addWidget( $ajaxComplete );
$layout->addWidget( $radio );
$layout->addWidget( $file );
$layout->addWidget( $canvas );
$layout->addWidget( $textarea );
$layout->addWidget( $submit );
?>
<!Doctype html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"> </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"> </script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css" type="text/css" />
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/black-tie/jquery-ui.css" type="text/css" />

    <?php foreach( $layout->widgets->getJavascripts() as $url ) : ?>
        <script src="<?= $url ?>"> </script>
    <?php endforeach ?>

    <?php foreach( $layout->widgets->getStylesheets() as $url ) : ?>
        <link rel="stylesheet" href="<?= $url ?>" type="text/css"/>
    <?php endforeach ?>

    <!--
    $_POST = <? print_r($_POST) ?>
    $_FILES = <? print_r($_FILES) ?>
    -->
</head>
<body>
<?php


/*
echo $layout->renderWidget( 'size' );
echo $layout->widgets->render( 'size' );
*/

$form = new FormKit\Element\Form;
$form->method('post')->action('?');
$form->addChild( $layout );

// $form->addChild( $submit );

echo $form;

#  echo $text;
#  echo $password;
#  echo $remember;
#  $layout->renderRow( 'username' );
#  $layout->renderRow( 'password' );
?>
</body>
</html>
