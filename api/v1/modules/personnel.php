<?php 
/**
 * Listing all personnel from a particular unit
 * method GET
 * url /tasks          
 */
$app->get('/personnel', 'authenticate', function() {
            global $user_id;
            global $user_unit;
            $response = array();
            $db = new DbHandler();

            // fetching all user tasks
            $result = $db->getAllPersonnel($user_unit);
            $response["user_unit"] = $user_unit;
            $response["error"] = false;
            $response["personnel"] = array();
            
            // looping through result and preparing tasks array
            while ($personnel = $result->fetch_assoc()) {
                $tmp = array();
                $tmp["id"] = $personnel["id"];
                $tmp["surname"] = $personnel["surname"];
                $tmp["status"] = $personnel["status"];
                $tmp["rank"] = $personnel["rank"]; 
                array_push($response["personnel"], $tmp); 
            } 

            echoRespnse(200, $response);
        });
