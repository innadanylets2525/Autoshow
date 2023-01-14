-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 14 2023 г., 11:36
-- Версия сервера: 10.4.27-MariaDB
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bib_bab`
--

-- --------------------------------------------------------

--
-- Структура таблицы `buyer`
--

CREATE TABLE `buyer` (
  `id_client` bigint(20) UNSIGNED NOT NULL,
  `Initials` varchar(64) NOT NULL,
  `Phone_number` int(16) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `buyer`
--

INSERT INTO `buyer` (`id_client`, `Initials`, `Phone_number`, `Email`, `Password`) VALUES
(1, 'Наумова Д. Д.', 911744409, 'konstabelskamer@gmail.com', '557fEHZv9p'),
(2, 'Седова В. Ф.', 911993780, 'epithelioglandu@gmail.com', '6A4ak7M2aF'),
(3, 'Борисова М. А.', 985896202, 'ryokuju@gmail.com', 'sdzYZ3492U'),
(4, 'Смирнова А. Л.', 965247204, 'consults@gmail.com', 'nDALt244e9'),
(5, 'Данилова М. Д.', 990860557, 'kenshuuk@gmail.com', '56VMJrse66'),
(6, 'Соколов М. В.', 668587895, 'cubbyhouse@gmail.com', 'A5c72sH3Vi'),
(7, 'Климова І. Р.', 959537969, 'menacer@gmail.com', 'kLc59rR4B6'),
(8, 'Князева К. Е.', 938515617, 'porphyrine@gmail.com', 'sjY426PV7a'),
(9, 'Горбунова М. Э.', 926318726, 'plaatsvervangin@gmail.com', 'Mt3cp587DR'),
(10, 'Токарева В. В.', 664562224, 'abul@gmail.com', '75t65GHDts'),
(17, '1', 1, '1@gmail.com', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id_goods` bigint(20) UNSIGNED NOT NULL,
  `id_workers` bigint(20) UNSIGNED NOT NULL,
  `Mark` varchar(64) NOT NULL,
  `Year` date NOT NULL,
  `Color` varchar(64) NOT NULL,
  `Price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id_goods`, `id_workers`, `Mark`, `Year`, `Color`, `Price`) VALUES
(1, 4, 'Skoda', '2002-05-16', 'чорний', 297999),
(2, 6, 'Citroen', '1997-10-22', 'білий', 257823),
(3, 8, 'Lexus', '2003-01-22', 'Сірий', 750870),
(4, 1, 'Mazda', '2003-01-04', 'синій', 255150),
(5, 3, 'Mercedes-Benz', '1996-03-25', 'жовтий', 457609);

-- --------------------------------------------------------

--
-- Структура таблицы `order_1`
--

CREATE TABLE `order_1` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_supplier` bigint(20) UNSIGNED NOT NULL,
  `id_worker` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_1`
--

