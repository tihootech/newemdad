<?php

function persian_to_carbon($persian_date)
{
    $array = explode('/', $persian_date);
    return (new \Morilog\Jalali\Jalalian($array[0], $array[1], $array[2]))->toCarbon();
}

function human_date($timestamp)
{
    return \Morilog\Jalali\Jalalian::forge($timestamp)->format('%d %B، %Y');
}

function date_picker_date($income)
{
    return $income ? \Morilog\Jalali\Jalalian::forge($income)->format('%Y/%m/%d') : null;
}

function user($p=null)
{
    $u = auth()->user();
    return $u ? ($p ? $u->$p : $u) : null;
}

function persian_apply_type($i)
{
    if ($i == 1) {
        return 'شغل';
    }
    if ($i == 2) {
        return 'وام';
    }
    if ($i == 3) {
        return 'بیمه خویش فرمائی و کارفرمائی';
    }
}

function is($type)
{
    $u = auth()->user();
    if ($type == 'admin') {
        return $u && ($u->type == 'expert' || $u->type == 'master');
    }
    return $u && $u->type == $type;
}

function nf($x)
{
    return number_format($x);
}

function active($path)
{
    return request()->fullUrl() == url($path);
}

function rn()
{
    return request()->route()->getName();
}

function expanded($array)
{
    // $query = str_replace(request()->url(), '',request()->fullUrl());
    $path = request()->path();
    return in_array(url($path),$array);
}

function short($string, $n=100)
{
    return $string ? (strlen($string) > $n ? mb_substr($string, 0, $n).'...' : $string) : '-';
}

function class_name($input, $prefix='App\\')
{
    return $prefix.str_replace('_', '', ucwords($input, '_'));;
}

function rs($length = 10) {
    return substr(str_shuffle(str_repeat($x='123456789ABCDEFXYZ', ceil($length/strlen($x)) )),1,$length);
}

function upload($new_file, $old_file=null)
{
    delete_file($old_file);
    if ($new_file) {
        $relarive_path = "storage/app/public";
        $file_name = random_sha(20) . '.' . $new_file->getClientOriginalExtension();
        $result = $new_file->move(base_path($relarive_path),$file_name);
        return 'storage/' . $file_name;
    }else {
        return null;
    }
}

function delete_file($file)
{
    if ($file && file_exists($file)) {
        \File::delete($file);
    }
}

function prepare_multiple($inputs)
{
    $result = [];
    foreach ($inputs as $key => $array) {
        if(is_array($array) && count($array)){
            foreach ($array as $i => $value) {
                $result[$i][$key] = $value;
            }
        }
    }
    return $result;
}

function random_rgba($opacity=null)
{
    $opacity = $opacity ?? rand(0,10)/10;
    return "rgba(".rand(1,255).", ".rand(1,255).", ".rand(1,255).", $opacity)";
}


function defaults($key=0)
{
    $arr = [
        0 => ['دارد', 'ندارد'],
        'city' => [
			'اسلام آباد غرب',
			'پاوه',
			'ثلاث باباجانی',
			'جوانرود',
			'دالاهو',
			'روانسر',
			'سرپل ذهاب',
			'سنقر',
			'صحنه',
			'قصرشیرین',
			'کرمانشاه',
			'کنگاور',
			'گیلانغرب',
			'هرسین',
		],
        'lifestyle' => [
			'شهری',
			'روستایی',
			'عشایر',
		],
        'marital_status' => [
			'متاهل',
			'مجرد',
			'فوت همسر',
			'مطلقه',
			'بدسرپرست',
		],
        'military_status' => [
			'پایان خدمت یا معافیت',
			'انجام نداده',
		],
        'gender' => [
			'زن',
			'مرد',
		],
        'education' => [
			'بیسواد',
			'ابتدایی',
			'سیکل',
			'دیپلم ناقص',
			'دیپلم',
			'فوق دیپلم',
			'لیسانس',
			'فوق لیسانس',
			'دکترا',
		],
        'warden_type' => [
			'سرپرست',
			'عضو خانوار',
		],
        'health_status' => [
			'معلول',
			'سالم',
		],
        'file_domain' => [
			'توانبخشی',
			'اجتماعی',
			'پیشگیری',
		],
        'disability_type' => [
			'جسمی حرکتی',
			'شنوایی',
			'صوت و گفتار',
            'بینایی',
            'ذهنی',
            'اعصاب و روان',
		],
        'disability_level' => [
			'خفیف',
			'متوسط',
			'شدید',
			'خیلی شدید',
		],
        'file_status_1' => [
			'زن سرپرست خانوار',
			'زن بدسرپرست',
			'زن خودسرپرست',
			'زنان و دختران در معرض آسیب',
			'کودکان کار',
			'فرزندان ترخیصی شبه خانواده',
		],
        'file_status_2' => [
			'بهبود یافته',
			'HIV',
		],
        'activity_section' => [
			'خدمات',
			'صنعت',
			'کشاورزی',
		],
        'housing_status' => [
			'استیجاری',
			'شخصی',
		],
        'insurance_status' => [
			'کارفرمایی',
			'خوداشتغالی',
		],
        'workshop_location' => [
			'شهر',
			'روستا',
		],
        'payment_amount' => [
			'دستمزد مصوب اداره کار',
			'توافقی',
		],
        'vehicle_type' => [
			'ندارم',
			'موتور',
			'سواری',
			'وانت',
			'سایر',
		],
        'meal' => [
			'ندارد',
			'صبحانه',
			'نهار ',
			'شام',
			'میان وعده',
		],
    ];
    return $arr[$key] ?? [];
}
