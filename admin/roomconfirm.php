<?php

include '../config.php';

$id = $_GET['id'];

$sql ="Select * from roombook where id = '$id'";
$re = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($re))
{
	$Name = $row['Name'];
    $Email = $row['Email'];
    $Phone = $row['Phone'];
    $RoomType = $row['RoomType'];
    $NoofRoom = $row['NoofRoom'];
    $cin = $row['cin'];
    $cout = $row['cout'];
    $noofday = $row['nodays'];
    $stat = $row['stat'];
}


if($stat == "NotConfirm")
{
    $st = "Confirm";

    $sql = "UPDATE roombook SET stat = '$st' WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);

    if($result){

        $type_of_room = 0;      
        if($RoomType=="Double Room")
        {
            $type_of_room = 1000;
        }
        else if($RoomType=="Trible Room")
        {
            $type_of_room = 1500;
        }
        else if($RoomType=="Suite Room")
        {
            $type_of_room = 2500;
        }
                                                            
        $ttot = $type_of_room *  $noofday * $NoofRoom;

        $fintot = $ttot;

        $psql = "INSERT INTO payment(id,Name,Email,RoomType,NoofRoom,cin,cout,noofdays,roomtotal,finaltotal) VALUES ('$id', '$Name', '$Email', '$RoomType', '$NoofRoom', '$cin', '$cout', '$noofday', '$ttot', '$fintot')";

        mysqli_query($conn,$psql);

        header("Location:roombook.php");
    }
}
// else
// {
//     echo "<script>alert('Guest Already Confirmed')</script>";
//     header("Location:roombook.php");
// }


?>