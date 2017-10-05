var app = angular.module('orderingSystem', []);


app.controller('productsController', function($scope, $http) {

        $scope.loadproducts = function() { 
            $http.get("http://localhost.com/cakeangular/products/select")
            .then(function(e) {
                $("#tableResults").html(e.data);
            })
        };

        $scope.loadproducts();

});


app.controller('userController', function($scope, $http) {
    angular.element(document).ready(function () {

        $scope.user = {};

        $scope.loadUser = function() { 
            $http.get("http://localhost.com/cakeangular/users/select")
            .then(function(e) {
                $scope.user = e.data;
            })
        };

        $scope.loadUser();

    });
});

app.controller('cartsController', function($scope, $http) {
        $scope.loadCart = function() { 
            $http.get("http://localhost.com/cakeangular/carts/select")
            .then(function(e) {
                $("#tableResults").html(e.data);
            })
        };

        $scope.removeCart = function(id) {
            $http.post("http://localhost.com/cakeangular/carts/delete",id)
            .then(function(e) {
                alert('Items successfully removed from cart!');
                $scope.countCart();
                $scope.loadCart();

            })
        };
 
        $scope.loadCart();

});




app.controller('globalController', function($scope, $http) {
    angular.element(document).ready(function () {
        $scope.count = 0;
        $scope.countCart = function() {
             $http.get("http://localhost.com/cakeangular/carts/count")
            .then(function(e) {
                $scope.count = e.data;
            })
        };
      
        $scope.countCart();

    });

    $scope.addToCart = function(id,quantity) {
        var Cart = {
            product_id : id,
            quantity : quantity
        }
        $http.post("http://localhost.com/cakeangular/carts/addCart",Cart)
        .then(function(e) {
            alert(quantity+' Item/s successfully added to cart!');
            $scope.countCart();
        })
    };

});




//   angular.element($("[ng-controller='productsController']")).scope().mySample();