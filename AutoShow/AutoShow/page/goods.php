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

$id_goods  = '';
$id_workers = '';
$Mark = '';
$Year = '';
$Color = '';
$Price = '';
$Initials = '';

function getPosts()
{
    $posts = array();
    
    $posts[0] = trim($_POST['id_goods']);
    $posts[1] = trim($_POST['id_workers']);
    $posts[2] = trim($_POST['Mark']);
    $posts[3] = trim($_POST['Year']);
    $posts[4] = trim($_POST['Color']);
    $posts[5] = trim($_POST['Price']);
    $posts[6] = trim($_POST['Initials']);
    
    return $posts;
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

//Search And Display Data 

if(isset($_POST['search']))
{
    $data = getPosts();
    if(empty($data[0]))
    {
        $message = 'Enter The User Id To Search';
    }  else {

        $searchStmt = $con->prepare('SELECT g.*, w.Initials FROM goods g,workers w WHERE g.id_goods = :id_goods AND w.id_worker = g.id_workers;');
        $searchStmt->execute(array(
            ':id_goods'=> htmlspecialchars($data[0]),
        ));
        
        if($searchStmt)
        {
            $user = $searchStmt->fetch();
            if(empty($user))
            {
                $message = 'No Data For This Id';
            } else {

                $id_goods = $user[0];
                $id_workers = $user[1];
                $Mark = $user[2];
                $Year = $user[3];
                $Color = $user[4];            
                $Price = $user[5];
                $Initials = $user[6];
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
    }  else if(!validateDate($data[3], 'Y-m-d')===TRUE)
    {
        $message = 'Enter correct Year';
    }  else {

        $insertStmt = $con->prepare('INSERT INTO goods (id_workers,Mark,Year,Color,Price) VALUES(:id_workers,:Mark,:Year,:Color,:Price)');
        $insertStmt->execute(array(
            ':id_workers'=> htmlspecialchars($data[1]),
            ':Mark'=> htmlspecialchars($data[2]),
            ':Year'=> htmlspecialchars($data[3]),
            ':Color'  => htmlspecialchars($data[4]),
            ':Price'  => htmlspecialchars($data[5])
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
    }  else if(!validateDate($data[3], 'Y-m-d')===TRUE)
    {
        $message = 'Enter correct Year';
    }  else {

        $updateStmt = $con->prepare('UPDATE goods SET id_workers = :id_workers, Mark = :Mark, Year = :Year, Color = :Color, Price = :Price WHERE id_goods = :id_goods');
        $updateStmt->execute(array(
            ':id_goods'=> htmlspecialchars($data[0]),
            ':id_workers'=> htmlspecialchars($data[1]),
            ':Mark'=> htmlspecialchars($data[2]),
            ':Year'=> htmlspecialchars($data[3]),
            ':Color'  => htmlspecialchars($data[4]),
            ':Price'  => htmlspecialchars($data[5])

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

        $deleteStmt = $con->prepare('DELETE FROM goods WHERE id_goods = :id_goods');
        $deleteStmt->execute(array(
            ':id_goods'=> htmlspecialchars($data[0])
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
    if(empty($data[1]))
    {
        $message = 'Enter The User Id To Search';
    }  else {

        $searchStmt = $con->prepare('SELECT id_worker, Initials FROM workers WHERE id_worker = :id_workers;');
        $searchStmt->execute(array(
            ':id_workers'=> htmlspecialchars($data[1]),
        ));
        
        if($searchStmt)
        {
            $user = $searchStmt->fetch();
            if(empty($user))
            {
                $message = 'No Data For This Id';
            } else {

                $id_goods = $data[0];
                $id_workers = $user[0];
                $Mark = $data[2];
                $Year = $data[3];
                $Color = $data[4];            
                $Price = $data[5];
                $Initials = $user[1];
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
            <form action="goods.php" method="POST">

                <input type="number" name="id_goods" min="1" placeholder="ID good" value="<?php echo $id_goods;?>"><br><br>
                <input type="number" min="1" style="width: 71%" name="id_workers" placeholder="id workers" value="<?php echo $id_workers;?>"><input class="button" type="submit" id="buttonmain1" name="reload" value="Reload"><br><br>
                <input type="text" name="Initials" placeholder="Initials" value="<?php echo $Initials;?>"><br><br>
                <input type="text" name="Mark" placeholder="Mark" value="<?php echo $Mark;?>"><br><br>
                <input type="text" name="Year" placeholder="Year" value="<?php echo $Year;?>"><br><br>
                <input type="text" name="Color" placeholder="Color" value="<?php echo $Color;?>"><br><br>
                <input type="number"  min="1" name="Price" placeholder="Price" value="<?php echo $Price;?>"><br><br>

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