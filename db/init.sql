
CREATE TABLE categories (
  id int(11) AUTO_INCREMENT PRIMARY KEY,
  name varchar(150) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  deleted tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE news (
  id int(11)  AUTO_INCREMENT PRIMARY KEY,
  title varchar(255) NOT NULL,
  category_id int(11) NOT NULL,
  details text NOT NULL,
  image varchar(255) DEFAULT NULL,
  user_id int(11) NOT NULL,
  deleted tinyint(1) DEFAULT 0,
  created_at timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE users (
  id int(11)  AUTO_INCREMENT PRIMARY KEY,
  name varchar(100) NOT NULL,
  email varchar(150) NOT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
