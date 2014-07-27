<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;

 class DetalledanoTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getDetalledano($id_lote)
     {
         $id_lote  = (int) $id_lote;
         $rowset = $this->tableGateway->select(array('id_lote' => $id_lote));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_lote");
         }
         return $row;
     }
     
      
     public function saveDetalledano($detalledano)
     {
         $data = array(
             'id_lote'  => $detalledano->id_lote,
             'imp_o_zcho'  => $detalledano->imp_o_zcho,
             'imp_o_taco'  => $detalledano->imp_o_taco,
             'imp_d_zcho'  => $detalledano->imp_d_zcho,
             'imp_d_taco'  => $detalledano->imp_d_taco,
             'imp_piezas_o'  => $detalledano->imp_piezas_o,
             'imp_piezas_d'  => $detalledano->imp_piezas_d,
             'observaciones'  => $detalledano->observaciones,
         );

         $id_detalle = (int) $detalledano->id_detalle;
         if ($id_detalle == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getDetalledano($id_detalle)) {
                 $this->tableGateway->update($data, array('id_detalle' => $id_detalle));
             } else {
                 throw new \Exception('Detalledano id does not exist');
             }
         }
     }

     public function deleteDetalledano($id_detalle)
     {
         $this->tableGateway->delete(array('id_detalle' => (int) $id_detalle));
     }
 }