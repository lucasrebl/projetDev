<?php 
class database{
    function createDatabase(){
        
        $dsn = new PDO("mysql:host=mysql;dbname=my_database", "my_user", "my_password");
        $dsn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `user` (
            `idUser` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(255) DEFAULT NULL,
            `email` varchar(255) DEFAULT NULL,
            `passwordUser` varchar(255) DEFAULT NULL,
            `age` int(11) DEFAULT NULL,
            `isAdmin` tinyint(1) DEFAULT '0',
            PRIMARY KEY (`idUser`),
            CONSTRAINT unique_key UNIQUE (`username`, `email`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `subscriber` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `idUser` int(11) DEFAULT NULL,
            `idSubscriber` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`),
            CONSTRAINT fk_idUser FOREIGN KEY (`idUser`) REFERENCES user(`idUser`),
            CONSTRAINT fk_idSubscriber FOREIGN KEY (`idSubscriber`) REFERENCES user(`idUser`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);


        $createTable = ("CREATE TABLE IF NOT EXISTS
        `list` (
            `idList` int(11) NOT NULL AUTO_INCREMENT,
            `nameList` varchar(255) DEFAULT NULL,
            `idUser` int(11) DEFAULT NULL,
            PRIMARY key (`idList`),
            CONSTRAINT fk_idUser_in_list FOREIGN KEY (`idUser`) REFERENCES user(`idUser`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `like` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `idUser` int(11) DEFAULT NULL,
            `idList` int(11) DEFAULT NULL,
            PRIMARY key (`id`),
            CONSTRAINT fk_idUser_in_like FOREIGN KEY (`idUser`) REFERENCES user(`idUser`),
            CONSTRAINT fk_idList_in_like FOREIGN KEY (`idList`) REFERENCES list(`idList`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `favorites` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `idUser` int(11) DEFAULT NULL,
            `idList` int(11) DEFAULT NULL,
            PRIMARY key (`id`),
            CONSTRAINT fk_idUser_in_favorites FOREIGN KEY (`idUser`) REFERENCES user(`idUser`),
            CONSTRAINT fk_idList_in_favorites FOREIGN KEY (`idList`) REFERENCES list(`idList`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `works` (
            `idWorks` int(11) NOT NULL AUTO_INCREMENT,
            `nameWorks` varchar(255) DEFAULT NULL,
            `status` varchar(255) DEFAULT NULL,
            `image` LONGBLOB DEFAULT NULL,
            `summary` LONGTEXT DEFAULT NULL,
            `numberOfEpisodes` int(11) DEFAULT NULL,
            `numberOfSeason` int(11) DEFAULT NULL,
            `numberOfTome` int(11) DEFAULT NULL,
            PRIMARY key (`idWorks`),
            CONSTRAINT unique_nameWorks UNIQUE (`nameWorks`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `listWorks` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `idWorks` int(11) DEFAULT NULL,
            `idList` int(11) DEFAULT NULL,
            PRIMARY key (`id`),
            CONSTRAINT fk_idWorks_in_listWorks FOREIGN KEY (`idWorks`) REFERENCES works(`idWorks`),
            CONSTRAINT fk_idList_in_listWorks FOREIGN KEY (`idList`) REFERENCES list(`idList`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `tag` (
            `idTag` int(11) NOT NULL AUTO_INCREMENT,
            `nameTag` varchar(255) DEFAULT NULL,
            PRIMARY key (`idTag`),
            CONSTRAINT unique_nameTag UNIQUE (`nameTag`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `Category` (
            `idCategory` int(11) NOT NULL AUTO_INCREMENT,
            `nameCategory` varchar(255) DEFAULT NULL,
            PRIMARY key (`idCategory`),
            CONSTRAINT unique_nameCategory UNIQUE (`nameCategory`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `worksTag` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `idWorks` int(11) DEFAULT NULL,
            `idTag` int(11) DEFAULT NULL,
            PRIMARY key (`id`),
            CONSTRAINT fk_idWorks_in_worksTag FOREIGN KEY (`idWorks`) REFERENCES works(`idWorks`),
            CONSTRAINT fk_idTag_in_worksTag FOREIGN KEY (`idTag`) REFERENCES tag(`idTag`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);

        $createTable = ("CREATE TABLE IF NOT EXISTS
        `worksCategory` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `idWorks` int(11) DEFAULT NULL,
            `idCategory` int(11) DEFAULT NULL,
            PRIMARY key (`id`),
            CONSTRAINT fk_idWorks_in_worksCategory FOREIGN KEY (`idWorks`) REFERENCES works(`idWorks`),
            CONSTRAINT fk_idTag_in_worksCategory FOREIGN KEY (`idCategory`) REFERENCES Category(`idCategory`)
        ) ENGINE = InnoDB AUTO_INCREMENT = 1 DEFAULT CHARSET = latin1");
        $dsn->exec($createTable);
    }

    function connect(){
        $servername = "mysql";
        $username = "my_user";
        $password = "my_password";
        $dbname = "my_database";
        $dsn = '';

        try {
            $dsn = 'mysql:host=' . $servername . ';dbname=' . $dbname;
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'connection failed: ' . $e->getMessage();
        }
        return $pdo;
    }
}
?>