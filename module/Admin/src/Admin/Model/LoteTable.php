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

 class LoteTable
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
        $select->from('lote'); 
        $select->columns(array(
            'id_lote'           =>  'id_lote',
            'numero_entrega'    =>  'numero_entrega',
            'destino'           =>  'destino',
            'codigo_sap'        =>  'codigo_sap',
            'numero_lote'       =>  'numero_lote',
            'caracteristicas'   =>  'caracteristicas',
            'pieza_danada'      =>  'pieza_danada',
            'pieza_paquete'     =>  'pieza_paquete',
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
       
        
        $select->where('fecha ='.'\''.date('Y-m-d').'\'');
        $select->where('inspeccion_lote.id_usuario ='.'\''.$usuario.'\'');
        
        $select->getSqlString(); 
        if ($paginated) {
             // create a new Select object for the table album
             
             // create a new result set based on the Album entity
             $resultSetPrototype = new ResultSet();
             $resultSetPrototype->setArrayObjectPrototype(new Lote());
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
     
     public function reporteDamage($inspector, $fecha, $turno, $paginated = false)
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
            'pieza_danada'      =>  'pieza_danada',
            'pieza_paquete'     =>  'pieza_paquete',
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
                    array('inspeccion_lote.fecha = \''.$fecha.'\'')
                )->where(
                    array('inspeccion_lote.id_usuario = '.$inspector)
                )->where(
                    array('inspeccion_lote.turno = '.$turno)
                )->where(
                    array('inspeccion_lote.tipo = \'daños\'')
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
     
     public function reporteDiferencias($inspector, $fecha, $turno, $paginated = false)
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
            'pieza_danada'      =>  'pieza_danada',
            'pieza_paquete'     =>  'pieza_paquete',
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
                    array('inspeccion_lote.fecha = \''.$fecha.'\'')
                )->where(
                    array('inspeccion_lote.id_usuario = '.$inspector)
                )->where(
                    array('inspeccion_lote.turno = '.$turno)
                )->where(
                    array('inspeccion_lote.tipo = \'diferencias\'')
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
     
     
     

     public function getLote($id_lote)
     {
         $id_lote  = (int) $id_lote;
         $rowset = $this->tableGateway->select(array('id_lote' => $id_lote));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontrar la columna : $id_lote");
         }
         return $row;
     }
     
     public function getLoteIC($id_cont)
     {
            $select = new \Zend\Db\Sql\Select ; 
            $select->from('lote'); 
            $select->columns(array(
                'id_lote' => 'id_lote',
            'id_cliente'           =>  'id_cliente',
            'producto'    =>  'id_material',
            'numero_lote'           =>  'numero_lote',
            'caracteristicas'        =>  'caracteristicas',
            'pieza_danada'       =>  'pieza_danada',
            'pieza_paquete'   =>  'pieza_paquete',
            'destino'      =>  'destino',
            'nro_bodega'     =>  'nro_bodega',
            'nave'            =>  'id_nave',
            'numero_entrega' => 'numero_entrega',
            
            )); 
            $select->where('id_cont ='.$id_cont);
            
         $rowset = $this->tableGateway->selectWith($select);
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontrar la columna :");
         }
         return $row;
     }
     public function getLoteIL($id_lote)
     {
            $select = new \Zend\Db\Sql\Select ; 
            $select->from('lote'); 
            $select->columns(array(
            'id_cliente'           =>  'id_cliente',
            'producto'    =>  'id_material',
            'numero_lote'           =>  'numero_lote',
            'caracteristicas'        =>  'caracteristicas',
            'pieza_danada'       =>  'pieza_danada',
            'pieza_paquete'   =>  'pieza_paquete',
            'destino'      =>  'destino',
            'nro_bodega'     =>  'nro_bodega',
            'nave'            =>  'id_nave',
            'numero_entrega' => 'numero_entrega',
                'id_lote'   => 'id_lote',
                'estado'  => 'estado',
                'codigo_sap' => 'codigo_sap'
            
            )); 
            $select->where('id_lote ='.$id_lote);
            
         $rowset = $this->tableGateway->selectWith($select);
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontrar la columna :");
         }
         return $row;
     }
     
     public function getIDLote()
     {
            $select = new \Zend\Db\Sql\Select ; 
            $select->from('lote'); 
            $select->columns(array(
            'id_lote'  => new \Zend\Db\Sql\Expression('MAX(id_lote)'),           
            
            )); 
         $rowset = $this->tableGateway->selectWith($select);
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("No se puede encontrar la columna :");
         }
         return $row;
     }
     public function saveLote($lote)
     {
         
         $data = array(
             'id_cliente' => $lote->id_cliente,
             'rut_cliente'  => $lote->rut_cliente,
             'id_material'  => $lote->producto,
             'id_cont'  => $lote->id_cont,
             'numero_entrega'  => $lote->numero_entrega,
             'destino'  => $lote->destino,
             'codigo_sap'  => $lote->codigo_sap,
             'numero_lote'  => $lote->numero_lote,
             'caracteristicas'  => $lote->observaciones,
             'pieza_danada'  => $lote->pieza_danada,
             'pieza_paquete'  => $lote->pieza_paquete,
             'estado'  => $lote->estado,
             'nro_bodega'  => $lote->nro_bodega,
             'id_nave'  => $lote->nave,
         );

         $id_lote = (int) $lote->id_lote;
         if ($id_lote == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getLote($id_lote)) {
                 $this->tableGateway->update($data, array('id_lote' => $id_lote));
             } else {
                 throw new \Exception('El ID de lote no existe');
             }
         }
         
          
     }
     
     public function saveLoteIC($lote)
     {
         
         $data = array(
             'id_cliente' => $lote->id_cliente,
             'rut_cliente'  => $lote->rut_cliente,
             'id_material'  => $lote->producto,
             'id_cont'  => $lote->id_cont,
             'numero_entrega'  => $lote->numero_entrega,
             'destino'  => $lote->destino,
             'codigo_sap'  => $lote->codigo_sap,
             'numero_lote'  => $lote->numero_lote,
             'caracteristicas'  => $lote->caracteristicas,
             'pieza_danada'  => $lote->pieza_danada,
             'pieza_paquete'  => $lote->pieza_paquete,
             'estado'  => $lote->estado,
             'nro_bodega'  => $lote->nro_bodega,
             'id_nave'  => $lote->nave,
         );

         $id_cont = (int) $lote->id_cont;
         if ($id_cont == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getLoteIC($id_cont)) {
                 $this->tableGateway->update($data, array('id_cont' => $id_cont));
             } else {
                 throw new \Exception('El ID de lote no existe');
             }
         }
         
          
     }

     public function deleteLote($id_lote)
     {
         $this->tableGateway->delete(array('id_lote' => (int) $id_lote));
     }
     public function deleteLoteIC($id_lote)
     {
         $this->tableGateway->delete(array('id_cont' => (int) $id_lote));
     }
     
 }
 
