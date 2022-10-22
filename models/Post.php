


<?php 
   class Post {
    // DB stuff//
    private $conn;
    private $table = 'posts';

    // Post Properties//
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Posts
    public function read() {
      // Create query
      $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                                FROM ' . $this->table . ' p
                                LEFT JOIN
                                  categories c ON p.category_id = c.id
                                ORDER BY
                                  p.created_at DESC';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    function read_single(){

      $query  = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
       FROM ' . $this->table . ' p
      LEFT JOIN
        categories c ON p.category_id = c.id
      WHERE 
      p.id=?
      LIMIT 0,1';
      //The PDOStatement::bindParam() function is an inbuilt function in PHP that is used to bind a parameter to the specified variable name//
    //The PDOStatement::bindValue() function is an inbuilt function in PHP that is used to bind a value to a parameter.//
      $stmt=$this->conn->prepare( $query);
      $stmt->BindParam(1,$this->id);
      $stmt->exicute();
      $row=$stmt->fetch(PDO::FETCH_ASSOC);

    //Set Atrributes//
  
    
  


    }
  }

?>