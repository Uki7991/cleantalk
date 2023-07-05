CREATE DATABASE IF NOT EXISTS cleantalk;

USE cleantalk;

CREATE TABLE IF NOT EXISTS jobs
(
    id         int        NOT NULL AUTO_INCREMENT,
    command    TEXT       NOT NULL,
    status     tinyint(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP           DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP           DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS employees
(
    id         int          NOT NULL AUTO_INCREMENT,
    first_name varchar(255) NOT NULL,
    last_name  varchar(255) NOT NULL,
    position   varchar(255) NULL,
    email      varchar(255) NULL,
    phone      varchar(255) NULL,
    notes      TEXT         NULL,
    manager_id INT          NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (manager_id) REFERENCES employees (id) ON UPDATE SET NULL ON DELETE SET NULL
);