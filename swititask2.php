<?php 

    include_once ('conn.php');
    
         if(isset($_GET['submit']))
         {

            $email = $_GET["email"];
            $exampleInputName = $_GET["exampleInputName"];
            $exampleInputAddress = $_GET["exampleInputAddress"];
            $exampleInputNumber = $_GET["exampleInputNumber"];
            $exampleInputDOB = $_GET["exampleInputDOB"];
            
            
            $query = "UPDATE register SET exampleInputName = '".$exampleInputName."' , 
            exampleInputAddress = '".$exampleInputAddress."' ,
             exampleInputDOB = '".$exampleInputDOB."' , exampleInputNumber = '".$exampleInputNumber."' WHERE email = '".$email."'";

            $data = mysqli_query($conn , $query);
            if($data)
            {
                echo "Record Updated Successfully";
            }
            else
            {
                echo "Record not updated";
            }
        
        $email = "";
        if(isset($_GET['email'])) {
            $email =  $_GET['email'];
        }
        $query = "SELECT * 
          FROM 
          register WHERE email = '". $email ."'";
    
        $result = mysqli_query($conn, $query);

        $row = array();
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        }
        else {
         $msg = "Record not found.";
            header('location: index.php?msg=' . $msg); 
            exit();
}
 ?>
  <!DOCTYPE html>
 <html>
 <head>
    <title>update</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  </head>
 <body>
    <div class="container">
        <div class="jumbotron">
            <h1>Update\Edit Form</h1>
            <p>Please fill all the details correctly</p>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">


        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
        </div>


        <div class="form-group">
        <label for="exampleInputName">Name</label>
        <input type="text" class="form-control" name="exampleInputName" value="<?php echo $row['exampleInputName']; ?>">
        </div>

        <div class="form-group">
        <label for="exampleInputAddress">Address</label>
        <textarea class="form-control" name="exampleInputAddress" rows="5" value="<?php echo $row['exampleInputAddress']; ?>"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputNumber">Number</label>
                    <input type="number" class="form-control" name="exampleInputNumber" value="<?php echo $row['exampleInputNumber']; ?>">
                </div>                  
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputDOB">DOB</label>
                    <input type="date" class="form-control" name="exampleInputDOB" value="<?php echo $row['exampleInputDOB']; ?>">
                </div>                  
            </div>  
        </div> 
        <input type="submit" name="submit" value="Update">
    </form>
</div>
 