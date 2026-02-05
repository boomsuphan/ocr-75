<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BookingsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithEvents
{
    protected $bookings;
    protected $title; // เก็บหัวข้อรายงาน
    private $rowNumber = 0;

    // รับค่า bookings และ title เข้ามา
    public function __construct($bookings, $title) {
        $this->bookings = $bookings;
        $this->title = $title;
    }

    public function collection() {
        return $this->bookings;
    }

    // กำหนดบรรทัดหัวตาราง (3 บรรทัดแรก)
    public function headings(): array {
        return [
            [$this->title], // แถวที่ 1: ชื่อรายงาน (เดี๋ยวจะสั่ง Merge)
            [''],           // แถวที่ 2: เว้นว่าง
            [               // แถวที่ 3: หัวตารางจริง
                'No.', 
                'วันที่', 
                'ห้อง', 
                'เวลาเริ่ม', 
                'เวลาสิ้นสุด', 
                'วิชา', 
                'ชื่อผู้จอง', 
                'อาจารย์ผู้สอน', 
                'รายละเอียด', 
                'สถานะ'
            ]
        ];
    }

    public function map($booking): array {
        return [
            ++$this->rowNumber,
            date('d/m/', strtotime($booking->date_booking)) . (date('Y', strtotime($booking->date_booking)) + 543),
            $booking->room->name ?? '-',
            substr($booking->time_start_booking, 0, 5),
            substr($booking->time_end_booking, 0, 5),
            $booking->subject,
            $booking->user->fullname ?? '-',
            $booking->name_professor,
            $booking->note ?? '-',
            $booking->status,
        ];
    }

    public function styles(Worksheet $sheet) {
        return [
            // แถวที่ 1 (ชื่อรายงาน) ตัวใหญ่ หนา
            1 => ['font' => ['bold' => true, 'size' => 16]],
            // แถวที่ 3 (หัวตาราง) ตัวหนา
            3 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }

    public function registerEvents(): array {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $sheet->getHighestRow();
                $lastColumn = $sheet->getHighestColumn(); // น่าจะเป็น 'J'

                // 1. ผสานเซลล์แถวที่ 1 (Title) ตั้งแต่ A1 ถึง J1
                $sheet->mergeCells('A1:' . $lastColumn . '1');

                // 2. จัดกึ่งกลางทั้งหน้า
                $sheet->getStyle('A1:' . $lastColumn . $lastRow)
                      ->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                
                // จัดกึ่งกลางแนวนอนเฉพาะส่วนหัว (แถว 1 และ 3)
                $sheet->getStyle('A1:' . $lastColumn . '3')
                      ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // 3. ตีเส้นตาราง (เริ่มตีตั้งแต่แถวที่ 3 ลงไป ถึงแถวสุดท้าย)
                $sheet->getStyle('A3:' . $lastColumn . $lastRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                        ],
                    ],
                ]);
            },
        ];
    }
}