<?php
//initiation for image uploder
    define("IMGPATH","C:/xampp/htdocs/KeceCake");
    define("BASEURL","http://localhost/KeceCake");

//initiation for sweet alert

//system
class Database {
//prepare system initiation
    // Initialization
        private ?string
        $host = null,
        $port = null,
        $user = null,
        $password = null,
        $location = null;
   // Constructor
        public function __construct($host, $port, $user, $password, $location){
            // Set self value
            $this->host = $host;
            $this->port = $port;
            $this->user = $user;
            $this->password = $password;
            $this->location = $location;
        }
    // Connection
        public function connectDb()
        {
            try {
                return new PDO(
                    "mysql:host={$this->host}:{$this->port};dbname={$this->location}",
                    $this->user,
                    $this->password
                );
            } catch (PDOException $err) {
                return null;
            }
        }
    // init for upload image
        public function handlerimg($filename, $filetmppath){
            $pathimg = "/uploads/";
            $targetdir = IMGPATH . $pathimg;
            $uploadfile = $targetdir . $filename;
            //move_uploaded_file() digunakan untuk memindahkan file yang diunggah dari lokasi sementara ke lokasi tujuan yang diinginkan pada server
            if(move_uploaded_file($filetmppath, $uploadfile)) {
                return BASEURL . $pathimg . $filename; 
            }else{
                throw new Exception("GAGAL");
            }
        }
    
    //``````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````

    //product section
    //show product
    public function getproduct()
        {
        // Init
        $db = $this->connectDb();
        // Fetch query
        $query = "SELECT * FROM product";
        // Get the result
        //query digunakan untuk menjalankan perintah SELECT dan mendapatkan hasilnya langsung.
        $results = $db->query($query);
        return $results;
        }

    //search product
    public function searchproduct(){
        //init db
        $db = $this->connectDb();

        if(isset($_POST["search"])){
            $searchcategory = $_POST["searchcategory"];
            // Fetch query
            $query = "SELECT * FROM product WHERE Product_category = '$searchcategory'";
            // Get the result
            //query digunakan untuk menjalankan perintah SELECT dan mendapatkan hasilnya langsung.
            $results = $db->query($query);
            return $results;
        }
    }

    //edit product
    public function editproduct(){
        //init db
        $db = $this->connectDb();
        if(isset($_POST["editproduct"])){
            //init var
            $id = $_POST["id"];
             // init var
            $category = $_POST["category"];
            $productname = $_POST["name"];
            $price = $_POST["price"];
        //foto isi
            //basename adalah untuk ngambil nama file terakhir dari sebuah path. jadi hanya ambil nama filenya saja disini
            $filenameproduct = basename($_FILES["imageproduct"]["name"]);
            $filetmppathproduct = $_FILES["imageproduct"]["tmp_name"];
            $fixpathproduct = $this->handlerimg($filenameproduct, $filetmppathproduct);
            
        // insert product
            $editproduct=
            <<<SQL
            UPDATE product SET Product_name = :product_name, Product_image = :product_image, Product_category = :product_category, Product_price = :product_price WHERE Product_id = :id;
            SQL;

            $statement = $db->prepare($editproduct);
            $statement->bindParam(':product_image',$fixpathproduct);
            $statement->bindParam(':product_name', $productname);
            $statement->bindParam(':product_category', $category);
            $statement->bindParam(":product_price", $price);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            
                try {
                    $statement->execute();
                    header("location: listproduct.php");
                } catch (PDOException $e) {
                    echo "error dibagian " . $e;
                }

        }
    }

