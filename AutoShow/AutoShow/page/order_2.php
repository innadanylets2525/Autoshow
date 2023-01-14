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

$id_order  = '';
$id_bueyr = '';
$id_goods = '';
$Initials = '';
$Mark = '';

function getPosts()
{
    $posts = array();
    
    $posts[0] = trim($_POST['id_order']);
    $posts[1] = trim($_POST['id_bueyr']);
    $posts[2] = trim($_POST['id_goods']);
    $posts[3] = trim($_POST['Initials']);
    $posts[4] = trim($_POST['Mark']);
    
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

        $searchStmt = $con->prepare('SELECT o.*, b.Initials, g.Mark FROM order_2 o,buyer b,goods g WHERE o.id_order = :id_order AND b.id_client = o.id_bueyr AND g.id_goods = o.id_goods;');
        $searchStmt->execute(array(
            ':id_order'=> htmlspecialchars($data[0]),
        ));
        
        if($searchStmt)
        {
            $user = $searchStmt->fetch();
            if(empty($user))
            {
                $message = 'No Data For This Id';
            } else {

                $id_order = $user[0];
                $id_bueyr = $user[1];
                $id_goods = $user[2];
                $Initials = $user[3];
                $Mark = $user[4];
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

        $insertStmt = $con->prepare('INSERT INTO order_2 (id_bueyr,id_goods) VALUES(:id_bueyr,:id_goods)');
        $insertStmt->execute(array(
            ':id_bueyr'=> htmlspecialchars($data[1]),
            ':id_goods'=> htmlspecialchars($data[2]),
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

        $updateStmt = $con->prepare('UPDATE order_2 SET id_bueyr = :id_bueyr, id_goods = :id_goods WHERE id_order = :id_order');
        $updateStmt->execute(array(
            ':id_order'=> htmlspecialchars($data[0]),
            ':id_bueyr'=> htmlspecialchars($data[1]),
            ':id_goods'=> htmlspecialchars($data[2]),

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

        $deleteStmt = $con->prepare('DELETE FROM order_2 WHERE id_order = :id_order');
        $deleteStmt->execute(array(
            ':id_order'=> htmlspecialchars($data[0])
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
            $searchStmt = $con->prepare('SELECT b.Initials, g.Mark FROM buyer b,goods g WHERE b.id_client = :id_bueyr AND g.id_goods = :id_goods;');
        $searchStmt->execute(array(
            ':id_bueyr'=> htmlspecialchars($data[1]),
            ':id_goods'=> htmlspecialchars($data[2]),
        ));
        
        if($searchStmt)
        {
            $user = $searchStmt->fetch();
            if(empty($user))
            {
                $message = 'No Data For This Id';
            } else {

                $id_order = $data[0];
                $id_bueyr = $data[1];
                $Initials = $user[0];
                $id_goods = $data[2];
                $Mark = $user[1];
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
            <form action="order_2.php" method="POST">

                <input type="number" min="1" name="id_order" placeholder="ID order" value="<?php echo $id_order;?>"><br><br>
                <input type="number" min="1" style="width: 71%" name="id_bueyr" placeholder="id bueyr" value="<?php echo $id_bueyr;?>"><input class="button" type="submit" id="buttonmain1" name="reload" value="Reload"><br><br>
                <input type="text" name="Initials" placeholder="Initials" value="<?php echo $Initials;?>"><br><br>
                <input type="number" min="1" style="width: 71%" name="id_goods" placeholder="id good" value="<?php echo $id_goods;?>"><input class="button" type="submit" id="buttonmain1" name="reload" value="Reload"><br><br>
                <input type="text" name="Mark" placeholder="Mark" value="<?php echo $Mark;?>"><br><br>

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