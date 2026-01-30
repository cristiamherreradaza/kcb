<?php

namespace App\Http\Controllers;

use App\Ejemplar;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    // 'PDF' => Barryvdh\DomPDF\Facade::class;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ejemplarporRaza(Request $request){
        return view('reportes.ejemplaresporraza');
    }

    public function ejemplarporRazaPdf(Request $request){

        $anio = $request->input('anio');

        $ejemplares = DB::table('ejemplares')
                        ->join('razas', 'ejemplares.raza_id', '=', 'razas.id')
                        ->groupBy('ejemplares.raza_id')
                        ->orderBy('razas.nombre', 'asc')
                        ->get();

        // return view('pdf.ejemplarporRazaPdf')->with(compact('anio','ejemplares'));

        $pdf    = PDF::loadView('pdf.ejemplarporRazaPdf', compact('anio','ejemplares'))->setPaper('letter');

        return $pdf->stream('boletinInscripcion_'.date('Y-m-d H:i:s').'.pdf');

    }

    public function ejemplarporGestionExcel(Request $request){

        $anio = $request->input('anio');

        $fecha_ini = $anio.'-01-01 00:00:00';
        $fecha_fin = $anio.'-12-31 23:59:59';

        $ejemplares = Ejemplar::whereBetween('created_at', [$fecha_ini, $fecha_fin])->get();

        // dd($ejemplares);

        // generacion del excel
        $fileName = 'RerpteEjemplares.xlsx';
        $libro = new Spreadsheet();
        $hoja = $libro->getActiveSheet();

        // Ajustar ancho de columnas
        $hoja->getColumnDimension('A')->setWidth(15); // N°
        $hoja->getColumnDimension('B')->setWidth(25); // CLIENTE
        $hoja->getColumnDimension('C')->setWidth(25); // RAZON
        $hoja->getColumnDimension('D')->setWidth(15); // NIT
        $hoja->getColumnDimension('E')->setWidth(20); // FECHA
        $hoja->getColumnDimension('F')->setWidth(15); // MONTO
        $hoja->getColumnDimension('G')->setWidth(20); // SECTOR
        $hoja->getColumnDimension('H')->setWidth(20); // MODALIDAD
        $hoja->getColumnDimension('I')->setWidth(20); // ESTADO

        $hoja->setCellValue('A1', "REPORTE DE EJEMPLARES POR GESTION");
        $hoja->setCellValue('A2', "EJEMPLARES REGISTRADOS");
        $hoja->setCellValue('A3', date('d/m/Y H:i:s'));

        $hoja->setCellValue('A4', "N°");
        $hoja->setCellValue('B4', "KCB");
        $hoja->setCellValue('C4', "NOMBRE");
        $hoja->setCellValue('D4', "FECHA DE REGISTRO");
        $hoja->setCellValue('E4', "RAZA");
        $hoja->setCellValue('F4', "PROPIETARIO");
        $hoja->setCellValue('G4', "CRIADERO");
        $hoja->setCellValue('H4', "CHIP");
        $hoja->setCellValue('I4', "NUM TATUAJE");

        $encabezadoStyle =[
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        $hoja->mergeCells('A1:I1');
        $hoja->mergeCells('A2:I2');
        $hoja->mergeCells('A3:I3');

        $hoja->getStyle('A1')->applyFromArray($encabezadoStyle);
        $hoja->getStyle('A2')->applyFromArray($encabezadoStyle);
        $hoja->getStyle('A3')->applyFromArray($encabezadoStyle);

        // Aplicar márgenes y formato a los encabezados
        $encabezadoStyle = [
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFFE0B2', // Color de fondo
                ],
            ],
        ];
        $hoja->getStyle('A4:I4')->applyFromArray($encabezadoStyle);

        $contadorInicio              = 5;

        foreach ($ejemplares as $key => $ejemplar) {

            $hoja->setCellValue('A'.$contadorInicio, ($key+1));
            $hoja->setCellValue('B'.$contadorInicio, $ejemplar->kcb);
            $hoja->setCellValue('C'.$contadorInicio, $ejemplar->nombre_completo);
            $hoja->setCellValue('D'.$contadorInicio, $ejemplar->created_at);
            $hoja->setCellValue('E'.$contadorInicio, ($ejemplar->raza)? $ejemplar->raza->nombre : '');
            $hoja->setCellValue('F'.$contadorInicio, ($ejemplar->propietario)? $ejemplar->propietario->name : '');
            $hoja->setCellValue('G'.$contadorInicio, ($ejemplar->criadero)? $ejemplar->criadero->nombre : '');
            $hoja->setCellValue('H'.$contadorInicio, $ejemplar->chip);
            $hoja->setCellValue('I'.$contadorInicio, $ejemplar->num_tatuaje);

            $contadorInicio++;

        }

        $hoja->getStyle('A5:I'.($contadorInicio-1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Establecer los encabezados para forzar la descarga
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'. $fileName .'"');
        header('Cache-Control: max-age=0');

        // Guardar el archivo
        $writer = new Xlsx($libro);
        $writer->save('php://output');
        exit;
    }


}