    //insert product
    public function insertproduct(){
        // init db
        $db = $this->connectDb();
        if(isset($_POST["deleteproduct"])){
            // init var
            $id = $_POST["id"];
            
            //delete product
            // Prepared digunakan untuk meningkatkan keamanan dan efisiensi saat menjalankan query SQL, terutama ketika menerima input dari pengguna
            $statement = $db->prepare("DELETE FROM product WHERE Product_id = $id");
            try {
                $statement->execute();
                //reload data dari DB, bukan data lama
                header("Location: " . $_SERVER['PHP_SELF']);
                //exit setelah selesai
                exit;

            } catch (PDOException $e) {
                echo "error dibagian" . $e;
            }
        }

        //insert product
        if(isset($_POST["submit"])){
         // init var
            $category = $_POST["category"];
            $productname = $_POST["productname"];
            $price = $_POST["price"];
        //foto isi
            //basename adalah untuk ngambil nama file terakhir dari sebuah path. jadi hanya ambil nama filenya saja disini
            $filenameproduct = basename($_FILES["imageproduct"]["name"]);
            $filetmppathproduct = $_FILES["imageproduct"]["tmp_name"];
            $fixpathproduct = $this->handlerimg($filenameproduct, $filetmppathproduct);
            
        // insert product
            $insertproduct=
            <<<SQL
            INSERT INTO product ( Product_name, Product_image, Product_category, Product_price) VALUES (:product_name, :product_image, :product_category, :product_price);
            SQL;

            $statement = $db->prepare($insertproduct);
            $statement->bindParam(':product_image',$fixpathproduct);
            $statement->bindParam(':product_name', $productname);
            $statement->bindParam(':product_category', $category);
            $statement->bindParam(":product_price", $price);
            
                try {
                    $statement->execute();
                } catch (PDOException $e) {
                    echo "error dibagian " . $e;
                }
            } 
        }


    //``````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````

    //user section

    //show user
    public function getuser()
        {
        // Init
        $db = $this->connectDb();
        // Fetch query
        $query = "SELECT * FROM user";
        // Get the result
        //query digunakan untuk menjalankan perintah SELECT dan mendapatkan hasilnya langsung.
        $results = $db->query($query);
        return $results;
        }

    //delete user
    public function deleteuser(){
        //init db
        $db = $this->connectDb();
        //cek apakah ada tombol yang diklik
        if(isset($_POST["deleteuser"])){
            $id = $_POST["id"];

            //delete user
            $statement = $db->prepare("DELETE FROM user WHERE User_id = $id");

            try{
                $statement->execute();
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }catch(PDOException $e){
                echo "error dibagian:" . $e;
            }
        }
    }

    //insert user
    public function insertuser(){
        // init db
        $db = $this->connectDb();
        //user login
        if(isset($_POST["login"])){
            // init var
            $username = $_POST["username"];
            $password = $_POST["password"];
            

            $stmt = $db->prepare("SELECT * FROM user WHERE Username = :username AND Password = :password");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            $cekuser = $stmt->fetch(PDO::FETCH_ASSOC);

            if($cekuser){
                if($cekuser["Username"] === $username && $cekuser["Password"] === $password){
                    //session for validation
                    $_SESSION['User_id'] = $cekuser['User_id'];
                    $_SESSION['Username'] = $cekuser['Username'];

                    //redirect to after login
                    header("Location: ../php/Afterloginindex.php");
                    //exit setelah selesai
                    exit;
                }else{
                echo "<script>alert('Username/Password Wrong');</script>";
                }
            }
        }

        //insert user
        if(isset($_POST["register"])){
         // init var
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            

        $stmt = $db->prepare("SELECT * FROM user WHERE Username = :username OR Email = :email");
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $cekuser = $stmt->fetch(PDO::FETCH_ASSOC);

        if($cekuser){
            if($cekuser["Username"] === $username || $cekuser["Email"] === $email){
                echo "<script>alert('Username/Email Already Register');</script>";
            }
        }else{

            $insertuser=
            <<<SQL
            INSERT INTO user ( Username, Email, Password) VALUES (:username, :email, :password);
            SQL;

            $statement = $db->prepare($insertuser);
            $statement->bindParam(':username', $username);
            $statement->bindParam(':email', $email);
            $statement->bindParam(":password", $password);
            
                try {
                    $statement->execute();
                    header("Location: ../php/Login.php");
                    //exit setelah selesai
                    exit;

                } catch (PDOException $e) {
                    echo "error at " . $e;
                }
            } 
        }
    }

    //``````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````````

    //Order section
    
