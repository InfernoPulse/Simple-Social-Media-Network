--creating tables

--users table
CREATE TABLE IF NOT EXISTS users(
    username VARCHAR(25) NOT NULL PRIMARY KEY,
    pword VARCHAR(255) NOT NULL,
    bio VARCHAR(144) NOT NULL
) ENGINE InnoDB; 

--posts table
CREATE TABLE IF NOT EXISTS postsT(
    dateCreated DATETIME NOT NULL PRIMARY KEY,
    votes INT NOT NULL,
    title VARCHAR(144) NOT NULL,
    content varchar(50000),
    username VARCHAR(25),
    FOREIGN KEY (username) REFERENCES users(username)
) ENGINE = InnoDB; 

--images for posts table
CREATE TABLE IF NOT EXISTS postsI(
    dateCreated TIMESTAMP NOT NULL,
    username VARCHAR(25) NOT NULL,
    image VARBINARY(65536) NOT NULL,
    PRIMARY KEY (dateCreated,username),
    FOREIGN KEY (dateCreated) REFERENCES postsT(dateCreated),
    FOREIGN KEY (username) REFERENCES users(username)
) ENGINE = InnoDB;

--friends table
CREATE TABLE IF NOT EXISTS friends(
    request VARCHAR(25) NOT NULL,
    addressee VARCHAR(25) NOT NULL,
    accepted BIT NOT NULL,
    PRIMARY KEY (request, addressee),
    FOREIGN KEY (request) REFERENCES users(username),
    FOREIGN KEY (addressee) REFERENCES users(username)
) ENGINE = InnoDB;

--user profile image for users table
CREATE TABLE IF NOT EXISTS uimage(
    username VARCHAR(25) NOT NULL PRIMARY KEY,
    image VARBINARY(65540) NOT NULL,
    FOREIGN KEY (username) REFERENCES users(username)
) ENGINE = InnoDB;



--Inserting new data into the database after checking the account doesn't exist
SELECT COUNT(*) FROM users WHERE username = '$user';

INSERT INTO users(username,pword) VALUES('$user','$pword');