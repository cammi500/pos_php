 <?php
// $conne = new PDO("")

$conn = new PDO("mysql:host=localhost;port=3307;dbname=php_pos", 'root', '');
$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function query($sql,$params = [])
{
    global $conn;
    $stmt =$conn->prepare($sql);
    return $stmt->execute($params);
}

function getAll($sql,$params =[])
{
    global $conn;
    $stmt =$conn->prepare($sql);
     $stmt->execute($params);
     return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function getOne($sql,$params =[]){
    global $conn;
    $stmt =$conn->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

$data =getOne("select * from users");
// print_r($data);



// $sql = "insert into users (slug,name, email,password) values (?, ?, ?, ?)";
// $stmt = $conn->prepare($sql);
// $stmt->execute([
//     'slug',
//     'User one',
//     'Userone@com',
//     password_hash('password', PASSWORD_BCRYPT)
// ]);

