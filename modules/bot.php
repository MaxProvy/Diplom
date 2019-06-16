<footer><p>Обновлен © 2013 МБОУ ПОЛИТЭК</p></footer>
<!--<script src="../js/jquery-3.4.1.js"></script>-->
<!--<script src="../js/script.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    var i = 0;

    $('.slide-item').eq(i).css({"display": "block"}).addClass("active-slide");

    if ($('.slide-item').length > 1) {

        for (let i = 0; i < $('.slide-item').length; i++) {
            // $('.slider-switch').append(`<div class="switch"></div>`);
            $('<div class="switch"></div>').data('id', i).appendTo('.slider-switch');
        }
        $('.switch').eq(i).addClass("active-switch");
        i++;

        var inter = setInterval(function () {
            if (i >= $('.slide-item').length) i = 0;
            $('.active-slide').css({"display": "none"}).removeClass("active-slide");
            $('.slide-item').eq(i).css({"display": "block"}).addClass("active-slide");

            $('.active-switch').removeClass("active-switch");
            $('.switch').eq(i).addClass("active-switch");

            i++;
        }, 2500);

        $('.switch').click(function () {

            i = $(this).data('id');

            $('.active-slide').css({"display": "none"}).removeClass("active-slide");
            $('.slide-item').eq(i).css({"display": "block"}).addClass("active-slide");

            $('.active-switch').removeClass("active-switch");
            $('.switch').eq(i).addClass("active-switch");

        })

    }

    $('.rows>img').click(function () {
        // $('.preview').css({ "display": "block", "background": `url("${$(this).attr('src')}")`, "background-size": "contain", "background-repeat": "no-repeat" });
        $('.preview').css({
            "display": "block",
            "background": `url("${$(this).attr('src')}")`,
            "background-size": "contain"
        });
    })
    $('.close').click(function () {
        $('.preview').css({"display": "none"});
    })

    $(document).ready(function () { // Ждём загрузки страницы

        // $(".image").click(function() {
        //     alert(this.getAttribute('src'));
        // })

        $(".image").click(function () {	// Событие клика на маленькое изображение
            var img = $(this);	// Получаем изображение, на которое кликнули
            console.log($(this).attr('src'));
            var src = img.attr('src'); // Достаем из этого изображения путь до картинки
            $("body").append("<div class='popup'>" + //Добавляем в тело документа разметку всплывающего окна
                "<div class='popup_bg'></div>" + // Блок, который будет служить фоном затемненным
                "<img src='" + src + "' class='popup_img' />" + // Само увеличенное фото
                "</div>");
            $(".popup").fadeIn(800); // Медленно выводим изображение
            $(".popup_bg").click(function () {	// Событие клика на затемненный фон
                $(".popup").fadeOut(800);	// Медленно убираем всплывающее окно
                setTimeout(function () {	// Выставляем таймер
                    $(".popup").remove(); // Удаляем разметку всплывающего окна
                }, 800);
            });
        });

    });
</script>

</body>
</html>