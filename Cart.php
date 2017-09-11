<?php if(!isset($_SESSION)){
    session_start();
}
class Cart {
    protected $cart_contents = array();
    
    public function __construct(){
        // laat de winkelwagen array zien van de sessie 
        $this->cart_contents = !empty($_SESSION['cart_contents'])?$_SESSION['cart_contents']:NULL;
        if ($this->cart_contents === NULL){
            // zet een paar basic values zien
            $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        }
    }
    
    // Deze functie laat de gehele winkelwagen zien
    public function contents(){
        // Laat de nieuwste als eerste zien
        $cart = array_reverse($this->cart_contents);

        unset($cart['total_items']);
        unset($cart['cart_total']);

        return $cart;
    }
    
  
     // Laat specifieke artikelitems details zien
    public function get_item($row_id){
        return (in_array($row_id, array('total_items', 'cart_total'), TRUE) OR ! isset($this->cart_contents[$row_id]))
            ? FALSE
            : $this->cart_contents[$row_id];
    }
    
   // Laat het geheel zien van de winkelwagen
    public function total_items(){
        return $this->cart_contents['total_items'];
    }
  
    // Laat het geheel zien van de winkelwagen
    public function total(){
        return $this->cart_contents['cart_total'];
    }
    
    
    // Gegevens gaan de winkelwagen in en de sessie wordt opgeslagen
    public function insert($item = array()){
        if(!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if(!isset($item['id'], $item['name'], $item['price'], $item['qty'])){
                return FALSE;
            }else{
             
                // het aantal wordt ingevoerd
                $item['qty'] = (float) $item['qty'];
                if($item['qty'] == 0){
                    return FALSE;
                }
                // de prijs wordt ingevoerd
                $item['price'] = (float) $item['price'];
                // maakt een unieke identifier aan vaan in de winkelwagen
                $rowid = md5($item['id']);
                $old_qty = isset($this->cart_contents[$rowid]['qty']) ? (int) $this->cart_contents[$rowid]['qty'] : 0;
                $item['rowid'] = $rowid;
                $item['qty'] += $old_qty;
                $this->cart_contents[$rowid] = $item;
                
                // save Cart Item
                if($this->save_cart()){
                    return isset($rowid) ? $rowid : TRUE;
                }else{
                    return FALSE;
                }
            }
        }
    }
    
    // Zorgt dat de winkelwagen up-to-date is
    public function update($item = array()){
        if (!is_array($item) OR count($item) === 0){
            return FALSE;
        }else{
            if (!isset($item['rowid'], $this->cart_contents[$item['rowid']])){
                return FALSE;
            }else{
             
                if(isset($item['qty'])){
                    $item['qty'] = (float) $item['qty'];

                    if ($item['qty'] == 0){
                        unset($this->cart_contents[$item['rowid']]);
                        return TRUE;
                    }
                }
                
                
                $keys = array_intersect(array_keys($this->cart_contents[$item['rowid']]), array_keys($item));
                
                if(isset($item['price'])){
                    $item['price'] = (float) $item['price'];
                }
             
                foreach(array_diff($keys, array('id', 'name')) as $key){
                    $this->cart_contents[$item['rowid']][$key] = $item[$key];
                }
                // slaat de winkelwagen gegevens op
                $this->save_cart();
                return TRUE;
            }
        }
    }
    

    
    // Slaat de array van de winkelwagen op in de sessie
    protected function save_cart(){
        $this->cart_contents['total_items'] = $this->cart_contents['cart_total'] = 0;
        foreach ($this->cart_contents as $key => $val){
            
            if(!is_array($val) OR !isset($val['price'], $val['qty'])){
                continue;
            }
     
            $this->cart_contents['cart_total'] += ($val['price'] * $val['qty']);
            $this->cart_contents['total_items'] += $val['qty'];
            $this->cart_contents[$key]['subtotal'] = ($this->cart_contents[$key]['price'] * $this->cart_contents[$key]['qty']);
        }
        
        
        if(count($this->cart_contents) <= 2){
            unset($_SESSION['cart_contents']);
            return FALSE;
        }else{
            $_SESSION['cart_contents'] = $this->cart_contents;
            return TRUE;
        }
    }
    
    
    // Verwijderd producten van de winkelwagen
     public function remove($row_id){
        // unset & save
        unset($this->cart_contents[$row_id]);
        $this->save_cart();
        return TRUE;
     }
     
  // Verwijderd de winkelwagen en de sessie
    public function destroy(){
        $this->cart_contents = array('cart_total' => 0, 'total_items' => 0);
        unset($_SESSION['cart_contents']);
    }
    
    // Laat de product van de dag zien
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