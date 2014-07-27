<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use PHPExcel;
class AdministradorController extends AbstractActionController
{
    public function indexAction()
    {
        
        
        
        echo "<center><h1>HOLA MUNDO</h1></center>";
      return new ViewModel(array(
             
             'template' => $this->layout('layout/layout2'),
         ));
    }
    public function agregarAction()
    {
        
        
      
    }
    
    public function editarAction()
    {
      
    }
    
    public function borrarAction()
    {
      
    }
}
