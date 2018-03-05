<!DOCTYPE html>
    <html>
           <title> 
                Pints Product menu
           </title>
           <head>
                 <meta name="viewport" content="width=device-width, initial-scale=1.3">
                <style>
                        #hm {
                              margin-left:40px; 
                              padding-bottom:60px;
                            }
                        input[type=text] {
                                 width: 20%;
                                 padding: 12px 20px;
                                 margin: 20px 14px;
                                 box-sizing: border-box;
                                 border: none;
                                 border-bottom: 2px solid red ;
                                 font-size:20px;
                                 border-radius:10px;
                               }
                      input[type=submit]{
                                background-color:green;
                                color:white;
                                border-radius:10px;
                                width:7em;
                                height:2em;
                                cursor:pointer;
                                font-size:20px;
                   
                            }
                    .error{
                             color:red;
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
                    .button{
                           color:white;
                           background-color:green;
                           font-size:20px;
                           border-radius:10px;
                           width:120px;
                           height:40px;
                       }
               </style>
         </head>
      <body>
          <?php
                   
                     $dd=0;
                     $c_err= $n_err = $p_err = $g_err= $q_err= " ";
                     if($_SERVER["REQUEST_METHOD"] == "POST"){
                         if(empty($_POST["tcode"])) {$c_err="*required";$GLOBALS['dd']=1;}
                         if(empty($_POST["tname"])) {$n_err="*required";$GLOBALS['dd']=1;}
                         if(empty($_POST["tprice"])) {$p_err="*required";$GLOBALS['dd']=1;}
                         if(empty($_POST["tgst"])) {$g_err="*required";$GLOBALS['dd']=1;}
                         if(empty($_POST["tquantity"])) {$q_err="*required";$GLOBALS['dd']=1;}
                          function data_store(){
                                 $servername = "localhost";
                                 $username = "root";
                                 $password = "hello123";
                                 $dbname= "PRODUCTS";
                                 // mysql for data entry
                                /* Create connection 
                                    $conn = new mysqli($servername, $username, $password, $dbname)
                                    if ($conn->connect_error) {
                                           die("Connection failed: " . $conn->connect_error);
                                         }
                                    $stmt = $conn->prepare("INSERT INTO product (code, name, price, gst, quantity, Total_price) VALUES (?, ?, ?, ?, ?, ?)");
                                    $stmt->bind_param("ssssss", $e1, $e2, $e3, $e4, $e5, $e6);
                                                $e1= $_POST['tcode'];
            		                        $e2= $_POST['tname'];
                                                $e3= $_POST['tprice'];
                                                $e4= $_POST['tgst'];
                                                $e5= $_POST['tquantity'];
                                                $e6=(($e3+($e3*$e4/100))*$e5);
                                                $stmt->execute(); 
                                                 $stmt->close();
                                                  $conn->close();*/
                                 try {
                                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                        // set the PDO error mode to exception
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                       if($conn){
                                             $stmt = $conn->prepare("INSERT INTO product (code,name,price,gst,quantity,Total_price) VALUES 												 (:b1,:b2,:b3,:b4,:b5,:b6)");
                                                 $stmt->bindParam(':b1',$e1);
                                                 $stmt->bindParam(':b2',$e2);
                                                 $stmt->bindParam(':b3',$e3);
                                                 $stmt->bindParam(':b4',$e4);
                                                 $stmt->bindParam(':b5',$e5);
                                                 $stmt->bindParam(':b6',$e6);
                                                //set parameters and execute
                                                $e1= $_POST['tcode'];
            		                        $e2= $_POST['tname'];
                                                $e3= $_POST['tprice'];
                                                $e4= $_POST['tgst'];
                                                $e5= $_POST['tquantity'];
                                                $e6=(($e3+($e3*$e4/100))*$e5);
                                                $stmt->execute(); 
                                       
                                              }
                                      }
                                       
                                  catch(PDOException $e)
                                    {
                                      echo $sql . "<br>" . $e->getMessage();
                                    }
                                  $conn=null;
                   
                           }
     
                        if($GLOBALS['dd']==0) data_store();
                      }
                 ?>
          <h1 text-align="center" style="font-size:40px"> Welcome to Product Entry Page</h1>
              
            <div id="hm">
                         <form style="margin-top:5em" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> ">
                             <fieldset>
                               <legend style="font-size:30px;color:red">New Product Entry</legend>
                               <h4 class="error">*all data is Require</h4><br>
                               <label for="tcode">Product Code:</label>
                               <input type="text" placeholder=" code.." name="tcode">
                               <span class="error"><?php echo "$c_err" ?></span><br>

                               <label for="tname">Product Name:</label>
                               <input type="text" placeholder=" name.." name="tname">
                               <span class="error"><?php echo"$n_err" ?></span><br> 
 
                               <label for="tprice">Product Price(per unit):</lable>
                               <input type="text" placeholder=" per unit price.." name="tprice">
                               <span class="error"> <?php echo"$p_err" ?></span><br>

                               <label for="tgst">GST(%):</label>
                               <input type="text" placeholder=" gst.." name="tgst">
                               <span class="error"> <?php echo"$g_err" ?></span><br>

                               <label for="tquantity">Quantity of Product:</lable>
                               <input type="text" placeholder=" Quantity.." name="tquantity">
                               <span class="error"> <?php echo"$q_err" ?></span><br>

                               <div align="right" ><input type="submit" value="Go"></div>
                            </fieldset>
                         </form>
            </div>
             
          <?php
                               /* Create connection 
                                    $conn = new mysqli($servername, $username, $password, $dbname)
                                    if ($conn->connect_error) {
                                           die("Connection failed: " . $conn->connect_error);
                                         }
                                     echo "<fieldset> <legend style=\"font-size:30px;color:red\">Our Products </legend> ";
                                               $stmt2= $conn->query("select code,name,price,gst,quantity,Total_price from product");
                                              echo "<table><tr><th>Code</th><th>Name</th><th>Price(unit)</th><th>GST(%)</th><th>Quantity</th><th>Total 								price</th></tr>";
                                               while($row = $stmt2->fetch_assoc()){
                                                     echo "<tr><td>" . $row["code"]. "</td><td>" . $row["name"]. "</td><td>" . $row["price"]. "</td><td>". $row["gst"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["Total_price"] . "</td></tr>" ;
                                                    }  
                                              echo "</table>";
                                              echo "</fieldset>"; 
                                        $conn->close();
                                   */
                                 $servername = "localhost";
                                 $username = "root";
                                 $password = "hello123";
                                 $dbname= "PRODUCTS";

                                 try {
                                     //mysql for data show
                                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                       if($conn){ 
                                              echo "<fieldset> <legend style=\"font-size:30px;color:red\">Our Products </legend> ";
                                               $stmt2= $conn->query("select code,name,price,gst,quantity,Total_price from product");
                                              echo "<table><tr><th>Code</th><th>Name</th><th>Price(unit)</th><th>GST(%)</th><th>Quantity</th><th>Total 								price</th></tr>";
                                               while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
                                                     echo "<tr><td>" . $row["code"]. "</td><td>" . $row["name"]. "</td><td>" . $row["price"]. "</td><td>". $row["gst"] . "</td><td>" . $row["quantity"] . "</td><td>" . $row["Total_price"] . "</td></tr>" ;
                                                    }  
                                              echo "</table>";
                                              echo "</fieldset>"; 
                                            } 
                                     }
                                  catch(PDOException $e)
                                    {
                                      echo "<span style=\"text-align:center;font-size:30px;color:red\">Access Denied</span>";
                                    }
                                  $conn=null;
          ?>
            <div align="center"style="padding-top:30px">
                      <h4 style="color:red">Go to Search for product Page</h4>
                      <a href="entry_page.php" target="_blank">
			        <button class="button" >
					     next >>
					</button>
			  </a></div>
     </body>
</html>


