<?php 
session_start();
require_once 'dbConnect.php';

$business = $_SESSION['business'];
$sql = "SELECT * FROM business WHERE businessId = {$business}";
$row = mysqli_query($connect, $sql);

$business = $row->fetch_assoc();
$id = $business['businessId'];
$skillId = $business['fk_skillId'];


$output='';

$businessId=$_SESSION['business'];
$sqlFavAlId="SELECT favorites FROM business WHERE businessId ='".$businessId."'";
//echo "<h1>" .$sqlFavAlId."</h1>";
$resultFavAlId = mysqli_query($connect, $sqlFavAlId);//1,3,4

$fav_Id='';



if(isset($_POST["favAlId"])){
  $fav_Id=$_POST["favAlId"];  //ex  if you click the alumni id =6  $fav_Id=6


        if($resultFavAlId->num_rows==0){  // if there is no fav alumnis...  it is simple just update the table
                mysqli_query($connect, "UPDATE business SET favorites = '".$fav_Id."' WHERE businessId='".$businessId."' ");

        }
        elseif($resultFavAlId->num_rows==1) // if there are already one or more fav alumnis ..
        {  // rows should be always max 1

                $row = $resultFavAlId->fetch_assoc();  //$row["favorites"]  is string like "2,3,4,5"
                $arrAlId=explode(",",$row["favorites"]); // split $row["favorites"] by "," then create an array  [2,3,4,5].
                $length=count($arrAlId);   // length of array is "4";
               
  
                    for($i=0; $i<$length; $i++){

                         if($i+1==$length && $arrAlId[$i]!=$fav_Id ){  // when the last one $arrAlId[3] and 6 are different, 
                            array_push($arrAlId, $fav_Id );//   6 will be pushed to array   [2,3,4,5]　→　[2,3,4,5,6]   
                            $favAls=implode(",",$arrAlId); //[2,3,4,5,6]　→　"2,3,4,5,6"

                            mysqli_query($connect, "UPDATE business SET favorites = '".$favAls."' WHERE businessId='".$businessId."' ");
                            
                          }else{

                            if($arrAlId[$i] != $fav_Id ){  // 6 will be compared with 2,3,4, 
                               // if they are differend id, loop will be continued.
                              continue;  
                             
                            } else {   // if there is smae fav_Id, the id will be removed. 
                                unset($arrAlId[$i]); 
                                $favAls=implode(",",$arrAlId);
                                mysqli_query($connect, "UPDATE business SET favorites = '".$favAls."' WHERE businessId='".$businessId."' ");
                                break;   //  
                           }
                       }
                 
                } // end forloop

        }

    }
    
           $resultFavAlId = mysqli_query($connect, $sqlFavAlId);

            $sqlFavAl ="SELECT*FROM alumni WHERE  ";  // to get each alumni data  

            if($resultFavAlId->num_rows==0){
                echo "No Favorite alumnis";
                }elseif($resultFavAlId->num_rows==1){  // rows should always max 1
                  $row = $resultFavAlId->fetch_assoc();  //$row["favorites"]  is string like 2,3,4,5
                  $arrAlId=explode(",",$row["favorites"]); // split $row["favorites"] by "," then create an array  [1,3,4].
                  $length=count($arrAlId);   // length of array is "3";
                 

                  if($length==1)  // In case favorite is only one.  no need for loop 
                    {
                         $sqlFavAl .="alumniId ='".$arrAlId[0]."'";
             
                    }
                     else  // In case there are more than one favorite alumnis .
                    {  
                       for($i=0; $i<$length; $i++){
                         if($i+1==$length){
                              $sqlFavAl.="alumniId ='".$arrAlId[$i]."'"; 

                         }else{
                              $sqlFavAl.="alumniId ='".$arrAlId[$i]."'OR ";
                           }
                 
                        } // end forloop

                    }
              }
             //  echo "<h1>" .$sqlFavAl."</h1>";
              $resultFavAl = mysqli_query($connect, $sqlFavAl);
              if($resultFavAl->num_rows == 0){
                echo "No result";
              }elseif($resultFavAl->num_rows == 1){
                $row = $resultFavAl->fetch_assoc();
                $output .='<div class="card" style="width: 18rem;">
                      <div class="card-body">
                      <h5 class="card-title"> Firstname : '.$row["firstname"].' </h5>
                       <form> 
                      <input type="hidden" class="businessId" value='.$businessId.'>
                      <button type="button"  class="fav_btn" id='.$row["alumniId"].' name="fav" value='.$row["alumniId"].'>
                       
                      favorite
                     </button>
                     </form> 
                     </div>
                     </div>';

                echo $output;
              }else{
                 $rows = $resultFavAl->fetch_all(MYSQLI_ASSOC);
                 foreach($rows as $key => $value){
                     $output .='<div class="card" style="width: 18rem;">
                      <div class="card-body">
                      <h5 class="card-title"> Firstname : '.$value["firstname"].' </h5>
                       <form> 
                      <input type="hidden" class="businessId" value='.$businessId.'>
                      <button type="button"  class="fav_btn" id='.$value["alumniId"].' name="fav"  value='.$value["alumniId"].'>
                      favorite
                     </button>
                     </form> 
                     </div>
                     </div>';
                 }

                  echo $output;
              };





 

 ?>