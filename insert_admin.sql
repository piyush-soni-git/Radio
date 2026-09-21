INSERT INTO users (email, auth_password, name, created_at, updated_at) 
VALUES ('admin@azuracast.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Radio Admin', UNIX_TIMESTAMP(), UNIX_TIMESTAMP());

INSERT INTO user_has_role (user_id, role_id) 
SELECT id, 1 FROM users WHERE email='admin@azuracast.com';
