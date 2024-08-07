-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 24 2024 г., 21:41
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `crm_bd`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categorys`
--

CREATE TABLE `categorys` (
  `id` int NOT NULL,
  `name` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `categorys`
--

INSERT INTO `categorys` (`id`, `name`) VALUES
(1, 'Футболки'),
(2, 'Кофты'),
(3, 'штаны');

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int NOT NULL,
  `partner` int NOT NULL,
  `worker_id` int NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id` int NOT NULL,
  `first_name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `second_name` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `start_date_of_the_cooperation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `second_name`, `phone_number`, `email`, `address`, `birthday`, `start_date_of_the_cooperation`) VALUES
(1, 'Сос', 'Гулунов', 'не указан', 'sosgul999@gmail.com', '--', NULL, '2024-06-17 02:42:24'),
(2, 'Иван ', 'Иванов', '11111111111', '123', 'ффф', '2024-07-08', '2024-07-14 14:16:52');

-- --------------------------------------------------------

--
-- Структура таблицы `Finance`
--

CREATE TABLE `Finance` (
  `id` int NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `expenses` int DEFAULT NULL,
  `profit` int DEFAULT NULL,
  `taxes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `Finance`
--

INSERT INTO `Finance` (`id`, `date_start`, `date_end`, `expenses`, `profit`, `taxes`) VALUES
(3, '2024-07-11', '2024-07-31', 0, 0, 1000),
(4, '2024-05-08', '2024-08-15', 1000, 0, 1000),
(5, '2024-05-17', '2024-09-14', 1000, 15000, 500);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int NOT NULL,
  `chat_id` int NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isreaded` tinyint(1) NOT NULL DEFAULT '0',
  `worker_or_client` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `tovar_id` int NOT NULL,
  `date_order` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `count` int NOT NULL,
  `adress_order` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_order` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `tovar_id`, `date_order`, `count`, `adress_order`, `status_order`) VALUES
(2, 1, 3, '2024-06-28 17:22:46', 10, 'Проспект мира 1', 1),
(3, 1, 3, '2024-06-28 17:47:33', 5, 'Ленина 111', 1),
(4, 2, 3, '2024-07-14 14:17:31', 5, 'Центральная 2', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `purchase_tovar`
--

CREATE TABLE `purchase_tovar` (
  `id` int NOT NULL,
  `tovar_id` int NOT NULL,
  `count` int NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `purchase_tovar`
--

INSERT INTO `purchase_tovar` (`id`, `tovar_id`, `count`, `date`) VALUES
(1, 3, 5, '2024-07-08');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `id_client` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_reviews` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `id_client`, `rating`, `comment`, `date_reviews`) VALUES
(5, 2, 5, 'круто!!!!', '2023-07-23 12:47:57'),
(7, 2, 2, '(', '2024-07-24 14:43:43'),
(8, 2, 2, 'AAAA', '2024-07-24 14:54:24'),
(9, 2, 3, 'aa', '2024-07-24 15:04:47'),
(10, 1, 3, '123', '2024-07-24 15:07:06'),
(11, 2, 3, '123', '2024-07-24 16:44:58');

-- --------------------------------------------------------

--
-- Структура таблицы `size`
--

