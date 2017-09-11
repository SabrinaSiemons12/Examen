<?php
//require_once('/MySqlDatabaseClass.php');
require_once("./connect_db.php");
	require_once("MailingClass.php");
    require_once("connect_db.php");

// Maak je sql opdracht

class CollectieClass
{
    //Fields
    private $id;
    private $name;
    private $description;
    private $category;
    private $price;
    private $picture;
    private $amount;

    //Properties
    //getters
    public function getId()   {   return $this->id;    }
    public function getName()   {   return $this->name;    }
    public function getDescription()  {  return $this->description;   }
    public function getCategory()    {   return $this->category;    }
    public function getPrice() {  return $this->price;  }
    public function getPicture()   {   return $this->picture;   }
    public function getAmount()    {  return $this->amount;  }

    //setters
    public function setId($value)    { $this->id = $value;   }
    public function setName($value)   {  $this->name = $value; }
    public function setDescription()   {   $this->description = $value; }
    public function setCategory()  { $this->category = $value; }
    public function setPrice()   {  $this->price = $value; }
    public function setPicture()  { $this->picture = $value; }
    public function setAmount()  { $this->amount = $value; }


    //Constuctor
    public function __construct()
    {
    }
    
    //Methods
    public static function find_by_sql($query)
    {
        
        global $database;
        
        
        $result = $database->fire_query($query);
        
        
        $object_array = array();
        
        // Doorloop alle gevonden records uit de database
        while ($row = mysqli_fetch_array($result)) {
            // Een object aan van de OptredenClass (De class waarin we ons bevinden)
            $object = new CollectieClass();
            
            // Stop de gevonden recordwaarden uit de database in de fields van een OptredenClass-object
            $object->id                = $row['id'];
            $object->name              = $row['name'];
            $object->description      = $row['price'];
            $object->category             = $row['category'];
            $object->price             = $row['price'];
            $object->picture             = $row['picture'];
            $object->amount             = $row['amount'];
            $object_array[]            = $object;
        }
        return $object_array;
    }
    
    public static function find_info_by_id($id)
    {
        $query            = "SELECT 	*
					  FROM 		`product`
					  WHERE		`id`	=	" . $id;
        $object_array     = self::find_by_sql($query);
        $collectieclassObject = array_shift($object_array);
        return $collectieclassObject;
    }
    
    public static function check_if_product_exists($name)
    {
        global $database;
        $query  = "SELECT `name`
					  FROM	 `product`
					  WHERE	 `name` = '" . $name . "'";
        $result = $database->fire_query($query);
        //ternary operator
        return (mysqli_num_rows($result) > 0) ? true : false;
    }
    
    public static function delete_by_id($id)
    {
                
        $sql    = "DELETE FROM `product` WHERE `id` = '" . $id . "'";
        $link   = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASENAME);
        $result = mysqli_query($link, $sql);
                
        $yesOrNo = ($result) ? "" : "niet ";

				echo "Het verwijderen is " . $yesOrNo . "gelukt.<br>
					U wordt doorgestuurd naar de vorige pagina";
        //header("refresh:1;url=index.php?content=verwijderen");
        
    }
    
    public static function insert_product_database($post)
    {
        global $database;
        $query = "INSERT INTO `product` (`id`,
										   `name`,
										   `description`,
										   `category`,
                                           `price`,
                                            `picture`,
                                            `amount`)
					  VALUES			  (NULL,
										   '" . $post['name'] . "',
										   '" . $post['description'] . "',
										   '" . $post['category'] . "',
                                           '" . $post['price'] . "',
                                           '" . $post['picture'] . "',
                                           '" . $post['amount'] . "')";
        
        $database->fire_query($query);
        echo "Uw gegevens zijn verwerkt.";
       // header("refresh:3;url=index.php?content=toevoegen");
    }      
    
        
     public static function get_Product_Van_De_Dag()
    {
        global $database;

        $query = "SELECT *, `prijs` * 0.5 as priceDayProduct 
                  FROM `product`
                  WHERE `dayProduct` = '1'";
        $result = $database->fire_query($query);
        // echo $query;

        return $result;
    }
}
?>