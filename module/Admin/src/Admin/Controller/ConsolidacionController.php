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
use Admin\Form\ConsolidacionForm;
use Admin\Model\Imagencontenedor;
use Admin\Model\Contenedor;


class ConsolidacionController extends AbstractActionController
{
    
    protected $consolidacionTable;
    protected $imagencontenedorTable;
    protected $contenedorTable;
    
    public function indexAction()
    {
        $reporte = $this->params()->fromRoute('reporte');
         $fecha_excel = $this->params()->fromRoute('fecha');
         $turno_excel = $this->params()->fromRoute('turno');
         $contenedor_excel = $this->params()->fromRoute('contenedor');
        
        
                
        $usuario = $this->getServiceLocator()->get('admin-model-usuariotable');
    
        $form = new ConsolidacionForm($usuario);
        $form->get('submit')->setValue('Buscar reporte');

         $request = $this->getRequest();
         
         if($fecha_excel == 0){
             $fecha_excel = NULL;
         }
         if($turno_excel == 0){
             $turno_excel = NULL;
         }
        if($contenedor_excel == 0){
            $contenedor_excel = NULL;
        }
         
         if ($request->isPost()) {
             
             $form->setData($request->getPost());

             if ($form->isValid()) {
                $consolida_contenedor = $form->get('consolida_contenedor')->getValue();
                $fecha = $form->get('fecha')->getValue();
                $turno = $form->get('turno')->getValue();
                
                $paginator = $this->getConsolidacionTable()->Reporte($consolida_contenedor,$fecha,$turno,true);
                $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
                $paginator->setItemCountPerPage(10);
                
                //$imagenes = $this->getImagencontenedorTable()->getImagencontenedor($paginator->id_cont);
                
                return new ViewModel(array(
                    'fecha' => $fecha,
                    'contenedor' => $consolida_contenedor,
                    'turno' => $turno,
                    'form' => $form,
                    'paginator' => $paginator,
                    'template' => $this->layout('layout/layout2'),   
                    ));
                
                    // Redirect to list of albums
                 //return $this->redirect()->toRoute('admin-reporte-consolidacion');
             
             }
         }else{
                $paginator = $this->getConsolidacionTable()->Reporte(null,null,null,true);
                $paginator->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
                $paginator->setItemCountPerPage(10);
               
                if($reporte == 'excel'){
                    
                    $this->reporteAction(
                            $this->getConsolidacionTable()->ReporteExcel($contenedor_excel,$fecha_excel,$turno_excel,true));
                    
                }
                
                
                return new ViewModel(array(
                    'form' => $form,
                    'paginator' => $paginator,
                    'template' => $this->layout('layout/layout2'),   
                    ));
         }
         
             return array(
             
             'form' => $form,
             'template' => $this->layout('layout/layout2'),
             
             );
         
             
         
    }
    public function imagenesAction()
    {
          // Mostrando imagenes.
         $reporte = $this->params()->fromRoute('reporte');
         $fecha = $this->params()->fromRoute('fecha');
         $turno = $this->params()->fromRoute('turno');
         $contenedor = $this->params()->fromRoute('contenedor');
       /* Le indicamos que será una vista sin plantilla,
               es decir, no cargará todo el contenido de la plantilla
               sino que solo cargará los datos que imprima
               */
         $imagenes = $this->getImagencontenedorTable()->buscar($contenedor);
         
         
         echo "<div class='modal-content'>
                <div class = 'modal-header'>
                <center><h4>Imagenes inspección</h4></center>
                </div>
                <div class='modal-body'>";
         echo "<div id='imagenes' class='carousel slide' data-ride='carousel'>";
         echo "<ol class='carousel-indicators'>";
         echo "<li data-target='#imagenes' data-slide-to='0' class='active'></li>
               <li data-target='#imagenes' data-slide-to='1'></li>
               <li data-target='#imagenes' data-slide-to='2'></li></ol>
               <div class='carousel-inner'>";
         $i=1;
         foreach ($imagenes as $img) :
            $filename = $img->codigo;
         
            $contents = null;
            if (file_exists($filename)) {
                           $handle = fopen($filename, "r"); // "r" - not r but b for Windows "b" - keeps giving me errors no file
                           $contents = fread($handle, filesize($filename));
                           fclose($handle);
           }    
           if($i==1){
               echo "<div class='item active'>";}
           else{
               echo "<div class='item'>";}
          echo "<img src='data:image/png;base64,".base64_encode($contents)."' width='100%'/>"
          . "</div>";
          $i++;
         endforeach;
         echo "</div><a class='left carousel-control' href='#imagenes' role='button' data-slide='prev'>
                                      <span class='glyphicon glyphicon-chevron-left'></span>
                                    </a>
                                    <a class='right carousel-control' href='#imagenes' role='button' data-slide='next'>
                                      <span class='glyphicon glyphicon-chevron-right'></span>
                                    </a>";
         echo "</div></div><div class='modal-footer'>
                <button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
                </div>
                </div>";
         
             
                $response = $this->getResponse();
                $response->setStatusCode(200);
                $response->setContent(" ");
                return $response;
     }
    
