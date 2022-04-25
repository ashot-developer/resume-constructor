// Добавление блока 3. Опыт работы
jQuery(document).ready(function ($) {
    $('.work-experience-button').on('click', function () {
        var number = 1 + Math.floor(Math.random() * 1000000);
        $('.work-exp_content').append('<div class="basic_info_box work-experience">' +
            '<div class="date_work">' +
            '<div class="in_work">' +
            '<label for="settled' + number + '">Устроился</label>' +
            '<input id="settled' + number + '"  name="settled' + number + '" />' +
            '</div>' +
            '<div class="out_work">' +
            '<label for="quit' + number + '">Уволился</label>' +
            '<input  id="quit' + number + '" name="quit' + number + '" />' +
            '</div>' +
            '<div class="expirience-1-now-block">' +
            '<div class="checkbox checkbox-info">' +
            '<input id="expirience-1-now' + number + '" class="styled" type="checkbox" name="expirience-1-now' + number + '" value="настоящее время">' +
            ' <label for="expirience-1-now' + number + '">' +
            '    настоящее время' +
            '</label>' +
            ' </div>' +
            '</div>' +
            ' </div>' +
            ' <div class="position_block">' +
            '  <div class="position_input posi_inp">' +
            ' <input type="text" class="form-control requ_field" placeholder="Должность" name="position' + number + '">' +
            '</div>' +
            '<div class="checkbox checkbox-info">' +
            '<input id="full-time' + number + '" class="styled" type="checkbox" name="full-time' + number + '" value="yes">' +
            '<label for="full-time' + number + '">' +
            ' полная занятость' +
            '</label>' +
            '</div>' +
            '</div>' +
            '<div class="form-group c-group">' +
            '<input type="text" class="form-control requ_field" placeholder="Организация" name="organization' + number + '">' +
            '<textarea class="form-control" id="exampleFormControlTextarea1' + number + '" name="about_org' + number + '" rows="3" placeholder="Должностные обязанности и достижения"></textarea>' +
            ' </div>' +
            '<p class="delete_block">X</p>' +
            '</div>'

        );
        $('#quit' + number).datepick($.datepick.regionalOptions['ru']);
        $('#quit' + number).attr('autocomplete', 'off');
        $('#settled' + number).datepick($.datepick.regionalOptions['ru']);
        $('#quit' + number).attr('autocomplete', 'off');



        $('.expirience-1-now-block label').on('click', function () {
            $(this).parent().parent().parent().find('.out_work #quit' + number).next().toggleClass('input-group-append-dis')
            if ($(this).parent().parent().parent().find('.out_work #quit' + number).attr('disabled')) {
                $(this).parent().parent().parent().find('.out_work #quit' + number).attr('disabled', false);
            } else {
                $(this).parent().parent().parent().find('.out_work #quit' + number).attr('disabled', true);
            }
        })

    })

    // Добавление блока  4. Образование

    $('.education-content-button').on('click', function () {
        var number = 1 + Math.floor(Math.random() * 1000000);
        $('.education-content').append('<div class="basic_info_box">' +
            '<div class="form-group c-group">' +
            '<input type="text" class="form-control requ_field" placeholder="Учебное заведение" name="educational-institution' + number + '">' +
            '<input type="text" class="form-control requ_field" placeholder="Факультет" name="faculty' + number + '">' +
            '<input type="text" class="form-control" placeholder="Специальность" name="specialty' + number + '">' +
            '<div class="year-of-div">' +
            '<label class="year-of" for="year-of-ending' + number + '">Год окончания</label>' +
            '<input id="year-of-ending' + number + '" name="year-of-ending' + number + '" />' +
            '<label for="form-of-training' + number + '">Форма обучения</label>' +
            '<select class="form-control" id="form-of-training' + number + '" name="form-of-training' + number + '">' +
            '<option value="1">Очная</option>' +
            '<option value="2">Очно-заочная (вечерняя)</option>' +
            '<option value="3">Заочная</option>' +
            '<option value="4">Дистанционная</option>' +
            '</select>' +
            '</div>' +
            '</div>' +
            '<p class="delete_block">X</p>' +
            '</div>');

        $('#year-of-ending' + number).datepick($.datepick.regionalOptions['ru']);
        $('#year-of-ending' + number).attr('autocomplete', 'off');


    })

    // Добавление блока  5. Курсы и тренинги

    $('.courses-content-button').on('click', function () {
        var number = 1 + Math.floor(Math.random() * 1000000);
        $('.courses-content').append('<div class="basic_info_box">' +
            '<div class="form-group c-group courses_block">' +
            '<input type="text" class="form-control requ_field" placeholder="Название курса" name="name-courses' + number + '">' +
            '<input type="text" class="form-control requ_field" placeholder="Учебное заведение" name="courses-educational' + number + '">' +
            '<div class="year-d year-of-div' + number + '">' +
            '<label class="year-of" for="year-of-ending-courses' + number + '">Год окончания</label>' +
            '<input id="year-of-ending-courses' + number + '" name="year-of-ending-courses' + number + '" />' +
            '<input class="form-control d-courses" type="text" value="" placeholder="Продолжительность" name="course-duration' + number + '">' +
            '</div>' +
            '</div>' +
            '<p class="delete_block">X</p>' +
            '</div>');

        $('#year-of-ending-courses' + number).datepick($.datepick.regionalOptions['ru']);
        $('#year-of-ending-courses' + number).attr('autocomplete', 'off');

    })

    $(document).on('click', '.delete_block', function () {
        $(this).parent().remove();
    })

    $('.expirience-1-now-block label').on('click', function () {
        $(this).parent().parent().parent().find('.out_work').toggleClass('input-group-append-dis')
        if ($('#quit').attr('disabled')) {
            $('#quit').attr('disabled', false);
        } else {
            $('#quit').attr('disabled', true);
        }
    })

    // Подключение datepicker
    var config = {
        value: '02/15/2019',
        minDate: '02/12/2019',
        uiLibrary: 'bootstrap4'
    };

    $('.d_inp').each(function () {
        $(this).datepick($.datepick.regionalOptions['ru']);
        $(this).attr('autocomplete', 'off');
    })

    $('#payment_form').on('submit', function () {
        $('#download_pdf').click();
    })

    $('#download_pdf').on('click', function (e) {
        var href = myScript.pluginsUrl;
        var html = $('#pills-tabContent div.active').html();
        var unic_v = $('#u_key').val();
        e.preventDefault()
        $.ajax({
            url: href + '/includes/pdf.php',
            method: 'post',
            data: {
                'html': html,
                'name': name,
                'unic_key': unic_v
            },
            success: function (data) {
                $('#download_pdf').after('<a href="' + data + '" style="display: none;" id="down" download></a>')
                var a = document.getElementById('down');
                //a.click();
            }
        })
    })


    $(document).on('change', '#img_imp', function () {
        var href = myScript.pluginsUrl;
        var name = document.getElementById("img_imp").files[0].name;
        var form_data = new FormData();
        var ext = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert("Invalid Image File");
        }
        $('.prof_photo').remove();
        $('#img_ajax').remove();
        $('.delete_img').remove();
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("img_imp").files[0]);
        var f = document.getElementById("img_imp").files[0];
        var fsize = f.size || f.fileSize;
        if (fsize > 2000000) {
            alert("Image File Size is very big");
        } else {
            form_data.append("img_imp", document.getElementById('img_imp').files[0]);
            $.ajax({
                url: href + "/includes/upload.php",
                method: "POST",
                data: form_data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    $("#new_img").val(data.img_name);

                    $('#d_img_box').append(data.html);
                    $('.img_fake').after(data.html_close);
                }
            });
        }
    });

    $(document).on('click', '.delete_img', function () {
        $('.prof_photo').remove();
        $('#img_ajax').remove();
        $(this).remove();
    })

    if ($('#gender').val() == 'Мужской') {
        $('#marital_status').html('<option value="Холост">Холост</option><option value="Женат">Женат</option>');
    }

    $('#gender').on('change', function () {
        if ($(this).val() == 'Женский') {
            $('#marital_status').html('<option value="Не замужем">Не замужем</option><option value="Замужем">Замужем</option>');
        } else {
            $('#marital_status').html('<option value="Холост">Холост</option><option value="Женат">Женат</option>');
        }
    })

    $('#tab_for_mob').on('change', function () {
        $tab_val = $(this).val();
        $('#pills-tab li a').each(function () {
            if ($(this).attr('href') == $tab_val) {
                $(this).click();
            }
        })
    })
    var req_field = [];

    $('.requ_field').each(function () {
        if ($(this).val() == '') {
            $(this).css('background-color', '#fffdb8');
            req_field.push($(this).val());
        }
    })

    $(document).on('input', '.requ_field', function () {
        if ($(this).val() != '') {
            $(this).css('background-color', '#ffffff');
            req_field.push($(this).val());
        } else {
            $(this).css('background-color', '#fffdb8');
            req_field.push($(this).val());
        }
    })

    if (req_field.length != 0) {
        $('#pills-tab').after('<div class="alert alert-warning custome_warning_mess" role="alert">Заполните поля выделенные желтым маркером</div>');
    }

    $('#for_adding noscript').remove();

    function scroll_top() {
        var body = $("html, body");
        body.stop().animate({ scrollTop: 300 }, 500, 'swing', function () {
        });
    }

    $('#send_to_mail').on('click', function () {
        scroll_top()
        $('.link_3').click();
    })

    $('#go_back').on('click', function (e) {
        e.preventDefault();
        scroll_top()
        $('.link_1').click();

    })

    $('#go_back2').on('click', function (e) {
        e.preventDefault();
        scroll_top()
        $('.link_2').click();

    })

})