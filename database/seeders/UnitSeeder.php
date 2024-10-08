<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;


class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * ประเภทสินค้า.
         */

        $data = [
            'Roll', 'กรง', 'กรอบ', 'กระถาง', 'กระบอก', 'กระป๋อง', 'กระสอบ',
            'กล่อง', 'ก้อน', 'กิโลกรัม', 'แกลลอน', 'ขด', 'ขวด', 'คัน', 'คิว',
            'คู่', 'เครื่อง', 'ชิ้น', 'ชุด', 'ซอง', 'ดวง', 'ดอก',
            'ตลับ', 'ตัน', 'ตัว', 'ตู้', 'ถ้วย', 'ถัง', 'ถุง', 'ท่อ', 'ท่อน', 'แท่ง', 'แท่น', 'บาน', 'ใบ',
            'ปี๊บ', 'ผืน', 'แผง', 'แผ่น', 'แพค', 'แฟ้ม', 'ภาพ/รูป', 'มัด', 'เม็ด', 'รีม', 'เรือน',
            'ล้อ', 'ลัง', 'ลิตร', 'ลูก', 'เล่ม', 'วง', 'เส้น ', 'หลอ', 'หลัง', 'หีบ', 'โหล'
        ];

        foreach ($data as $data_unit) {
            $unit = new Unit();
            $unit->name = $data_unit;
            $unit->user_id = 1;
            $unit->save();
        }
    }
}
