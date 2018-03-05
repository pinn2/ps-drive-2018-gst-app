<!DOCTYPE HTML>
<html>
     <title>
           pints product entry 
     </title>
      
     <head>
           <meta name="viewport" content="width=device-width, initial-scale=1.3">
           <style> 
               .header{
                       font-size:40px;
                       color:red;
                       padding:40px;
                   }
                  table {
                           margin:40px;
                           border:solid 1px black;
                          }
                    th,td {
                            border:solid 1px black;
                            width:410px;
                            height:20px;
                            text-align:center;
                         } 
                 input[type=text] {
                              width: 70%;
                              box-sizing: border-box;
                              border: 2px solid #ccc;
                              border-radius: 4px;
                              font-size: 26px;
                              margin:60px;
                              background-color: white;
                              background-image: url('http://icons.iconarchive.com/icons/graphicloads/100-flat/256/zoom-search-2-icon.png');
                              height:80px;
                              background-position: 10px 10px; 
                              background-repeat: no-repeat;
                              padding: 20px 20px 20px 220px;
                             }
                
                  input[type=submit]{
                                background-color:green;
                                color:white;
                                border-radius:10px;
                                width:5em;
                                height:3em;
                                cursor:pointer;
                                }
                   .button{
                           color:white;
                           background-color:green;
                           font-size:20px;
                           border-radius:10px;
                           width:120px;
                           height:60px;
                       }

           </style>
     </head>
     
     <body>
	      <!--Welcome Heading -->
          <span class="header"> Welcome to Entry Search Product Page </span>
	     
	     <!-- Search Form for product by Code or BY Name -->
	     
           <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
                 <input type="text" name="search" placeholder="Search.. Enter Product Name or Code">
                 <input type="submit" value="Search">
           </form>
	     
	     <!-- php code for getting that product -->
	     <!-- two type MYSQL is shown below first MYSQLi and Second one is MYQSL PDO -->
	     <!--  but i used as local host in Linux MYSQL PDO -->
	     
	     <!--
                   DATABSE NAME: PRODUCTS
                   TABLE :   product (code int , name varchar(40), price double(10,3), gst float(4,2) quantity int, Total_price double(40,3));
                   
              -->
      <?php
              $inv=" ";
              $de=1;
              if($_SERVER["REQUEST_METHOD"] == "POST"){
                                 $servername = "localhost";
                                 $username = "pints";
                                 $password = "password";
                                 $dbname= "PRODUCTS";

                                 //for MYSQLi DATA base Connection

                                  /* Create connection 
                                    $conn = new mysqli($servername, $username, $password, $dbname)
                                    if ($conn->connect_error) {
                                           die("Connection failed: " . $conn->connect_error);
                                         }
                                                 $sd=$_POST['search'];
                                                 $stmt=$conn->query("select code,name,Total_price from product where code='$sd' OR name='$sd'");
                                                 
                                                 while($result = $stmt->fetch_assoc()) {
                                           $GLOBALS['de']=0;
                                           echo "<table><tr><th>Code</th><th>Name</th><th>Total price</th></tr>";
                                           echo "<tr><td>" . $result["code"]. "</td><td>" . $result["name"]. "</td><td>" . $result["Total_price"].  "</td></tr>" ; 
                                              echo "</table>";
                                             }
                                             if($GLOBALS['de']==1){
                                                        $GLOBALS['inv']="<div align=\"center\" style=\" padding-bottom:40px\"><span style=\"font-size:30px;color:red\">Invalid input</span></div>";
                                                     }
                                        $conn->close();
                                         echo "$inv";
                                   */
                    
                               // for MYSQL PDO data base connection

                                 try {
                                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                        // set the PDO error mode to exception
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                       if($conn){
                                                 $sd=$_POST['search'];
                                                 $stmt=$conn->query("select code,name,Total_price from product where code='$sd'OR name='$sd'");
                                                 // data fetch from data base
                                                 while($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                           $GLOBALS['de']=0;
                                           echo "<table><tr><th>Code</th><th>Name</th><th>Total price</th></tr>";
                                           echo "<tr><td>" . $result["code"]. "</td><td>" . $result["name"]. "</td><td>" . $result["Total_price"].  "</td></tr>" ; 
                                              echo "</table>";
                                             }
                                             if($GLOBALS['de']==1){
                                                        $GLOBALS['inv']="<div align=\"center\" style=\" padding-bottom:40px\"><span style=\"font-size:30px;color:red\">Invalid input</span></div>";
                                                     }
                                           }
                                     }
                                 catch(PDOException $e)
                                    {
                                      echo $sql . "<br>" . $e->getMessage();
                                    }
                                  $conn=null;
		      // Warning if input is not Valid 
                               echo "$inv";
                           }
      ?>
	     
	     <!-- button for go back to product page -->
         <div align="center"><a href="product.php" target="_self">
			        <button class="button" >
					     Go Back
					</button>
			  </a></div>
     </body>
   
</html>
