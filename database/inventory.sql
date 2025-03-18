

CREATE TABLE `bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `transfer_amount` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `staff` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4095 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `bulk_sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `debit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` int(10) NOT NULL,
  `deposit` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1341 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `debit_histories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total` int(10) NOT NULL,
  `deposit` int(10) NOT NULL,
  `total_paid` int(10) NOT NULL,
  `balance` int(10) NOT NULL,
  `total_balance` int(10) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10434 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `cash` varchar(255) NOT NULL,
  `transfer` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `deposit_amount` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `staff` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `deposit_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `staff` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=712 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `manufacturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO manufacturer VALUES("9","e60028d10cdfc98e2d55b0653842d38f","UNIGO");
INSERT INTO manufacturer VALUES("10","394faca717cceca47d60e10b84f48b76","CHANLIN");
INSERT INTO manufacturer VALUES("11","536de2205ff227a57ca7e2f38be9a2e5","SHIRORO");
INSERT INTO manufacturer VALUES("12","18ccd4490df874b8823ce36378c28d23","JEELY");
INSERT INTO manufacturer VALUES("13","285439832c29c6bebce508c0815d072d","JHIENG");





CREATE TABLE `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO model VALUES("10","c5ee05a8a39ed474f492e239e078d235","AX100");
INSERT INTO model VALUES("11","e827453179cb75f5a5eb80bfccdfbe8f","BX100");
INSERT INTO model VALUES("12","3c4407c30786f77431dd2ba750bccb5d","CB125");
INSERT INTO model VALUES("13","45092cf6afa1513623ae23dcc9c6a2ef","CB110");
INSERT INTO model VALUES("14","9bcf68b4d0329f8bc13050d6819bbe49","CG125");
INSERT INTO model VALUES("15","e53a1e7495ada73658e3cfd8682102a8","HJ125");
INSERT INTO model VALUES("16","ede1ebd8be2ec555d2822e8dc80a3102","CG110");
INSERT INTO model VALUES("17","2c0726a3d2d7271d99c58eea5d5940e7","CG200");
INSERT INTO model VALUES("18","a7116d478abd997b145b2941ff6f9f5f","BX125");
INSERT INTO model VALUES("19","44be12493c4e286f7bcea52c87fab33a","CD110");





CREATE TABLE `online_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `online_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `online_order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO online_order_details VALUES("1","75417411545ba04ab8a650eee53bc4","30af03e6fdcecee","5","700","3500");
INSERT INTO online_order_details VALUES("2","75417411545ba04ab8a650eee53bc4","dbf30e53a70f15c","10","3200","32000");
INSERT INTO online_order_details VALUES("3","75417411545ba04ab8a650eee53bc4","9539a19444b8599","50","4800","240000");
INSERT INTO online_order_details VALUES("4","d445a82eda369b805b4828e6c070a3","30af03e6fdcecee","10","700","7000");
INSERT INTO online_order_details VALUES("5","d445a82eda369b805b4828e6c070a3","b45858f53ff9329","10","5000","50000");
INSERT INTO online_order_details VALUES("6","d445a82eda369b805b4828e6c070a3","dbfe21c4811455b","5","6000","30000");
INSERT INTO online_order_details VALUES("7","d445a82eda369b805b4828e6c070a3","aad8178944fc2a9","5","5000","25000");
INSERT INTO online_order_details VALUES("8","e892bb7cfcff021eae4bb5968d91c7","1751eeb421c3355","10","7500","75000");
INSERT INTO online_order_details VALUES("9","e892bb7cfcff021eae4bb5968d91c7","ac0bbde620ff18e","10","4600","46000");





