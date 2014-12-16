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
        
        $myData = jQuery.parseJSON(
            $.ajax({
                type: "GET",
                url: "http://localhost/cadetnet-be/v1/personnel",
                //url: "http://api.takethechallenge.co.nz/v1/personnel",
                //async: false,
                contentType : "application/json",
                dataType: 'jsonp',
                beforeSend: function (xhr){ 
                    xhr.setRequestHeader('Authorization', '3a2e796b37691444c7143bf406f1a538'); 
                    //xhr.setRequestHeader('Authorization', 'a42efed6147492e278ecdf752ed3f0b4'); 
                }
            }).responseText
        );
        $scope.names = $myData['personnel'];
        console.log($myData);
        //console.log($myData["personnel"]);
    }
</script>
</body>
</html>