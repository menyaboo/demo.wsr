-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2024 г., 22:20
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
-- База данных: `service`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `message` text NOT NULL,
  `service_request_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`, `code`) VALUES
(1, 'Заказчик', 'client'),
(2, 'Оператор', 'admin'),
(3, 'Мастер', 'master'),
(4, 'Менеджер', 'manager');

-- --------------------------------------------------------

--
-- Структура таблицы `service_order`
--

CREATE TABLE `service_order` (
  `id` int NOT NULL,
  `is_executor` tinyint(1) NOT NULL DEFAULT '0',
  `service_requests_id` int NOT NULL,
  `employee_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `service_order_spare`
--

CREATE TABLE `service_order_spare` (
  `id` int NOT NULL,
  `service_order_id` int NOT NULL,
  `spare_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `service_request`
--

CREATE TABLE `service_request` (
  `id` int NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tech_type` varchar(32) NOT NULL,
  `tech_model` varchar(32) NOT NULL,
  `description` text NOT NULL,
  `completion_date` datetime NOT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  `client_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `service_request_status`
--

CREATE TABLE `service_request_status` (
  `id` int NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `spare`
--

CREATE TABLE `spare` (
  `id` int NOT NULL,
  `name` int NOT NULL,
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `surname` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `patronymic` varchar(32) DEFAULT NULL,
  `phone` varchar(16) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `surname`, `name`, `patronymic`, `phone`, `login`, `password`, `role_id`) VALUES
(1, 'Трубин', 'Никита', 'Юрьевич', '89210563128', 'kasoo', 'root', 4),
(2, 'Мурашов', 'Андрей', 'Юрьевич', '89535078985', 'murashov123', 'qwerty', 3),
(3, 'Степанов', 'Андрей', 'Викторович', '89210673849', 'test1', 'test1', 3),
(4, 'Перина', 'Анастасия', 'Денисовна', '89990563748', 'perinaAD', '250519', 2),
(7, 'Мажитова', 'Ксения', 'Сергеевна', '89994563847', 'krutiha1234567', '1234567890', 2),
(8, 'Семенова', 'Ясмина', 'Марковна', '89994563848', 'login1', 'pass1', 3),
(9, 'Баранова', 'Эмилия', 'Марковна', '89994563841', 'login2', 'pass2', 1),
(10, 'Егорова', 'Алиса', 'Платоновна', '89994563842', 'login3', 'pass3', 1),
(11, 'Титов', 'Максим', 'Иванович', '89994563843', 'login4', 'pass4', 1),
(12, 'Иванов', 'Марк', 'Максимович', '89994563844', 'login5', 'pass5', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_request_id` (`service_request_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `service_order`
--
ALTER TABLE `service_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_requests_id` (`service_requests_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Индексы таблицы `service_order_spare`
--
ALTER TABLE `service_order_spare`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_order_id` (`service_order_id`),
  ADD KEY `spare_id` (`spare_id`);

--
-- Индексы таблицы `service_request`
--
ALTER TABLE `service_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Индексы таблицы `service_request_status`
--
ALTER TABLE `service_request_status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `spare`
--
ALTER TABLE `spare`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `service_order`
--
ALTER TABLE `service_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `service_order_spare`
--
ALTER TABLE `service_order_spare`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `service_request`
--
ALTER TABLE `service_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `service_request_status`
--
ALTER TABLE `service_request_status`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `spare`
--
ALTER TABLE `spare`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`service_request_id`) REFERENCES `service_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `service_order`
--
ALTER TABLE `service_order`
  ADD CONSTRAINT `service_order_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_order_ibfk_2` FOREIGN KEY (`service_requests_id`) REFERENCES `service_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `service_order_spare`
--
ALTER TABLE `service_order_spare`
  ADD CONSTRAINT `service_order_spare_ibfk_1` FOREIGN KEY (`service_order_id`) REFERENCES `service_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_order_spare_ibfk_2` FOREIGN KEY (`spare_id`) REFERENCES `spare` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `service_request`
--
ALTER TABLE `service_request`
  ADD CONSTRAINT `service_request_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `service_request_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `service_request_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
