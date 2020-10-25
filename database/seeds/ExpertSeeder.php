<?php

use Illuminate\Database\Seeder;
use App\Expert;
use App\User;

class ExpertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            [
                'first_name' => 'فریدون',
                'last_name' => 'رحیمی',
                'city' => 'اسلام آباد غرب',
                'national_code' => '3329755271',
            ],
            [
                'first_name' => 'سلام',
                'last_name' => 'بهرامی',
                'city' => 'پاوه',
                'national_code' => '3230926420',
            ],
            [
                'first_name' => 'علی',
                'last_name' => 'مرادی',
                'city' => 'ثلاث باباجانی',
                'national_code' => '5959934205',
            ],
            [
                'first_name' => 'شهاب',
                'last_name' => 'مرادی',
                'city' => 'جوانرود',
                'national_code' => '5959920883',
            ],
            [
                'first_name' => 'رضا',
                'last_name' => 'قاسمی',
                'city' => 'دالاهو',
                'national_code' => '4940076539',
            ],
            [
                'first_name' => 'فرشته',
                'last_name' => 'محمدی',
                'city' => 'روانسر',
                'national_code' => '3220026346',
            ],
            [
                'first_name' => 'امیر',
                'last_name' => 'شریفی',
                'city' => 'سرپل ذهاب',
                'national_code' => '3369538806',
            ],
            [
                'first_name' => 'الهام',
                'last_name' => 'قهرمانی',
                'city' => 'سنقر',
                'national_code' => '3359523342',
            ],
            [
                'first_name' => 'ستار',
                'last_name' => 'فزونی',
                'city' => 'صحنه',
                'national_code' => '3255793981',
            ],
            [
                'first_name' => 'فریبا',
                'last_name' => 'اسکندری',
                'city' => 'قصرشیرین',
                'national_code' => '3379567779',
            ],
            [
                'first_name' => 'فرحناز',
                'last_name' => 'حسینی',
                'city' => 'کرمانشاه',
                'national_code' => '3257025955',
            ],
            [
                'first_name' => 'بیتا',
                'last_name' => 'خزائی',
                'city' => 'کنگاور',
                'national_code' => '3309556141',
            ],
            [
                'first_name' => 'فرشته',
                'last_name' => 'رجب زاده',
                'city' => 'گیلانغرب',
                'national_code' => '3329221291',
            ],
            [
                'first_name' => 'فرنگیس',
                'last_name' => 'مرادی',
                'city' => 'هرسین',
                'national_code' => '3310096769',
            ],
        ];

        foreach ($arr as $data) {
            $user = User::create([
                'name' => $data['national_code'],
                'password' => bcrypt($data['national_code']),
                'type' => 'expert'
            ]);
            $data['user_id'] = $user->id;
            Expert::create($data);
        }
    }
}
