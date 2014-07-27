<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Paginator\Adapter\DbTableGateway;
 use Zend\Paginator\Paginator;
 use Zend\Db\Sql\Select;
 use Zend\Db\Sql\Sql;
 
 class ImagencontenedorTable
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

     public function getImagencontenedor($id_cont)
     {
         $id_cont  = (int) $id_cont;
         $rowset = $this->tableGateway->select(array('id_cont' => $id_cont));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_cont");
         }
         return $row;
     }
     
     public function buscar($id_cont){
         $resultSet = $this->tableGateway->select(array(
             'id_cont' => $id_cont,
         ));
         return $resultSet;
        
     }

     public function saveImagencontenedor($imagencontenedor)
     {
         $data = array(
             'id_cont' => $imagencontenedor->id_cont,
             'codigo'  => $imagencontenedor->codigo,
         );

         $id_img_c = (int) $imagencontenedor->id_img_c;
         if ($id_img_c == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getImagencontenedor($id_img_c)) {
                 $this->tableGateway->update($data, array('id_img_c' => $id_img_c));
             } else {
                 throw new \Exception('Imagencontenedor id does not exist');
             }
         }
     }

     public function deleteImagencontenedor($id_cont)
     {
         $this->tableGateway->delete(array('id_cont' => (int) $id_cont));
     }
 }