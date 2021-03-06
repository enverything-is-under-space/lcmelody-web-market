CREATE TABLE t_customer
(
    `c_id` INT (4) AUTO_INCREMENT,
    `c_FL_name` VARCHAR (60) NOT NULL,
    `c_password` VARCHAR (250) NOT NULL,
    `c_phonenumer` VARCHAR (15) NOT NULL,
    `c_email` VARCHAR (60) NOT NULL,
    `c_attempts_TL` INT (1) DEFAULT('0'),
    `c_address` TEXT (250) NOT NULL,
    `c_registration` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`c_id`)

);

CREATE TABLE t_admin
(
    `a_id` INT (1) NOT NULL AUTO_INCREMENT,
    `a_email` VARCHAR (50) NOT NULL,
    `a_attempts_TL` INT (1) DEFAULT('0'),
    `a_first_pass` VARCHAR (250) NOT NULL,
    -- `a_second_pass` VARCHAR (250) NOT NULL,
    -- `a_third_pass` VARCHAR (250) NOT NULL,
    PRIMARY KEY (`a_id`)
);

CREATE TABLE t_ticket
(
    `t_id` INT (5) NOT NULL AUTO_INCREMENT,
    `t_subject` VARCHAR (159) NOT NULL,
    `t_status` INT (1) DEFAULT('3'),
    `t_email` VARCHAR (60) NOT NULL,
    `t_main_text` TEXT (2500) NOT NULL,
    `t_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`t_id`)
);

CREATE TABLE t_product
(
    `p_id` INT (3) AUTO_INCREMENT,
    `p_brand` VARCHAR (15) NOT NULL,
    `p_model` VARCHAR (15) NOT NULL,
    `p_title` VARCHAR (65) NOT NULL,
    `p_description` TEXT (2000) NOT NULL,
    `p_status` INT (5) DEFAULT('0'),
    `p_priority_TS` INT (1) DEFAULT('0'),
    `p_discount` VARCHAR (10) DEFAULT('0'),
    `p_summary_desc` varchar(1000) NOT NULL,
    `p_type` VARCHAR (15) DEFAULT('0'),
    `p_price` VARCHAR (10) DEFAULT('1,000'),
    `p_creator_aid` INT (1) NOT NULL,
    `p_amount` INT (3) DEFAULT('0'),
    `p_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`p_id`),
    FOREIGN KEY (`p_creator_aid`) REFERENCES t_admin(`a_id`) ON DELETE CASCADE
);

CREATE TABLE t_orders
(
    `o_id` INT (4) AUTO_INCREMENT,
    `o_status` INT (1) DEFAULT('2'),
    `o_PP` VARCHAR(11) DEFAULT('15000'),
    `o_PTC` VARCHAR (20) DEFAULT('0'),
    `o_PSC` INT (1) DEFAULT('0'),
    `o_owner_cid` INT (4) NOT NULL,
    `o_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`o_id`),
    FOREIGN KEY (`o_owner_cid`) REFERENCES t_customer(`c_id`) ON DELETE CASCADE
);

CREATE TABLE t_banners
(
    `b_id` INT (1) DEFAULT('0'),
    `special_product_a` VARCHAR (4) DEFAULT('1'),
    `special_product_b` VARCHAR (4) DEFAULT('1'),
    `special_product_c` VARCHAR (4) DEFAULT('1'),
    `special_product_d` VARCHAR (4) DEFAULT('2'),
    `special_product_e` VARCHAR (4) DEFAULT('2'),
    `special_product_f` VARCHAR (4) DEFAULT('2')
);

CREATE TABLE t_orders_items
(
    `oi_o_id` INT (4) NOT NULL,
    `oi_p_id` INT (3) NOT NULL,
    `oi_amount` INT (2) DEFAULT('1'),
    `oi_price` VARCHAR (10) DEFAULT('0'),
    `oi_discount` VARCHAR (10) DEFAULT('0'),
    PRIMARY KEY (`oi_o_id`,`oi_p_id`),
    FOREIGN KEY (`oi_o_id`) REFERENCES t_orders(`o_id`) ON DELETE CASCADE,
    FOREIGN KEY (`oi_p_id`) REFERENCES t_product(`p_id`) ON DELETE CASCADE
);

CREATE TABLE t_cart_list
(
    `cl_c_id` INT (4) NOT NULL,
    `cl_p_id` INT (4) NOT NULL,
    `cl_p_amount` INT (2) NOT NULL,
    PRIMARY KEY (`cl_p_id`,`cl_c_id`),
    FOREIGN KEY (`cl_c_id`) REFERENCES t_customer(`c_id`) ON DELETE CASCADE,
    FOREIGN KEY (`cl_p_id`) REFERENCES t_product(`p_id`) ON DELETE CASCADE
);


CREATE TABLE t_comment_verified
(
  `cv_c_id` INT (4) NOT NULL,
  `cv_p_id` INT (3) NOT NULL,
  `cv_text` VARCHAR (301) NOT NULL,
  `cv_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cv_c_id`,`cv_p_id`),
  FOREIGN KEY (`cv_c_id`) REFERENCES t_customer(`c_id`) ON DELETE CASCADE,
  FOREIGN KEY (`cv_p_id`) REFERENCES t_product(`p_id`) ON DELETE CASCADE
);


CREATE TABLE t_comment_confirm
(
  `cc_c_id` INT (4) NOT NULL,
  `cc_p_id` INT (3) NOT NULL,
  `cc_text` VARCHAR (301) NOT NULL,
  `cc_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cc_c_id`,`cc_p_id`),
  FOREIGN KEY (`cc_c_id`) REFERENCES t_customer(`c_id`) ON DELETE CASCADE,
  FOREIGN KEY (`cc_p_id`) REFERENCES t_product(`p_id`) ON DELETE CASCADE
);


CREATE TABLE t_ticket_customer_message
(
    `tm_id` INT (4) AUTO_INCREMENT,
    `tm_t_id` INT (5) NOT NULL,
    `tm_c_id` INT (4) NOT NULL,
    `tm_message_text` TEXT (2500) NOT NULL,
    `tm_appendixes` VARCHAR (650),
    `tm_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `tm_admin_mode` INT (1) DEFAULT('0'),
    PRIMARY KEY (`tm_id`),
    FOREIGN KEY (`tm_c_id`) REFERENCES t_customer(`c_id`) ON DELETE CASCADE,
    FOREIGN KEY (`tm_t_id`) REFERENCES t_ticket(`t_id`) ON DELETE CASCADE
);

CREATE TABLE t_ticket_admin_message
(
    `tm_id` INT (4) AUTO_INCREMENT,
    `tm_t_id` INT (5) NOT NULL,
    `tm_a_id` INT (1) NOT NULL,
    `tm_message_text` TEXT (2500) NOT NULL,
    `tm_appendixes` VARCHAR (500),
    `tm_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `tm_admin_mode` INT (1) DEFAULT('1'),
    PRIMARY KEY (`tm_id`),
    FOREIGN KEY (`tm_a_id`) REFERENCES t_admin(`a_id`) ON DELETE CASCADE,
    FOREIGN KEY (`tm_t_id`) REFERENCES t_ticket(`t_id`) ON DELETE CASCADE
);
