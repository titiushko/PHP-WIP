DROP DATABASE IF EXISTS combobox_dependientes;
CREATE DATABASE combobox_dependientes DEFAULT CHARACTER SET latin1 COLLATE latin1_bin;
USE combobox_dependientes;

CREATE TABLE IF NOT EXISTS ajax_categories (
	id 			int(11) NOT NULL AUTO_INCREMENT,
	category 	varchar(50) NOT NULL,
	pid 		int(11) NOT NULL,
	PRIMARY KEY (id)
);

INSERT INTO ajax_categories(id,category,pid)
VALUES
(NULL,'tenaza', '1'),
(NULL,'martillo','1'),
(NULL,'silla', '2'),
(NULL,'mesa','2');