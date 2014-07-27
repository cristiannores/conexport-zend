<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;

 class InspeccionloteTable
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

     public function getInspeccionlote($id_il)
     {
         $id_il  = (int) $id_il;
         $rowset = $this->tableGateway->select(array('id_il' => $id_il));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_il");
         }
         return $row;
     }
     
     public function getInspeccionloteIC($id_cont)
     {
         $id_cont  = (int) $id_cont;
         $rowset = $this->tableGateway->select(array('id_cont' => $id_cont));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_cont");
         }
         return $row;
     }
     public function getInspeccionloteIL($id_lote)
     {
         $id_lote  = (int) $id_lote;
         $rowset = $this->tableGateway->select(array('id_lote' => $id_lote));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_lote");
         }
         return $row;
     }

     public function saveInspeccionlote($inspeccionlote)
     {
         $data = array(
             'id_usuario' => $inspeccionlote->id_usuario,
             'rut'  => $inspeccionlote->rut,
             'fecha' => $inspeccionlote->fecha,
             'hora'  => $inspeccionlote->hora,
             'id_lote' => $inspeccionlote->id_lote,
             'turno'  => $inspeccionlote->turno,
             'observaciones' => $inspeccionlote->observaciones,
             'tipo'  => $inspeccionlote->tipo,
             
         );

         $id_il = (int) $inspeccionlote->id_il;
         if ($id_il == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getInspeccionlote($id_il)) {
                 $this->tableGateway->update($data, array('id_il' => $id_il));
             } else {
                 throw new \Exception('Inspeccionlote id does not exist');
             }
         }
     }
     
     public function saveInspeccionloteIL($inspeccionlote)
     {
         $data = array(
             'id_usuario' => $inspeccionlote->id_usuario,
             'rut'  => $inspeccionlote->rut,
             'fecha' => $inspeccionlote->fecha,
             'hora'  => $inspeccionlote->hora,
             'id_lote' => $inspeccionlote->id_lote,
             'turno'  => $inspeccionlote->turno,
             'observaciones' => $inspeccionlote->observaciones,
             'tipo'  => $inspeccionlote->tipo,
             
         );

         $id_il = (int) $inspeccionlote->id_lote;
         if ($id_il == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getInspeccionloteIL($id_il)) {
                 $this->tableGateway->update($data, array('id_lote' => $id_il));
             } else {
                 throw new \Exception('Inspeccionlote id does not exist');
             }
         }
     }

     public function deleteInspeccionlote($id_il)
     {
         $this->tableGateway->delete(array('id_lote' => (int) $id_il));
     }
 }