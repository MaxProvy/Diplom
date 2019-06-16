$(function () {
    if (!localStorage.getItem("auth")) {
        $('body').append(`<div class="login">
        <h2>Войти</h2>
        <form>
        <input class="logininput" type="text" name="login" placeholder="Логин">
        <input class="passwordinput" type="password" name="password" placeholder="Пароль">
        <input class="coming" type="submit" value="Войти">
        </form>
        </div>`)
    } else {
        $('body *').css({"visibility": "visible"});
        $('.login').remove();
    }
})

$('body').on('click', '.coming', function (e) {
    e.preventDefault();
    if ($('.logininput').val() == 'admin' && $('.passwordinput').val() == 'pass') {
        $('body *').css({"visibility": "visible"});
        $('.login').remove();
        localStorage.setItem("auth", true);
    } else {
        alert("Проверьте правильность введённых полей");
    }
})