CREATE TABLE `size` (
  `id` int NOT NULL,
  `text` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `size`
--

INSERT INTO `size` (`id`, `text`) VALUES
(1, 'M'),
(2, 'L');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `name_task` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description_task` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deadline` date NOT NULL,
  `priority` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `responsible` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name_task`, `description_task`, `date_start`, `deadline`, `priority`, `status`, `responsible`) VALUES
(1, 'Продать 100 футболок', 'Продать 100 футболок за месяц и будет премия', '2024-06-26 11:40:23', '2024-07-26', 0, 0, 2),
(2, 'проснутся', 'без кофе', '2024-06-26 11:54:39', '2024-06-25', 1, 1, 8),
(3, 'нанять сотрудника', 'нанять сотрудника с опытом 5+ лет', '2024-06-28 15:32:47', '2024-06-30', 1, 1, 8),
(4, 'закупить ткань', 'закупить ткань на месяц', '2024-06-28 16:32:11', '2024-06-30', 1, 1, 8),
(5, 'задача 1', '---', '2024-06-28 16:35:23', '2024-06-18', 1, 1, 2),
(6, 'ooaallaaoo', '123', '2024-06-30 14:55:31', '2024-07-04', 1, 1, 8),
(7, 'задача1', 'aaa', '2024-07-22 09:15:09', '2014-08-16', 1, 0, 2),
(8, 'задача2', 'aaaa', '2024-07-22 09:15:27', '2024-08-31', 1, 0, 10),
(9, 'Продаться', 'ффф', '2024-07-24 16:38:33', '2024-07-31', 0, 0, 10),
(10, 'поспать', '123', '2024-07-24 16:44:46', '2024-07-26', 1, 0, 2),
(11, 'задача5', 'abc', '2024-07-24 16:51:49', '2024-07-26', 0, 0, 8),
(12, 'задача6', 'qwer', '2024-07-24 16:52:57', '2024-07-27', 1, 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `tovars`
--

CREATE TABLE `tovars` (
  `id` int NOT NULL,
  `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `season` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL,
  `size_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `tovars`
--

INSERT INTO `tovars` (`id`, `name`, `price`, `season`, `category_id`, `size_id`) VALUES
(3, 'Футболка', 1000, 'Осень-Зима', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE `workers` (
  `id` int NOT NULL,
  `first_name` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `second_name` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `start_work_date` date NOT NULL,
  `salary` int NOT NULL,
  `contact_information` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` date NOT NULL,
  `login` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_date_on_reviews` timestamp NULL DEFAULT NULL,
  `last_date_on_tasks` timestamp NULL DEFAULT NULL,
  `isAdminRoot` tinyint(1) NOT NULL DEFAULT '0',
  `id_position` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id`, `first_name`, `second_name`, `start_work_date`, `salary`, `contact_information`, `date_of_birth`, `login`, `password`, `last_date_on_reviews`, `last_date_on_tasks`, `isAdminRoot`, `id_position`) VALUES
(2, 'Адрей', 'Петров', '2024-06-06', 40000, 'q@gmail.com', '2003-06-04', 'qwerty1', 'asdf', NULL, NULL, 0, 1),
(8, 'Админ', 'Админов', '2024-06-18', 1, '+7 987 654 32 10', '2024-06-04', 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', '2024-07-24 16:57:22', '2024-07-24 16:57:22', 1, 1),
(10, 'Андрей', 'Иванов', '2024-07-03', 100000, '123', '2024-07-09', 'Ivanov', 'b0701e9801a02a25040f55555985b32f', '2024-07-24 16:57:08', '2024-07-24 16:57:08', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `WorkPosition`
--

CREATE TABLE `WorkPosition` (
  `id` int NOT NULL,
  `title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `WorkPosition`
--

INSERT INTO `WorkPosition` (`id`, `title`, `description`) VALUES
(1, 'Менеджер', '---'),
(2, 'упаковщик заказов', '---');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categorys`
--
ALTER TABLE `categorys`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`partner`),
  ADD KEY `worker_id` (`worker_id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Finance`
--
ALTER TABLE `Finance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `tovar_id` (`tovar_id`);

--
-- Индексы таблицы `purchase_tovar`
--
ALTER TABLE `purchase_tovar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tovar_id` (`tovar_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client` (`id_client`);

--
-- Индексы таблицы `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsible` (`responsible`);

--
-- Индексы таблицы `tovars`
--
ALTER TABLE `tovars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Индексы таблицы `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `id_position` (`id_position`);

--
-- Индексы таблицы `WorkPosition`
--
ALTER TABLE `WorkPosition`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categorys`
--
ALTER TABLE `categorys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `Finance`
--
ALTER TABLE `Finance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `purchase_tovar`
--
ALTER TABLE `purchase_tovar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `size`
--
ALTER TABLE `size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `tovars`
--
ALTER TABLE `tovars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `workers`
--
ALTER TABLE `workers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `WorkPosition`
--
ALTER TABLE `WorkPosition`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `chat_ibfk_3` FOREIGN KEY (`partner`) REFERENCES `workers` (`id`);

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`tovar_id`) REFERENCES `tovars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `purchase_tovar`
--
ALTER TABLE `purchase_tovar`
  ADD CONSTRAINT `purchase_tovar_ibfk_1` FOREIGN KEY (`tovar_id`) REFERENCES `tovars` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`);

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`responsible`) REFERENCES `workers` (`id`);

--
-- Ограничения внешнего ключа таблицы `tovars`
--
ALTER TABLE `tovars`
  ADD CONSTRAINT `tovars_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categorys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tovars_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `size` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `workers`
--
ALTER TABLE `workers`
  ADD CONSTRAINT `workers_ibfk_1` FOREIGN KEY (`id_position`) REFERENCES `WorkPosition` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
