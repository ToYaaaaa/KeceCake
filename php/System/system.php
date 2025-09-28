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
                    echo "error at " . $e;
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
                echo "error at" . $e;
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
                    echo "error at " . $e;
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

    //insert user
    public function insertuser(){
        // init db
        $db = $this->connectDb();
        if(isset($_POST["deleteuser"])){
            // init var
            $id = $_POST["id"];
            
            //delete user
            // Prepared digunakan untuk meningkatkan keamanan dan efisiensi saat menjalankan query SQL, terutama ketika menerima input dari pengguna
            $statement = $db->prepare("DELETE FROM user WHERE User_id = $id");
            try {
                $statement->execute();
            } catch (PDOException $e) {
                echo "error at" . $e;
            }
        }

        //user login
        if(isset($_POST["login"])){
            // init var
            $username = $_POST["username"];
            $password = $_POST["password"];
            

            $stmt = $db->prepare("SELECT * FROM user WHERE Username = :username OR Password = :password");
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

}

// buat object db
$auth = new Database("localhost", "3306", "root", "", "KeceCake");

?>