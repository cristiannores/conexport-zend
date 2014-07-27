<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


class Lote
{
    public $id_lote;   //1 
    public $id_cliente; //2
    public $rut_cliente; //3
    public $producto; //4
    public $id_cont; //
    public $nro_bodega;
    public $nave;
    public $numero_entrega; //6
    public $destino;
    public $codigo_sap; //7
    public $numero_lote;    //8       
    public $caracteristicas;    //9
    public $pieza_danada;   //10      
    public $pieza_paquete;  //11
    public $estado;  //12
   
    public $usuario;
    public $fecha; 
    public $turno;
    public $hora;
    public $observaciones;
    public $tipo;
    protected $inputFilter; 
    
    public function exchangeArray($data)
     {
         $this->id_lote = (!empty($data['id_lote'])) ? $data['id_lote'] : null;
         $this->id_cliente = (!empty($data['id_cliente'])) ? $data['id_cliente'] : null;
         $this->rut_cliente  = (!empty($data['rut_cliente'])) ? $data['rut_cliente'] : null;
         $this->producto  = (!empty($data['producto'])) ? $data['producto'] : null;
         $this->id_cont  = (!empty($data['id_cont'])) ?  $data['id_cont'] : null;
         $this->nro_bodega  = (!empty($data['nro_bodega'])) ? $data['nro_bodega'] : null;
         $this->nave  = (!empty($data['nave'])) ? $data['nave'] : null;
         $this->numero_entrega  = (!empty($data['numero_entrega'])) ? $data['numero_entrega'] : null;
         $this->destino  = (!empty($data['destino'])) ? $data['destino'] : null;
         $this->codigo_sap  = (!empty($data['codigo_sap'])) ? $data['codigo_sap'] : null;
         $this->numero_lote  = (!empty($data['numero_lote'])) ? $data['numero_lote'] : null;
         $this->caracteristicas  = (!empty($data['caracteristicas'])) ? $data['caracteristicas'] : null;
         $this->pieza_danada  = (!empty($data['pieza_danada'])) ? $data['pieza_danada'] : null;
         $this->pieza_paquete  = (!empty($data['pieza_paquete'])) ? $data['pieza_paquete'] : null;
         $this->estado  = (!empty($data['estado'])) ? $data['estado'] : null;
         $this->usuario  = (!empty($data['usuario'])) ? $data['usuario'] : null;
         $this->fecha  = (!empty($data['fecha'])) ? $data['fecha'] : null;
         $this->turno  = (!empty($data['turno'])) ? $data['turno'] : null;
         $this->hora  = (!empty($data['hora'])) ? $data['hora'] : null;
         $this->observaciones  = (!empty($data['observaciones'])) ? $data['observaciones'] : null;
         $this->tipo  = (!empty($data['tipo'])) ? $data['tipo'] : null;
         
     }
   
     public function getArrayCopy()
     {
         return get_object_vars($this);
     }
     
     public function getInputFilter($dir)
     {
         if (!$this->inputFilter) {
             $inputFilter = new InputFilter();

             // File Input
                $fileInput = new \Zend\InputFilter\FileInput('image-file');
                $fileInput->setRequired(true);
                

                // You only need to define validators and filters
                // as if only one file was being uploaded. All files
                // will be run through the same validators and filters
                // automatically.
                $fileInput->getValidatorChain()
                    ->attachByName('filesize',      array('max' => 804800))
                    //->addValidator('Extension',false,'jpg,png,gif');
                    ->attachByName('filemimetype',  array('mimeType' => 'image/png, image/x-png, image/jpeg'));
        //            ->attachByName('fileimagesize', array('maxWidth' => 100, 'maxHeight' => 100));

                // All files will be renamed, i.e.:
                //   ./data/tmpuploads/avatar_4b3403665fea6.png,
                //   ./data/tmpuploads/avatar_5c45147660fb7.png
                $fileInput->getFilterChain()->attachByName(
                    'filerenameupload',
                    array(
                        'target'    => $dir, // './data/tmpuploads/avatar.png',
                        'randomize' => true,
                    )
                );
             
             $inputFilter->add(array(
                 'name'     => 'destino',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 4,
                             'max'      => 20,
                         )),
                     array(
                         'name'    => 'Alpha',
                         'options' => array (
                             'allowWhiteSpace' => TRUE
                         )
                         
                         ),
                     
                     
                     ),
             ));
             
             $inputFilter->add(array(
                 'name'     => 'numero_entrega',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 4,
                             'max'      => 20,
                         )),
                     array('name'    => 'Alnum',
                           
                       ),                 ),
             ));
             $inputFilter->add(array(
                 'name'     => 'codigo_sap',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 4,
                             'max'      => 20,
                         )),
                     array('name'    => 'Alnum'),
                     ),
             ));
             $inputFilter->add(array(
                 'name'     => 'numero_lote',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 4,
                             'max'      => 20,
                         )),
                     array('name'    => 'Alnum'),
                     ),
             ));
             $inputFilter->add(array(
                 'name'     => 'pieza_danada',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 0,
                             
                         )),
                     array('name'    => 'Digits'),
                     ),
             ));
             $inputFilter->add(array(
                 'name'     => 'pieza_paquete',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 0,
                             
                         )),
                     array('name'    => 'Digits'),
                     ),
             ));
             $inputFilter->add(array(
                 'name'     => 'estado',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 4,
                             
                         )),
                     array(
                         'name'    => 'Alpha',
                         'options' => array (
                             'allowWhiteSpace' => TRUE
                         )
                         
                         ),
                     ),
             ));
             $inputFilter->add(array(
                 'name'     => 'observaciones',
                 'required' => true,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 4,
                             
                         )),
                     array(
                         'name'    => 'Alpha',
                         'options' => array (
                             'allowWhiteSpace' => TRUE
                         )
                         
                         ),
                     ),
             ));
             $inputFilter->add(array(
                 'name'     => 'name',
                 'required' => false,
                 
                 
             ));
            
             
             
             
             
             $this->inputFilter = $inputFilter;
         }

         return $this->inputFilter;
     }
    
    
}
