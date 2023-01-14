<?php

$dsn = 'mysql:host=localhost;dbname=bib_bab';
$username = 'root';
$password = '';

try{
    // Connect To MySQL Database
    $con = new PDO($dsn,$username,$password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (Exception $ex) {

    $message = 'Not Connected '.$ex->getMessage();
    
}

$id_supplier  = '';
$Initials = '';
$Company = '';
$Phone_number = '';
$Email = '';
$Password = '';

function getPosts()
{
    $posts = array();
    
    $posts[0] = trim($_POST['id_supplier']);
    $posts[1] = trim($_POST['Initials']);
    $posts[2] = trim($_POST['Company']);
    $posts[3] = trim($_POST['Phone_number']);
    $posts[4] = trim($_POST['Email']);
    $posts[5] = trim($_POST['Password']);
    
    return $posts;
}

//Search And Display Data 

if(isset($_POST['search']))
{
    $data = getPosts();
    if(empty($data[0]))
    {
        $message = 'Enter The User Id To Search';
    }  else {

        $searchStmt = $con->prepare('SELECT * FROM supplier WHERE id_supplier = :id_supplier');
        $searchStmt->execute(array(
            ':id_supplier'=> htmlspecialchars($data[0]),
        ));
        
        if($searchStmt)
        {
            $user = $searchStmt->fetch();
            if(empty($user))
            {
                $message = 'No Data For This Id';
            } else {

                $id_supplier = $user[0];
                $Initials = $user[1];
                $Company = $user[2];
                $Phone_number = $user[3];
                $Email = $user[4];            
                $Password = $user[5];
            }
        }
        
    }
}

// Insert Data

if(isset($_POST['insert']))
{
    $data = getPosts();
    if(empty($data[1]) || empty($data[2]) || empty($data[3])|| empty($data[4])|| empty($data[5]))
    {
        $message = 'Enter The User Data To Insert';
    }  else if (!filter_var($data[4], FILTER_VALIDATE_EMAIL)) {
      $message = 'Enter The correct E-mail';
  } else {

    $insertStmt = $con->prepare('INSERT INTO supplier (Initials,Company,Phone_number,Email,Password) VALUES(:Initials,:Company,:Phone_number,:Email,:Password)');
    $insertStmt->execute(array(
        ':Initials'=> htmlspecialchars($data[1]),
        ':Company'=> htmlspecialchars($data[2]),
        ':Phone_number'=> htmlspecialchars($data[3]),
        ':Email'  => htmlspecialchars($data[4]),
        ':Password'  => htmlspecialchars($data[5])
    ));
    
    if($insertStmt)
    {
        $message = 'Data Inserted';
    }
    
}
}

//Update Data

if(isset($_POST['update']))
{
    $data = getPosts();
    if(empty($data[0]) || empty($data[1]) || empty($data[2]) || empty($data[3])|| empty($data[4])|| empty($data[5]))
    {
        $message = 'Enter The User Data To Update';
    }  else if (!filter_var($data[4], FILTER_VALIDATE_EMAIL)) {
      $message = 'Enter The correct E-mail';
  } else {

    $updateStmt = $con->prepare('UPDATE supplier SET Initials = :Initials, Company = :Company, Phone_number = :Phone_number, Email = :Email, Password = :Password WHERE id_supplier = :id_supplier');
    $updateStmt->execute(array(
        ':id_supplier'=> htmlspecialchars($data[0]),
        ':Initials'=> htmlspecialchars($data[1]),
        ':Company'=> htmlspecialchars($data[2]),
        ':Phone_number'=> htmlspecialchars($data[3]),
        ':Email'  => htmlspecialchars($data[4]),
        ':Password'  => htmlspecialchars($data[5])

    ));
    
    if($updateStmt)
    {
        $message = 'Data Updated';
    }
    
}
}

// Delete Data

if(isset($_POST['delete']))
{
    $data = getPosts();
    if(empty($data[0]))
    {
        $message = 'Enter The User ID To Delete';
    }  else {

        $deleteStmt = $con->prepare('DELETE FROM supplier WHERE id_supplier = :id_supplier');
        $deleteStmt->execute(array(
            ':id_supplier'=> htmlspecialchars($data[0])
        ));
        
        if($deleteStmt)
        {
            $message = 'User Deleted';
        }
        
    }
}

?>

<?php if (!empty($message)) {echo "<p class='error'>" . "MESSAGE: ". $message . "</p>";} ?>

<?php

session_start();

if(!isset($_SESSION["session_Email"])):
    header("location:login.php");
else:
    ?>

    <?php include("../includes/header.php"); ?>
    <div class="container mlogin">
        <div id="login">
            <form action="supplier.php" method="POST">

                <input type="number" name="id_supplier" min="1" placeholder="ID supplier" value="<?php echo $id_supplier;?>"><br><br>
                <input type="text" name="Initials" placeholder="Initials(Призвіще та ініціали)" value="<?php echo $Initials;?>"><br><br>
                <input type="text" name="Company" placeholder="Company" value="<?php echo $Company;?>"><br>
                <p id="p38">+380<input type="number" style="width: 78%" name="Phone_number" placeholder="Phone_number" value="<?php echo $Phone_number;?>"></p>
                <input type="text" name="Email" placeholder="E-mail" value="<?php echo $Email;?>"><br><br>
                <input type="text" name="Password" placeholder="Password" value="<?php echo $Password;?>"><br><br>

                <input class="button" type="submit" id="buttonmain1" name="insert" value="Insert">
                <input class="button" type="submit" id="buttonmain1" name="update" value="Update">
                <input class="button" type="submit" id="buttonmain1" name="delete" value="Delete">
                <input class="button" type="submit" id="buttonmain1" name="search" value="Search">
                <br><br>
                <p><a href="main.php" class="button">Повернутися</a></p>

            </form>
        </div>
    </div>
    <?php include("../includes/footer.php"); ?>    

    <?php endif; ?> 