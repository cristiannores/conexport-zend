<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;


 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\Db\Sql\Select;
 use Zend\Paginator\Adapter\DbSelect;
 use Zend\Paginator\Paginator;
 
 
 class DamageTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     
     public function Reporte($codigo_sap, $fecha, $turno, $paginated = false)
     {
         date_default_timezone_set ('America/Santiago');
        
        $select = new \Zend\Db\Sql\Select ; 
        $select->from('lote'); 
        $select->columns(array(
            'id_lote'           =>  'id_lote',
            'numero_entrega'    =>  'numero_entrega',
            'destino'           =>  'destino',
            'codigo_sap'        =>  'codigo_sap',
            'numero_lote'       =>  'numero_lote',
            'caracteristicas'   =>  'caracteristicas',
            'piezas_danadas'      =>  'pieza_danada',
            'piezas_paquete'     =>  'pieza_paquete',
            'estado'            =>  'estado',
            
            )); 
        $select->join('inspeccion_lote',
                "lote.id_lote = inspeccion_lote.id_lote",
                array(
                   
                    'fecha'         =>  'fecha',
                    'hora'          =>  'hora',
                    'turno'         =>  'turno',
                    'observaciones' =>  'observaciones',
                    'tipo'          =>  'tipo',
                    ),
                'inner'); 
        
        $select->join(
                'material',
                "material.id_material = lote.id_material",
                array('producto'  =>  'nombre'),
                'inner'); 
        $select->join(
                'usuario',
                "usuario.id_usuario = inspeccion_lote.id_usuario",
                array('usuario'  =>  'nombre'),
                'inner');
        $select->join(
                'cliente',
                "cliente.id_cliente = lote.id_cliente",
                array('exportador'  =>  'organizacion'),
                'inner');
        $select->join(
                'nave',
                "nave.id_nave = lote.id_nave",
                array('nave'  =>  'nombre'),
                'inner');
       $select->where(
                    array('inspeccion_lote.tipo = \'daños\'')
                );
        if($turno != null){
            $select->where(
                    array('inspeccion_lote.turno = '.$turno)
                );
        }
        if($fecha != null){
            $select->where(
                    array('inspeccion_lote.fecha = \''.$fecha.'\'')
                );
        }
        if($codigo_sap != null){
            $select->where(
                    array('lote.codigo_sap = \''.$codigo_sap.'\'')
                );
        }
       
        
        $select->getSqlString();
        
        
        if ($paginated) {
             // create a new Select object for the table album
             
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Damage());
             // create a new pagination adapter object
             $paginatorAdapter = new DbSelect(
                 // our configured select object
                 $select,
                 // the adapter to run it against
                 $this->tableGateway->getAdapter(),
                 // the result set to hydrate
                 $resultSetPrototype
             );
             $paginator = new Paginator($paginatorAdapter);
             return $paginator;
         }
         $resultSet = $this->tableGateway->select();
         return $resultSet; 
        
        
        
     }

 }
 
