<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */
namespace Admin\Model;

 use Zend\InputFilter\InputFilter;
 use Zend\InputFilter\InputFilterAwareInterface;
 use Zend\InputFilter\InputFilterInterface;


class Contenedor
{
    public $id_cont;   //1 
    public $nro_bodega; //2
    public $id_nave; //3
    public $codigo_contenedor; //4
    public $hora;
    public $usuario;
    public $contenedor;
    public $turno;
    public $tipo;
    public $bodega;
    public $exportador;
    public $producto;
    public $nave;
    public $destino;
    public $numero_entrega;
    public $lote;
    public $estado;
    public $pieza_danada;
    public $piezas_totales;
    public $observaciones;
    public $imagenes;
    protected $inputFilter; 
    
    
    public function exchangeArray($data)
     {
         $this->id_cont = (!empty($data['id_cont'])) ? $data['id_cont'] : null;
         $this->nro_bodega = (!empty($data['nro_bodega'])) ? $data['nro_bodega'] : null;
         $this->id_nave  = (!empty($data['id_nave'])) ? $data['id_nave'] : null;
         $this->codigo_contenedor  = (!empty($data['codigo_contenedor'])) ? $data['codigo_contenedor'] : null;
         $this->usuario  = (!empty($data['usuario'])) ? $data['usuario'] : null;
         $this->hora  = (!empty($data['fecha'])) ? $data['fecha'] : null;
         $this->contenedor  = (!empty($data['contenedor'])) ? $data['contenedor'] : null;
         $this->turno  = (!empty($data['turno'])) ? $data['turno'] : null;
         $this->tipo = (!empty($data['tipo'])) ? $data['tipo'] : null;
         $this->bodega = (!empty($data['bodega'])) ? $data['bodega'] : null;
         $this->exportador  = (!empty($data['exportador'])) ? $data['exportador'] : null;
         $this->producto  = (!empty($data['producto'])) ? $data['producto'] : null;
         $this->nave  = (!empty($data['nave'])) ? $data['nave'] : null;
         $this->destino = (!empty($data['destino'])) ? $data['destino'] : null;
         $this->numero_entrega = (!empty($data['numero_entrega'])) ? $data['numero_entrega'] : null;
         $this->lote  = (!empty($data['lote'])) ? $data['lote'] : null;
         $this->estado  = (!empty($data['estado'])) ? $data['estado'] : null;
         $this->pieza_danada  = (!empty($data['pieza_danada'])) ? $data['pieza_danada'] : null;
         $this->piezas_totales  = (!empty($data['piezas_totales'])) ? $data['piezas_totales'] : null;
         $this->observaciones  = (!empty($data['observaciones'])) ? $data['observaciones'] : null;
         $this->imagenes  = (!empty($data['imagenes'])) ? $data['imagenes'] : null;
                  
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
                $inputFilter->add($fileInput);
             

             $this->inputFilter = $inputFilter;
             
         }

         return $this->inputFilter;
     }
    
    
}
