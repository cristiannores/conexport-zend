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
use Admin\Model\Graficos; 


class GlobalController extends AbstractActionController
{
    protected $graficosTable;
    
    public function indexAction()
    {
        $bodega = $this->getGraficosTable()->bodega();
        $cliente = $this->getGraficosTable()->cliente();
        $material = $this->getGraficosTable()->material();
        $nave = $this->getGraficosTable()->nave();
        $inspector = $this->getGraficosTable()->inspectores();
        $inspeccion = $this->getGraficosTable()->inspeccion();
        
        
      return new ViewModel(array(
             'inspeccion' => $inspeccion,
            'inspector' => $inspector,
            'material' => $material,
            'nave'  => $nave,
             'bodega'  => $bodega,
             'cliente' => $cliente,
             'template' => $this->layout('layout/grafico'),
         ));
    }
    public function inspectorAction()
    {
            /*Comprobamos si la petición es por AJAX
        y si no lo es nos redirige a otra pagina*/
       
         
        $viewModel = new ViewModel();
        // Deshabilita el layout
        $viewModel->setTerminal(true);
        return $viewModel;
    }
  
    
    
    public function getGraficosTable()
     {
         if (!$this->graficosTable) {
             $sm = $this->getServiceLocator();
             $this->graficosTable = $sm->get('Admin\Model\GraficosTable');
         }
         return $this->graficosTable;
     }
}
