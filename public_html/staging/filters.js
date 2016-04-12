
var clothApp = angular.module('clothApp', []);
clothApp.controller('clothCtrl', function ($scope, $http)
    {
        /*$scope.items = null;*/
        $http.get('../items.php?ResultsCount=100').success(function(data)
        { $scope.items = data;});
    
    
        $scope.filterParams = {
            gender: '',
            upToPrice: 10001,
            type: ''
        };
    
        $scope.upToPriceList = [{id:10001, label: 'הכל' }, {id: 50, label: 'עד 50'}, 
                                {id: 100, label: 'עד 100'}, {id: 200, label: 'עד 200'}, 
                                {id: 300, label: 'עד 300'}, {id: 500, label: 'עד 500'}, 
                                {id:10000, label:'מעל 500'}];


        $scope.filterItems = function () 
        {
            var urlString ='../items.php?PriceMax=' + $scope.filterParams.upToPrice.toString();
            
            if($scope.filterParams.upToPrice == 10000)
                urlString = urlString + '&PriceMin=500';

            if ($scope.filterParams.type  !== '')
                urlString = urlString + '&SubCategory='+ $scope.filterParams.type;

            if ($scope.filterParams.gender !== '')
                urlString = urlString + '&MainCategory=' + $scope.filterParams.gender;

            urlString = urlString +'&ResultsCount=100';

            $http.get(urlString).success(function(data) { $scope.items = data; }); 
         };
        
    }
);

