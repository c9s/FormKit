FormKit
========

With FormKit library, you can integrate form widgets with your own frameworks,

And of course, you can define your own form widgets for your applications easily.

Tired with HTML forms ? There are some widget layout engines that
can render widget into HTML with HTML table or fieldsets/legends. Of course you can
define your own layout engine too!


For example, to use a text input widget:

```php
<?php

    $text = new FormKit\Widget\TextInput('username', array( 
        'label' => 'Username',
        'placeholder' => 'Your name please',
        'hint'  => 'Please enter 6 characters for your username',
    ));
    $text->value( 'default' )
        ->size(20);

    echo $text; // render 
```

Which outputs:

```html
<input type="text" name="username" value="default" placeholder="Your name please" size="20"/>
<div class="formkit-hint">Please enter 6 characters for your username</div>
```

SelectInput:

```php
<?php
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
```


Layout
------
To use generic layout:

```php
<?php
$layout = new FormKit\Layout\GenericLayout;
$layout->width(400);
$layout->addWidget( $text )
    ->addWidget( $password )
    ->addWidget( $remember )
    ->addWidget( $birthday )
    ->addWidget( $best_time )
    ->addWidget( $role )
    ->addWidget( $size )
    ->addWidget( $countries )
    ->cellpadding(6)
    ->cellspacing(6)
    ->border(0);
echo $layout;
```


Availabel Form Widgets
----------------------
* TextareaInput
* TextInput
* ButtonInput
* CheckboxInput
* ColorInput
* DateInput
* DatetimeInput
* FileInput
* HiddenInput
* Label
* PasswordInput
* RadioInput
* ResetInput
* SelectInput
* SubmitInput
* AjaxCompleteInput
* CanvasInput

Installation
------------

    $ pear install -f package.xml

License
-------

MIT License