CREATE TABLE `online_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO online_orders VALUES("1","676f5f190588c4226ae40f17997c61","75417411545ba04ab8a650eee53bc4","INV-886A3290","275500","pending","2025-03-17 09:49:24");
INSERT INTO online_orders VALUES("2","676f5f190588c4226ae40f17997c61","d445a82eda369b805b4828e6c070a3","INV-0F248FE1","112000","pending","2025-03-17 09:56:20");
INSERT INTO online_orders VALUES("3","676f5f190588c4226ae40f17997c61","e892bb7cfcff021eae4bb5968d91c7","INV-ADFADEB9","121000","pending","2025-03-17 13:29:43");





CREATE TABLE `online_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO online_products VALUES("21","30af03e6fdcecee","4 DOTS WHITE IGHT","AX100","CHANLIN","700","../assets/images/products/4 DOTS WHITE LIGHT.JPG");
INSERT INTO online_products VALUES("22","37a5182723ab685","4 BULBS LONGCYT","BX100","CHANLIN","600","../assets/images/products/4BULBS LONGCYT.JPG");
INSERT INTO online_products VALUES("23","63de832f8a5e9f4","4 MINUTES GUM","CB125","SHIRORO","600","../assets/images/products/4MINUTES GUM.JPG");
INSERT INTO online_products VALUES("24","b45858f53ff9329","5 DOTS LIGHT STEADY","CB125","SHIRORO","5000","../assets/images/products/5 DOTS LIGHT STEADY.JPG");
INSERT INTO online_products VALUES("25","dbfe21c4811455b","6 DOTS LIGHT MULTIPLE","CB125","SHIRORO","6000","../assets/images/products/6 DOTS LIGHT MULTIPLE.JPG");
INSERT INTO online_products VALUES("26","aad8178944fc2a9","6 DOTS LIGHT ORIGINAL","CB125","SHIRORO","5000","../assets/images/products/6 DOTS LIGHT ORIGINAL.JPG");
INSERT INTO online_products VALUES("28","8e0ec62b4a5b21d","CHAIN AND SPROCKET","CB110","CHANLIN","3000","../assets/images/products/CHAIN AND SPROCKET");
INSERT INTO online_products VALUES("29","37de14722bfef00","ENGINE BLOCK","CB125","CHANLIN","3500","../assets/images/products/ENGINE BLOCK");
INSERT INTO online_products VALUES("30","30bbcb555cf9eb4","CRANKSHAFT","BX100","CHANLIN","15000","../assets/images/products/CRANKSHAFT");
INSERT INTO online_products VALUES("31","1751eeb421c3355","FLASHING 6 DOTS LIGHT - COPY","BX100","UNIGO","7500","../assets/images/products/FLASHING 6 DOTS LIGHT - COPY.JPG");
INSERT INTO online_products VALUES("32","affc8f1ea62e17d","FLY REFLECTOR LIGHT - COPY","CB125","JEELY","4500","../assets/images/products/FLY REFLECTOR LIGHT - COPY.JPG");
INSERT INTO online_products VALUES("33","6a8ffbbcbfe035f","FOOTREST RUBBER - COPY","CB110","CHANLIN","6500","../assets/images/products/FOOTREST RUBBER - COPY.JPG");
INSERT INTO online_products VALUES("34","eb5daa012134ea5","FORK RUBBER - COPY","CG125","JEELY","5200","../assets/images/products/FORK RUBBER - COPY.JPG");
INSERT INTO online_products VALUES("35","dbf30e53a70f15c","FOUR FACE BAJAJ BULB - COPY","AX100","CHANLIN","3200","../assets/images/products/FOUR FACE BAJAJ BULB - COPY.JPG");
INSERT INTO online_products VALUES("36","9539a19444b8599","CRANKSHAFT","AX100","SHIRORO","4800","../assets/images/products/CRANKSHAFT");
INSERT INTO online_products VALUES("37","ba477ff7c62c424","SHOE BRAKE","BX100","CHANLIN","5000","../assets/images/products/SHOE BRAKE");
INSERT INTO online_products VALUES("38","1504fdca1b63467","CHAIN AND SPROCKET","CB110","SHIRORO","5100","../assets/images/products/CHAIN AND SPROCKET");
INSERT INTO online_products VALUES("40","71ce53eb92542e9","V5 BULB CYT","BX100","JEELY","8500","../assets/images/products/V5 BULB CYT.JPG");
INSERT INTO online_products VALUES("41","93b94c845766a97","VALVE LIGHT","CB110","CHANLIN","8400","../assets/images/products/VALVE LIGHT.JPG");
INSERT INTO online_products VALUES("42","ff9d50b831d1891","WIPER AID","CB125","SHIRORO","8600","../assets/images/products/WIPER AID.JPG");
INSERT INTO online_products VALUES("43","d1778016b63c08d","WORK LIGHT CYT SMALL","CG125","SHIRORO","780","../assets/images/products/WORK LIGHT CYT SMALL.JPG");
INSERT INTO online_products VALUES("44","c434c06a133eb4d","VISA BOUND","AX100","JEELY","6800","../assets/images/products/VISA BOUND.JPG");
INSERT INTO online_products VALUES("45","3e2004f7e64fef1","WHITE GUM","CB110","CHANLIN","5200","../assets/images/products/WHITE GUM.JPG");
INSERT INTO online_products VALUES("46","dab2c738b55dba0","CHAIN AND SPROCKET","BX100","SHIRORO","4700","../assets/images/products/CHAIN AND SPROCKET");
INSERT INTO online_products VALUES("49","f87dfd994651e0e","CHAIN AND SPROCKET","BX100","CHANLIN","4570","../assets/images/products/CHAIN AND SPROCKET");
INSERT INTO online_products VALUES("50","ac0bbde620ff18e","CHAIN AND SPROCKET","AX100","UNIGO","4600","../assets/images/products/CHAIN AND SPROCKET");





CREATE TABLE `online_sub_category` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `online_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO online_users VALUES("1","676f5f190588c4226ae40f17997c61","MRS Dele","IRAGBIJI","+2347035483213","ezesunny4378@gmail.com","$2y$10$A8tmpQxxgvaE3wymhu7oROKy4h/LqsK7EjdFxB6HuXQCclMgwnpwq","2025-03-16 21:25:27");





CREATE TABLE `pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `pos_type` varchar(255) NOT NULL,
  `pos_charges` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53094 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `producer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distributor` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `cprice` int(255) NOT NULL,
  `wprice` int(255) NOT NULL,
  `rprice` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3932 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `productname` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `price` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `registered` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date_registered` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `return_each_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1020 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `return_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `cash` varchar(255) NOT NULL,
  `transfer` varchar(255) NOT NULL,
  `pos` varchar(255) NOT NULL,
  `old_deposit` varchar(255) NOT NULL,
  `deposit` varchar(255) NOT NULL,
  `transport` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `return_goods_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3071 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `cash` varchar(255) NOT NULL,
  `transfer` varchar(255) NOT NULL,
  `pos` varchar(265) NOT NULL,
  `old_deposit` varchar(255) NOT NULL,
  `deposit` varchar(255) NOT NULL,
  `transport` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53158 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `sales_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `customer_type` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `staff_name` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `supply_check` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `supplied_by` varchar(255) NOT NULL,
  `checked_by` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




