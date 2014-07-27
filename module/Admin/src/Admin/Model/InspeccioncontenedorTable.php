<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;

 class InspeccioncontenedorTable
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

     public function getInspeccioncontenedor($id_ic)
     {
         $id_ic  = (int) $id_ic;
         $rowset = $this->tableGateway->select(array('id_ic' => $id_ic));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_ic");
         }
         return $row;
     }
     
     public function getInspeccioncontenedorIC($id_cont)
     {
         $id_cont  = (int) $id_cont;
         $rowset = $this->tableGateway->select(array('id_cont' => $id_cont));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_cont");
         }
         return $row;
     }

     public function saveInspeccioncontenedor($inspeccioncontenedor)
     {
         $data = array(
             'id_usuario' => $inspeccioncontenedor->id_usuario,
             'rut'  => $inspeccioncontenedor->rut,
             'fecha' => $inspeccioncontenedor->fecha,
             'hora'  => $inspeccioncontenedor->hora,
             'id_cont' => $inspeccioncontenedor->id_cont,
             'turno'  => $inspeccioncontenedor->turno,
             'observaciones' => $inspeccioncontenedor->observaciones,
             'tipo'  => $inspeccioncontenedor->tipo,
             
         );

         $id_cont = (int) $inspeccioncontenedor->id_ic;
         if ($id_cont == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getInspeccioncontenedorIC($id_cont)) {
                 $this->tableGateway->update($data, array('id_ic' => $id_cont));
             } else {
                 throw new \Exception('Inspeccioncontenedor id does not exist');
             }
         }
     }
     public function saveInspeccioncontenedorIC($inspeccioncontenedor)
     {
         $data = array(
             'id_usuario' => $inspeccioncontenedor->id_usuario,
             'rut'  => $inspeccioncontenedor->rut,
             'fecha' => $inspeccioncontenedor->fecha,
             'hora'  => $inspeccioncontenedor->hora,
             'id_cont' => $inspeccioncontenedor->id_cont,
             'turno'  => $inspeccioncontenedor->turno,
             'observaciones' => $inspeccioncontenedor->observaciones,
             'tipo'  => $inspeccioncontenedor->tipo,
             
         );

         $id_cont = (int) $inspeccioncontenedor->id_cont;
         if ($id_cont == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getInspeccioncontenedorIC($id_cont)) {
                 $this->tableGateway->update($data, array('id_cont' => $id_cont));
             } else {
                 throw new \Exception('Inspeccioncontenedor id does not exist');
             }
         }
     }

     public function deleteInspeccioncontenedor($id_ic)
     {
         $this->tableGateway->delete(array('id_cont' => (int) $id_ic));
     }
 }