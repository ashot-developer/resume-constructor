<div class="for_dompdf resume_block">
    <div class="modern_img_name progressive_img_name">
        <div class="modern_resume_img progressive_resume_img" style="border-radius: 5px">
            <?php if (isset($allResumeInfo['basic_info']['image']) && $allResumeInfo['basic_info']['image'] != '') : ?>
                <img style="width: 120px; height: 120px;" src="/wp-content/plugins/constructor-resume/uploads/<?= $allResumeInfo['basic_info']['image'] ?>" alt="" style="width: 100%; max-height: none">
            <?php else : ?>
                <img src="/wp-content/plugins/constructor-resume/assets/img/no_photo.png" alt="">
            <?php endif ?>
        </div>
        <div class="user_name">
            <?php if (isset($allResumeInfo['basic_info']['last_name']) && $allResumeInfo['basic_info']['last_name'] != '') echo $allResumeInfo['basic_info']['last_name'];
            else  echo  'Фамилия'; ?>
            <?php if (isset($allResumeInfo['basic_info']['first_name']) && $allResumeInfo['basic_info']['first_name'] != '') echo $allResumeInfo['basic_info']['first_name'];
            else  echo  'Имя'; ?>
            <?php if (isset($allResumeInfo['basic_info']['sure_name']) && $allResumeInfo['basic_info']['sure_name'] != '') echo $allResumeInfo['basic_info']['sure_name'];
            else  echo  'Отчество'; ?>
            <p class="usr_location"><img src="/wp-content/plugins/constructor-resume/assets/img/location.png" alt=""><?= $allResumeInfo['personal_info']['country'] != '' ? $allResumeInfo['personal_info']['country']  : 'Не указано' ?></p>
        </div>
    </div>
    <div class="clr"></div>
    <div class="l">
        <div class="personal_info_resume">
            <span class="resume_blocks_title modern_personail_title"><img src="/wp-content/plugins/constructor-resume/assets/img/user.png" alt=""> Личная информация </span>
            <ul>
                <li><span>Гражданство:</span><?= $allResumeInfo['personal_info']['citizenship'] != '' ? $allResumeInfo['personal_info']['citizenship']  : 'Не указано' ?></li>
                <li><span>Место проживания:</span><?= $allResumeInfo['personal_info']['country'] != '' ? $allResumeInfo['personal_info']['country']  : 'Не указано' ?></li>
                <li><span>Образование:</span><?= $allResumeInfo['personal_info']['education'] != '' ? $allResumeInfo['personal_info']['education']  : 'Не указано' ?></li>
                <li><span>Дата рождения:</span><?= $allResumeInfo['personal_info']['b-date'] != '' ? $allResumeInfo['personal_info']['b-date']  : 'Не указано' ?></li>
                <li><span>Пол:</span><?= $allResumeInfo['personal_info']['gender'] != '' ? $allResumeInfo['personal_info']['gender']  : 'Не указано' ?></li>
                <li><span>Семейное положение:</span><?= $allResumeInfo['personal_info']['marital_status'] != '' ? $allResumeInfo['personal_info']['marital_status']  : 'Не указано' ?></li>
            </ul>
        </div>
        <div class="experience_info_resume">
            <span class="resume_blocks_title modern_personail_title"><img src="/wp-content/plugins/constructor-resume/assets/img/case.png" alt=""> Опыт работы </span>
            <?php foreach ($allResumeInfo['experience'] as $exp) : ?>
                <ul>
                    <li><span>Период работы:</span><?= $exp['settled'] != '' ? $exp['settled']  : 'Не указано' ?>
                        <?php if (isset($exp['quit']) && $exp['quit'] != '') echo ' - ' . $exp['quit'] ?>
                        <?php if (isset($exp['expirience-1-now']) && $exp['expirience-1-now'] != '') echo ' - ' . $exp['expirience-1-now'] ?>
                    <li><span>Должность:</span><?= $exp['position'] != '' ? $exp['position']  : 'Не указано' ?></li>
                    <li><span>Организация:</span><?= $exp['organization'] != '' ? $exp['organization']  : 'Не указано' ?></li>
                    <?php if (isset($exp['about_org']) && $exp['about_org'] != '') : ?>
                        <li><span>Должностные обязанности и достижения:</span><?= $exp['about_org'] ?></li>
                    <?php endif; ?>
                </ul>

            <?php endforeach; ?>
        </div>
        <div class="education_info_resume">
            <span class="resume_blocks_title modern_personail_title"><img src="/wp-content/plugins/constructor-resume/assets/img/students-cap.png" alt=""> Образование </span>
            <?php foreach ($allResumeInfo['education'] as $edu) : ?>
                <ul>
                    <li><span>Учебное заведение:</span><?= $edu['educational-institution'] != '' ? $edu['educational-institution']  : 'Не указано' ?></li>
                    <li><span>Год окончания:</span><?= $edu['year-of-ending'] != '' ? $edu['year-of-ending']  : 'Не указано' ?></li>
                    <li><span>Факультет:</span><?= $edu['faculty'] != '' ? $edu['faculty']  : 'Не указано' ?></li>
                    <li><span>Специальность:</span><?= $edu['specialty'] != '' ? $edu['specialty']  : 'Не указано' ?></li>
                    <li><span>Форма обучения:</span><?= $edu['form-of-training'] != '' ? $edu['form-of-training']  : 'Не указано' ?></li>
                </ul>

            <?php endforeach; ?>
        </div>
        <div class="courses_trainings_info_resume">
            <span class="resume_blocks_title modern_personail_title"><img src="/wp-content/plugins/constructor-resume/assets/img/write-board.png" alt=""> Курсы и тренинги </span>
            <?php foreach ($allResumeInfo['courses_trainings'] as $course) : ?>
                <ul>
                    <li><span>Название курса:</span><?= $course['name-courses'] != '' ? $course['name-courses']  : 'Не указано' ?></li>
                    <li><span>Учебное заведение:</span><?= $course['courses-educational'] != '' ? $course['courses-educational']  : 'Не указано' ?></li>
                    <li><span>Дата окончания:</span><?= $course['year-of-ending-courses'] != '' ? $course['year-of-ending-courses']  : 'Не указано' ?></li>
                    <?php if (isset($course['course-duration']) && $course['course-duration'] != '') : ?>
                        <li><span>Продолжительность:</span><?= $course['course-duration'] ?></li>
                    <?php endif; ?>
                </ul>
            <?php endforeach; ?>
        </div>
        <div class="dop_info_resume">
            <span class="resume_blocks_title modern_personail_title"><img src="/wp-content/plugins/constructor-resume/assets/img/info.png" alt=""> Дополнительная информация </span>
            <ul>
                <li><span>Наличие водительских прав (категории):</span>
                    <?php foreach ($allResumeInfo['additional_info']['drivers_license'] as $dr_license) : ?>
                        <?php if ($dr_license != '') : ?>
                            <span class="el"><?= $dr_license . ', '; ?></span>
                        <?php else : ?>
                            <?php echo 'Не указано';
                            break; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </li>
                <li><span>Рекомендации:</span><?= $allResumeInfo['additional_info']['recommendations'] != '' ? $allResumeInfo['additional_info']['recommendations']  : 'Не указано' ?></li>
                <li><span>Ваши занятия в свободное время:</span><?= $allResumeInfo['additional_info']['leisure_activities'] != '' ? $allResumeInfo['additional_info']['leisure_activities']  : 'Не указано' ?></li>
                <li><span>Личные качества:</span><?= $allResumeInfo['additional_info']['personal_qualities'] != '' ? $allResumeInfo['additional_info']['personal_qualities']  : 'Не указано' ?></li>
            </ul>
        </div>
    </div>
    <div class="modern_resume_inf progressive_resume_inf">
        <ul>
            <li style="font-size: 14px;"><span>Желаемая зарплата<br></span><?= $allResumeInfo['basic_info']['desired_salary'] != '' ? $allResumeInfo['basic_info']['desired_salary']  : 'Не указано' ?></li>
            <li class="moder_li"><?= $allResumeInfo['basic_info']['employment'] ?? 'Не указано' ?></li>
            <li class="moder_li"><?= $allResumeInfo['basic_info']['schedule'] ?? 'Не указано' ?></li>
            <!-- <li style="font-size: 14px;"><span style="font-size: 13px; font-weight: normal; color: #757575; margin-right: 3px;">Готовность к командировкам:</span><?= $allResumeInfo['basic_info']['willingness'] ?? 'нет' ?></li>
                    <li style="font-size: 14px;"><span style="font-size: 13px; font-weight: normal; color: #757575; margin-right: 3px;">Телефон:</span><?= $allResumeInfo['basic_info']['phone'] != '' ? $allResumeInfo['basic_info']['phone']  : 'Не указано' ?></li> -->
        </ul>
        <?php if ((isset($allResumeInfo['basic_info']['email']) || isset($allResumeInfo['basic_info']['phone'])) && ($allResumeInfo['basic_info']['email'] != '' || $allResumeInfo['basic_info']['phone'] != '')) : ?>
            <ul>
                <li>Контакты</li>
                <?php if (isset($allResumeInfo['basic_info']['email']) && $allResumeInfo['basic_info']['email'] != '') : ?>
                    <li class="moder_li"><?= $allResumeInfo['basic_info']['email'] ?></li>
                <?php endif; ?>
                <?php if (isset($allResumeInfo['basic_info']['phone']) && $allResumeInfo['basic_info']['phone'] != '') : ?>
                    <li class="moder_li"><?= $allResumeInfo['basic_info']['phone'] ?>
                        <?php if (isset($allResumeInfo['basic_info']['phone']) && $allResumeInfo['basic_info']['phone'] != '') : ?>
                            <?php if ($allResumeInfo['basic_info']['viber'] != '') : ?>
                                <img style="margin-bottom: 3px;" src="/wp-content/plugins/constructor-resume/assets/img/viber.png" alt="">
                            <?php endif; ?>
                            <?php if ($allResumeInfo['basic_info']['whatsapp'] != '') : ?>
                                <img style="margin-bottom: 3px;" src="/wp-content/plugins/constructor-resume/assets/img/whatsapp.png" alt="">
                            <?php endif; ?>
                            <?php if ($allResumeInfo['basic_info']['telegram'] != '') : ?>
                                <img style="margin-bottom: 3px;" src="/wp-content/plugins/constructor-resume/assets/img/telegram.png" alt="">
                            <?php endif; ?>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif ?>
        <ul>
            <li>Иностранные языки:</li>
            <li class="moder_li"><?= $allResumeInfo['lang_computer_skills']['foreign-languages'] != '' ? $allResumeInfo['lang_computer_skills']['foreign-languages']  : 'Не указано' ?></li>
        </ul>
        <ul>
            <li>Компьютерные навыки:</li>
            <?php if ($allResumeInfo['lang_computer_skills']['computer_skills']['0'] != '') : ?>
                <li class="moder_li">
                    <?php foreach ($allResumeInfo['lang_computer_skills']['computer_skills'] as $scils) : ?>
                        <?php if ($scils != '') : ?>
                            <p class="el"><?= $scils; ?></p>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </li>
            <?php else : ?>
                <li class="moder_li">
                    <?php echo 'Не указано'; ?>
                </li>
            <?php endif ?>
        </ul>
    </div>
    <div class="clr"></div>
</div>