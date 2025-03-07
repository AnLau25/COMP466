CREATE TABLE links(
   link_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   link_adr TEXT NOT NULL,
   link_name VARCHAR(50) NOT NULL,
   link_click INT DEFAULT 1,
   user_name VARCHAR(50)  NOT NULL,
   CONSTRAINT fk_user FOREIGN KEY (user_name) REFERENCES users(user_name) ON UPDATE CASCADE
);
--A chinga, mi plan funcionó (- 3 -)

INSERT INTO users (user_name, user_pswrd) VALUES 
    ('Messi', '10WhatIsPassword'), 
    ('Carlos', '55NotaSafePassowrd'); --populating, populating

--For XML
CREATE TABLE xml_storage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255),
    status ENUM('unread', 'read', 'tested') NOT NULL,
    xml_content LONGTEXT 
);