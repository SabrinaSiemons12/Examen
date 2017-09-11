<?php
require_once('MySqlDatabaseClass.php');
class SpeciaalClass
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
    public function __construct() {}
    //Methods
    
    public static function find_by_sql($query)
    {
        // Maak het $database-object vindbaar binnen deze method
        global $database;
        // Vuur de query af op de database
        $result = $database->fire_query($query);
        // Maak een array aan waarin je ProductClass-objecten instopt
        $object_array = array();
        // Doorloop alle gevonden records uit de database
        while ($row = mysqli_fetch_array($result)) {
            // Een object aan van de ProductClass (De class waarin we ons bevinden)
            $object = new SpeciaalClass();
            // Stop de gevonden recordwaarden uit de database in de fields van een ProductClass-object
            $object->id                 = $row['id'];
            $object->name               = $row['name'];
            $object->description        = $row['price'];
            $object->category           = $row['category'];
            $object->price              = $row['price'];
            $object->picture            = $row['picture'];
            $object->amount             = $row['amount'];
            $object_array[]             = $object;
        }
        return $object_array;
    }
    public static function find_info_by_id($id)
    {
        $query = "SELECT 	*
					  FROM 		`product`
					  WHERE		`id`	=	" . $id;
        $object_array = self::find_by_sql($query);
        $ProductclassObject = array_shift($object_array);
        return $ProductclassObject;
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
        echo $query;
        $database->fire_query($query);
        $last_id = mysqli_insert_id($database->getDb_connection());
    }
    public static function delete_product($post)
    {
        global $database;
        $sql = "DELETE FROM `product` WHERE `id` = " . $_POST['id'] . " ";
        $database->fire_query($sql);
        $last_id = mysqli_insert_id($database->getDb_connection());
    }
    public static function wijzig_gegevens_product($post)
    {
        global $database;
        $sql = "UPDATE	`product`  SET 	    `name`		       =	'" . $_POST['name'] . "',
											`description`	   = 	'" . $_POST['description'] . "',
											`category`	       = 	'" . $_POST['category'] . "',
											`price`	           = 	'" . $_POST['price'] . "',
											`picture`	       = 	'" . $_POST['picture'] . "',
											`amount`	       = 	'" . $_POST['amount'] . "'
									WHERE	`id`			   =	'" . $_POST['id'] . "'";
//			echo $sql;
        $database->fire_query($sql);
        $last_id = mysqli_insert_id($database->getDb_connection());
    }
  
    public static function set_Product_Van_De_Dag($id)
    {
        global $database;

        $query = "UPDATE `product` SET `dayProduct` = 1 WHERE `id` = $id";
        // echo $query;
        $database->fire_query($query);
        self::remove_andere_producten_van_de_dag($id);
    }
    
    public static function get_Product_Van_De_Dag()
    {
        global $database;

        $query = "SELECT *, `price` * 0.5 as priceDayProduct 
                  FROM `product`
                  WHERE `dayProduct` = '1'";
        $result = $database->fire_query($query);
        // echo $query;

        return $result;
    }
    
}
?>