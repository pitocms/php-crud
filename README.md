## Install process 

### Using docker 
    - docker command 
        ```
            docker-compose build 
            docker-compose up 
        ```

## Access URL 
    - http://localhost:9000/
## PHP myadmin 
    - http://localhost:9001/

## PHP myadmin credentials 
    - Host : mysql_db
    - user : root
    - password : root 

## SQL Script to Create the Tables

```
CREATE DATABASE user_management;

USE user_management;

-- Table for roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255)
);

-- Insert default roles
INSERT INTO roles (role_name, description) VALUES
('admin', 'Administrator with full permissions'),
('user', 'Regular user with limited permissions');

-- Table for users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);
```

## Create dummy user 

```

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'alimon', 'test@gmail.com', '$2y$10$/TJsUuB5TlwsiG.nsjcLPuvKgPF3dtWVxwV3DeofCcZHXKhyeiK1W', 1, '2024-06-09 17:42:05', '2024-06-09 18:13:22'),
(2, 'pitocms', 'pitocms@yahoo.com', '$2y$10$635ReOz3hJyGlVMS7vEH6.iM.LaNGZWxsqne1rNuivEHjYCa6sB9W', 1, '2024-06-09 17:49:59', '2024-06-09 17:49:59'),
(3, 'abcd@gmail.com', 'abcd@gmail.com', '$2y$10$yQrWvJENTEYZpAd5.f4Axe4BXUyv8o48jj8LRSHU4HY.xBVa1VDEW', 2, '2024-06-10 06:01:25', '2024-06-10 06:05:54');

```

## Login credentials after import dummy user 

- Email : test@gmail.com
- Password : password
