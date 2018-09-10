<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Header:Access-Control-Allow-Header,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');



include_once '../../config/dbh.inc.php';
include_once '../../model/posts.php';


$database=new Database();
$db=$database->getconnection();

$post=new Post($db);

$data=json_decode(file_get_contents("php://input"));

$post->id=$data->id;

if($post->delete())
{
	echo json_encode(array('message'=>'Post Deleted'));
}


else 
{
	echo json_encode(array('message'=>'Post Not Deleted'));
}