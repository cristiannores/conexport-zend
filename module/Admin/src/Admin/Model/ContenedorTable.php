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
 
 
 class ContenedorTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll($paginated = false,$usuario)
     {
        date_default_timezone_set ('America/Santiago');
        
        $select = new \Zend\Db\Sql\Select ; 
        $select->from('contenedor'); 
        $select->columns(array(
            'contenedor'    => 'codigo_contenedor',
            'id_cont'       => 'id_cont',
            
            )); 
        
        $select->join('lote',
                "contenedor.id_cont = lote.id_cont",
                array(
                   
                    'lote'  =>  'numero_lote',
                    'estado'=>  'estado'),
                'inner'); 
        $select->join(
                'inspeccion_contenedor',
                "contenedor.id_cont = inspeccion_contenedor.id_cont",
                array(
                    'fecha'  =>  'hora',
                    'tipo'=>  'tipo',
                    'observaciones' => 'observaciones',
                    'turno' => 'turno',
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
                array('exportador'  =>  'organizacion'),
                'inner');
        $select->join(
                'bodega',
                "bodega.nro_bodega = lote.nro_bodega",
                array('bodega'  =>  'descripcion'),
                'inner');
        
        $select->where('fecha ='.'\''.date('Y-m-d').'\'');
        $select->where('inspeccion_contenedor.id_usuario ='.'\''.$usuario.'\'');
        
        $select->getSqlString(); 
        
        if ($paginated) {
             // create a new Select object for the table album
             
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Contenedor());
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
     
     
     public function reporteConsolidacion($contenedor, $fecha, $turno, $paginated = false)
     {
        date_default_timezone_set ('America/Santiago');
        
        $select = new \Zend\Db\Sql\Select ; 
        $select->from('contenedor'); 
        $select->columns(array(
            'contenedor'    => 'codigo_contenedor',
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
                    'fecha'  =>  'hora',
                    'tipo'=>  'tipo',
                    'observaciones' => 'observaciones',
                    'turno' => 'turno',
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
                array('exportador'  =>  'organizacion'),
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
                    array('inspeccion_contenedor.fecha = \''.$fecha.'\'')
                )->where(
                    array('inspeccion_contenedor.turno = '.$turno)
                )->where(
                    array('inspeccion_contenedor.tipo = \'consolidacion\'')
                );
        
        if($contenedor != ''){
            $select->where(
                    array('contenedor.codigo_contenedor = \''.$contenedor.'\'')
                );
        }
        
        $select->getSqlString(); 
        
         if ($paginated) {
             // create a new Select object for the table album
             
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Contenedor());
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
     
     public function reporteDesconsolidacion($inspector, $fecha, $turno, $paginated = false)
     {
        date_default_timezone_set ('America/Santiago');
        
        $select = new \Zend\Db\Sql\Select ; 
        $select->from('contenedor'); 
        $select->columns(array(
            'contenedor'    => 'codigo_contenedor',
            'id_cont'       => 'id_cont',
            
            )); 
        $select->join('lote',
                "contenedor.id_cont = lote.id_cont",
                array(
                   
                    'lote'  =>  'numero_lote',
                    'estado'=>  'estado'),
                'inner'); 
        $select->join(
                'inspeccion_contenedor',
                "contenedor.id_cont = inspeccion_contenedor.id_cont",
                array(
                    'fecha'  =>  'hora',
                    'tipo'=>  'tipo',
                    'observaciones' => 'observaciones',
                    'turno' => 'turno',
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
                array('exportador'  =>  'organizacion'),
                'inner');
        $select->join(
                'bodega',
                "bodega.nro_bodega = lote.nro_bodega",
                array('bodega'  =>  'descripcion'),
                'inner');
        
        $select->where(
                    array('inspeccion_contenedor.fecha = \''.$fecha.'\'')
                )->where(
                    array('inspeccion_contenedor.id_usuario = '.$inspector)
                )->where(
                    array('inspeccion_contenedor.turno = '.$turno)
                )->where(
                    array('inspeccion_contenedor.tipo = \'desconsolidacion\'')
                );
        
        
        $select->getSqlString(); 
        
        if ($paginated) {
             // create a new Select object for the table album
             
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Contenedor());
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

     public function getContenedor($id_cont)
     {
         $id_cont  = (int) $id_cont;
         $rowset = $this->tableGateway->select(array('id_cont' => $id_cont));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontenedorrar la columna : $id_cont");
         }
         return $row;
     }
     public function getIDContenedor()
     {
          $select = new \Zend\Db\Sql\Select ; 
            $select->from('contenedor'); 
            $select->columns(array(
            'id_cont'  => new \Zend\Db\Sql\Expression('MAX(id_cont)'),           
            
            )); 
         $rowset = $this->tableGateway->selectWith($select);
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontrar la columna :");
         }
         return $row;
     }
     public function getContenedorIC($id_cont)
     {
            $select = new \Zend\Db\Sql\Select ; 
            $select->from('contenedor'); 
            $select->columns(array(
            'codigo_contenedor'    => 'codigo_contenedor',
            'id_cont'       => 'id_cont',
            
            ));
            $select->where('id_cont ='.$id_cont);
            
         $rowset = $this->tableGateway->selectWith($select);
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontrar la columna :");
         }
         return $row;
     }
     public function contenedorPorCodigo($codigo)
     {
            $select = new \Zend\Db\Sql\Select ; 
            $select->from('contenedor'); 
            $select->columns(array(
            'codigo_contenedor'    => 'codigo_contenedor',
            'id_cont'       => 'id_cont',
            
            ));
            $select->where('codigo_contenedor = \''.$codigo.'\'');
            
         $rowset = $this->tableGateway->selectWith($select);
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontrar la columna :");
         }
         return $row;
     }
     public function saveContenedor($contenedor)
     {
         
         $data = array(
             'id_cont' => $contenedor->id_cont,
             'codigo_contenedor'  => $contenedor->codigo_contenedor,
             
         );

         $id_cont = (int) $contenedor->id_cont;
         if ($id_cont == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getContenedor($id_cont)) {
                 $this->tableGateway->update($data, array('id_cont' => $id_cont));
             } else {
                 throw new \Exception('El ID de contenedor no existe');
             }
         }
         
          
     }

     public function deleteContenedor($id_cont)
     {
         $this->tableGateway->delete(array('id_cont' => (int) $id_cont));
     }
 }
 
