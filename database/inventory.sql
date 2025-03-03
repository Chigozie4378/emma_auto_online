

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO manufacturer VALUES("9","e60028d10cdfc98e2d55b0653842d38f","UNIGO");
INSERT INTO manufacturer VALUES("10","394faca717cceca47d60e10b84f48b76","CHANLIN");
INSERT INTO manufacturer VALUES("11","536de2205ff227a57ca7e2f38be9a2e5","SHIRORO");
INSERT INTO manufacturer VALUES("12","18ccd4490df874b8823ce36378c28d23","JEELY");





CREATE TABLE `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO model VALUES("10","c5ee05a8a39ed474f492e239e078d235","AX100");
INSERT INTO model VALUES("11","e827453179cb75f5a5eb80bfccdfbe8f","BX100");
INSERT INTO model VALUES("12","3c4407c30786f77431dd2ba750bccb5d","CB125");
INSERT INTO model VALUES("13","45092cf6afa1513623ae23dcc9c6a2ef","CB110");
INSERT INTO model VALUES("14","9bcf68b4d0329f8bc13050d6819bbe49","CG125");





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






CREATE TABLE `online_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `online_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






CREATE TABLE `online_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO online_products VALUES("20","71b0ad3bac450e9","CHAIN AND SPROCKET","AX100","UNIGO","../assets/images/products/CHAIN AND SPROCKET");
INSERT INTO online_products VALUES("21","30af03e6fdcecee","4 DOTS WHITE LIGHT","AX100","CHANLIN","../assets/images/products/4 DOTS WHITE LIGHT.JPG");
INSERT INTO online_products VALUES("22","37a5182723ab685","4 BULBS LONGCYT","BX100","CHANLIN","../assets/images/products/4BULBS LONGCYT.JPG");
INSERT INTO online_products VALUES("23","63de832f8a5e9f4","4 MINUTES GUM","CB125","SHIRORO","../assets/images/products/4MINUTES GUM.JPG");
INSERT INTO online_products VALUES("24","b45858f53ff9329","5 DOTS LIGHT STEADY","CB125","SHIRORO","../assets/images/products/5 DOTS LIGHT STEADY.JPG");
INSERT INTO online_products VALUES("25","dbfe21c4811455b","6 DOTS LIGHT MULTIPLE","CB125","SHIRORO","../assets/images/products/6 DOTS LIGHT MULTIPLE.JPG");
INSERT INTO online_products VALUES("26","aad8178944fc2a9","6 DOTS LIGHT ORIGINAL","CB125","SHIRORO","../assets/images/products/6 DOTS LIGHT ORIGINAL.JPG");
INSERT INTO online_products VALUES("28","8e0ec62b4a5b21d","CHAIN AND SPROCKET","CB110","CHANLIN","../assets/images/products/CHAIN AND SPROCKET");





CREATE TABLE `online_sub_category` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;






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




