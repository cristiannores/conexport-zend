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
 
 
 class DesconsolidacionTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     
     public function Reporte($contenedor, $fecha, $turno, $paginated = false)
     {
        date_default_timezone_set ('America/Santiago');
        
        $select = new \Zend\Db\Sql\Select ; 
        $select->from('contenedor'); 
        $select->columns(array(
            'id_contenedor'    => 'codigo_contenedor',
            'id_cont'       => 'id_cont',
            
            )); 
        $select->join('lote',
                "contenedor.id_cont = lote.id_cont",
                array(
                   
                    'lote'  =>  'numero_lote',
                    'numero_entrega'  =>  'numero_entrega',
                    'destino'  =>  'destino',
                    'pieza_danada'  =>  'pieza_danada',
                    'piezas_totales'  =>  'pieza_paquete',
                    'estado'=>  'estado'),
                'inner'); 
        $select->join(
                'inspeccion_contenedor',
                "contenedor.id_cont = inspeccion_contenedor.id_cont",
                array(
                    'fecha'  =>  'fecha',
                    'tipo'=>  'tipo',
                    'observaciones' => 'observaciones',
                    'turno' => 'turno',
                    ),
                'inner'); 
        $select->join(
                'detalle_dano',
                "detalle_dano.id_lote = lote.id_lote",
                array(
                    'imp_o_zcho'  => 'imp_o_zcho',
                    'imp_o_taco'=>  'imp_o_zcho',
                    'imp_d_zcho' => 'imp_d_zcho',
                    'imp_d_taco' => 'imp_d_taco',
                    'imp_piezas_o' => 'imp_piezas_o',
                    'imp_piezas_d' => 'imp_piezas_d',
                    ),
                'inner'); 
        $select->join(
                'material',
                "material.id_material = lote.id_material",
                array('producto'  =>  'nombre'),
                'inner'); 
        $select->join(
                'usuario',
                "usuario.id_usuario = inspeccion_contenedor.id_usuario",
                array('usuario'  =>  'nombre'),
                'inner');
        $select->join(
                'cliente',
                "cliente.id_cliente = lote.id_cliente",
                array('cliente'  =>  'organizacion'),
                'inner');
        $select->join(
                'bodega',
                "bodega.nro_bodega = lote.nro_bodega",
                array('bodega'  =>  'descripcion'),
                'inner');
        $select->join(
                'nave',
                "nave.id_nave = lote.id_nave",
                array('nave'  =>  'nombre'),
                'inner');
        
        $select->where(
                    array('inspeccion_contenedor.tipo = \'desconsolidacion\'')
                );
        if($turno != null){
            $select->where(
                    array('inspeccion_contenedor.turno = '.$turno)
                );
        }
        if($fecha != null){
            $select->where(
                    array('inspeccion_contenedor.fecha = \''.$fecha.'\'')
                );
        }
        if($contenedor != null){
            $select->where(
                    array('contenedor.codigo_contenedor = \''.$contenedor.'\'')
                );
        }
        
        $select->getSqlString(); 
        
         if ($paginated) {
             // create a new Select object for the table album
             
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Desconsolidacion());
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
 
