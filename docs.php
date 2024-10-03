<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:ital@1&display=swap" rel="stylesheet">


</head>



<body>
    <header>
        <!--NavBar Section-->
        <div class="navbar">
            <nav class="navigation hide" id="navigation">
                <span class="close-icon" id="close-icon" onclick="showIconBar()"><i class="fa fa-close"></i></span>
                <ul class="nav-list">
                    <li class="nav-item"><a href="Homepage.html">Homepage</a></li>
                    <li class="nav-item"><a href="docs.html">Documents</a></li>
                    <li class="nav-item"><a href="encryption.php">Encryption</a></li>
                </ul>
            </nav>
            <a class="bar-icon" id="iconBar" onclick="hideIconBar()"><i class="fa fa-bars"></i></a>
            <div class="brand">Documentation</div>
        </div>
        
    <div class="container">
        <!--Navigation-->
        <div class="navigate">
            <span><a href="">Documentations</a> >> <a href="">current notes</a></span>
        </div>

        <div class="comment-area hide" id="reply-area">
            <textarea name="reply" id="" placeholder="reply here ... "></textarea>
            <input type="submit" value="submit">
        </div>

<form action="database.php" method="GET">
    <input id="search" name="search" type="text" placeholder="Type here">
    <input id="submit" type="submit" value="Search">
    </form>


 <div class="main-container col-4">
        <!-- Login Form -->
        <div class="notepad" id="notes">
            <h2 class="text-center">Welcome </h2>
            <div class="documentation">
                <form action="docs.php" method="POST">
                    <div class="form-group">
                        <label for="name">Document Name</label>
                        <input type="text" class="doc-name" id="name" name="name"><br><br>
                    </div>
                    <div class="texts">
                        <label for="Document">Input your text here:</label>
                        <input type="Document" class="doc" id="Document" name="Document" size="150" height=" 300">
                        
                    </div><br><br>


                    <input id="submit" type="submit" value="submit">

                </form>
            </div>
        </div>

        

    </div>
    <script src="main.js"></script>

    <table>
  <tr>
     <th>Document Name</th>
     <th></th><th><th><th><th>
     <th>Notes</th>
     <th></th><th><th><th><th>
  </tr>
  </div>


</body>
</html>


<?php
include('database.php');
 $sql="SELECT serviceName,description,endDate,note from roomService_table ORDER BY endDate ASC";
  $result=$conn -> query($sql);
  if($result->num_rows>0){
      while ($row = $result -> fetch_assoc()){
     ?>
     <tr>
      <td><?php echo $row["Document Name"]; ?></td>
      <td></td><td><td><td><td>
      <td><?php echo $row["Document"]; ?></td>
      <td></td><td><td><td><td>

      <td><?php echo $row["endDate"]; ?></td>
      <td></td><td><td><td><td>
      <td><?php echo $row["note"]; ?></td>
      <td><a href="roomServiceForm.php?serviceName=<?php echo $row["serviceName"]; ?>
       & description=<?php echo $row["description"];?>
       & endDate=<?php echo $row["endDate"];?>
       & note=<?php echo $row["note"];?>"
       style="color:green; font-size: 30px;">
       <button style="color:white; border:green;
       background:green; width:110px; height: 39px;"> Book </button> </a>


     </tr>
     <?php
      }
  }
$conn-> close();

    

 
