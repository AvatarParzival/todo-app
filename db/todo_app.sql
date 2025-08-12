CREATE DATABASE IF NOT EXISTS todo_app
  DEFAULT CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE todo_app;

CREATE TABLE IF NOT EXISTS tasks (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  task_name VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

INSERT INTO tasks (task_name) VALUES ('Sample task – delete me!');