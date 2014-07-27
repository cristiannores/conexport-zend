<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Paginator\Adapter\DbTableGateway;
 use Zend\Paginator\Paginator;
 
 class MaterialTable
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

     public function getMaterial($id_material)
     {
         $id_material  = (int) $id_material;
         $rowset = $this->tableGateway->select(array('id_material' => $id_material));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_material");
         }
         return $row;
     }

     public function saveMaterial($material)
     {
         $data = array(
             'nombre' => $material->nombre,
             'codigo'  => $material->codigo,
         );

         $id_material = (int) $material->id_material;
         if ($id_material == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getMaterial($id_material)) {
                 $this->tableGateway->update($data, array('id_material' => $id_material));
             } else {
                 throw new \Exception('Material id does not exist');
             }
         }
     }

     public function deleteMaterial($id_material)
     {
         $this->tableGateway->delete(array('id_material' => (int) $id_material));
     }
 }