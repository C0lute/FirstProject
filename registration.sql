-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 27 2025 г., 13:34
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `registration`
--

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
  `id_города` int NOT NULL,
  `название` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id_города`, `название`) VALUES
(1, 'Тула'),
(2, 'Москва'),
(3, 'Санкт-Петербург'),
(4, 'Казань'),
(5, 'Нижний Новгород'),
(6, 'Калининград'),
(7, 'Ярославль'),
(8, 'Екатеринбург'),
(9, 'Владимир'),
(10, 'Краснодар');

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `id` int NOT NULL,
  `название_проекта` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL,
  `название_корпорации` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL,
  `город` int NOT NULL,
  `краткое_описание` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL,
  `полное_описание` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL,
  `Оценка_надежности` float NOT NULL DEFAULT '0',
  `стоимость_проекта` int NOT NULL DEFAULT '0',
  `окупаемость_проекта` int NOT NULL DEFAULT '0',
  `Оценка_конкурентоспособности` float NOT NULL DEFAULT '0',
  `оценка_рейтинга` int NOT NULL DEFAULT '0',
  `download` text CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `название_проекта`, `название_корпорации`, `город`, `краткое_описание`, `полное_описание`, `Оценка_надежности`, `стоимость_проекта`, `окупаемость_проекта`, `Оценка_конкурентоспособности`, `оценка_рейтинга`, `download`) VALUES
(1, 'Проект 1', 'Корп1', 1, '1', '1', 50.5255, 154000000, 4, 0.98901, 10, 'temp/251.docx'),
(2, 'Проект 2', 'Корп2', 2, '2', '2', 99.7441, 110250000, 3, 0.7378, 11, 'temp/TeoriaVer.doc'),
(3, 'Проект 3', 'Корп3', 3, '3', '3', 32.0349, 1750000, 3, 0.8014, 13, 'temp/xxx.jpg'),
(4, 'Проект 4', 'Корп4', 3, '4', '4', 99.7919, 1000000, 5, 0.8653, 11, NULL),
(5, 'Проект 5', 'Корп5', 8, '5', '5', 99.4184, 500000, 6, 0.99656, 9, NULL),
(6, 'Проект 6', 'Корпорация6', 5, 'Краткое описание Проекта 6', 'Полное описание Проекта 6', 34.5188, 750000, 4, 0.79554, 8, NULL),
(7, 'Тестовый проект 7', '7', 3, '7', '7', 0, 0, 0, 0, 0, NULL),
(40, 'Майдадыр', 'ООО Майдадыр', 10, 'Здесь должен быть текст, но его нет', 'А здесь должно быть больше текста', 0, 0, 0, 0, 0, 'temp/Создание и автоматизация процессов оператора лотерей Национальная лотерея.doc');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `fio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_ru_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `phone` varchar(11) NOT NULL,
  `root` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fio`, `email`, `phone`, `root`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Альдергот Алексей Германович', 'admin@gmail.com', '79060622505', 1),
(8, 'test', '81dc9bdb52d04dc20036dbd8313ed055', '123412', 'test@mail.ru', '79038233828', 1),
(9, 'abcd', '81dc9bdb52d04dc20036dbd8313ed055', 'фыфка', 'abcd@mail.ru', '0', 0),
(10, '1234', '81dc9bdb52d04dc20036dbd8313ed055', 'фывафыва', 'asdfa@gmail.com', '79687867674', 0),
(11, '1', 'c4ca4238a0b923820dcc509a6f75849b', '1', '12324@gmail.com', '0', 0),
(12, 'test_login', '81dc9bdb52d04dc20036dbd8313ed055', 'test_login', 'testfio@gmail.com', '0', 0),
(13, 'phone', '81dc9bdb52d04dc20036dbd8313ed055', 'phone', 'phone@gmail.com', '11111111111', 0),
(14, 'тестовой', '81dc9bdb52d04dc20036dbd8313ed055', 'Тестовый ФИО', 'test1523@mail.ru', '12345678901', 0),
(15, 'noviy', 'd93591bdf7860e1e4ee2fca799911215', 'noviy', 'noviylogin@mail.ru', '79060622535', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id_города`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `город` (`город`),
  ADD KEY `город_2` (`город`),
  ADD KEY `город_3` (`город`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
  MODIFY `id_города` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`город`) REFERENCES `city` (`id_города`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
