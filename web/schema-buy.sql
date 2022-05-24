-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 24 2022 г., 16:07
-- Версия сервера: 8.0.24
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `buy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth`
--

CREATE TABLE `auth` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `source` varchar(255) NOT NULL,
  `sourse_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `auth`
--

INSERT INTO `auth` (`id`, `user_id`, `source`, `sourse_id`) VALUES
(1, 12, 'vkontakte', '390471339');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Дом'),
(2, 'Авто'),
(3, 'Спорт и отдых'),
(4, 'Электроника'),
(5, 'Одежда'),
(6, 'Книги');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `text` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `offer_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `text`, `created_at`, `user_id`, `offer_id`) VALUES
(1, 'Есть возможность изготовить из груши разумной', '2022-04-13 12:06:15', 2, 6),
(2, 'А можете сделать сундук из груши разумной? Мне для для путешествия в Анк МорПок', '2022-04-13 14:04:16', 12, 6),
(3, 'Хороший коврик, и не дорого, я считаю', '2022-04-18 16:45:33', 12, 5),
(4, 'А я думаю что дорого, соотношение цена-качество меня не устраивает, хотелось бы дешевле и качественнее.', '2022-04-18 16:50:46', 1, 5),
(5, 'Отличное телка, неплохой мячик, рекомендую', '2022-04-18 16:58:09', 1, 3),
(7, 'Нда, ведь груши разумной не бывает, это миф', '2022-04-19 10:50:43', 1, 6),
(8, 'Комент, коментарий, комментарий, описание вопрос', '2022-04-19 10:52:02', 1, 8),
(13, 'четкий плащик, и телка ниче так', '2022-04-27 09:02:20', 12, 8),
(14, 'да, получилось исправить глюк', '2022-05-16 13:05:20', 12, 5),
(15, 'Мир лучше войны, гораздо лучше', '2022-05-16 16:25:23', 12, 9),
(16, 'да да да точно правда правда', '2022-05-16 16:33:38', 12, 9),
(17, 'Again some commetn it\'s true', '2022-05-16 17:40:36', 1, 7),
(19, 'yes really good girl i want her', '2022-05-23 11:22:38', 12, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1647924729),
('m220319_151752_create_users_table', 1647924734),
('m220320_065616_add_is_moderator_column_to_users_table', 1647924734),
('m220320_070645_create_categories_table', 1647924734),
('m220320_074807_create_offers_table', 1647924734),
('m220320_080034_create_comments_table', 1647924734),
('m220329_163126_create_auth_table', 1648642775),
('m220331_165755_insert_data_to_categories_table', 1648813450),
('m220418_112343_add_number_comments_column_to_offers_table', 1650281694);

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE `offers` (
  `id` int NOT NULL,
  `title` varchar(128) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `price` int NOT NULL,
  `type` int NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `number_comments` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `offers`
--

INSERT INTO `offers` (`id`, `title`, `img`, `price`, `type`, `description`, `created_at`, `user_id`, `category_id`, `number_comments`) VALUES
(1, 'Ауди крутая и красивая', 'uploads/audi.jpg', 1000000, 2, 'Продам машину дорого и не срочно, хорошая такая, мощная и быстрая', '2022-04-13 11:48:45', 12, 2, 0),
(2, 'Хочу купить бэху', 'uploads/bmw.jpg', 5000000, 0, 'Я, гордый осенившей меня идеей, отвёл майора в помещение охраны.  Система наблюдения была обесточена, но пара щелчков переключателями привела её в рабочее состояние — загорелись лампочки индикаторов, моргнув, ожили мониторы. Бледные и чёрно-белые, но вполне чёткие картинки подходов к замку, ворота снаружи, ворота изнутри, двор с трёх ракурсов, панорама города', '2022-04-13 11:50:57', 12, 2, 0),
(3, 'Мячик с телкой', 'uploads/boll.jpg', 3000, 0, ' ИК-подсветка и ночной режим. А главное — есть функция слежения. Реагирует на движение в кадре, автоматически включает запись, можно звуковой сигнал настроить. И не надо в карауле никому стоять! На снегу вообще чётко всё будет отсекать, контраст высокий.', '2022-04-13 11:54:24', 1, 3, 2),
(4, 'Боксерские перчатки', 'uploads/boxing.jpg', 2000, 2, 'ошловато-роскошное помещение носило следы проживания значительного количества не очень бережно относившихся к интерьеру людей. С тех пор, как меня здесь провели с импровизированной экскурсией, хозяйские апартаменты лишились своего грандиозного траходрома, зато украсились десятком раскладушек, кучей серых ящиков и грубо сваренной приборной стойкой, набитой большими автомобильными аккумуляторами и преобразователями. На огромном экране телевизора теснились мозаикой картинки с внутренних камер. Надо же, а я и забыл про то, что здесь есть подключение. В проекте было, но монтировал его не я, вот и вылетело из башки.', '2022-04-13 11:58:44', 1, 3, 0),
(5, 'Коврик для йоги', 'uploads/carpet.jpg', 5001, 2, 'ошловато-роскошное помещение носило следы проживания значительного количества не очень бережно относившихся к интерьеру людей. С тех пор, как меня здесь провели с импровизированной экскурсией, хозяйские апартаменты лишились своего грандиозного траходрома, зато украсились десятком раскладушек, кучей серых ящиков и грубо сваренной приборной стойкой, набитой большими автомобильными аккумуляторами и преобразователями. ', '2022-04-13 12:01:40', 2, 3, 3),
(6, 'Мебель в дом из массива', 'uploads/chairs.jpg', 300000, 2, 'Изготовлю и продам мебель в дом из массива какого-нибудь дерева.', '2022-04-13 12:03:53', 2, 1, 1),
(7, 'Часики тик-так', 'uploads/clocks.jpg', 1000, 2, 'Продам часы любые и разные, всякие разнообразные, синие и красные, желтые и черные.', '2022-04-18 14:29:08', 12, 4, 1),
(8, 'Белый плащик', 'uploads/coat.jpg', 6000, 2, 'Прекрасный плащик, белый снаружи и пушистый внутри', '2022-04-18 16:54:42', 1, 5, 2),
(9, 'Лев Толстой \"Война и мир\"', 'uploads/война и мир.jpg', 500, 2, 'Продается книга Толстого, самая главная его книга, я ее не читал, но осуждаю', '2022-04-21 10:07:32', 12, 6, 2),
(10, 'Красные наушники', 'uploads/head phone.jpg', 2532, 2, 'Красивые красные наушники, в отличном состоянии, почти новые продам не дорого. Звук хороший вид еще лучше.', '2022-05-24 15:32:32', 12, 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `date_registration` datetime DEFAULT CURRENT_TIMESTAMP,
  `avatar` varchar(255) DEFAULT NULL,
  `is_moderator` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `date_registration`, `avatar`, `is_moderator`) VALUES
(1, 'User Some', 'hero34@mail.ru', '$2y$13$5IHweT9JfF2alF1qWjHJyuv1VPBtW.bedrKAyVnsNFNDGWZ20upRS', '2022-03-30 13:24:20', '/uploads/IMG_20220301_113727.jpg', NULL),
(2, 'Пользователь', 'buy22052022@mail.ru', '$2y$13$6mmLEixdDl1.kgVq/duBseM3FsET.gqYqCePXBqR0PwsT3EgSHZ2i', '2022-03-30 13:26:57', '/uploads/IMG_20220301_131521_1.jpg', NULL),
(12, 'Ярослав Савельев', 't89191202527@gmail.com', 'qx0akY', '2022-04-01 09:45:08', 'https://sun3-10.userapi.com/s/v1/if1/3Z8bWKyPIdM0bNAlSBiW49frqqHikuJ02BQ6ch18WJYZDzlFTtZZAxtFNtcV98GGQ0g2Zg.jpg?size=50x50&quality=96&crop=324,161,613,613&ava=1', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-auth-user_id` (`user_id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-comments-user_id` (`user_id`),
  ADD KEY `idx-comments-offer_id` (`offer_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-offers-user_id` (`user_id`),
  ADD KEY `idx-offers-category_id` (`category_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk-auth-user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk-comments-offer_id` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-comments-user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `fk-offers-category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-offers-user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
