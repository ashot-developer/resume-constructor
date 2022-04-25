<?php


if (!defined('ABSPATH')) {
    //If wordpress isn't loaded load it up.
    $path = $_SERVER['DOCUMENT_ROOT'];
    include_once $path . '/wp-load.php';
}



function form_shortcode()
{
    global $wpdb;
    $table_data = $wpdb->get_blog_prefix() . 'resume_data';
    $table_resume = $wpdb->get_blog_prefix() . 'resume';
    if (isset($_POST['ik_inv_st']) && isset($_POST['ik_co_id'])) {
        if ($_POST['ik_inv_st'] == 'success') {
            $u_code = $_POST['ik_pm_no'];
            $wpdb->query($wpdb->prepare("UPDATE $table_resume SET payment_status='1' WHERE unic_code=$u_code"));
            $form_data = $wpdb->get_results("SELECT form_data FROM $table_data WHERE unic_key=$u_code");
            $new_array = (array) json_decode($form_data['0']->form_data);
            $_POST = $_POST + $new_array;
            $pdf_url = $wpdb->get_results("SELECT file_url FROM $table_resume WHERE (unic_code=$u_code AND payment_status='1')");
            $url_pdf_adding = $pdf_url['0']->file_url;
        }
    }

    include CONSTRUCTOR_RESUME_DIR . '/includes/form-data-createing.php';
    $current_url = home_url($_SERVER['REQUEST_URI']);
    $a1 = isset($_GET["tab"]) ? "" : "active";
    $a2 = isset($_GET["tab"]) ? "active" : "";
    $a3 = $a1;
    $a4 = isset($_GET['tab']) ?  " active show" : "";
    ob_start(); ?>
    <div id="for_adding" class="custom_container">
        <div class="container mt-3">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="for_scroll">
                <li class="nav-item">
                    <a class="nav-link link_1 <?= $a1 ?>" data-toggle="tab" href="#home">Ввод данных</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link_2 <?= $a2 ?>" data-toggle="tab" href="#menu1">Просмотр</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link_3" data-toggle="tab" href="#menu2">Отправить</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="tab-pane <?= $a3 ?>"><br>
                    <div class="alert alert-success">
                        Ваши персональные данные надежно защищены!<br>
                        Данные будут использованы для составления резюме
                    </div>
                    <form name="send_data" action="<?php $co = (strlen($current_url) - 1);
                                                    if ($current_url[$co] == '/') {
                                                        echo $current_url . '?tab=#menu1';
                                                    } else {
                                                        echo $current_url . '?a&tab=#menu1';
                                                    } ?>" method="post">
                        <div class="form_basic_block">
                            <div class="box_titles">
                                <span>
                                    1. Основная информация
                                </span>
                            </div>
                            <div class="basic_info_box">
                                <div class="photo_name_block">
                                    <div class="image_block">

                                        <label for="img_imp" id="d_img_box">
                                            <span><img src="<?= CONSTRUCTOR_RESUME_URL ?>/assets/img/phone.png" alt=""></span>
                                            Прикрепить фотографию
                                            <?php if (isset($allResumeInfo['basic_info']['image']) && $allResumeInfo['basic_info']['image'] != '') : ?>
                                                <img src="<?= CONSTRUCTOR_RESUME_URL ?>/uploads/<?= $allResumeInfo['basic_info']['image'] ?>" class="prof_photo" alt="">
                                            <?php endif; ?>
                                        </label>
                                        <?php if (isset($allResumeInfo['basic_info']['image']) && $allResumeInfo['basic_info']['image'] != '') : ?>
                                            <span class="delete_img"><img src="<?= CONSTRUCTOR_RESUME_URL ?>assets/img/cancel.png"></span>
                                        <?php endif; ?>
                                        <span class="img_fake"></span>
                                        <input id="img_imp" type="file" name="image">
                                        <input type="hidden" name="new_img" id="new_img">
                                        <span id="uploaded_image"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control requ_field" placeholder="Фамилия" name="last_name" value="<?php if (isset($allResumeInfo['basic_info']['last_name']) && $allResumeInfo['basic_info']['last_name'] != '') echo $allResumeInfo['basic_info']['last_name'];
                                                                                                                                            else echo ''; ?>">
                                        <input type="text" class="form-control requ_field" placeholder="Имя" name="first_name" value="<?php if (isset($allResumeInfo['basic_info']['first_name']) && $allResumeInfo['basic_info']['first_name'] != '') echo $allResumeInfo['basic_info']['first_name'];
                                                                                                                                        else echo ''; ?>">
                                        <input type="text" class="form-control" placeholder="Отчество" name="sure_name" value="<?php if (isset($allResumeInfo['basic_info']['sure_name']) && $allResumeInfo['basic_info']['sure_name'] != '') echo $allResumeInfo['basic_info']['sure_name'];
                                                                                                                                else echo ''; ?>">
                                    </div>
                                </div>

                                <div class="info_work">
                                    <input type="text" class="form-control" placeholder="Должность" name="work_position" value="<?php if (isset($allResumeInfo['basic_info']['work_position']) && $allResumeInfo['basic_info']['work_position'] != '') echo $allResumeInfo['basic_info']['work_position'];
                                                                                                                                else echo ''; ?>">
                                    <input type="text" class="form-control desired_salary" placeholder="Желаемая зарплата" name="desired_salary" value="<?= $allResumeInfo['basic_info']['desired_salary'] != '' ? $allResumeInfo['basic_info']['desired_salary']  : '' ?>">
                                    <div class="form-group custom_form_g group_mrg">
                                        <label for="employment">Занятость</label>
                                        <select class="form-control" id="employment" name="employment">
                                            <option value="Полная" <?php if (isset($allResumeInfo['basic_info']['employment']) && $allResumeInfo['basic_info']['employment'] == 'Полная') echo 'selected'; ?>>Полная</option>
                                            <option value="Частичная" <?php if (isset($allResumeInfo['basic_info']['employment']) && $allResumeInfo['basic_info']['employment'] == 'Частичная') echo 'selected'; ?>>Частичная</option>
                                            <option <?php if (isset($allResumeInfo['basic_info']['employment']) && $allResumeInfo['basic_info']['employment'] == 'Проектная') echo 'selected'; ?> value="Проектная">Проектная</option>
                                            <option value="Стажировка" <?php if (isset($allResumeInfo['basic_info']['employment']) && $allResumeInfo['basic_info']['employment'] == 'Стажировка') echo 'selected'; ?>>Стажировка</option>
                                            <option value="Волонтёрство" <?php if (isset($allResumeInfo['basic_info']['employment']) && $allResumeInfo['basic_info']['employment'] == 'Волонтёрство') echo 'selected'; ?>>Волонтёрство</option>
                                        </select>
                                    </div>
                                    <div class="form-group custom_form_g">
                                        <label for="schedule">График работы</label>
                                        <select class="form-control" id="schedule" name="schedule">
                                            <option value="Полный день" <?php if (isset($allResumeInfo['basic_info']['schedule']) && $allResumeInfo['basic_info']['schedule'] == 'Полный день') echo 'selected'; ?>>Полный день</option>
                                            <option value="Сменный график" <?php if (isset($allResumeInfo['basic_info']['schedule']) && $allResumeInfo['basic_info']['schedule'] == 'Сменный график') echo 'selected'; ?>>Сменный график</option>
                                            <option value="Гибкий график" <?php if (isset($allResumeInfo['basic_info']['schedule']) && $allResumeInfo['basic_info']['schedule'] == 'Гибкий график') echo 'selected'; ?>>Гибкий график</option>
                                            <option value="Удаленная работа" <?php if (isset($allResumeInfo['basic_info']['schedule']) && $allResumeInfo['basic_info']['schedule'] == 'Удаленная работа') echo 'selected'; ?>>Удаленная работа</option>
                                            <option value="Вахтовый метод" <?php if (isset($allResumeInfo['basic_info']['schedule']) && $allResumeInfo['basic_info']['schedule'] == 'Вахтовый метод') echo 'selected'; ?>>Вахтовый метод</option>
                                        </select>
                                    </div>
                                    <div class="checkbox checkbox-info custom_check">
                                        <input id="check4" class="styled" type="checkbox" name="willingness" value="да" <?php if (isset($allResumeInfo['basic_info']['willingness']) && $allResumeInfo['basic_info']['willingness'] == 'да') echo 'checked'; ?>>
                                        <label for="check4">
                                            Готовность к командировкам
                                        </label>
                                    </div>
                                    <div class="phone_email_block">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Электронная почта" name="email" value="<?php if (isset($allResumeInfo['basic_info']['email']) && $allResumeInfo['basic_info']['email'] != '') echo $allResumeInfo['basic_info']['email'];
                                                                                                                                            else echo ''; ?>">
                                            <div class="flex_for_social">
                                                <input type="text" class="form-control requ_field" placeholder="Телефон" name="phone" value="<?php if (isset($allResumeInfo['basic_info']['phone']) && $allResumeInfo['basic_info']['phone'] != '') echo $allResumeInfo['basic_info']['phone'];
                                                                                                                                                else echo ''; ?>">
                                                <div class="cont_block">
                                                    <div class="checkbox checkbox-info">
                                                        <input id="Viber" class="styled" type="checkbox" value="viber" name="viber" <?php if (isset($allResumeInfo['basic_info']['viber']) && $allResumeInfo['basic_info']['viber'] == 'viber') echo 'checked'; ?>>
                                                        <label for="Viber">
                                                            Viber
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-info">
                                                        <input id="Whatsapp" class="styled" type="checkbox" value="whatsapp" name="whatsapp" <?php if (isset($allResumeInfo['basic_info']['whatsapp']) && $allResumeInfo['basic_info']['whatsapp'] == 'whatsapp') echo 'checked'; ?>>
                                                        <label for="Whatsapp">
                                                            Whatsapp
                                                        </label>
                                                    </div>
                                                    <div class="checkbox checkbox-info">
                                                        <input id="Telegram" class="styled" type="checkbox" value="telegram" name="telegram" <?php if (isset($allResumeInfo['basic_info']['telegram']) && $allResumeInfo['basic_info']['telegram'] == 'telegram') echo 'checked'; ?>>
                                                        <label for="Telegram">
                                                            Telegram
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="box_titles">
                                <span>
                                    2. Личная информация
                                </span>
                            </div>
                            <div class="basic_info_box">
                                <div class="addres_block">
                                    <input type="text" class="form-control requ_field" placeholder="Город проживания" name="country" value="<?php if (isset($allResumeInfo['personal_info']['country']) && $allResumeInfo['personal_info']['country'] != '') echo $allResumeInfo['personal_info']['country'];
                                                                                                                                            else echo ''; ?>">
                                    <div class="form-group">
                                        <label for="relocation">Переезд</label>
                                        <select class="form-control" id="relocation" name="relocation">
                                            <option value="Невозможен" <?php if (isset($allResumeInfo['personal_info']['relocation']) && $allResumeInfo['personal_info']['relocation'] == 'Невозможен') echo 'selected'; ?>>Невозможен</option>
                                            <option value="Возможен" <?php if (isset($allResumeInfo['personal_info']['relocation']) && $allResumeInfo['personal_info']['relocation'] == 'Возможен') echo 'selected'; ?>>Возможен</option>
                                            <option value="Нежелателен" <?php if (isset($allResumeInfo['personal_info']['relocation']) && $allResumeInfo['personal_info']['relocation'] == 'Нежелателен') echo 'selected'; ?>>Нежелателен</option>
                                            <option value="Желателен" <?php if (isset($allResumeInfo['personal_info']['relocation']) && $allResumeInfo['personal_info']['relocation'] == 'Желателен') echo 'selected'; ?>>Желателен</option>
                                        </select>
                                    </div>
                                    <input type="text" class="form-control requ_field" placeholder="Гражданство" name="citizenship" value="<?php if (isset($allResumeInfo['personal_info']['citizenship']) && $allResumeInfo['personal_info']['citizenship'] != '') echo $allResumeInfo['personal_info']['citizenship'];
                                                                                                                                            else echo ''; ?>">
                                </div>
                                <div class="date_form">
                                    <label for="example-date-input">Дата рождения</label>
                                    <input class="d_inp" id="example-date-input" value="<?php if (isset($allResumeInfo['personal_info']['b-date']) && $allResumeInfo['personal_info']['b-date'] != '') echo $allResumeInfo['personal_info']['b-date'];
                                                                                        else echo ''; ?>" width="270" name="b-date" />
                                    <label for="gender">Пол</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="Мужской" <?php if (isset($allResumeInfo['personal_info']['gender']) && $allResumeInfo['personal_info']['gender'] == 'Мужской') echo 'selected'; ?>>Мужской</option>
                                        <option value="Женский" <?php if (isset($allResumeInfo['personal_info']['gender']) && $allResumeInfo['personal_info']['gender'] == 'Женский') echo 'selected'; ?>>Женский</option>
                                    </select>
                                </div>

                                <div class="marital_status_block">
                                    <div class="form-group">
                                        <div class="family">
                                            <label for="marital_status">Семейное положение</label>
                                            <select class="form-control" id="marital_status" name="marital_status">
                                                <option value="<?= $allResumeInfo['personal_info']['gender'] == 'Мужской' ? 'Холост' : 'Не замужем' ?>" <?php if (isset($allResumeInfo['personal_info']['marital_status']) && ($allResumeInfo['personal_info']['marital_status'] == 'Холост' || $allResumeInfo['personal_info']['marital_status'] == 'Не замужем')) echo 'selected'; ?>> <?= $allResumeInfo['personal_info']['gender'] == 'Мужской' ? 'Холост' : 'Не замужем' ?></option>
                                                <option value="<?= $allResumeInfo['personal_info']['gender'] == 'Мужской' ? 'Женат' : 'Замужем' ?>" <?php if (isset($allResumeInfo['personal_info']['marital_status']) && ($allResumeInfo['personal_info']['marital_status'] == 'Женат' || $allResumeInfo['personal_info']['marital_status'] == 'Замужем')) echo 'selected'; ?>><?= $allResumeInfo['personal_info']['gender'] == 'Мужской' ? 'Женат' : 'Замужем' ?></option>
                                            </select>
                                        </div>
                                        <div class="child">
                                            <div class="checkbox checkbox-info">
                                                <input id="children" class="styled" type="checkbox" name="children" value="yes" <?php if (isset($allResumeInfo['personal_info']['children']) && $allResumeInfo['personal_info']['children'] == 'yes') echo 'checked'; ?>>
                                                <label for="children">
                                                    Есть дети
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form_education">
                                    <label for="education">Образование</label>
                                    <select class="form-control" id="education" name="education">
                                        <option value="Среднее" <?php if (isset($allResumeInfo['personal_info']['education']) && $allResumeInfo['personal_info']['education'] == 'Среднее') echo 'selected'; ?>>Среднее</option>
                                        <option value="Среднее неполное" <?php if (isset($allResumeInfo['personal_info']['education']) && $allResumeInfo['personal_info']['education'] == 'Среднее неполное') echo 'selected'; ?>>Среднее неполное</option>
                                        <option value="Среднее специальное" <?php if (isset($allResumeInfo['personal_info']['education']) && $allResumeInfo['personal_info']['education'] == 'Среднее специальное') echo 'selected'; ?>>Среднее специальное</option>
                                        <option value="Высшее" <?php if (isset($allResumeInfo['personal_info']['education']) && $allResumeInfo['personal_info']['education'] == 'Высшее') echo 'selected'; ?>>Высшее</option>
                                        <option value="Высшее неполное" <?php if (isset($allResumeInfo['personal_info']['education']) && $allResumeInfo['personal_info']['education'] == 'Высшее неполное') echo 'selected'; ?>>Высшее неполное</option>
                                    </select>
                                </div>
                            </div>
                            <div class="box_titles">
                                <span>
                                    3. Опыт работы
                                </span>
                                <p>Укажите ваши предыдущие места работы - большинство работодателей предпочитают опытных сотрудников</p>
                            </div>
                            <div class="work-exp_content">
                                <?php
                                $i = 1;
                                $number = rand(100, 1000000);
                                foreach ($allResumeInfo['experience'] as $exp) :
                                ?>
                                    <div class="basic_info_box work-experience">
                                        <div class="date_work">
                                            <div class="in_work">
                                                <label for="settled<?php if ($i > 1) echo $number; ?>">Устроился</label>
                                                <input class="d_inp" id="settled<?php if ($i > 1) echo $number; ?>" name="settled<?php if ($i > 1) echo $number; ?>" value="<?= $exp['settled'] != '' ? $exp['settled']  : '' ?>" />
                                            </div>
                                            <div class="out_work <?php if (isset($exp['expirience-1-now']) && $exp['expirience-1-now'] == 'настоящее время') echo 'input-group-append-dis'; ?>">
                                                <label for="quit<?php if ($i > 1) echo $number; ?>">Уволился</label>
                                                <input class="d_inp" id="quit<?php if ($i > 1) echo $number; ?>" name="quit<?php if ($i > 1) echo $number; ?>" value="<?= $exp['quit'] != '' ? $exp['quit']  : '' ?>" <?php if (isset($exp['expirience-1-now']) && $exp['expirience-1-now'] == 'настоящее время') echo 'disabled'; ?> />
                                            </div>
                                            <div class="expirience-1-now-block">
                                                <div class="checkbox checkbox-info">
                                                    <input id="expirience-1-now<?php if ($i > 1) echo $number; ?>" class="styled" type="checkbox" name="expirience-1-now<?php if ($i > 1) echo $number; ?>" <?php if (isset($exp['expirience-1-now']) && $exp['expirience-1-now'] == 'настоящее время') echo 'checked'; ?> value="настоящее время">
                                                    <label for="expirience-1-now<?php if ($i > 1) echo $number; ?>">
                                                        настоящее время
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="position_block">
                                            <div class="position_input">
                                                <input type="text" class="form-control requ_field" placeholder="Должность" name="position<?php if ($i > 1) echo $number; ?>" value="<?php if (isset($exp['position']) && $exp['position'] != '') echo $exp['position'];
                                                                                                                                                                                    else echo ''; ?>">
                                            </div>
                                            <div class="checkbox checkbox-info">
                                                <input id="full-time<?php if ($i > 1) echo $number; ?>" class="styled" type="checkbox" name="full-time<?php if ($i > 1) echo $number; ?>" value="yes" <?php if (isset($exp['full-time']) && $exp['full-time'] == 'yes') echo 'checked'; ?>>
                                                <label for="full-time<?php if ($i > 1) echo $number; ?>">
                                                    полная занятость
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group c-group">
                                            <input type="text" class="form-control requ_field" placeholder="Организация" name="organization<?php if ($i > 1) echo $number; ?>" value="<?php if (isset($exp['organization']) && $exp['organization'] != '') echo $exp['organization'];
                                                                                                                                                                                        else echo ''; ?>">
                                            <textarea class="form-control" id="exampleFormControlTextarea1<?php if ($i > 1) echo $number; ?>" name="about_org<?php if ($i > 1) echo $number; ?>" rows="3" placeholder="Должностные обязанности и достижения"><?php if (isset($exp['about_org']) && $exp['about_org'] != '') echo $exp['about_org'];
                                                                                                                                                                                                                                                            else echo ''; ?></textarea>
                                        </div>
                                        <?php if ($i > 1) echo '<p class ="delete_block">X</p>'; ?>
                                    </div>
                                <?php
                                    $i++;
                                endforeach;
                                ?>
                            </div>
                            <div class="more_button">
                                <div class="button_plus work-experience-button">
                                    +
                                </div>
                            </div>
                            <div class="box_titles">
                                <span>
                                    4. Образование
                                </span>
                                <p>Расскажите где вы получали образование - это увеличит ваши шансы на трудоустройство</p>
                            </div>
                            <div class="education-content">
                                <?php
                                $j = 1;
                                $number = rand(100, 1000000);
                                foreach ($allResumeInfo['education'] as $edu) :
                                ?>
                                    <div class="basic_info_box">
                                        <div class="form-group c-group">
                                            <input type="text" class="form-control requ_field" placeholder="Учебное заведение" name="educational-institution<?php if ($j > 1) echo $number; ?>" value="<?= $edu['educational-institution'] != '' ? $edu['educational-institution']  : '' ?>">
                                            <input type="text" class="form-control requ_field" placeholder="Факультет" name="faculty<?php if ($j > 1) echo $number; ?>" value="<?= $edu['faculty'] != '' ? $edu['faculty']  : '' ?>">
                                            <input type="text" class="form-control" placeholder="Специальность" name="specialty<?php if ($j > 1) echo $number; ?>" value="<?= $edu['specialty'] != '' ? $edu['specialty']  : '' ?>">
                                            <div class="year-of-div">
                                                <label class="year-of" for="year-of-ending<?php if ($j > 1) echo $number; ?>">Год окончания</label>
                                                <input class="d_inp" id="year-of-ending<?php if ($j > 1) echo $number; ?>" name="year-of-ending<?php if ($j > 1) echo $number; ?>" value="<?= $edu['year-of-ending'] != '' ? $edu['year-of-ending']  : '' ?>" />
                                                <label for="form-of-training<?php if ($j > 1) echo $number; ?>">Форма обучения</label>
                                                <select class="form-control" id="form-of-training<?php if ($j > 1) echo $number; ?>" name="form-of-training<?php if ($j > 1) echo $number; ?>">
                                                    <option value="Очная" <?php if (isset($edu['form-of-training']) && $edu['form-of-training'] == 'Очная') echo 'selected'; ?>>Очная</option>
                                                    <option value="Очно-заочная (вечерняя)" <?php if (isset($edu['form-of-training']) && $edu['form-of-training'] == 'Очно-заочная ( вечерняя )') echo 'selected'; ?>>Очно-заочная (вечерняя)</option>
                                                    <option value="Заочная" <?php if (isset($edu['form-of-training']) && $edu['form-of-training'] == 'Заочная') echo 'selected'; ?>>Заочная</option>
                                                    <option value="Дистанционная" <?php if (isset($edu['form-of-training']) && $edu['form-of-training'] == 'Дистанционная') echo 'selected'; ?>>Дистанционная</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php if ($j > 1) echo '<p class = "delete_block">X</p>'; ?>
                                    </div>
                                <?php
                                    $j++;
                                endforeach;
                                ?>
                            </div>
                            <div class="more_button">
                                <div class="button_plus education-content-button">
                                    +
                                </div>
                            </div>

                            <div class="box_titles">
                                <span>
                                    5. Курсы и тренинги
                                </span>
                                <p>Если вы занимались самообразованием, укажите где и что вы изучали</p>
                            </div>
                            <div class="courses-content">
                                <?php
                                $k = 1;
                                $number = rand(100, 1000000);
                                foreach ($allResumeInfo['courses_trainings'] as $course) :
                                ?>
                                    <div class="basic_info_box">
                                        <div class="form-group c-group courses_block">
                                            <input type="text" class="form-control requ_field" placeholder="Название курса" name="name-courses<?php if ($k > 1) echo $number; ?>" value="<?= $course['name-courses'] != '' ? $course['name-courses']  : '' ?>">
                                            <input type="text" class="form-control requ_field" placeholder="Учебное заведение" name="courses-educational<?php if ($k > 1) echo $number; ?>" value="<?= $course['courses-educational'] != '' ? $course['courses-educational']  : '' ?>">
                                            <div class="year-of-div">
                                                <label class="year-of" for="year-of-ending-courses<?php if ($k > 1) echo $number; ?>">Год окончания</label>
                                                <input class="d_inp" id="year-of-ending-courses<?php if ($k > 1) echo $number; ?>" name="year-of-ending-courses<?php if ($k > 1) echo $number; ?>" value="<?= $course['year-of-ending-courses'] != '' ? $course['year-of-ending-courses']  : '' ?>" />
                                                <input class="form-control d-courses" type="text" value="" placeholder="Продолжительность" name="course-duration<?php if ($k > 1) echo $number; ?>" value="<?= $course['course-duration'] != '' ? $course['course-duration']  : '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $k++;
                                endforeach;
                                ?>
                            </div>
                            <div class="more_button">
                                <div class="button_plus courses-content-button">
                                    +
                                </div>
                            </div>
                            <div class="box_titles">
                                <span>
                                    6. Иностранные языки и компьютерные навыки
                                </span>
                            </div>
                            <div class="basic_info_box">
                                <div class="form-group c-group foreign-languages">
                                    <input type="text" class="form-control" placeholder="Какие иностранные языки вы знаете?" name="foreign-languages" value="<?= $allResumeInfo['lang_computer_skills']['foreign-languages'] != '' ? $allResumeInfo['lang_computer_skills']['foreign-languages']  : '' ?>">
                                    <p class="subtitle">Владение компьютером:</p>
                                    <div class="checkbox checkbox-info">
                                        <input id="print" class="styled" type="checkbox" name="print" value="Печать, сканирование, копирование документов" <?php if (in_array('Печать, сканирование, копирование документов', $allResumeInfo['lang_computer_skills']['computer_skills'])) echo 'checked'; ?>>
                                        <label for="print">
                                            Печать, сканирование, копирование документов
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-info">
                                        <input id="internet" class="styled" type="checkbox" name="internet" value="Интернет" <?php if (in_array('Интернет', $allResumeInfo['lang_computer_skills']['computer_skills'])) echo 'checked'; ?>>
                                        <label for="internet">
                                            Интернет
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-info">
                                        <input id="scil-email" class="styled" type="checkbox" name="scil-email" value="Электронная почта" <?php if (in_array('Электронная почта', $allResumeInfo['lang_computer_skills']['computer_skills'])) echo 'checked'; ?>>
                                        <label for="scil-email">
                                            Электронная почта
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-info">
                                        <input id="word" class="styled" type="checkbox" name="word" value="Microsoft Word" <?php if (in_array('Microsoft Word', $allResumeInfo['lang_computer_skills']['computer_skills'])) echo 'checked'; ?>>
                                        <label for="word">
                                            Microsoft Word
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-info">
                                        <input id="excel" class="styled" type="checkbox" name="excel" value="Microsoft Excel" <?php if (in_array('Microsoft Excel', $allResumeInfo['lang_computer_skills']['computer_skills'])) echo 'checked'; ?>>
                                        <label for="excel">
                                            Microsoft Excel
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-info">
                                        <input id="power_point" class="styled" type="checkbox" name="power_point" value="Microsoft Power Point" <?php if (in_array('Microsoft Power Point', $allResumeInfo['lang_computer_skills']['computer_skills'])) echo 'checked'; ?>>
                                        <label for="power_point">
                                            Microsoft Power Point
                                        </label>
                                    </div>
                                    <input type="text" class="form-control anouder" placeholder="Другое" name="anouder" value="<?= $allResumeInfo['lang_computer_skills']['anouder'] != '' ? $allResumeInfo['lang_computer_skills']['anouder']  : '' ?>">
                                </div>
                            </div>
                            <div class="box_titles">
                                <span>
                                    7. Дополнительная информация
                                </span>
                            </div>
                            <div class="basic_info_box">
                                <div class="form-group c-group foreign-languages">
                                    <p class="subtitle">Водительские права (категории):</p>
                                    <div class="checkbox_content">
                                        <div class="checkbox checkbox-info">
                                            <input id="A" class="styled" type="checkbox" value="A" name="licnes1" <?php if (in_array('A', $allResumeInfo['additional_info']['drivers_license'])) echo 'checked'; ?>>
                                            <label for="A">
                                                A
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input id="B" class="styled" type="checkbox" value="B" name="licnes2" <?php if (in_array('B', $allResumeInfo['additional_info']['drivers_license'])) echo 'checked'; ?>>
                                            <label for="B">
                                                B
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input id="C" class="styled" type="checkbox" value="C" name="licnes3" <?php if (in_array('C', $allResumeInfo['additional_info']['drivers_license'])) echo 'checked'; ?>>
                                            <label for="C">
                                                C
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input id="D" class="styled" type="checkbox" value="D" name="licnes4" <?php if (in_array('D', $allResumeInfo['additional_info']['drivers_license'])) echo 'checked'; ?>>
                                            <label for="D">
                                                D
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input id="M" class="styled" type="checkbox" value="M" name="licnes5" <?php if (in_array('M', $allResumeInfo['additional_info']['drivers_license'])) echo 'checked'; ?>>
                                            <label for="M">
                                                M
                                            </label>
                                        </div>
                                        <div class="checkbox checkbox-info">
                                            <input id="TB" class="styled" type="checkbox" value="TB и TM" name="licnes6" <?php if (in_array('TB и TM', $allResumeInfo['additional_info']['drivers_license'])) echo 'checked'; ?>>
                                            <label for="TB">
                                                TB и TM
                                            </label>
                                        </div>
                                    </div>
                                    <textarea class="form-control" rows="3" placeholder="Рекомендации" name="recommendations"><?= $allResumeInfo['additional_info']['recommendations'] != '' ? $allResumeInfo['additional_info']['recommendations']  : '' ?></textarea>
                                    <textarea class="form-control" rows="3" placeholder="Ваши занятия в свободное время" name="leisure_activities"><?= $allResumeInfo['additional_info']['leisure_activities'] != '' ? $allResumeInfo['additional_info']['leisure_activities']  : '' ?></textarea>
                                    <textarea class="form-control" rows="3" placeholder="Личные качества" name="personal_qualities"><?= $allResumeInfo['additional_info']['personal_qualities'] != '' ? $allResumeInfo['additional_info']['personal_qualities']  : '' ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="resume_submin_button">
                            <button name="submit_resume">
                                Перейти к просмотру
                            </button>
                        </div>
                        <form>
                </div>
                <div id="menu1" class="tab-pane fade<?= $a4 ?>">
                    <select class="form-control" name="" id="tab_for_mob">
                        <option value="#pills-home">Классический</option>
                        <option value="#pills-profile">Современный</option>
                        <option value="#pills-contact">Прогрессивный</option>
                    </select>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Классический</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Современный</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Прогрессивный</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane custom_panel fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <?php include CONSTRUCTOR_RESUME_DIR . "templates/classic-template.php" ?>
                        </div>
                        <div class="tab-pane custom_panel fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <?php include CONSTRUCTOR_RESUME_DIR . "templates/modern-template.php" ?>
                        </div>
                        <div class="tab-pane custom_panel fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <?php include CONSTRUCTOR_RESUME_DIR . "templates/progressive-template.php" ?>
                        </div>
                    </div>
                    <div class="basic_button_box">
                        <a href="<?php echo $current_url ?>/?tab=#menu1" class="btn btn-primary btn-lg" id="go_back">Назад</a>
                        <div class="action_buttons">
                            <?php if (isset($_POST['ik_inv_st']) != 'success') :  ?>
                                <a id="download_pdf" class="btn btn-primary btn-lg <?php if ($_POST['ik_inv_st'] != 'success') echo 'disabled'; ?>" href="<?php if ($_POST['ik_inv_st'] != 'success') {
                                                                                                                                                                echo 'pdf.php';
                                                                                                                                                            } else {
                                                                                                                                                                echo $url_pdf_adding;
                                                                                                                                                            } ?>" <?php if ($_POST['ik_inv_st'] == 'success') echo 'download'; ?>>Скачать</a>
                            <?php else : ?>
                                <a class="btn btn-primary btn-lg <?php if ($_POST['ik_inv_st'] != 'success') echo 'disabled'; ?>" href="<?php if ($_POST['ik_inv_st'] != 'success') {
                                                                                                                                            echo 'pdf.php';
                                                                                                                                        } else {
                                                                                                                                            echo $url_pdf_adding;
                                                                                                                                        } ?>" <?php if ($_POST['ik_inv_st'] == 'success') echo 'download'; ?>>Скачать</a>
                            <?php endif; ?>
                            <button type="button" class="btn btn-primary btn-lg" id="send_to_mail">Отправить</button>
                        </div>

                    </div>
                    <?php if (isset($_POST['ik_inv_st']) != 'success') : ?>
                        <div class="payment_block">
                            <div class="price_for_payment">
                                <p class="price_for_payment_content">Стоимость: <span class="basic_price">199 руб</span><span class="sale_price">149 руб.</span></p>
                            </div>
                            <form action=""></form>
                            <form id="payment_form" name="payment" method="post" action="https://sci.interkassa.com/" accept-charset="UTF-8">
                                <input type="hidden" name="ik_co_id" value="5da784951ae1bd13008b4641" />
                                <input id="u_key" type="hidden" name="ik_pm_no" value="<?= $_SESSION['unic_num']; ?>" />
                                <input type="hidden" name="ik_am" value="1" />
                                <input type="hidden" name="ik_cur" value="RUB" />
                                <input type="hidden" name="ik_desc" value="Payment Description" />
                                <input type="submit" class="btn btn-primary btn-lg pay_button" value="Перейти к оплате">
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                <div id="menu2" class="tab-pane fade"><br>
                    <div class="alert alert-info">
                        <p>
                            Отправьте резюме работодателю прямо с нашего сайта
                            Мы уведомим вас о доставке и прочтении письма
                        </p>
                    </div>
                    <form action="<?= $current_url ?>" name="send_mail" method="post">
                        <div class="basic_info_box">
                            <input type="text" name="title_messige" class="form-control form-control-lg mail_input" placeholder="Заголовок письма">
                            <input type="text" name="mail_to" class="form-control form-control-lg mail_input" placeholder="Кому (адрес электронной почты работодателя)">
                            <input type="text" name="mail_feedback" class="form-control form-control-lg mail_input" placeholder="Обратный адрес для уведомлений (адрес вашей электронной почты)">
                            <?php if (isset($_POST['ik_inv_st']) && $_POST['ik_inv_st'] == 'success') : ?>
                                <input type="hidden" name="file_url" value="<?= $url_pdf_adding; ?>">
                            <?php endif ?>
                        </div>
                        <div class="basic_button_box">
                            <a href="<?php echo $current_url ?>/?tab=#menu1" class="btn btn-primary btn-lg" id="go_back2">Назад</a>
                            <button type="submit" class="btn btn-primary btn-lg" <?php if ($_POST['ik_inv_st'] != 'success') echo 'disabled'; ?>>Отправить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php $html = ob_get_clean();

    return $html;
}


add_shortcode(FORM_SHORTCODE_NAME, 'form_shortcode');
