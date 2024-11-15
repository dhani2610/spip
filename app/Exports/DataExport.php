<?php

namespace App\Exports;

use App\Models\Form;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment; // Pastikan ini diimpor
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DataExport implements FromView ,WithEvents 
{
    protected $monitoring;

    // Konstruktor untuk menerima data
    public function __construct($monitoring)
    {
        $this->monitoring = $monitoring;
    }

    public function view(): View
    {
        // Kirim data yang diterima ke view
        return view('backend.pages.monitoring.tablehtml', [
            'monitoring' => $this->monitoring
        ]);
    }

    public function registerEvents(): array
    {

        $data = '';

        $verti_center = array(
            'alignment' => array(
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            )
        );
        
        return [
            AfterSheet::class    => function (AfterSheet $event) use ($data, $verti_center) {
                $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K']; // All headers

                for ($x = 'A'; $x <= 'ZZ'; $x++) {

                    if (in_array($x, ['A'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(5);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    if (in_array($x, ['B','C','D','E','F','G','H'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(20);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    if (in_array($x, ['I','J','K','L'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(10);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    if (in_array($x, ['M'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(20);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    
                    if (in_array($x, ['N'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(25);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    if (in_array($x, ['O'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(10);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    if (in_array($x, ['P','Q','R','S','T','Y','Z'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(30);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    if (in_array($x, ['U','V','W','X'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(10);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    
                    if (in_array($x, ['AA','AB'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(30);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    
                    if (in_array($x, ['AC'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(20);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    if (in_array($x, ['AD'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(10);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    
                    if (in_array($x, ['AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'])) {
                        $event->sheet->getDelegate()->getColumnDimension($x)->setWidth(30);
                        $event->sheet->getDelegate()->getStyle($x)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    }
                    

                }

            },
        ];
    }


    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function (AfterSheet $event) {
    //             $sheet = $event->sheet->getDelegate();
                
    //             // Dapatkan seluruh kolom yang digunakan
    //             $highestColumn = $sheet->getHighestColumn(); // Mengambil kolom terakhir
    //             $highestRow = $sheet->getHighestRow(); // Mengambil baris terakhir

    //             // Setel lebar kolom dan pembungkusan teks dengan perataan tengah
    //             foreach (range('A', $highestColumn) as $column) {
    //                 // Setel lebar kolom
    //                 $sheet->getColumnDimension($column)->setWidth(20);

    //                 $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
    //                 $event->sheet->getDelegate()->getStyle($column)->getAlignment()->setWrapText(true); // Set wrap text for column G
                    
    //                 // // Terapkan gaya ke seluruh baris pada kolom tersebut, mulai dari baris 1 hingga baris terakhir
    //                 // $sheet->getStyle($column . '2:' . $column . $highestRow)
    //                 //     ->getAlignment()
    //                 //     ->setWrapText(true) // Aktifkan pembungkusan teks
    //                 //     ->setHorizontal(Alignment::HORIZONTAL_CENTER) // Set perataan horizontal ke tengah
    //                 //     ->setVertical(Alignment::VERTICAL_CENTER); // Set perataan vertikal ke tengah

    //                 // $sheet->getStyle($column . '3:' . $column . $highestRow)
    //                 //     ->getAlignment()
    //                 //     ->setWrapText(true) // Aktifkan pembungkusan teks
    //                 //     ->setHorizontal(Alignment::HORIZONTAL_CENTER) // Set perataan horizontal ke tengah
    //                 //     ->setVertical(Alignment::VERTICAL_CENTER); // Set perataan vertikal ke tengah

    //                 // $sheet->getStyle($column . '4:' . $column . $highestRow)
    //                 //     ->getAlignment()
    //                 //     ->setWrapText(true) // Aktifkan pembungkusan teks
    //                 //     ->setHorizontal(Alignment::HORIZONTAL_CENTER) // Set perataan horizontal ke tengah
    //                 //     ->setVertical(Alignment::VERTICAL_CENTER); // Set perataan vertikal ke tengah

    //                 // $sheet->getStyle($column . '5:' . $column . $highestRow)
    //                 //     ->getAlignment()
    //                 //     ->setWrapText(true) // Aktifkan pembungkusan teks
    //                 //     ->setHorizontal(Alignment::HORIZONTAL_CENTER) // Set perataan horizontal ke tengah
    //                 //     ->setVertical(Alignment::VERTICAL_CENTER); // Set perataan vertikal ke tengah

    //                 // $sheet->getStyle($column . '6:' . $column . $highestRow)
    //                 //     ->getAlignment()
    //                 //     ->setWrapText(true) // Aktifkan pembungkusan teks
    //                 //     ->setHorizontal(Alignment::HORIZONTAL_CENTER) // Set perataan horizontal ke tengah
    //                 //     ->setVertical(Alignment::VERTICAL_CENTER); // Set perataan vertikal ke tengah

    //                 // $sheet->getStyle($column . '7:' . $column . $highestRow)
    //                 //     ->getAlignment()
    //                 //     ->setWrapText(true) // Aktifkan pembungkusan teks
    //                 //     ->setHorizontal(Alignment::HORIZONTAL_CENTER) // Set perataan horizontal ke tengah
    //                 //     ->setVertical(Alignment::VERTICAL_CENTER); // Set perataan vertikal ke tengah
    //             }
    //         },
    //     ];
    // }

    // public function registerEvents(): array
    // {
    //     $cellRange = 'A1:AZ1'; // All headers
    //     return [
    //         AfterSheet::class    => function(AfterSheet $event) {
    //             $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setWrapText(true);
    //         },
    //     ];
    // }
}
