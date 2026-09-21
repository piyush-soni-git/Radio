INSERT INTO users (id, email, auth_password, name, created_at, updated_at) 
VALUES (1, 'admin@azuracast.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Radio Admin', 1787935418, 1787935418);

INSERT INTO user_has_role (user_id, role_id) 
VALUES (1, 1);
