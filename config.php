<?php


$host = 'localhost';
$db = 'games';
$user = 'root';
session_start();
$password = '';
$dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
try {
	$pdo = new PDO($dsn, $user, $password);
	if ($pdo) {
        // SQL statement for creating new tables
        $statements = [
            'CREATE TABLE if not exists games( 
                game_id   INT AUTO_INCREMENT,
                game_name  VARCHAR(100) NOT NULL, 
                game_image VARCHAR(50) NULL, 
                url VARCHAR(50) NULL, 
                created_date datetime   DEFAULT NOW(),
                PRIMARY KEY(game_id)
            );',
           'CREATE TABLE if not exists users (
            user_id   INT NOT NULL AUTO_INCREMENT, 
            first_name varchar(250) NOT NULL,
            last_name varchar(250) NOT NULL,
            username varchar(250) NOT NULL,
            email varchar(250) NOT NULL,
            password text not null,
            created_date datetime   DEFAULT NOW(),
            PRIMARY KEY(user_id)
            
        );'];

        // execute SQL statements
        foreach ($statements as $statement) {
            $pdo->exec($statement);
        }

        $games = [
            [
                "name"=> "Planet destroy",  "image"=>"images/planet_destroy.jpg", "url"=>"planet_destroy/index.html"],
               [ "name"=> "Ninja game",  "image"=>"images/menja.jpg", "url"=>"min_game/index.html"],
               [ "name"=> "Snake game",  "image"=>"images/snake_game.jpg", "url"=>"snake_game/index.html"],
               [ "name"=> "Typing master",  "image"=>"images/typing.jpg", "url"=>"typing_master/index.html"],
               [ "name"=> "Photo editing",  "image"=>"images/photo_editing.jpg", "url"=>"photo_editing/index.html"],
               [ "name"=> "Memory game",  "image"=>"images/memory.jpg", "url"=>"memory/index.html"],
               [ "name"=> "Color blast",  "image"=>"images/color_blast.jpg", "url"=>"color_blast/index.html"],
               [ "name"=> "Tic Tac Toe",  "image"=>"images/tic.jpg", "url"=>"tic-tac_toe/index.html"],
               [ "name"=> "Word scramble ",  "image"=>"images/word_scramble.jpg", "url"=>"word_scramble/index.html"],
                ["name"=>"Drawing ", "image"=>"images/drawing.jpg", "url"=>"drawing/index.html"],
                ["name"=>"Word Guessing ", "image"=>"images/guess_word.jpg", "url"=>"drawing/index.html"]
            ];
        foreach ($games as $key => $value) {
            $sql = "INSERT INTO games (game_name , game_image, url) VALUES (?,?,?)";
            $stmt= $pdo->prepare($sql);
            $stmt->execute([$value['name'], $value['image'], $value['url']]);
        }
        return $pdo;
    }

   
}
 catch (PDOException $e) {
	echo $e->getMessage();
}