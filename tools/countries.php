<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
if(connection());
if(isset($_REQUEST['country'])){
	$result = MysqlSelectQuery("select * from countries where continent='".$_REQUEST['country']."'");
	echo '<option value = ""> -- Select Country -- </option>';
	while($rows = SqlArrays($result)){
		echo '<option value="'.$rows['id'].'">'.$rows['countries'].'</option>';
	}
}

if(isset($_REQUEST['GetState'])){
	$result = MysqlSelectQuery("select * from states where state_id='".$_REQUEST['GetState']."'");
	
	echo'<option value = ""> -- Select State -- </option>';
	while($rows = SqlArrays($result)){
		echo '<option value="'.$rows['id_state'].'">'.$rows['name'].'</option>';
	}

}
if(isset($_REQUEST['LagosDivisons'])){
    $availRegions = array("Badagry"=>1, "Epe"=>2, "Ikeja"=>3, "Ikorodu"=>4, "Lagos"=>5);
    echo'<option value = ""> -- Select a Division (Lagos State Only) -- </option>';
    foreach ($availRegions as $key => $value) {
        echo '<option style="color:red" disabled="disabled">'.$key.' Division</option>';
        $result = MysqlSelectQuery("SELECT * FROM lagos_divisions WHERE region = $value ");
	while($rows = SqlArrays($result)){
            echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
	}
    }

}
if(isset($_REQUEST['LagosSubDivisons'])){
        $region = isset($_REQUEST['LagosSubDivisons']) && !empty($_REQUEST['LagosSubDivisons']) && is_numeric($_REQUEST['LagosSubDivisons']) ? " WHERE region = ".$_REQUEST['LagosSubDivisons'] : "";
	$result = MysqlSelectQuery("SELECT * FROM lagos_divisions $region");
	
	echo'<option value = ""> ** Select a sub-division ** </option>';
	while($rows = SqlArrays($result)){
		echo '<option value="'.$rows['id'].'">'.$rows['name'].'</option>';
	}

}
?>