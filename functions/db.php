<?php
 class Db {
    private $host = "localhost";
    private $username = "root";
    private $password = "mysql";
    private $dbname = "nft_explorer";
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->host,$this->username, $this->password, $this->dbname);
        if($this->conn->connect_error){
            die("Connection faild:" . $this->conn->connect_error);
        }
    } 

    public function __destruct()
    {
        $this->conn->close();
    }

    public function Sign_up($wallet, $login, $password,$email){
        $stmt = $this->conn->prepare("INSERT INTO users (wallet_id, user_login, user_password, user_mail) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $wallet, $login, $password,$email);
        $stmt->execute();
        $stmt->close();
    }

    public function Sign_in($login, $password){
        $stmt = $this->conn->prepare("SELECT wallet_id,user_role FROM users WHERE user_login = ? AND user_password = ?");
        $stmt->bind_param("ss", $login, $password);
        $stmt->execute();
        $stmt->bind_result($walletid, $role);
        $stmt->fetch();
        $stmt->close();
        return array('wallet_id'=> $walletid, 'user_role'=>$role);
    }

    public function Log_out() {
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_destroy();
    }
    

    public function getUserData($walletId) {
        $stmt = $this->conn->prepare("SELECT user_login, user_role FROM users WHERE wallet_id = ?"); //add avarar to the selector, add count of the purchased nft to the selector
        $stmt->bind_param("s", $walletId);
        $stmt->execute();
        $stmt->bind_result($login, $role);
        $user = null;
        if ($stmt->fetch()) {
            $user = ['login' => $login, 'role' => $role];
        }
        $stmt->close();
        return $user;
    }

    public function get_user_notifications($wallet) {
        $notifications = [];
        $stmt = $this->conn->prepare("SELECT message_text 
                                      FROM notifications 
                                      WHERE reciever_address = ?");
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }
        $stmt->bind_param("s", $wallet);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result === false) {
            die("Ошибка выполнения запроса: " . $this->conn->error);
        }
        while ($row = $result->fetch_assoc()) {
            $notifications[] = $row['message_text'];
        }
        $stmt->close();
        return $notifications;
    }


    public function get_nft_list() {
        $nfts = [];
        $query = "SELECT n.collection_address, n.collection_name, n.descr, n.IMG, n.Owner_address, n.Nft_price, n.Creator, c.artist_name, c.artist_avatar
                  FROM nft AS n
                  JOIN artists AS c ON n.Creator = c.artist_id
                  WHERE n.Status = 1;";
        $result = $this->conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $nfts[] = $row;
        }
        $result->free();
        return $nfts;
    }

    public function get_creator_info($creatorId) {
        $stmt = $this->conn->prepare("SELECT artist_name, artist_avatar FROM artists WHERE artist_id = ?");
        $stmt->bind_param("i", $creatorId);
        $stmt->execute();
        $stmt->bind_result($artist_name, $artist_avatar);
        $creatorInfo = null;
        if ($stmt->fetch()) {
            $creatorInfo = ['artist_name' => $artist_name, 'artist_avatar' => $artist_avatar];
        }
        $stmt->close();
        return $creatorInfo;
    }

    public function get_artist_nftlist($creatorId) {
        $nfts = [];
        $stmt = $this->conn->prepare("SELECT n.collection_address, n.collection_name, n.IMG, n.Nft_price, a.artist_name, a.artist_avatar
                                      FROM nft AS n
                                      JOIN artists AS a ON n.Creator = a.artist_id
                                      WHERE n.Creator = ? AND n.Status = 1;");
        $stmt->bind_param("i", $creatorId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $nfts[] = $row;
        }
        $stmt->close();
        return $nfts;
    }
    public function get_user_nfts($walletId) {
        $nfts = [];
        $stmt = $this->conn->prepare("SELECT n.collection_address, n.collection_name, n.descr, n.IMG, n.Owner_address, n.Nft_price, n.Creator, c.artist_name, c.artist_avatar
                                      FROM nft AS n
                                      JOIN artists AS c ON n.Creator = c.artist_id
                                      WHERE n.Owner_address = ?");
        $stmt->bind_param("s", $walletId);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $nfts[] = $row;
        }
        $stmt->close();
        return $nfts;
    }

    public function new_order($receiver_address, $nft_address){
        $stmt = $this->conn->prepare("INSERT INTO orders (receiver_address, nft_address) VALUES(?,?)");
        $stmt->bind_param("ss",$receiver_address,$nft_address);
        $stmt->execute();
        $stmt->close();
    }

    public function update_status($nft_address, $new_status){
        $stmt = $this->conn->prepare("UPDATE nft SET status = ? WHERE collection_address = ?");
        if ($stmt === false) {
            // Лучше здесь добавить обработку ошибок
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }
        $stmt->bind_param("is", $new_status, $nft_address);
        $stmt->execute();
        $stmt->close();
    }
    
    // add new user counter query into global query
    public function admin_info_page(){
        $query = "SELECT 
                (SELECT SUM(Nft_price) FROM nft WHERE Status = 1) AS total_price,
                c.artist_name,
                c.artist_avatar
                FROM 
                        artists c
                JOIN 
                (SELECT Creator, COUNT(*) AS nft_count
                 FROM nft 
                 WHERE status = 1 
                 GROUP BY Creator 
                 ORDER BY nft_count DESC LIMIT 1) AS subquery";
                
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        $total_price = $data['total_price'];
        $artist_name = $data['artist_name'];
        $artist_avatar = $data['artist_avatar'];
    
        // $query_users = "SELECT COUNT(*) AS users_registered_this_month FROM users WHERE MONTH(registration_date) = MONTH(CURRENT_DATE()) AND YEAR(registration_date) = YEAR(CURRENT_DATE())";
        // $result_users = $this->conn->query($query_users);
        // $data_users = $result_users->fetch_assoc();
        // $users_registered_this_month = $data_users['users_registered_this_month'];
        return [
            'total_price' => $total_price,
            'artist_name' => $artist_name,
            'artist_avatar' => $artist_avatar,
            //'users_registered_this_month' => $users_registered_this_month
        ];
    }
    

    public function addNft($collection_address, $collection_name, $descr, $img, $nft_price, $creator, $nft_kind) {
        $stmt = $this->conn->prepare("INSERT INTO nft (collection_address, collection_name, descr, IMG, Nft_price, Creator, Nft_kind) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssdii", $collection_address, $collection_name, $descr, $img, $nft_price, $creator, $nft_kind);
        $stmt->execute();
        $stmt->close();
    }
    

    public function get_order_list() {
        $orders = [];
        $query = "SELECT o.receiver_address, o.nft_address, n.IMG, n.collection_name, u.user_login
                  FROM orders o
                  JOIN nft n ON o.nft_address = n.collection_address
                  JOIN users u ON o.receiver_address = u.wallet_id;";
        $result = $this->conn->query($query);
        while ($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
        $result->free();
        return $orders;
    }
    
    public function update_owner($new_owner, $nft_address){
        $stmt = $this->conn->prepare("UPDATE nft SET Owner_address = ? WHERE collection_address = ?");
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $this->conn->error);
        }
        $stmt->bind_param("ss", $new_owner, $nft_address);
        $stmt->execute();
        $stmt->close();
    }

    public function close_order($nft_address){
        $stmt = $this->conn->prepare("DELETE FROM orders WHERE nft_address = ?");
        if($stmt===false){
            die("Error of preparing the query!". $this->conn->error);
        }
        $stmt->bind_param("s", $nft_address);
        $stmt->execute();
        $stmt->close();
    }
}


    