    // insert orders
public function insertOrders($order_id, $total_price, $order_status, $transaction_time, $payment_type, $customer_name, $customer_email, $customer_phone){
    //init db
    $db = $this->connectDb();
    //query 
    $sql = "INSERT INTO orders 
    (Order_id, Total_price, Order_status, Transaction_time, payment_type, Customer_name, Customer_email, Customer_phone)
    VALUES (:Order_id, :Total_price, :Order_status, :Transaction_time, :Payment_type, :Customer_name, :Customer_email, :Customer_phone)";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':Order_id', $order_id);
    $stmt->bindParam(':Total_price', $total_price);
    $stmt->bindParam(':Order_status', $order_status);
    $stmt->bindParam(':Payment_type', $payment_type);
    $stmt->bindParam(':Transaction_time', $transaction_time);
    $stmt->bindParam(':Customer_name', $customer_name);
    $stmt->bindParam(':Customer_email', $customer_email);
    $stmt->bindParam(':Customer_phone', $customer_phone);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error insert order: " . $e->getMessage();
    }
}

    // insert detail item
public function insertOrdersItem($order_id, $product_id,$category, $image, $product_name, $price, $quantity){
    //init db
    $db = $this->connectDb();
    //query
    $sql = "INSERT INTO order_items 
        (Order_id, Product_id, Product_category, Product_image, Product_name, Price, Quantity)
        VALUES (:Order_id, :Product_id, :Product_category, :Product_image, :Product_name, :Price, :Quantity)";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':Order_id', $order_id);
    $stmt->bindParam(':Product_id', $product_id);
    $stmt->bindParam(':Product_category', $category);
    $stmt->bindParam(':Product_image', $image);
    $stmt->bindParam(':Product_name', $product_name);
    $stmt->bindParam(':Price', $price);
    $stmt->bindParam(':Quantity', $quantity);

    try {
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error insert order item: " . $e->getMessage();
    }
}

    //get data orders
    public function getorders()
        {
        // Init
        $db = $this->connectDb();
        // Fetch query
        $query = "SELECT * FROM orders";
        // Get the result
        //query digunakan untuk menjalankan perintah SELECT dan mendapatkan hasilnya langsung.
        $results = $db->query($query);
        return $results;
        }

    //get data item yang di order
    public function getordersitem()
        {
        // Init
        $db = $this->connectDb();
        // Fetch query
        $query = "SELECT * FROM order_items";
        // Get the result
        //query digunakan untuk menjalankan perintah SELECT dan mendapatkan hasilnya langsung.
        $results = $db->query($query);
        return $results;
        }

    //edit status orders
    public function editorders(){
    $db = $this->connectDb();
    if(isset($_POST['editstatus'])){
        // ambil id primary key dari hidden input
        $id = $_POST["id"];
        // status baru
        $status = $_POST["category"];

        $stmt = $db->prepare("UPDATE orders 
            SET Order_status = :order_status
            WHERE id = :id");
        $stmt->bindParam(":order_status", $status);
        $stmt->bindParam(":id", $id);
        try {
            $stmt->execute();
            header("Location: " . $_SERVER['PHP_SELF']);
            //exit setelah selesai
            exit;

        } catch (PDOException $e) {
            echo "error at " . $e;
        }
    }
}

    //delete orders and items history

    public function deleteorder(){
        //init
        $db = $this->connectDb();
        if(isset($_POST["deleteorders"])){
            // init var
            $id = $_POST["order_id"];
            
            //delete orders
            // Prepared digunakan untuk meningkatkan keamanan dan efisiensi saat menjalankan query SQL, terutama ketika menerima input dari pengguna
            $statement = $db->prepare("DELETE FROM orders WHERE Order_id = $id");

            //delete items
            $stmt = $db->prepare("DELETE FROM order_items WHERE Order_id = $id");
            try {
                $statement->execute();
                $stmt->execute();
                //reload data dari DB, bukan data lama
                header("Location: " . $_SERVER['PHP_SELF']);
                //exit setelah selesai
                exit;

            } catch (PDOException $e) {
                echo "error dibagian" . $e;
            }
        }
    }
}

// buat object db
$auth = new Database("localhost", "3306", "root", "", "KeceCake");

?>