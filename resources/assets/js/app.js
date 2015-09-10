
var userApp = angular.module('userApp', ['bw.paging'], function($interpolateProvider, $httpProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
        $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';

    }).controller('UserController', function ($http, $scope) {
        var _token = document.getElementById('uid').value,
            page = 1,

        get_links = function () {
            $http({
                url: '/api/my/links',
                method: 'GET',
                params: {
                    page: page,
                    q: $scope.q

                }
            }).success(function (links) {
                var i = 0;

                angular.forEach(links.data, function (link) {
                    link.position = i;
                    link.updated_at = moment.utc(link.updated_at).fromNow();
                    link.created_at = moment.utc(link.created_at).fromNow();
                    link.long_edit_mode = false;
                    link.short_edit_mode = false;
                    i++;
                });

                $scope.links = links;
            });

            return 0;
        };

        $scope.edit = function (column, link) {
            angular.forEach($scope.links.data, function (link) {
                link[column] = false;
            });

            link[column] = true;
        };

        $scope.save = function (column, link) {
            link._token = _token;
            link._to_edit = column;

            $http({
                url: '/api/my/links',
                method: 'POST',
                data: link
            }).success(function (data) {
                link.updated_at = moment.utc(data.updated_at).fromNow();
                link.long_edit_mode = false;
                link.short_edit_mode = false;
            });

        };

        $scope.deleteLink = function (link) {
            link._token = _token;

            $http({
                url: '/api/my/links',
                method: 'DELETE',
                params: link
            }).success(function (data) {
                $scope.links.data.splice(link.position, 1);
            });
        };

        $scope.search = function () {
            get_links();
        };

        $scope.pageChanged = function () {
            page = arguments[0];
            get_links();

            return 0;
        };

        get_links();
    });

