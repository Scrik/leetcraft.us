<!doctype html>
<html ng-app>
<head>
    <meta http-equiv="refresh" content="0; url=http://leetcraft.us/server">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
</head>
<body>
	<div id="header">
		<h2>Welcome to leetcraft server.</h2>
		1.6.4
	</div>
    <div ng-controller="todoCtrl">
        <ul>
            <li ng-repeat="do in todos">
                {{do.text}} 
            </li>
        </ul>
    </div>
</body>

<!--
    <script src="js/angular.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
->
</html>
