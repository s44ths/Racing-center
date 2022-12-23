-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 23 2022 г., 14:56
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `racingcenter`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fin_verdict`
--

CREATE TABLE `fin_verdict` (
  `fv_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `Verdict` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `fin_verdict`
--

INSERT INTO `fin_verdict` (`fv_id`, `req_id`, `s_id`, `Verdict`) VALUES
(1, 2, 2, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `race`
--

CREATE TABLE `race` (
  `r_id` int(11) NOT NULL,
  `RaceName` varchar(50) NOT NULL,
  `RaceInfo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `race`
--

INSERT INTO `race` (`r_id`, `RaceName`, `RaceInfo`) VALUES
(1, 'FIA Formula One World Championship', 'Чемпионат мира по кольцевым гонкам, который проводится ежегодно и состоит из этапов (называемых Гран-при), в соответствии с техническими нормами, требованиями и правилами, установленными Международной автомобильной федерацией (FIA).'),
(2, 'FIA World Endurance Championship', 'Международное спортивное соревнование, организованное Западным автомобильным клубом и санкционированное Международной автомобильной федерацией. Чемпионат стал преемником Межконтинентального кубка Ле-Мана, проводимого в 2010−11 годах, и первым мировым чемпионатом по автогонкам на выносливость после упразднения в 1992 году чемпионата мира по гонкам на спорткарах. Название World Endurance Championship использовалось ФИА в 1981−85 года.'),
(3, 'World RX Rallycross', 'Чемпионат мира по ралли-кроссу, серия автомобильных соревнований, организуемых ФИА, промоутером которых является медиаконцерн IMGruen из США.<br />\r\n<br />\r\nДебютировал чемпионат в 2014 годуruen. Его первым победителем стал норвежский автогонщик Петтер Сульберг, прежде становившийся чемпионом мира по ралли (2003).');

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `req_id` int(11) NOT NULL,
  `Model` varchar(80) DEFAULT NULL,
  `Rollcage` tinyint(4) NOT NULL,
  `Power` float NOT NULL,
  `BeltType` varchar(50) NOT NULL,
  `Tuning` tinyint(4) NOT NULL,
  `Tire` float NOT NULL,
  `sender_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `request`
--

INSERT INTO `request` (`req_id`, `Model`, `Rollcage`, `Power`, `BeltType`, `Tuning`, `Tire`, `sender_id`, `r_id`) VALUES
(1, 'ВАЗ 2107', 1, 75, 'трехточечные', 1, 175, 3, 2),
(2, '1', 0, 1, '1', 0, 1, 3, 3),
(3, 'ВАЗ 2107', 1, 75, 'трехточечные', 1, 175, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `s_verdict`
--

CREATE TABLE `s_verdict` (
  `sv_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `sec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `s_verdict`
--

INSERT INTO `s_verdict` (`sv_id`, `req_id`, `sec_id`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `t_verdict`
--

CREATE TABLE `t_verdict` (
  `tv_id` int(11) NOT NULL,
  `req_id` int(11) NOT NULL,
  `tech_id` int(11) NOT NULL,
  `TOResult` tinyint(4) NOT NULL,
  `CarType` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `t_verdict`
--

INSERT INTO `t_verdict` (`tv_id`, `req_id`, `tech_id`, `TOResult`, `CarType`) VALUES
(1, 1, 1, 1, 'Гоночная машина');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleName` varchar(100) DEFAULT NULL,
  `Login` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `StartDate` date NOT NULL,
  `Equipment` varchar(200) NOT NULL,
  `Points` int(11) NOT NULL,
  `Disquals` int(11) NOT NULL,
  `Role` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `LastName`, `FirstName`, `MiddleName`, `Login`, `Password`, `StartDate`, `Equipment`, `Points`, `Disquals`, `Role`) VALUES
(1, 'Петров', 'Петр', 'Петрович', 'petr', '123', '2019-01-30', 'Шлем', 2, 0, 2),
(2, 'Сидоров', 'Сидр', 'Сидрович', 'sidr', '123', '2013-06-04', 'Сидр', 31, 0, 1),
(3, 'Иванов', 'Иван', 'Иванович', 'ivan', '123', '2018-01-01', '-', 83, 0, 0),
(4, 'Васильев', 'Василий', 'Васильевич', 'vas', '123', '2016-02-23', '-', 180, 0, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `fin_verdict`
--
ALTER TABLE `fin_verdict`
  ADD PRIMARY KEY (`fv_id`),
  ADD KEY `R_7` (`req_id`),
  ADD KEY `R_9` (`s_id`);

--
-- Индексы таблицы `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`r_id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `R_1` (`sender_id`),
  ADD KEY `R_10` (`r_id`);

--
-- Индексы таблицы `s_verdict`
--
ALTER TABLE `s_verdict`
  ADD PRIMARY KEY (`sv_id`),
  ADD KEY `R_2` (`req_id`),
  ADD KEY `R_3` (`sec_id`);

--
-- Индексы таблицы `t_verdict`
--
ALTER TABLE `t_verdict`
  ADD PRIMARY KEY (`tv_id`),
  ADD KEY `R_4` (`req_id`),
  ADD KEY `R_5` (`tech_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `fin_verdict`
--
ALTER TABLE `fin_verdict`
  MODIFY `fv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `race`
--
ALTER TABLE `race`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `s_verdict`
--
ALTER TABLE `s_verdict`
  MODIFY `sv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `t_verdict`
--
ALTER TABLE `t_verdict`
  MODIFY `tv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `fin_verdict`
--
ALTER TABLE `fin_verdict`
  ADD CONSTRAINT `R_7` FOREIGN KEY (`req_id`) REFERENCES `request` (`req_id`),
  ADD CONSTRAINT `R_9` FOREIGN KEY (`s_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `R_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `R_10` FOREIGN KEY (`r_id`) REFERENCES `race` (`r_id`);

--
-- Ограничения внешнего ключа таблицы `s_verdict`
--
ALTER TABLE `s_verdict`
  ADD CONSTRAINT `R_2` FOREIGN KEY (`req_id`) REFERENCES `request` (`req_id`),
  ADD CONSTRAINT `R_3` FOREIGN KEY (`sec_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `t_verdict`
--
ALTER TABLE `t_verdict`
  ADD CONSTRAINT `R_4` FOREIGN KEY (`req_id`) REFERENCES `request` (`req_id`),
  ADD CONSTRAINT `R_5` FOREIGN KEY (`tech_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
