var data;
// var ar, pa, me, lm = false;

$(function () {

    GetData('article');
    $('.articles .forms-control').append($(`<ul class="admin-article"></ul>`));
    Revol(data, '.admin-article');
    // ar = true;

    GetData('page');
    $('.pages .forms-control').append($(`<ul class="admin-page"></ul>`));
    Revol(data, '.admin-page');
    // pa = true;

    GetData('menu');
    $('.main-menu .forms-control').append($(`<ul class="admin-menu"></ul>`));
    Revol(data, '.admin-menu');
    // me = true;

    GetData('l_menu');
    $('.l-menu .forms-control').append($(`<ul class="admin-l-menu"></ul>`));
    Revol(data, '.admin-l-menu');
    // lm = true;

    // $('.h-item').on('click', function () {
    //     let classname = '.' + $('.active').attr('class').split(' ')[1];
    //     if (classname === '.h-articles') {
    //         if (!ar) {
    //             GetData('article');
    //             $('.articles .forms-control').append($(`<ul class="admin-article"></ul>`));
    //             Revol(data, '.admin-article');
    //         }
    //     }
    //     if (classname === '.h-pages') {
    //         if (!pa) {
    //             GetData('page');
    //             $('.pages .forms-control').append($(`<ul class="admin-page"></ul>`));
    //             Revol(data, '.admin-page');
    //             pa = true;
    //         }
    //     }
    //     if (classname === '.h-main-menu') {
    //         if (!me) {
    //             GetData('menu');
    //             $('.main-menu .forms-control').append($(`<ul class="admin-menu"></ul>`));
    //             Revol(data, '.admin-menu');
    //             me = true;
    //         }
    //     }
    //     if (classname === '.h-l-menu') {
    //         if (!lm) {
    //             GetData('l_menu');
    //             $('.l-menu .forms-control').append($(`<ul class="admin-l-menu"></ul>`));
    //             Revol(data, '.admin-l-menu');
    //             lm = true;
    //         }
    //     }
    // })

})

function Revol(list, container) {
    $(container).empty();
    if (container === '.admin-page') {
        for (let item of list) {
            // console.log(item);
            let el = $(`<li><p>Ссылка на страницу: ?pages=${item['id']}</p><p>${item['name']}</p></li>`)
            $(`<span class="delete">(Удалить)</span>`).data('id', item['id']).appendTo(el);
            $(container).append(el);
        }
    } else {
        for (let item of list) {
            // console.log(item);
            let el = $(`<li><p>${item['name']}</p></li>`)
            $(`<span class="delete">(Удалить)</span>`).data('id', item['id']).appendTo(el);
            $(container).append(el);
        }
    }
}

function GetData(m) {
    $.ajax({
        url: '/ajax/get_list.php/?m=' + m,
        type: 'POST',
        dataType: 'json',
        async: false,
        success: (res) => {
            data = res;
        },
        error: () => {
            alert('Ошибка запроса AJAX');
        }
    });
}

function Remove(id, table, el) {
    $.ajax({
        url: '/ajax/get_list.php/?id=' + id + '&table=' + table,
        type: 'POST',
        dataType: 'json',
        success: (res) => {
            if (res === 100) {
                alert("Удалено");
                el.parent().remove();
            } else alert("Ошибка запроса к удалению");
        },
        error: () => {
            alert('Ошибка запроса AJAX');
        }
    });
}

$('body').on('click', '.articles .delete', function () {
    Remove($(this).data('id'), 'article', $(this));
})
$('body').on('click', '.pages .delete', function () {
    Remove($(this).data('id'), 'page', $(this));
})
$('body').on('click', '.main-menu .delete', function () {
    Remove($(this).data('id'), 'menu', $(this));
    get_menu();
})
$('body').on('click', '.l-menu .delete', function () {
    Remove($(this).data('id'), 'l_menu', $(this));
    get_lmenu();
})