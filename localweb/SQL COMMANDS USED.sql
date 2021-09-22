--creating tables
	--users table
	CREATE TABLE IF NOT EXISTS users(
		username VARCHAR(25) NOT NULL PRIMARY KEY,
		pword VARCHAR(255) NOT NULL,
		bio VARCHAR(50000) NOT NULL
	) ENGINE InnoDB; 

	--posts table
	CREATE TABLE IF NOT EXISTS postsT(
		dateCreated DATETIME NOT NULL PRIMARY KEY,
		votes INT NOT NULL,
		title VARCHAR(255) NOT NULL,
		content varchar(60000),
		username VARCHAR(25),
		FOREIGN KEY (username) REFERENCES users(username)
	) ENGINE = InnoDB; 

--sql used in pages

	--for pages containing rownum
		SET @rownum = $pageno;
		--in mysql set pageno to a user session variable named rownum

	--about.php
		SELECT bio FROM users WHERE username LIKE '$user';
		--execute a query where it selects bio from users where the username is that of the contents of probepage
		
	--feed.php
		SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT ORDER BY dateCreated DESC LIMIT $pageno,50;
		--select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by newest posts, only outputting the first 50 newest
		SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT ORDER BY dateCreated ASC LIMIT $pageno,50;
		--select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by oldest posts, only outputting the first 50 newest
		SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT WHERE username = '$probepage' ORDER BY dateCreated DESC  LIMIT $pageno,50;
		--select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by newest posts, only outputting the first 50 newest and only outputting the posts from the user that has been searched
		SELECT (@rownum := @rownum + 1) AS rownum, title, dateCreated, votes, content, username FROM postsT WHERE username = '$probepage' ORDER BY dateCreated ASC LIMIT $pageno,50;
		--select rownum as an incrementing variable, along with title, dateCreated, votes, content, username from postsT and order it by oldest posts, only outputting the first 50 newest and only outputting the posts from the user that has been searched
		
	--login.php
		SELECT COUNT(*) FROM users WHERE username = '$user' AND pword = '$pword';
		--select the number of users who have x username and y password

	--register.php
		SELECT COUNT(*) FROM users WHERE username = '$user';
		--count the number of users who have the username equal to the $user variable
		INSERT INTO users(username,pword,bio) VALUES('$user','$pword','$bio');
		--insert into the users table in the fields username, pword and bio the values variable user, variable pword and variable bio

	--searchpage.php
		SET @rownum = 0;
		--in mysql set the user session variable named rownum to 0
		SELECT (@rownum := @rownum + 1) AS rownum, username, bio FROM users WHERE username LIKE '$search%';
		--select rownum, with it incrementing by one on each repitition, username and bio from the uesrs table where the username is contains in its first few characters
		--the contents of the search variable

	--postprocessing.php
		INSERT INTO postsT (dateCreated,votes,title,content, username) VALUES(CURRENT_TIMESTAMP, 0, '$title', '$content', '$user');
		--inserting new posts into the database into their respective fields

	--settingsaccount.php
		UPDATE users SET pword = '$pword' WHERE username = '$user';
		--update the users table by setting the password to the variable password where the user is the same as that of the user variable

	--settingspreferences.php
		UPDATE users SET bio = '$bio' WHERE username = '$user';
		--update users table and set the bio field to the bio variable where the username is the username variable

	--settingsdeletesubmit.php
		DELETE FROM postsT WHERE username = '$user';
		--delete from postst records where the username field is equal to that of the user variable
		DELETE FROM users WHERE username = '$user';
		--delete from users where the username field is equal to that of the user variable