INSERT INTO `order_1` (`id`, `id_supplier`, `id_worker`) VALUES
(3, 1, 3),
(6, 2, 8),
(2, 3, 7),
(1, 4, 4),
(7, 4, 7),
(4, 8, 9),
(5, 10, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `order_2`
--

CREATE TABLE `order_2` (
  `id_order` bigint(20) UNSIGNED NOT NULL,
  `id_bueyr` bigint(20) UNSIGNED NOT NULL,
  `id_goods` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order_2`
--

INSERT INTO `order_2` (`id_order`, `id_bueyr`, `id_goods`) VALUES
(3, 2, 2),
(2, 4, 5),
(1, 5, 1),
(4, 8, 3),
(5, 10, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` bigint(20) UNSIGNED NOT NULL,
  `Initials` varchar(64) NOT NULL,
  `Company` varchar(64) NOT NULL,
  `Phone_number` int(16) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `Initials`, `Company`, `Phone_number`, `Email`, `Password`) VALUES
(1, 'Князев Ф. А.', 'Boge', 992980087, 'bautizo@gmail.com', 'vi4AC99aE5'),
(2, 'Кондратев Т. Р.', 'Signav', 918202343, 'potensialene@gmail.com', '9cnnX65N8T'),
(3, 'Волкова Е. А.', 'Sachs', 937328425, 'bekendmaak@gmail.com', 'G8bc7iHH32'),
(4, 'Круглова К. А.', 'Lucas', 967307231, 'ruzycki@gmail.com', '3837BebyPA'),
(5, 'Фомичев І. П.', 'Valeo', 932307414, 'unhoardi@gmail.com', '4sEx5B9P7z'),
(6, 'Попов А. І.', 'Flennor', 915675090, 'bergkloven@gmail.com', '8f8eZL7d7E'),
(7, 'Тихонова В. П.', 'GKN-Spidan', 985940892, 'inadequat@gmail.com', 'mf855DTc3B'),
(8, 'Артемова А. Н.', 'National', 637657292, 'hexametrist@gmail.com', 'k9L2R57enM'),
(9, 'Белова А. І.', 'SNR', 960665676, 'vectors@gmail.com', 'Dv8n3NyP49'),
(10, 'Королев З. Ю.', 'Moog', 919687787, 'professeront@gmail.com', '6Y5k8YLsk9');

-- --------------------------------------------------------

--
-- Структура таблицы `workers`
--

CREATE TABLE `workers` (
  `id_worker` bigint(20) UNSIGNED NOT NULL,
  `Initials` varchar(64) NOT NULL,
  `Phone_number` int(16) NOT NULL,
  `Email` varchar(32) NOT NULL,
  `Password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `workers`
--

INSERT INTO `workers` (`id_worker`, `Initials`, `Phone_number`, `Email`, `Password`) VALUES
(1, 'Старостин П. В.', 950694925, 'professeront@gmail.com', 'b4NY485efM'),
(2, 'Ермакова А. Ф.', 963389654, 'liftmen@gmail.com', '4Ket47Ba2U'),
(3, 'Зиновев І. М.', 978878687, 'zotheden@gmail.com', '89ir4v4JJE'),
(4, 'Лопатина К. А.', 996327216, 'indultar@gmail.com', '27LV33vpvG'),
(5, 'Семенов Т. К.', 928444427, 'overproduction@gmail.com', 'e6K2r8pYL5'),
(6, 'Маслов С. Д.', 938782148, 'nachbestelltes@gmail.com', 'tH2c2b3P6C'),
(7, 'Бикова М. К.', 997849687, 'masquerade@gmail.com', 'J4t53nV8iX'),
(8, 'Никифоров Г. А.', 969504817, 'climbeth@gmail.com', 'gc853A3zKF'),
(9, 'Ефремова Е. О.', 936979204, 'thingamajigs@gmail.com', '8VL44v8Kei'),
(10, 'Майоров З. Д.', 673989047, 'ddp@gmail.com', 'sU5vm4EJ85');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `id_client` (`id_client`);

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id_goods`),
  ADD UNIQUE KEY `id_goods` (`id_goods`),
  ADD KEY `id_workers` (`id_workers`);

--
-- Индексы таблицы `order_1`
--
ALTER TABLE `order_1`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_supplier` (`id_supplier`,`id_worker`),
  ADD KEY `id_worker` (`id_worker`);

--
-- Индексы таблицы `order_2`
--
ALTER TABLE `order_2`
  ADD UNIQUE KEY `id_order` (`id_order`),
  ADD KEY `id_bueyr` (`id_bueyr`,`id_goods`),
  ADD KEY `id_goods` (`id_goods`);

--
-- Индексы таблицы `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD UNIQUE KEY `id` (`id_supplier`);

--
-- Индексы таблицы `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`id_worker`),
  ADD UNIQUE KEY `id_worker` (`id_worker`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `buyer`
--
ALTER TABLE `buyer`
  MODIFY `id_client` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id_goods` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `order_1`
--
ALTER TABLE `order_1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `order_2`
--
ALTER TABLE `order_2`
  MODIFY `id_order` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `workers`
--
ALTER TABLE `workers`
  MODIFY `id_worker` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `goods`
--
ALTER TABLE `goods`
  ADD CONSTRAINT `goods_ibfk_1` FOREIGN KEY (`id_workers`) REFERENCES `workers` (`id_worker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_1`
--
ALTER TABLE `order_1`
  ADD CONSTRAINT `order_1_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_1_ibfk_2` FOREIGN KEY (`id_worker`) REFERENCES `workers` (`id_worker`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_2`
--
ALTER TABLE `order_2`
  ADD CONSTRAINT `order_2_ibfk_1` FOREIGN KEY (`id_goods`) REFERENCES `goods` (`id_goods`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_2_ibfk_2` FOREIGN KEY (`id_bueyr`) REFERENCES `buyer` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
