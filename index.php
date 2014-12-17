<!DOCTYPE html>
<html>

<head>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<body>

<div ng-app="" ng-controller="personController">
    <p><input type="text" ng-model="searchbox" placeholder="search"></p>
    <ul>
        <li ng-repeat="x in names | filter:searchbox">
            {{ x.rank }} {{ x.surname }}
        </li>
    </ul>
</div>
<script>
    function personController($scope) {
        
        apikey = localStorage["cnApikey"];
        $myData = jQuery.parseJSON(
            $.ajax({
                type: "GET",
                url: "api/v1/personnel",
                async: false,
                dataType: 'json',
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', apikey); 
                    
                }
            }).responseText
        );
        $scope.names = $myData['personnel'];
        console.log($myData);
        //console.log($myData["personnel"]);
    }
</script>
    <?php
$dir = dirname(__FILE__);
?>
</body>
</html>