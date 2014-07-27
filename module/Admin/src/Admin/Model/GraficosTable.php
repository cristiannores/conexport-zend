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
 use Zend\Db\Sql\Sql;
 
 class GraficosTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }
     
     public function inspectores()
     {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter); 
        
        $select2 = $sql->select();
        $select2->from('inspeccion_contenedor');
        $select3 = $sql->select();
        $select3->from('inspeccion_lote');
        
        $select2->combine($select3);
        
        $select = $sql->select();
        $select->from(array('inspecciones' => $select2)); 
        $select->join('usuario',
                "usuario.id_usuario= inspecciones.id_usuario",
                array(                 
                    'inspector'  =>  'nombre',
                    'cantidad'  =>  new \Zend\Db\Sql\Expression('COUNT(usuario.id_usuario)'),
                     ),
                'inner'); 
       $select->group('usuario.id_usuario');
        
        $select->getSqlString(); 
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        
        return $results;
         
     }
     
     public function inspeccion()
     {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter); 
        
        $select2 = $sql->select();
        $select2->from('inspeccion_contenedor');
        $select3 = $sql->select();
        $select3->from('inspeccion_lote');
        
        $select2->combine($select3);
        
        $select = $sql->select();
        $select->from(array('inspecciones' => $select2)); 
        $select->join('usuario',
                "usuario.id_usuario= inspecciones.id_usuario",
                array(                 
                    'inspeccion'  =>  'inspecciones.tipo',
                    'cantidad'  =>  new \Zend\Db\Sql\Expression('COUNT(inspecciones.tipo)'),
                     ),
                'inner'); 
       $select->group('inspecciones.tipo');
        
        $select->getSqlString(); 
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        
        return $results;
         
     }

     
     public function cliente()
     {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter); 
        $select = $sql->select();
        $select->from('lote'); 
        $select->columns(array('cantidad' => new \Zend\Db\Sql\Expression('COUNT(lote.id_cliente)')));
        $select->join('cliente',
                "cliente.id_cliente= lote.id_cliente",
                array(                 
                    'cliente'  =>  'organizacion',
                     ),
                'inner'); 
       $select->group('cliente.id_cliente');
        
        $select->getSqlString(); 
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        
        return $results;
         
     }
     
     public function bodega()
     {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter); 
        $select = $sql->select();
        $select->from('lote'); 
        $select->columns(array('cantidad' => new \Zend\Db\Sql\Expression('COUNT(lote.nro_bodega)')));
        $select->join('bodega',
                "bodega.nro_bodega= lote.nro_bodega",
                array(                 
                    'bodega'  =>  'descripcion',
                     ),
                'inner'); 
       $select->group('bodega.nro_bodega');
        
        $select->getSqlString(); 
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        
        return $results;
         
     }
     
     public function material()
     {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter); 
        $select = $sql->select();
        $select->from('lote'); 
        $select->columns(array('cantidad' => new \Zend\Db\Sql\Expression('COUNT(lote.id_material)')));
        $select->join('material',
                "material.id_material= lote.id_material",
                array(                 
                    'material'  =>  'nombre',
                     ),
                'inner'); 
       $select->group('material.id_material');
        
        $select->getSqlString(); 
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        
        return $results;
         
     }
     
     public function nave()
     {
        $adapter = $this->tableGateway->getAdapter();
        $sql = new Sql($adapter); 
        $select = $sql->select();
        $select->from('lote'); 
        $select->columns(array('cantidad' => new \Zend\Db\Sql\Expression('COUNT(lote.id_nave)')));
        $select->join('nave',
                "nave.id_nave= lote.id_nave",
                array(                 
                    'nave'  =>  'nombre',
                     ),
                'inner'); 
       $select->group('nave.id_nave');
        
        $select->getSqlString(); 
        
        $selectString = $sql->getSqlStringForSqlObject($select);
        $results = $adapter->query($selectString, $adapter::QUERY_MODE_EXECUTE);
        
        return $results;
         
     }

 }
 
