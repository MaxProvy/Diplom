var article_id = -1;
var article_kol = 2;
var article_ready = false;

var page_id = -1;
var page_kol = 1;
var page_ready = false;

$(function () {

    ArticleCreate();
    // Menu();
    get_menu();
    get_lmenu();
    $('.h-item').on('click', function () {
        $('.h-item').removeClass("active");
        $(this).addClass("active");
        let classname = '.' + $('.active').attr('class').split(' ')[1];
        // $(classname).css({"background":"#000"});
        $('.content-block').css({"display": "none"});
        if (classname === '.h-articles') {
            ArticleCreate();
        }
        if (classname === '.h-pages') {
            PageCreate();
        }
        if (classname === '.h-main-menu') {
            Menu();
        }
        if (classname === '.h-l-menu') {
            LMenu();
        }
    })

    // $('.create-punkt-form>button').on('click', function () {
    //     get_menu();
    // })
    $('.create-punkt-form>button').on('click', function () {

    })

});

function ArticleCreate() {
    $('.content-block').css({"display": "none"});
    $('.articles').css({"display": "block"});
}

function PageCreate() {
    $('.content-block').css({"display": "none"});
    $('.pages').css({"display": "block"});
}

function Menu() {
    $('.content-block').css({"display": "none"});
    $('.main-menu').css({"display": "block"});
}

function LMenu() {
    $('.content-block').css({"display": "none"});
    $('.l-menu').css({"display": "block"});

}

function get_menu() {
    $.ajax({
        url: '/ajax/get_menu.php/?m=get',
        type: 'POST',
        dataType: 'json',
        success: (res) => {
            // console.log(res);
            $('.main-menu .create-subpunkt-form>select').empty().append(`<option value="0" selected disabled>Выберите пункт</option>`);
            for (let item of res) {
                $('.main-menu .create-subpunkt-form>select').append(`<option value="${item['id']}">${item['name']}</option>`);
                // console.log(item);
            }
        },
        error: () => {
            alert('Ошибка получения меню');
        }
    });
}

function get_lmenu() {
    $.ajax({
        url: '/ajax/get_menu.php/?m=lget',
        type: 'POST',
        dataType: 'json',
        success: (res) => {
            // console.log(res);
            $('.l-menu .create-subpunkt-form>select').empty().append(`<option value="0" selected disabled>Выберите пункт</option>`);
            for (let item of res) {
                $('.l-menu .create-subpunkt-form>select').append(`<option value="${item['id']}">${item['name']}</option>`);
                // console.log(item);
            }
        },
        error: () => {
            alert('Ошибка получения меню');
        }
    });
}

//Публикация пункта меню
$('.main-menu .create-punkts-btn').on("click", function () {
    $.ajax({
        url: '/ajax/get_menu.php/?m=postmenu',
        type: 'POST',
        dataType: 'json',
        data: {
            name: $('.main-menu .punkt-name').val(),
            href: $('.main-menu .punkt-href').val()
        },
        success: (res) => {
            $('.main-menu .punkt-name').val('');
            $('.main-menu .punkt-href').val('');
            get_menu();

            alert(res);

            GetData('menu');
            Revol(data, '.admin-menu');

        },
        error: () => {
            alert('Ошибка создания пункта меню');
        }
    });
})
//Публикация подпункта меню
$('.main-menu .create-punkts-sub-btn').on("click", function () {
    $.ajax({
        url: '/ajax/get_menu.php/?m=postsubmenu',
        type: 'POST',
        dataType: 'json',
        data: {
            sub: $('.main-menu .main-subpunkt-sub').val(),
            name: $('.main-menu .subpunkt-name').val(),
            href: $('.main-menu .subpunkt-href').val()
        },
        success: (res) => {
            if (res == 'Успешно создано') {
                $('.main-menu .main-subpunkt-sub').val(0);
                $('.main-menu .subpunkt-name').val('');
                $('.main-menu .subpunkt-href').val('');
            }
            alert(res);

        }
        ,
        error: () => {
            alert('Ошибка создания пункта меню');
        }
    });
});

//Публикация пункта л меню
$('.l-menu .create-punkts-btn').on("click", function () {
    $.ajax({
        url: '/ajax/get_menu.php/?m=lpostmenu',
        type: 'POST',
        dataType: 'json',
        data: {
            name: $('.l-menu .punkt-name').val(),
            href: $('.l-menu .punkt-href').val()
        },
        success: (res) => {
            $('.l-menu .punkt-name').val('');
            $('.l-menu .punkt-href').val('');
            get_lmenu();

            GetData('l_menu');
            Revol(data, '.admin-l-menu');

            alert(res);
        },
        error: () => {
            alert('Ошибка создания пункта меню');
        }
    });
})
//Публикация подпункта л меню
$('.l-menu .create-punkts-sub-btn').on("click", function () {
    $.ajax({
        url: '/ajax/get_menu.php/?m=lpostsubmenu',
        type: 'POST',
        dataType: 'json',
        data: {
            sub: $('.l-menu .main-subpunkt-sub').val(),
            name: $('.l-menu .subpunkt-name').val(),
            href: $('.l-menu .subpunkt-href').val()
        },
        success: (res) => {
            if (res == 'Успешно создано') {
                $('.l-menu .main-subpunkt-sub').val(0);
                $('.l-menu .subpunkt-name').val('');
                $('.l-menu .subpunkt-href').val('');
            }
            alert(res);
        },
        error: () => {
            alert('Ошибка создания пункта меню');
        }
    });
})

