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

$id  = '';
$id_supplier = '';
$id_worker = '';
$Initials = '';
$Initials1 = '';

function getPosts()
{
    $posts = array();
    
    $posts[0] = trim($_POST['id']);
    $posts[1] = trim($_POST['id_supplier']);
    $posts[2] = trim($_POST['id_worker']);
    $posts[3] = trim($_POST['Initials']);
    $posts[4] = trim($_POST['Initials']);
    
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

        $searchStmt = $con->prepare('SELECT o.*, s.Initials, w.Initials FROM order_1 o,workers w,supplier s WHERE o.id = :id AND w.id_worker = o.id_worker AND s.id_supplier = o.id_supplier;');
        $searchStmt->execute(array(
            ':id'=> htmlspecialchars($data[0]),
        ));
        
        if($searchStmt)
        {
            $user = $searchStmt->fetch();
            if(empty($user))
            {
                $message = 'No Data For This Id';
            } else {

                $id = $user[0];
                $id_supplier = $user[1];
                $id_worker = $user[2];
                $Initials = $user[3];
                $Initials1 = $user[4];
            }
        }
        
    }
}

// Insert Data

if(isset($_POST['insert']))
{
    $data = getPosts();
    if(empty($data[1]) || empty($data[2]))
    {
        $message = 'Enter The User Data To Insert';
    }  else {

        $insertStmt = $con->prepare('INSERT INTO order_1 (id_supplier,id_worker) VALUES(:id_supplier,:id_worker)');
        $insertStmt->execute(array(
            ':id_supplier'=> htmlspecialchars($data[1]),
            ':id_worker'=> htmlspecialchars($data[2]),
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
    if(empty($data[0]) || empty($data[1]) || empty($data[2]))
    {
        $message = 'Enter The User Data To Update';
    }  else {

        $updateStmt = $con->prepare('UPDATE order_1 SET id_supplier = :id_supplier, id_worker = :id_worker WHERE id = :id');
        $updateStmt->execute(array(
            ':id'=> htmlspecialchars($data[0]),
            ':id_supplier'=> htmlspecialchars($data[1]),
            ':id_worker'=> htmlspecialchars($data[2]),

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

        $deleteStmt = $con->prepare('DELETE FROM order_1 WHERE id = :id');
        $deleteStmt->execute(array(
            ':id'=> htmlspecialchars($data[0])
        ));
        
        if($deleteStmt)
        {
            $message = 'User Deleted';
        }
        
    }
}

// Reload Data

if(isset($_POST['reload']))
{
    $data = getPosts();
    if(empty($data[1]) || empty($data[2]))
    {
        $message = 'Enter The User Id To Search';
    }  else {

        $searchStmt = $con->prepare('SELECT s.id_supplier, s.Initials, w.id_worker, w.Initials FROM workers w,supplier s WHERE w.id_worker = :id_worker AND s.id_supplier = :id_supplier;');
        $searchStmt->execute(array(
            ':id_supplier'=> htmlspecialchars($data[1]),
            ':id_worker'=> htmlspecialchars($data[2]),
        ));
        
        if($searchStmt)
        {
            $user = $searchStmt->fetch();
            if(empty($user))
            {
                $message = 'No Data For This Id';
            } else {

                $id = $data[0];
                $id_supplier = $user[0];
                $Initials = $user[1];
                $id_worker = $user[2];
                $Initials1 = $user[3];
            }
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
            <form action="order_1.php" method="POST">

                <input type="number" min="1" name="id" placeholder="ID order" value="<?php echo $id;?>"><br><br>
                <input type="number" min="1" style="width: 71%" name="id_supplier" placeholder="id supplier" value="<?php echo $id_supplier;?>"><input class="button" type="submit" id="buttonmain1" name="reload" value="Reload"><br><br>
                <input type="text" name="Initials" placeholder="Initials" value="<?php echo $Initials;?>"><br><br>
                <input type="number" min="1" style="width: 71%" name="id_worker" placeholder="id worker" value="<?php echo $id_worker;?>"><input class="button" type="submit" id="buttonmain1" name="reload" value="Reload"><br><br>
                <input type="text" name="Initials" placeholder="Initials" value="<?php echo $Initials1;?>"><br><br>

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