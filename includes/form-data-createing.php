<?php
global $wpdb;

$_SESSION['unic_num'] = time();

if (isset($_POST['submit_resume']) && !empty($_POST)) {
    $table = $wpdb->get_blog_prefix() . 'resume_data';
    $data = array('form_data' => json_encode($_POST), 'unic_key' => $_SESSION['unic_num']);
    $wpdb->insert($table, $data);
}


// Новый массив. 
$allResumeInfo = [
    'basic_info' => [],
    'personal_info' => [],
    'experience' => [],
    'education' => [],
    'courses_trainings' => [],
    'lang_computer_skills' => [],
    'additional_info' => []
];


// 1. Основная информация
$allResumeInfo['basic_info']['image'] = $_POST['new_img'] ?? '';
$allResumeInfo['basic_info']['last_name'] = $_POST['last_name'] ?? '';
$allResumeInfo['basic_info']['first_name'] = $_POST['first_name'] ?? '';
$allResumeInfo['basic_info']['sure_name'] = $_POST['sure_name'] ?? '';
$allResumeInfo['basic_info']['work_position'] = $_POST['work_position'] ?? '';
$allResumeInfo['basic_info']['desired_salary'] = $_POST['desired_salary'] ?? '';
$allResumeInfo['basic_info']['employment'] = $_POST['employment'] ?? '';
$allResumeInfo['basic_info']['schedule'] = $_POST['schedule'] ?? '';
$allResumeInfo['basic_info']['willingness'] = $_POST['willingness'] ?? 'нет';
$allResumeInfo['basic_info']['phone'] = $_POST['phone'] ?? '';
$allResumeInfo['basic_info']['email'] = $_POST['email'] ?? '';
$allResumeInfo['basic_info']['viber'] = $_POST['viber'] ?? '';
$allResumeInfo['basic_info']['whatsapp'] = $_POST['whatsapp'] ?? '';
$allResumeInfo['basic_info']['telegram'] = $_POST['telegram'] ?? '';


// 2. Личная информация
$allResumeInfo['personal_info']['country'] = $_POST['country'] ?? '';
$allResumeInfo['personal_info']['relocation'] = $_POST['relocation'] ?? '';
$allResumeInfo['personal_info']['citizenship'] = $_POST['citizenship'] ?? '';
$allResumeInfo['personal_info']['b-date'] = $_POST['b-date'] ?? '';
$allResumeInfo['personal_info']['gender'] = $_POST['gender'] ?? '';
$allResumeInfo['personal_info']['marital_status'] = $_POST['marital_status'] ?? '';
$allResumeInfo['personal_info']['children'] = $_POST['children'] ?? '';
$allResumeInfo['personal_info']['education'] = $_POST['education'] ?? '';

// 3. Опыт работы
$expArr = ['settled', 'quit', 'position', 'full-time', 'organization', 'about_org', 'expirience-1-now'];

foreach ($expArr as $val) {
    $allResumeInfo['experience'][0][$val] = $_POST[$val] ?? '';
    $allResumeInfo['experience1'][0][$val] = $_POST[$val] ?? '';
    $j = 1;
    foreach ($_POST as $key => $value) {
        if (preg_match('/' . $val . '[0-9]{1,9}/', $key)) {
            $allResumeInfo['experience'][$j][$val] = $value;
            $j++;
        }
    }
}



// 4. Образование
$eduArr = ['educational-institution', 'faculty', 'specialty', 'year-of-ending', 'form-of-training'];

foreach ($eduArr as $val) {
    $allResumeInfo['education'][0][$val] = $_POST[$val] ?? '';
    $j = 1;
    foreach ($_POST as $key => $value) {
        if (preg_match('/' . $val . '[0-9]{1,9}/', $key)) {
            $allResumeInfo['education'][$j][$val] = $value;
            $j++;
        }
    }
}

// 5. Курсы и тренинги
$coursesArr = ['name-courses', 'courses-educational', 'year-of-ending-courses', 'course-duration'];

foreach ($coursesArr as $val) {
    $allResumeInfo['courses_trainings'][0][$val] = $_POST[$val] ?? '';
    $j = 1;
    foreach ($_POST as $key => $value) {
        if (preg_match('/' . $val . '[0-9]{1,9}/', $key)) {
            $allResumeInfo['courses_trainings'][$j][$val] = $value;
            $j++;
        }
    }
}

// 6. Иностранные языки и компьютерные навыки
$allResumeInfo['lang_computer_skills']['foreign-languages'] = $_POST['foreign-languages'] ?? '';
$allResumeInfo['lang_computer_skills']['computer_skills'] = [$_POST['print'] ?? '', $_POST['internet'] ?? '', $_POST['scil-email'] ?? '', $_POST['word'] ?? '', $_POST['excel'] ?? '', $_POST['power_point'] ?? '', $_POST['anouder'] ?? ''];
$allResumeInfo['lang_computer_skills']['anouder'] = $_POST['anouder'] ?? '';
// 7. Дополнительная информация
$allResumeInfo['additional_info']['drivers_license'] = [$_POST['licnes1'] ?? '', $_POST['licnes2'] ?? '', $_POST['licnes3'] ?? '', $_POST['licnes4'] ?? '', $_POST['licnes5'] ?? '', $_POST['licnes6'] ?? ''];
$allResumeInfo['additional_info']['recommendations'] = $_POST['recommendations'] ?? '';
$allResumeInfo['additional_info']['leisure_activities'] = $_POST['leisure_activities'] ?? '';
$allResumeInfo['additional_info']['personal_qualities'] = $_POST['personal_qualities'] ?? '';
