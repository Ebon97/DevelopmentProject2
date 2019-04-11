CREATE TABLE `appointments`
(
  `id` int PRIMARY KEY,
  `date_created` timestamp,
  `customer_id` int NOT NULL,
  `customer_name` varchar(255),
  `customer_contact` varchar(255),
  `staff_id` int,
  `services_booked` int NOT NULL,
  `created_at` datetime,
  `start_time` timestamp,
  `end_time_expected` timestamp,
  `end_time` timestamp,
  `price_final` decimal(10,2),
  `cancelled` bool,
  `cancellation_reason` text
);

CREATE TABLE `customers`
(
  `id` int PRIMARY KEY,
  `first_Name` varchar(64),
  `last_Name` varchar(64) NOT NULL,
  `contact_mobile` varchar(255) NOT NULL,
  `contact_email` varchar(255),
  `joined_since` datetime,
  `rec_by` int
);

CREATE TABLE `staffs`
(
  `id` int PRIMARY KEY,
  `first_Name` varchar(64),
  `lastName` varchar(64) NOT NULL,
  `joined_since` datetime
);

CREATE TABLE `services_booked`
(
  `id` int PRIMARY KEY,
  `appointment_id` int NOT NULL,
  `service_id` int NOT NULL,
  `total_price` decimal(10,2)
);

CREATE TABLE `services`
(
  `id` int PRIMARY KEY,
  `service_name` varchar(255) UNIQUE NOT NULL,
  `duration` int,
  `price` decimal(10,2),
  `package_id` int
);

CREATE TABLE `schedules`
(
  `id` int PRIMARY KEY,
  `staff_id` int NOT NULL,
  `from` timestamp,
  `to` timestamp
);

CREATE TABLE `products`
(
  `id` int PRIMARY KEY,
  `product_name` varchar(255) UNIQUE NOT NULL,
  `product_category_id` int,
  `manufacturer` varchar(255),
  `type_of_use` int,
  `status_id` int
);

CREATE TABLE `products_category`
(
  `id` int PRIMARY KEY,
  `name` varchar(255),
  `description` text
);

ALTER TABLE `appointments` ADD FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

ALTER TABLE `appointments` ADD FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);

ALTER TABLE `customers` ADD FOREIGN KEY (`rec_by`) REFERENCES `customers` (`id`);

ALTER TABLE `services_booked` ADD FOREIGN KEY (`id`) REFERENCES `appointments` (`services_booked`);

ALTER TABLE `services_booked` ADD FOREIGN KEY (`id`) REFERENCES `services` (`id`);

ALTER TABLE `services` ADD FOREIGN KEY (`package_id`) REFERENCES `services` (`id`);

ALTER TABLE `schedules` ADD FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);

ALTER TABLE `products` ADD FOREIGN KEY (`product_category_id`) REFERENCES `products_category` (`id`);
