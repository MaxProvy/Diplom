-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 13 2019 г., 14:13
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `politek`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE `article` (
  `id` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `dis` text NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `date`, `name`, `dis`, `text`) VALUES
(1, '2019-06-06 20:41:17', 'Я люблю мифи', 'Защищаемся 17 числа', '<p>Все плохо</p>\n'),
(2, '2019-06-06 20:43:31', 'Вторая моя статья', 'О да вы журналист', '<ul>\n	<li style=\"text-align: center;\"><strong><span style=\"background-color:#27ae60\">Как вам коты???</span></strong></li>\n</ul>\n'),
(3, '2019-06-06 20:50:14', 'Можно еще одну?', 'Люблю баловатся', '<h2 style=\"font-style:italic; text-align:center\"><em><strong><u><span style=\"background-color:#ecf0f1\">Пойду работать тестировщиком в гугл за такое</span></u></strong></em></h2>\n\n<h2 style=\"font-style:italic; text-align:center\"><em><strong><u><span style=\"background-color:#ecf0f1\">Или бизнес аналитиком за то что я летописец грамотный</span></u></strong></em></h2>\n'),
(4, '2019-06-11 14:23:12', '', 'мифи', ''),
(5, '2019-06-11 14:52:18', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `l_menu`
--

CREATE TABLE `l_menu` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `href` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `l_menu`
--

INSERT INTO `l_menu` (`id`, `name`, `href`) VALUES
(1, 'Вакантные места для перевода ', '/'),
(2, 'Пункт 2', '');

-- --------------------------------------------------------

--
-- Структура таблицы `l_menu_sub`
--

CREATE TABLE `l_menu_sub` (
  `id` int(255) NOT NULL,
  `sub_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `l_menu_sub`
--

INSERT INTO `l_menu_sub` (`id`, `sub_id`, `name`, `href`) VALUES
(1, 2, 'Руководство.Педагогический состав', '?pages=1'),
(2, 2, 'Стипендии и иные виды материальной поддержки', '?pages=1');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `href` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `name`, `href`) VALUES
(1, 'Основные сведения', ''),
(2, 'Государственная итоговая аттестация', '/');

-- --------------------------------------------------------

--
-- Структура таблицы `menu_sub`
--

CREATE TABLE `menu_sub` (
  `id` int(255) NOT NULL,
  `sub_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `href` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu_sub`
--

INSERT INTO `menu_sub` (`id`, `sub_id`, `name`, `href`) VALUES
(1, 1, 'Структура и органы управления', '?pages=1'),
(2, 1, 'Документы', '?pages=1'),
(4, 1, 'Образование', '?pages=1'),
(5, 1, 'Образовательные стандарты', '?pages=1');

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `date`, `name`, `text`) VALUES
(1, '2019-04-23 00:00:00', 'Страница 1', 'Текст статьи 1<br>Lorem ipsum dolor sit amet, consectetur adipisicing <b>elit</b>. Excepturi nisi perferendis praesentium? At cupiditate dolores earum esse <u>et</u> facere fuga id inventore libero, non praesentium quia rerum similique totam ut!'),
(2, '2019-04-24 00:00:00', 'Страница 2', 'Текст страницы'),
(3, '2019-04-10 00:00:00', 'Страница 3', 'Текст страницы'),
(6, '2019-06-06 22:18:18', '', ''),
(7, '2019-06-06 22:25:09', 'Название страницы которая надеюсь будет работать', '<blockquote>\n<p><span style=\"font-size:20px\">Кто скажет привет тот скажет и пока</span></p>\n</blockquote>\n'),
(8, '2019-06-11 13:43:27', 'Страница под названием ААА', '<p>Какая-то страница</p>\n'),
(9, '2019-06-11 14:52:23', '', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `l_menu`
--
ALTER TABLE `l_menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `l_menu_sub`
--
ALTER TABLE `l_menu_sub`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_sub`
--
ALTER TABLE `menu_sub`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `article`
--
ALTER TABLE `article`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `l_menu`
--
ALTER TABLE `l_menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `l_menu_sub`
--
ALTER TABLE `l_menu_sub`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `menu_sub`
--
ALTER TABLE `menu_sub`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
