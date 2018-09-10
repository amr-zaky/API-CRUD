<?php 

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Header:Access-Control-Allow-Header,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');


include_once '../../config/dbh.inc.php';
include_once '../../model/posts.php';


$databse=new Database();
$db=$databse->getconnection();

$post=new Post($db);

$data=json_decode(file_get_contents("php://input"));

  $post->id=$data->id;
  $post->title = $data->title;
  $post->body = $data->body;
  $post->author = $data->author;
  $post->category_id = $data->category_id;

  if($post->update())
  {
  	echo json_encode(array('Message'=>'Post Updated'));
  }
  else 
  {
  		echo json_encode(array('Message'=>'Post Not Updated'));
  }