<?php

use Model\Anexo;
use Model\Area;
use Model\Estado;
use Model\Usuario;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
    
    $anexos = Anexo::anexos_disponibles();

    foreach ($anexos as $anexo) {
        $anexo->estado_anexo = Estado::find($anexo->estado_anexo_id);
        $anexo->area = Area::find($anexo->area_id);
        $anexo->usuario = Usuario::find($anexo->creado);
    }
    $reporte = new Spreadsheet();
    $hoja = $reporte->getActiveSheet();
    //Añadir fecha al nombre del archivo
    $fecha = date('d/m/Y');
    //Añadir hora con formato : 00:00:00
    $hora = date('H-i-s');
    $nombre_archivo = 'Reporte de Anexos ' . $fecha . ' ' . $hora ;

    $hoja->setCellValue('B1', 'Reporte de Anexos Disponibles');
    $hoja->setCellValue('B3', 'ID');
    $hoja->setCellValue('C3', 'Anexo');
    $hoja->setCellValue('D3', 'Área');
    $hoja->setCellValue('E3', 'Estado');
    $hoja->setCellValue('F3', 'Creado por');
    $hoja->setCellValue('G3', 'Fecha de creación');

    $fila = 4;

    foreach ($anexos as $anexo) {
        //Fucionar celdas para dejar el titulo, centrado y en negrita
        $hoja->mergeCells('B1:G1');
        $hoja->getStyle('B1:G1')->getAlignment()->setHorizontal('center');
        $hoja->getStyle('B1:G1')->getFont()->setBold(true);

        //Darle formato a la celda ID, Anexo, Área, Estado, Creado por y Fecha de creación. Centrado y en negrita con borde
        $hoja->getStyle('B3:G3')->getAlignment()->setHorizontal('center');
        $hoja->getStyle('B3:G3')->getFont()->setBold(true);
        $hoja->getStyle('B3:G3')->getBorders()->getAllBorders()->setBorderStyle('thin');

        //Darle formato a los datos de ID, Anexo, Área, Estado, Creado por y Fecha de creación. Centrado y con borde
        $hoja->getStyle('B' . $fila . ':G' . $fila)->getAlignment()->setHorizontal('center');
        $hoja->getStyle('B' . $fila . ':G' . $fila)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        $hoja->getColumnDimension('B')->setWidth(5);
        $hoja->setCellValue('B' . $fila, $anexo->id);
        $hoja->getColumnDimension('C')->setWidth(7);
        $hoja->setCellValue('C' . $fila, $anexo->anexo);
        //Tamañano automatico
        $hoja->getColumnDimension('D')->setAutoSize(true);
        $hoja->setCellValue('D' . $fila, $anexo->area->nombre_area);
        $hoja->getColumnDimension('E')->setWidth(10);
        $hoja->setCellValue('E' . $fila, $anexo->estado_anexo->estado);
        $hoja->getColumnDimension('F')->setWidth(18);
        $hoja->setCellValue('F' . $fila, $anexo->usuario->nombre . ' ' . $anexo->usuario->apellido);
        $hoja->getColumnDimension('G')->setWidth(20);
        $hoja->setCellValue('G' . $fila, $anexo->fecha);
        $fila++;
    }

    header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Disposition: attachment; filename="' . $nombre_archivo . '.xls"');
    header("Cache-Control: max-age=0");

    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($reporte, 'Xls');

    $writer->save('php://output');

    exit;    

?>