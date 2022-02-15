<?php
/**
 * Created by PhpStorm.
 * User: kostyanhuseyn
 * Date: 3.02.22
 * Time: 18:34
 */

namespace App\Service;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpKernel\KernelInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;

class XlsxService extends AbstractController
{
    /**
     * @var Spreadsheet
     */
    protected $spreadsheet;

    /**
     * @var
     */
    protected $data;

    /** KernelInterface $appKernel */
    private $appKernel;

    /**
     * XlsxService constructor.
     * @param Spreadsheet $spreadsheet
     * @param KernelInterface $appKernel
     */
    public function __construct(Spreadsheet $spreadsheet, KernelInterface $appKernel)
    {
       $this->spreadsheet = $spreadsheet;
       $this->appKernel = $appKernel;
    }

    /**
     * @param $data
     * @return string
     */
    public function downloadTodo($data)
    {
        //$table = $this->spreadsheet->getActiveSheet();
        $spreadsheet = new Spreadsheet();

        /** @var Worksheet $sheet */
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle("ToDo");
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', 'isActive');
        $sheet->setCellValue('C1', 'nameReminder');
        $sheet->setCellValue('D1', 'textReminder');
        $sheet->setCellValue('E1', 'createdAt');
        $sheet->setCellValue('F1', 'dateEnd');
        $sheet->setCellValue('G1', 'isDeleted');

        $count = count($data);

        for ($i=0; $i < $count; $i++ ){
            $pos = $i+2;
            $sheet->setCellValue('A'.$pos, $data[$i]['id']);
            $sheet->setCellValue('B'.$pos, $data[$i]['isActive']);
            $sheet->setCellValue('C'.$pos, $data[$i]['nameReminder']);
            $sheet->setCellValue('D'.$pos, $data[$i]['textReminder']);
            $sheet->setCellValue('E'.$pos, $data[$i]['createdAt']);
            $sheet->setCellValue('F'.$pos, $data[$i]['dateEnd']);
            $sheet->setCellValue('G'.$pos, $data[$i]['isDeleted']);
        }

        $publicDirectory = $this->appKernel->getProjectDir() . '/public/xls/todo';

        $excelFilepath =  $publicDirectory . '/todo.xls';

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xls($spreadsheet);
        $writer->save($excelFilepath);
        return $excelFilepath;
    }

    /**
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function uploadTodo(): array
    {
        $inputFileType = 'Xls';
        $inputFileName = $this->appKernel->getProjectDir() . '/public/xls/uploadTodo/todoUpload.xls';
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($inputFileName);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        return $sheet;
    }

}