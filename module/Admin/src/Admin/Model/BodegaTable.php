<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Paginator\Adapter\DbTableGateway;
 use Zend\Paginator\Paginator;
 
 class BodegaTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll($paginated = false)
     {
         if($paginated){
             $dbTableGatewayAdapter  = new DbTableGateway($this->tableGateway);
             $paginator = new Paginator($dbTableGatewayAdapter);
             
             return $paginator;
         }
         
         $resultSet = $this->tableGateway->select();
         
         
         return $resultSet;
     }

     public function getBodega($id_bodega)
     {
         $id_bodega  = (int) $id_bodega;
         $rowset = $this->tableGateway->select(array('nro_bodega' => $id_bodega));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_bodega");
         }
         return $row;
     }

     public function saveBodega($bodega)
     {
              
         $data = array(
             'nro_bodega'             => $bodega->nro_bodega,
             'descripcion'             => $bodega->descripcion,
             
             
            
         );

         if ($id_bodega != 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getBodega($id_bodega)) {
                 $this->tableGateway->update($data, array('nro_bodega' => $id_bodega));
             } else {
                 throw new \Exception('Bodega no existe');
             }
         }
     }

     public function deleteBodega($nro_bodega)
     {
         $this->tableGateway->delete(array('nro_bodega' => (int) $nro_bodega));
     }
 }
 