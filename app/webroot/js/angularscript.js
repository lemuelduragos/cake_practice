var app = angular.module('orderingSystem', []);

app.controller('registrarQueueController', function($scope, $http) {
    $scope.loadRegistrarQueue = function() { 
        $http.get("http://192.168.100.84/cake_practice/queues/select_registrar")
        .then(function(e) {
            $scope.queue = e.data;
        })

         $http.get("http://192.168.100.84/cake_practice/queues/select_serving")
        .then(function(e) {
            $scope.role = e.data.role;
            console.log($scope.role);
            $scope.serving_registrar = e.data.registrar;
            $scope.serving_cashier = e.data.cashier;
            $scope.serving_bookkeeper = e.data.bookkeeper;

            console.log(e.data)
        })
    };
    //initial call
    $scope.loadRegistrarQueue();
    //polling
    setInterval($scope.loadRegistrarQueue, 5000);

    $scope.getClientType = function(type) { 
        switch(type) {
            case "0" : 
                return "New Student"
                break;
            case "1" :
                return "Old Student"
                break;
            case "2" :
                return "Guest"
                break;
        }
    };


     $scope.getOfficeIntended = function(type) { 
        switch(type) {
            case "1" :
                return "Registrar";
                break;
            case "2" :
                return "Cashier";
                break;
            case "3" :
                return "Bookkeeper";
                break;
        }
    };

     $scope.nextRegistrar = function(queue) { 
        var id;
        if(queue != null && queue != "undefined" && queue.length > 0) {
           id = queue[0].Queue.id
        }

        $http.get("http://192.168.100.84/cake_practice/queues/next?id="+id)
        .then(function(e) {
            $scope.loadRegistrarQueue();
        })
    };
});


app.controller('userController', function($scope, $http) {
    angular.element(document).ready(function () {

        $scope.user = {};

        $scope.loadUser = function() { 
            $http.get("http://192.168.100.84/cake_practice/users/select")
            .then(function(e) {
                $scope.user = e.data;
            })
        };

        $scope.loadUser();

    });
});

//   angular.element($("[ng-controller='productsController']")).scope().mySample();