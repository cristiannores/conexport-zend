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
use Admin\Model\Usuario;

class InicioController extends AbstractActionController
{
    protected $usuarioTable;
    
    public function indexAction()
    {
        
        
       
        return new ViewModel(array(
             
             'template' => $this->layout('layout/layout2'),
         ));
    }
    public function reporteAction()
    {
        $usuarios = $this->getUsuarioTable()->fetchAll();
        
       
        
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
        $objDrawing->setHeight(120); // sets the image height to 36px (overriding the actual image height);
        $objDrawing->setCoordinates('B2'); // pins the top-left corner of the image to cell D24
        $objDrawing->setOffsetX(10); // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(0));
        
        $objPHPExcel->setActiveSheetIndex(0)
            
            ->setCellValue('B11', 'ID  ')
            ->setCellValue('C11', 'Nombre  ')
            ->setCellValue('D11', 'Apellido  ')
            ->setCellValue('E11', 'Rut  ')
            ->setCellValue('F11', 'ID  ')
            ->setCellValue('G11', 'Nombre  ')
            ->setCellValue('H11', 'Apellido  ')
            ->setCellValue('I11', 'Rut  ')
            ->setCellValue('J11', 'Imagenes  ');
        $i = 12;
        $j = 1;
        
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet(0)->getColumnDimension('J')->setAutoSize(true);
        $styleArray = array(
            'borders' => array(
              'allborders' => array(
                'style' => \PHPExcel_Style_Border::BORDER_THIN,
              )
            )
          );

          $objPHPExcel->getActiveSheet()->getStyle('B11:I13')->applyFromArray($styleArray);
          unset($styleArray);  
        // CAMBIAR COLORES
        /*$sheet = $objPHPExcel->getActiveSheet();
        $sheet->getStyle('B11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('B11')->getFill()->getStartColor()->setRGB('FF0000');
        $sheet->getStyle('C11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('C11')->getFill()->getStartColor()->setRGB('FF0000');
        $sheet->getStyle('D11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('D11')->getFill()->getStartColor()->setRGB('FF0000');
        $sheet->getStyle('E11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('E11')->getFill()->getStartColor()->setRGB('FF0000');
        $sheet->getStyle('F11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('F11')->getFill()->getStartColor()->setRGB('FF0000');
        $sheet->getStyle('G11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('G11')->getFill()->getStartColor()->setRGB('FF0000');
        $sheet->getStyle('H11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('H11')->getFill()->getStartColor()->setRGB('FF0000');
        $sheet->getStyle('I11')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $sheet->getStyle('I11')->getFill()->getStartColor()->setRGB('FF0000');*/
                $objPHPExcel->getActiveSheet()->setTitle('Reporte');
                $objPHPExcel->setActiveSheetIndex(0);
        $sheet = 1;       
        foreach ($usuarios as $m) : 
            // FILTRO 
        $objPHPExcel->setActiveSheetIndex(0)->setAutoFilter('B11:I11');  
        
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$i, $m->id_usuario)
            ->setCellValue('C'.$i, $m->nombre)
            ->setCellValue('D'.$i, $m->apellido)
            ->setCellValue('E'.$i, $m->rut)
            ->setCellValue('F'.$i, $m->id_usuario)
            ->setCellValue('G'.$i, $m->nombre)
            ->setCellValue('H'.$i, $m->apellido)
            ->setCellValue('I'.$i, $m->rut); 
        $objPHPExcel->getActiveSheet(0)->setCellValue('J'.$i,'Click para abrir imagenes');
        $objPHPExcel->getActiveSheet(0)->getCell('J'.$i)
          ->getHyperlink()
          ->setUrl("sheet://'".$m->apellido."'!A".$j);
        
        // IMAGEN
        $objPHPExcel->createSheet()->setTitle($m->apellido);
        $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex($sheet);
        
        $objDrawing = new \PHPExcel_Worksheet_Drawing();
        
        $objDrawing->setName('PHPExcel logo');
        $objDrawing->setDescription('PHPExcel logo');
        $objDrawing->setPath('public/img/logo3.png'); // filesystem reference for the image file
        $objDrawing->setHeight(100); // sets the image height to 36px (overriding the actual image height);
        $objDrawing->setCoordinates('A1'); // pins the top-left corner of the image to cell D24
        $objDrawing->setOffsetX(10); // pins the top left corner of the image at an offset of 10 points horizontally to the right of the top-left corner of the cell
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet(0));
        
        $sheet++;
        $i++;
        $j = $j + 10 ;
        endforeach;
        // IMAGEN
        
        
        // AUTO AJUSTABLE
        
        
        
        //Creando otra hoja        
       
                
      
        
       
               
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="01simple.xls"');
        header('Cache-Control: max-age=0');
        $objWriter=  \PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $objWriter->save('php://output');
       
        return new ViewModel(array(
             
             'template' => $this->layout('layout/layout2'),
         ));
    }
    
    
    public function getUsuarioTable()
     {
         if (!$this->usuarioTable) {
             $sm = $this->getServiceLocator();
             $this->usuarioTable = $sm->get('Admin\Model\UsuarioTable');
         }
         return $this->usuarioTable;
     }
}