    public function reporteAction($paginator)
    {
        
       date_default_timezone_set ('America/Santiago');
       
        
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()
                ->setCreator('Conexport.cl')
                ->setLastModifiedBy('Conexport')
                ->setTitle('Reporte')
                ->setSubject('Reporte consolidacion')
                ->setDescription('Documento generado desde el sitio web')
                ->setCategory('Reportes');
        
        $objPHPExcel->getActiveSheet(0);
        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('PHPExcel logo');
        $objDrawing->setDescription('PHPExcel logo');
        $objDrawing->setPath('public/img/logo4.png'); // filesystem reference for the image file
        //$objDrawing->setHeight(40); // sets the image height to 36px (overriding the actual image height);
        $objDrawing->setCoordinates('B2'); // pins the top-left corner of the image to cell D24
        $objDrawing->setOffsetX(10); // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(0));
        
        $objPHPExcel->setActiveSheetIndex(0)
            
            ->setCellValue('B11', 'Fecha  ')
            ->setCellValue('C11', 'Exportador  ')
            ->setCellValue('D11', 'Producto  ')
            ->setCellValue('E11', 'Nave  ')
            ->setCellValue('F11', 'ID Contenedor  ')
            ->setCellValue('G11', 'Destino  ')
            ->setCellValue('H11', 'Entrega  ')
            ->setCellValue('I11', 'Lote  ')
            ->setCellValue('J11', 'Daños  ')
            ->setCellValue('K11', 'Piezas totales  ')
            ->setCellValue('L11', 'Observaciones  ');
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('C8','INFORME DE CONSOLIDADO')
                ->setCellValue('G4','Fecha')
                ->setCellValue('G5','Turno')
                ->setCellValue('G6','Inspector');
        //Estilos
        $objPHPExcel->getActiveSheet()->getStyle("C8")->getFont()
                ->setBold(true)
                ->setSize(18);
        // Combinar celdas
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C8:F8');   
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M11:O11');  
        //Fuente negrita
        $objPHPExcel->getActiveSheet()->getStyle("B11:L11")->getFont()
                ->setBold(true);
        // Obtener oja
        $sheet = $objPHPExcel->getActiveSheet();
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('A')->setWidth(2);
       // Cambiar colores
        $sheet->getStyle('A1:Z100')->getFill()->getStartColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:Z100')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        
        
        for($i="B";$i<="L";$i++){
            // REDIMENCIONAR
            $objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(true);
            // CAMBIAR COLOR Y BORDES
            
            
        }
        
        // CAMBIAR COLORES
        
                $objPHPExcel->getActiveSheet()->setTitle('Reporte');
                $objPHPExcel->setActiveSheetIndex(0);
       $sheet = 1;   
       $i = 12;
       $j = 1;
        foreach ($paginator as $m) : 
            // FILTRO 
        $objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('B11:L11');  
         
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$i, $m->fecha)
            ->setCellValue('C'.$i, $m->exportador)
            ->setCellValue('D'.$i, $m->producto)
            ->setCellValue('E'.$i, $m->nave)
            ->setCellValue('F'.$i, $m->contenedor)
            ->setCellValue('G'.$i, $m->destino)
            ->setCellValue('H'.$i, $m->entrega)
            ->setCellValue('I'.$i, $m->lote)
            ->setCellValue('J'.$i, $m->danos)
            ->setCellValue('K'.$i, $m->piezas_totales)
            ->setCellValue('L'.$i, $m->observaciones); 
        $objPHPExcel->getActiveSheet(0)->setCellValue('M'.$i,'Click para abrir imagenes');
        $objPHPExcel->getActiveSheet(0)->getCell('M'.$i)
          ->getHyperlink()
          ->setUrl("sheet://'".$m->id_cont."-".$m->contenedor."'!A".$j);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$i.':O'.$i);   
        



        // Se crea una hoja por cada cotenedor
        $objPHPExcel->createSheet()->setTitle($m->id_cont."-".$m->contenedor);
        $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($sheet);
        
        // Busqueda de imagenes
        
        $imagenes = $this->getImagencontenedorTable()->buscar($m->id_cont);
        
        // Por cada imagenes se integra la imagen en la hija de excel.
        $posicionIMG = 1;
        $contadorIMG = 1;
        foreach ($imagenes as $img) :
            $filename = $img->codigo;
            $contents = null;
            if (file_exists($filename)) {
                           $handle = fopen($filename, "r"); // "r" - not r but b for Windows "b" - keeps giving me errors no file
                           $contents = fread($handle, filesize($filename));
                           fclose($handle);
           }    
          
          //echo "<img src='data:image/png;base64,".base64_encode($contents)."' width='100%'/>"
          //. "</div>";
                
           
        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        
        $objDrawing->setName('PHPExcel logo');
        $objDrawing->setDescription('PHPExcel logo');
        $objDrawing->setPath($filename); // filesystem reference for the image file
        $objDrawing->setHeight(300); // sets the image height to 36px (overriding the actual image height);
        if($contadorIMG%2 !=0){
        $objDrawing->setCoordinates("A$posicionIMG"); 
        
        }else{
        $objDrawing->setCoordinates("H$posicionIMG");
        $posicionIMG += 16;
        }// pins the top-left corner of the image to cell D24
        $objDrawing->setOffsetX(10); // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(0));
        
        $contadorIMG++;
         endforeach;
        
        
        
        $sheet++;
        $i++;
        $j = $j + 10 ;
        
        
        
        endforeach;
        $styleArray = array(
            'borders' => array(
              'allborders' => array(
                'style' => \PHPExcel_Style_Border::BORDER_THIN,
              )
            )
          );
           $i = $i -1;
          $objPHPExcel->getActiveSheet();
          $objPHPExcel->setActiveSheetIndex(0);
          $objPHPExcel->getActiveSheet(0)->getStyle('B11:O'.$i)->applyFromArray($styleArray);
          
          unset($styleArray);  
        // IMAGEN
        
        
        // AUTO AJUSTABLE
        
        
        
        //Creando otra hoja        
        date_default_timezone_set ('America/Santiago');
        $fecha = date('Y-m-d');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Consolidacion-'.$fecha.'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter=  \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $objWriter->save('php://output');
       
        return new ViewModel(array(
             
             'template' => $this->layout('layout/layout2'),
         ));
    }
    
    
    
    
    public function getConsolidacionTable()
     {
         if (!$this->consolidacionTable) {
             $sm = $this->getServiceLocator();
             $this->consolidacionTable = $sm->get('Admin\Model\ConsolidacionTable');
         }
         return $this->consolidacionTable;
     }
     public function getContenedorTable()
     {
         if (!$this->contenedorTable) {
             $sm = $this->getServiceLocator();
             $this->contenedorTable = $sm->get('Admin\Model\ContenedorTable');
         }
         return $this->contenedorTable;
     }
     public function getImagencontenedorTable()
     {
         if (!$this->imagencontenedorTable) {
             $sm = $this->getServiceLocator();
             $this->imagencontenedorTable = $sm->get('Admin\Model\ImagencontenedorTable');
         }
         return $this->imagencontenedorTable;
     }
}
