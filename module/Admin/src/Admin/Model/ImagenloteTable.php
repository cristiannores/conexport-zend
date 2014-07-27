<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Paginator\Adapter\DbTableGateway;
 use Zend\Paginator\Paginator;
 
 class ImagenloteTable
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
     
     public function buscar($id_lote){
         $resultSet = $this->tableGateway->select(array(
             'id_lote' => $id_lote,
         ));
         return $resultSet;
        
     }
     
     public function getImagenlote($id_img_l)
     {
         $id_img_l  = (int) $id_img_l;
         $rowset = $this->tableGateway->select(array('id_img_l' => $id_img_l));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_img_l");
         }
         return $row;
     }

     public function saveImagenlote($imagenlote)
     {
         $data = array(
             'id_lote' => $imagenlote->id_lote,
             'codigo'  => $imagenlote->codigo,
         );

         $id_img_l = (int) $imagenlote->id_img_l;
         if ($id_img_l == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getImagenlote($id_img_l)) {
                 $this->tableGateway->update($data, array('id_img_l' => $id_img_l));
             } else {
                 throw new \Exception('Imagenlote id does not exist');
             }
         }
     }

     public function deleteImagenlote($id)
     {
         $this->tableGateway->delete(array('id_lote' => (int) $id));
     }
 }