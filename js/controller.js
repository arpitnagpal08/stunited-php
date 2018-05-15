var app=angular.module('mainApp',[]);

app.controller('mainCtrl', function($scope){
	
	//Website name
	$scope.website = "College Social Media";
	$scope.websiteName = "Stunited";
	//navbar lists
	$scope.nav_item_1 = "Home";
	$scope.nav_item_2 = "My Account";
	$scope.nav_item_3 = "Notifications";
	$scope.nav_item_4 = "Forum";
	$scope.nav_item_5 = "About";
	$scope.nav_item_6 = "Contact Us";
	$scope.nav_item_7 = "Login/Sign Up";

	$scope.my_account_1 = "Home";
	$scope.my_account_2 = "Profile";
	$scope.my_account_3 = "Messages";
	$scope.my_account_4 = "Events";
	$scope.my_account_5 = "Attendance";

	$scope.nav2Item1='Latest';
	$scope.nav2Item2='Trending';
	$scope.nav2Item3='Popular this week';
	$scope.nav2Item4='Popular this month';
	$scope.nav2Item5='Popular all time';


});

