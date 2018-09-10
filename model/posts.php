<?php

class Post 
{

	  private $conn;
	  private $table='posts';

	  public $id;
	  public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

   	public  function __construct($db)
      {
    	$this->conn=$db;
      }


    public function read()
      {

      	$sql='SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                  categories c ON p.category_id = c.id
                                ORDER BY
                                  p.created_at DESC';

      	 $rest= $this->conn->prepare($sql);
      	 $rest->execute();	
      	 return $rest;
      }


      Public function readsingle()
      {
        $sql='SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                    FROM ' . $this->table . ' p
                                    LEFT JOIN
                                      categories c ON p.category_id = c.id
                                    WHERE
                                      p.id = ?
                                    LIMIT 0,1';
        $res=$this->conn->prepare($sql);
        $res->bindParam(1,$this->id);
        $res->execute();

        $row=$res->fetch(PDO::FETCH_ASSOC);
       
          $this->title = $row['title'];
          $this->body = $row['body'];
          $this->author = $row['author'];
          $this->category_id = $row['category_id'];
          $this->category_name = $row['category_name'];                           
      }


      public function create()
      {

        $sql='INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';




        $res=$this->conn->prepare($sql);

        $this->title = htmlspecialchars(strip_tags($this->title));
          $this->body = htmlspecialchars(strip_tags($this->body));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->category_id = htmlspecialchars(strip_tags($this->category_id));


        
        $res->bindParam(':title',$this->title);
        $res->bindParam(':body',$this->body);
        $res->bindParam(':author',$this->author);
        $res->bindParam(':category_id',$this->category_id);
        
        if($res->execute())
        {
          return true;
        }


         // Print error if something goes wrong
      printf("Error: %s.\n", $res->error);

      return false;

      }



      public function update()
      {

        $sql='UPDATE ' . $this->table . '
                                SET title = :title, body = :body, author = :author, category_id = :category_id
                                WHERE id = :id';

        $res=$this->conn->prepare($sql);


        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $res->bindParam(':id', $this->id);
        $res->bindParam(':title',$this->title);
        $res->bindParam(':body',$this->body);
        $res->bindParam(':category_id',$this->category_id);
        $res->bindParam(':author',$this->author);
        

        if($res->execute())
        {
          return true;
        } 

        printf("Error: %s.\n", $res->error);

          return false;



      }



      public function delete()
      {

        $sql=' DELETE FROM ' .$this->table .' WHERE id=:id';

        $res=$this->conn->prepare($sql);

        $this->id=htmlspecialchars(strip_tags($this->id));
        $res->bindParam(':id',$this->id);

        if($res->execute())
        {
          return true;
        }

          printf("Error: %s.\n", $res->error);

      return false;
      }

}

