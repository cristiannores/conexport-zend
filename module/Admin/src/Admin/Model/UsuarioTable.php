<?php

/* 
 * Creado por Cristian Nores.
 * @cristiannores

 */

namespace Admin\Model;

 use Zend\Db\TableGateway\TableGateway;
 use Zend\Paginator\Adapter\DbTableGateway;
 use Zend\Paginator\Paginator;
 use Zend\Db\Sql\Expression;
 class UsuarioTable
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
     public function getInspector($tipo)
     {
         $resultSet = $this->tableGateway->select(array('tipo' => $tipo));
         return $resultSet;
     }
     
     public function InspectorGrafico()
     {
            $sqlSelect = $this->tableGateway->getSql()->select();
            $sqlSelect->columns(array('nombre' => 'nombre'));
            
            $sqlSelect->join('inspeccion_contenedor', 'inspeccion_contenedor.id_usuario = usuario.id_usuario', array(
                'id_usuario'  => new Expression('COUNT(inspeccion_contenedor.id_usuario)'),                
            ), 'left');
            $sqlSelect2 = $this->tableGateway->getSql()->select();
            $sqlSelect2->columns(array('nombre' => 'nombre'));
            
            $sqlSelect2->join('inspeccion_lote', 'inspeccion_lote.id_usuario = usuario.id_usuario', array(
                'id_usuario'  => new Expression('COUNT(inspeccion_lote.id_usuario)'),                
            ), 'left');
            $sqlSelect->combine($sqlSelect2);
            $sqlSelect2->group('usuario.nombre');
            echo $sqlSelect->getSqlString(); 
            $resultSet = $this->tableGateway->selectWith($sqlSelect);
            return $resultSet;
      }

     public function getUsuario($id_usuario)
     {
         $id_usuario  = (int) $id_usuario;
         $rowset = $this->tableGateway->select(array('id_usuario' => $id_usuario));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id_usuario");
         }
         return $row;
     }
     
     public function saveUsuario($usuario)
     {
         $supervisor_id = (int) $usuario->supervisor_id;
         $supervisor_rut = $usuario->supervisor_rut;
         
         if ($supervisor_id == '' && $supervisor_rut == ''){
             $supervisor_id  = NULL;
             $supervisor_rut = NULL;
         }
         $data = array(
             'nombre' => $usuario->nombre,
             'apellido'  => $usuario->apellido,
             'rut'  => $usuario->rut,
             'supervisor_id'  => $supervisor_id,
             'supervisor_rut'  =>  $supervisor_rut,
             'correo'  => $usuario->correo,
             'tipo'  => $usuario->tipo,
             'fono'  => $usuario->fono,
             'password'  => $usuario->password,
         );

         $id_usuario = (int) $usuario->id_usuario;
         if ($id_usuario == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getUsuario($id_usuario)) {
                 $this->tableGateway->update($data, array('id_usuario' => $id_usuario));
             } else {
                 throw new \Exception('Usuario id does not exist');
             }
         }
         
          
     }

     public function deleteUsuario($id_usuario)
     {
         $this->tableGateway->delete(array('id_usuario' => (int) $id_usuario));
     }
 }
 
