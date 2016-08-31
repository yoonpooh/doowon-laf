CREATE TABLE users (
  id varchar(30) PRIMARY KEY,
  username varchar(15) NOT NULL,
  password varchar(50) NOT NULL
)

CREATE TABLE contents (
  no int PRIMARY KEY AUTO_INCREMENT,
  id VARCHAR(30) NOT NULL,
  type VARCHAR(10) NOT NULL,
  title VARCHAR(20) NOT NULL,
  location VARCHAR(30) NOT NULL,
  content varchar(100) not null,
  url varchar(50) not null,
  datetime DATETIME not null,
  FOREIGN KEY (id) REFERENCES users (id)
  ON DELETE CASCADE
)