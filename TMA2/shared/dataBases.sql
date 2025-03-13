--Bookmarks database for part1
CREATE DATABASE bookmarks;

--For user identification
CREATE TABLE users(
   user_name VARCHAR(50) NOT NULL PRIMARY KEY,
   user_pswrd VARCHAR(255) NOT NULL --VERY IMPORTANT FOR HASHING    
);

--For link storage
CREATE TABLE links(
   link_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   link_adr TEXT NOT NULL,
   link_name VARCHAR(50) NOT NULL,
   link_click INT DEFAULT 1,
   user_name VARCHAR(50)  NOT NULL, --Foreign key to users
   CONSTRAINT fk_user FOREIGN KEY (user_name) REFERENCES users(user_name) ON UPDATE CASCADE
);

--populating, populating
INSERT INTO users (user_name, user_pswrd) VALUES 
    ('Messi', '10WhatIsPassword'), 
    ('Carlos', '55NotaSafePassowrd'); 

INSERT INTO links (link_adr, link_name, user_name) VALUES 
    ('https://ww4.123moviesfree.net/season/top-gear-uk-season-2-17301/', 'Top Gear', 'Carlos'), 
    ('https://librefutbol.su/eventos/?r=aHR0cHM6Ly92aXZvZnl0di5jb20vZ28zMS5odG1s', 'Futbol Libre', 'Messi');


--Lessons database for art2
CREATE DATABASE lessons;

--For user identification
CREATE TABLE users(
   user_name VARCHAR(50) NOT NULL PRIMARY KEY,
   user_pswrd VARCHAR(255) NOT NULL   
);

--For XML
CREATE TABLE xml_storage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(50) UNIQUE,
    xml_content LONGTEXT 
);--Upload the xml files via xmlUpload.php (One at a time) 

--For progress
CREATE TABLE progress_record (
    record_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    record_status ENUM('reading', 'tested') NOT NULL DEFAULT 'reading',
    user_name VARCHAR(50) NOT NULL,--foreign key to user
    lesson INT NOT NULL,--foreign key to lesson
    CONSTRAINT fk_user FOREIGN KEY (user_name) REFERENCES users(user_name) ON UPDATE CASCADE,
    CONSTRAINT fk_lesson FOREIGN KEY (lesson) REFERENCES xml_storage(id) ON UPDATE CASCADE
);

--populating, populating
INSERT INTO users (user_name, user_pswrd) VALUES 
    ('Messi', '10WhatIsPassword'), 
    ('Carlos', '55NotaSafePassowrd'); 

INSERT INTO progress_record (record_status, user_name, lesson) VALUES
    ('reading', 'Messi', 3), 
    ('tested', 'Messi', 1),
    ('reading', 'Carlos', 1),
    ('reading', 'Carlos', 2);