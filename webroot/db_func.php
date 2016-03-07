<?php
require_once('config.php');

function db_connect(){
	$dsn = sprintf("mysql:dbname=%s;host=%s;charset=utf8;", DB_NAME, DB_HOST, 
			array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false)
        	);

	try{
		$pdo = new PDO($dsn, DB_USER, DB_PASS);
	}catch(Exeption $e){
		print("Error: ".$getMessage());
		die();
	}
 
    return $pdo;
}

function db_insert($pdo, $data){
	$sql = 'INSERT INTO list (first_name, last_name, first_name_kana, last_name_kana, 
							  post1, post2, address)
			VALUES (:first_name, :last_name, :first_name_kana, :last_name_kana, 
					:post1, :post2, :address)';
	$stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

function db_update($pdo, $data){
	$sql = 'UPDATE list SET first_name=:first_name, 
							last_name=:last_name,
							first_name_kana=:first_name_kana,
							last_name_kana=:last_name_kana, 
							post1=:post1,
							post2=:post2,
							address=:address';
	$stmt = $pdo->prepare($sql);
    $stmt->execute($data);
}

function db_delete($pdo, $id){
	$sql = 'DELETE FROM list WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $id));
}
?>