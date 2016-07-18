var clothApp = angular.module('clothApp', ['infinite-scroll', 'ngMaterial']);

clothApp.config(function($mdThemingProvider) {

    $mdThemingProvider.alwaysWatchTheme(true);
    $mdThemingProvider.definePalette('black', {
        '50': '000000',
        '100': '000000',
        '200': '000000',
        '300': '000000',
        '400': '000000',
        '500': '000000',
        '600': '000000',
        '700': '000000',
        '800': '000000',
        '900': '000000',
        'A100': '000000',
        'A200': '000000',
        'A400': '000000',
        'A700': '000000',
        'contrastDefaultColor': 'light'
    });
    $mdThemingProvider.definePalette('white', {
        '50': 'ffffff',
        '100': 'ffffff',
        '200': 'ffffff',
        '300': 'ffffff',
        '400': 'ffffff',
        '500': 'ffffff',
        '600': 'ffffff',
        '700': 'ffffff',
        '800': 'ffffff',
        '900': 'ffffff',
        'A100': 'ffffff',
        'A200': 'ffffff',
        'A400': 'ffffff',
        'A700': 'ffffff',
        'contrastDefaultColor': 'dark'
    });

    $mdThemingProvider.theme('all').primaryPalette('white');
    $mdThemingProvider.theme('black').primaryPalette('black');
    $mdThemingProvider.theme('white').primaryPalette('white');
    $mdThemingProvider.theme('blue').primaryPalette('blue', {'hue-1': '500'});
    $mdThemingProvider.theme('green').primaryPalette('green', {'hue-1': '500'});
    $mdThemingProvider.theme('red').primaryPalette('red', {'hue-1': '500'});
    $mdThemingProvider.theme('pink').primaryPalette('pink');
    $mdThemingProvider.theme('purple').primaryPalette('purple');
    $mdThemingProvider.theme('grey').primaryPalette('grey');
    $mdThemingProvider.theme('cyan').primaryPalette('cyan');
    $mdThemingProvider.theme('brown').primaryPalette('brown');
    $mdThemingProvider.theme('yellow').primaryPalette('yellow');
    $mdThemingProvider.theme('orange').primaryPalette('orange');
    $mdThemingProvider.theme('mixed').primaryPalette('white');
});

clothApp.controller('clothCtrl', function ($scope, $http)
    {
        $scope.menuIsOpen = false;
        $scope.selectedMode = 'md-fling';
        $scope.selectedDirection = 'left';

        $http.get('items.php?ResultsCount=40').success(function(data)
        { $scope.items = data;});

        $scope.busy = false;
        $scope.endOfPage = false;
        $scope.count = 40;
        $scope.newItems;
        $scope.offset = 0;
        $scope.urlString = 'items.php?ResultsCount=40';
        $scope.filterParams = {
            gender: '',
            upToPrice: 10001,
            type: '',
            size: 'הכל',
            color: 'all',
            sort: ''

        };
        $scope.selectedStores = [];
        $scope.stores = [{name:'Castro', hName: 'קסטרו'}, {name:'Renuar', hName:'רנואר'}, {name:'Nautica', hName:'נאוטיקה'}];
        $scope.sorts = [{type:'asc', hType: 'מחיר - עולה'}, {type:'desc', hType: 'מחיר - יורד'}, {type:'', hType: 'אקראי'}];

        $scope.upToPriceList = [{id:10001, label: 'הכל' }, {id: 50, label: 'עד 50'}, 
                                {id: 100, label: 'עד 100'}, {id: 200, label: 'עד 200'}, 
                                {id: 300, label: 'עד 300'}, {id: 500, label: 'עד 500'}, 
                                {id:10000, label:'מעל 500'}];

        $scope.sizesList = [{id: 10001, label: 'הכל' }, {id: 0, label: 'XS' }, {id: 1, label: 'S' }, {id: 2, label: 'M' }, {id: 3, label: 'L'},
            {id: 4, label: 'XL' }, {id: 5, label: '2X' }, {id: 6, label: '3X'}, {id: 30, label: '30' }, {id: 32, label: '32' },
            {id: 34, label: '34'}, {id: 36, label: '36' }, {id: 38, label: '38'},
            {id: 40, label: '40' }, {id: 42, label: '42' }, {id: 44, label: '44'}];

        $scope.colorsList = [{id: 10001, label: 'הכל', query: 'all' }, {id: 0, label: 'שחור', query: 'black' },
            {id: 1, label: 'לבן', query: 'white'}, {id: 2, label: 'כחול', query: 'blue' }, {id: 3, label: 'ירוק', query: 'green' },
            {id: 4, label: 'אדום', query: 'red' }, {id: 5, label: 'ורוד', query: 'pink' }, {id: 6, label: 'סגול', query: 'purple' },
            {id: 7, label: 'אפור', query: 'grey'}, {id: 8, label: 'תכלת', query: 'cyan' }, {id: 9, label: 'חום', query: 'brown' },
            {id: 10, label: 'צהוב', query: 'yellow' }, {id: 11, label: 'כתום', query: 'orange' }, {id: 12, label: 'משולב', query: 'mixed' }];

        $scope.changeColor = function($colorParam) {

            $scope.filterParams.color = $colorParam;
            $scope.filterItems();
        };

        $scope.updateUrl = function ()
        {
            $scope.urlString ='items.php?PriceMax=' + $scope.filterParams.upToPrice.toString();

            if($scope.filterParams.upToPrice == 10000)
                $scope.urlString += '&PriceMin=500';

            if ($scope.filterParams.size !== 'הכל')
                $scope.urlString += '&Size=' + $scope.filterParams.size;

            if ($scope.filterParams.color !== 'all')
                $scope.urlString += '&Color=' + $scope.filterParams.color;

            $scope.urlString += '&SubCategory='+ $scope.filterParams.type + '&MainCategory=' + $scope.filterParams.gender
                +'&ResultsCount=' + $scope.count + '&ResultsOffset=' + $scope.offset + '&StoreName='
                + $scope.selectedStores.toString() + '&SortBy=' + $scope.filterParams.sort;

        };
        $scope.filterItems = function () 
        {
            $scope.busy = true;
            $scope.endOfPage = false;
            $scope.offset = 0;
            $scope.updateUrl();
            $http.get($scope.urlString).success(function(data) { $scope.items = data; $scope.busy = false;});
         };

        $scope.loadMore = function()
        {
            if ($scope.busy) return;
            $scope.busy = true;

            $scope.offset += $scope.count;
            $scope.updateUrl();
            $http.get($scope.urlString).success(function(data)
            {
                $scope.newItems = data;
                for (var i = 0; i < $scope.newItems.length; i++){
                    $scope.items.push($scope.newItems[i]);
                }
                if ($scope.newItems.length == 0)
                    $scope.endOfPage = true;
                
                $scope.busy = false;
            }
            );
        };
        
        $scope.trackEvent = function($category, $action, $label)
        {
            ga('send', 'event', $category, $action, $label);
        }
    }
);


