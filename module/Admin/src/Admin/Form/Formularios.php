<?php 
use Zend\Form\Factory;

$factory = new Factory();
$form    = $factory->createForm(array(
    'hydrator' => 'Zend\Stdlib\Hydrator\ArraySerializable',
    'elements' => array(
        array(
            'cliente' => array(
                'name' => 'nombre',
                'options' => array(
                    'label' => 'Nombre :  ',
                ),
                'type'  => 'Text',
            )
        ),
        array(
            'cliente' => array(
                'type' => 'Zend\Form\Element\Email',
                'name' => 'email',
                'options' => array(
                    'label' => 'Correo : ',
                )
            ),
        ),
        array(
            'cliente' => array(
                'name' => 'subject',
                'options' => array(
                    'label' => 'Subject',
                ),
                'type'  => 'Text',
            ),
        ),
        array(
            'cliente' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'message',
                'options' => array(
                    'label' => 'Message',
                )
            ),
        ),
        array(
            'cliente' => array(
                'type' => 'Zend\Form\Element\Captcha',
                'name' => 'captcha',
                'options' => array(
                    'label' => 'Please verify you are human.',
                    'captcha' => array(
                        'class' => 'Dumb',
                    ),
                ),
            ),
        ),
        array(
            'cliente' => array(
                'type' => 'Zend\Form\Element\Csrf',
                'name' => 'security',
            ),
        ),
        array(
            'cliente' => array(
                'name' => 'send',
                'type'  => 'Submit',
                'attributes' => array(
                    'value' => 'Submit',
                ),
            ),
        ),
    ),
    /* If we had fieldsets, they'd go here; fieldsets contain
     * "elements" and "fieldsets" keys, and potentially a "type"
     * key indicating the specific FieldsetInterface
     * implementation to use.
    'fieldsets' => array(
    ),
     */

    // Configuration to pass on to
    // Zend\InputFilter\Factory::createInputFilter()
    'input_filter' => array(
        /* ... */
    ),
));