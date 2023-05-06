<?php 
        $errors = array();
			require_once "connect.php";
			
			$db = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($db->connect_errno!=0)
	{
		echo "Error: ".$db->connect_errno;
	}
	else
	{
        $sql = "SELECT * FROM room WHERE user_id = (SELECT user_id FROM users WHERE username = '$_SESSION[username]') AND isActive = 1";
		$result = $db->query($sql);
			ini_set('display_errors', 0);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    if ($row["isActive"] == 1) {
                        ?>
						<form action="calculate.php">
						<button> <?PHP echo $row["renoName"]; ?></button>
						</form>
						<?php
                    }
					else {
						echo "brak";
					}
                }
            }
    $db->close();
}

		?>