//ДАЛЬШЕ СТАТЬИ

var files;

$('.article-material').change(function () {
    files = this.files;
    event.stopPropagation(); // Остановка происходящего
    event.preventDefault();  // Полная остановка происходящего

    // Создадим данные формы и добавим в них данные файлов из files

    var data = new FormData();
    $.each(files, function (key, value) {
        data.append(key, value);
    });

    // Отправляем запрос

    $.ajax({
        url: article_id === -1 ? '/ajax/multuply.php?uploadfiles' + '&article_kol=' + article_kol : '/ajax/multuply.php?uploadfiles=' + article_id + '&article_kol=' + article_kol,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Не обрабатываем файлы (Don't process the files)
        contentType: false, // Так jQuery скажет серверу что это строковой запрос
        success: function (respond, textStatus, jqXHR) {

            // Если все ОК

            if (typeof respond.error === 'undefined') {
                // Файлы успешно загружены, делаем что нибудь здесь

                for (let item of respond.files) {
                    article_id = respond.id;
                    article_kol = respond.kol;
                    // if (first) {
                    //     $('.loaded-preview').append(`<img src="${item}" alt="">`);
                    //     first = !first;
                    // } else {
                    //     if ($('[src="' + item + '"]').length) {
                    //         // exists
                    //         alert('загружденор уже');
                    //     } else $('.loaded-preview').append(`<img src="${item}" alt="">`);
                    // }
                    $('.loaded-preview').append(`<img src="${item}" alt="">`);

                }
            } else {
                console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('ОШИБКИ AJAX запроса: ' + textStatus);
        }
    });
});
var file;
$('.article-main-img').change(function () {
    file = this.files;
    event.stopPropagation(); // Остановка происходящего
    event.preventDefault();  // Полная остановка происходящего

    // Создадим данные формы и добавим в них данные файлов из files

    var data = new FormData();
    $.each(file, function (key, value) {
        data.append(key, value);
    });

    // Отправляем запрос

    $.ajax({
        url: article_id === -1 ? '/ajax/image.php?uploadfile' : '/ajax/image.php?uploadfile=' + article_id,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Не обрабатываем файлы (Don't process the files)
        contentType: false, // Так jQuery скажет серверу что это строковой запрос
        success: function (respond, textStatus, jqXHR) {

            // Если все ОК

            if (typeof respond.error === 'undefined') {
                // Файлы успешно загружены, делаем что нибудь здесь
                article_id = respond.id;
                article_kol = respond.kol;
                // выведем пути к загруженным файлам в блок '.ajax-respond'
                for (let item of respond.files) {
                    $('.main-img').empty().append(`<img src="${item}" alt="">`);
                    // console.log(item);
                }
                article_ready = true;

            } else {
                console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('ОШИБКИ AJAX запроса: ' + textStatus);
        }
    });
});

$('.send-article').on('click', function () {

    if (article_ready) {
        var data1 = CKEDITOR.instances.editor1.getData();
        $.ajax({
            url: '/ajax/create_article.php',
            type: 'POST',
            data: {
                id: article_id,
                title: $('.article-name-value').val(),
                description: $('.article-description-value').val(),
                text: data1
            },
            dataType: 'json',
            success: (res) => {
                alert(res);
                window.location.href = '/admin';

            },
            error: () => {
                alert('Ошибка создания статьи');
            }
        });

    } else alert('Вы не загрузили главную фотографию');
});

//ДАЛЬШЕ СТРАНИЦЫ

var files;

$('.page-material').change(function () {
    files = this.files;
    event.stopPropagation(); // Остановка происходящего
    event.preventDefault();  // Полная остановка происходящего

    // Создадим данные формы и добавим в них данные файлов из files

    var data = new FormData();
    $.each(files, function (key, value) {
        data.append(key, value);
    });

    // Отправляем запрос

    $.ajax({
        url: page_id === -1 ? '/ajax/multuplypage.php?uploadfiles' + '&article_kol=' + page_kol : '/ajax/multuplypage.php?uploadfiles=' + page_id + '&article_kol=' + page_kol,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false, // Не обрабатываем файлы (Don't process the files)
        contentType: false, // Так jQuery скажет серверу что это строковой запрос
        success: function (respond, textStatus, jqXHR) {

            // Если все ОК

            if (typeof respond.error === 'undefined') {
                // Файлы успешно загружены, делаем что нибудь здесь

                for (let item of respond.files) {
                    page_id = respond.id;
                    page_kol = respond.kol;
                    $('.loaded-preview-pages').append(`<img src="${item}" alt="">`);

                }
            } else {
                console.log('ОШИБКИ ОТВЕТА сервера: ' + respond.error);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('ОШИБКИ AJAX запроса: ' + textStatus);
        }
    });
});

$('.send-page').on('click', function () {

    var data2 = CKEDITOR.instances.editor2.getData();
    $.ajax({
        url: '/ajax/create_page.php',
        type: 'POST',
        data: {
            id: page_id,
            title: $('.page-name-value').val(),
            text: data2
        },
        dataType: 'json',
        success: (res) => {
            alert(res);
            $('.page-name-value').val('');
            CKEDITOR.instances.editor2.setData('');
            $('.page-material').val('');
            $('.loaded-preview-pages').empty();

            // $('.admin-page').empty();
            GetData('page');
            // $('.pages .forms-control').append($(`<ul class="admin-page"></ul>`));
            Revol(data, '.admin-page');

            // window.location.href = '/admin';
        },
        error: () => {
            alert('Ошибка создания статьи');
        }
    });
});