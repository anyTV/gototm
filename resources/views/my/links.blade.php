@extends('my.master')
@section('body')
    @include('partials.header')
    <div class="main" ng-controller="UserController">
        <div class="container">
            <h1>My URLs</h1>
            <p>Click the url to edit</p>
            <div class="content">
                <div class="sub-content">
                    Search: <input type="text" ng-model="q"/><button ng-click="search()">Submit</button>
                </div>
                <div class="sub-content">
                    <ul ng-show="errors" class="error-list">
                        <li ng-repeat="(key, error) in errors track by key">
                            <p ng-bind="error"></p>
                        </li>
                    </ul>
                    <table>
                        <thead>
                            <th>Long URL</th>
                            <th>Short URL</th>
                            <th>Date Updated</th>
                            <th>Date Created</th>
                            <th>Created By</th>
                            <th></th>
                        </thead>
                        <tr ng-repeat="(key, link) in links.data track by key">
                            <td>
                                <a ng-hide="link.long_edit_mode" href="#edit&long_id=<% link._id %>" ng-click="edit('long_edit_mode', link)" ng-bind="link.long_url" class="truncate"></a>
                                <div ng-show="link.long_edit_mode">
                                    <input type="text" name="long-url-<% link._id %>" ng-model="link.long_url"/>
                                    <button ng-click="save('long_url', link)">save</button>
                                    <button ng-click="link.long_edit_mode = !link.long_edit_mode">cancel</button>
                                </div>
                            </td>
                            <td>
                                <a ng-hide="link.short_edit_mode" href="#edit&short_id=<% link._id %>" ng-click="edit('short_edit_mode', link)" ng-bind = "link.short_url" class="truncate"></a>
                                <div ng-show="link.short_edit_mode">
                                    <input type="text" name="short-url-<% link._id %>" ng-model="link.short_url"/>
                                    <button ng-click="save('short_url', link)">save</button>
                                    <button ng-click="link.short_edit_mode = !link.short_edit_mode">cancel</button>
                                </div>
                            </td>
                            <td ng-bind = "link.updated_at">
                            <td ng-bind = "link.created_at">
                            <td ng-bind = "link.email">
                            <td>
                                <a href="#delete&link_id=<% link._id %>" ng-click="deleteLink(link)">delete</a>
                                <!--a href="#monitor&link_id=<% link._id %>">monitor</a-->
                            </td>
                        </tr>
                    </table>
                </div>

                <input type="hidden" id="uid" value="{{ csrf_token() }}"/>
                <paging class="paginate" page-size="links.per_page" total="links.total" page="links.current_page" paging-action="pageChanged(page, pageSize, total)" show-prev-next="true"></paging>
                <br>
                @if ($errors->any())
                    <ul class="error-list">
                        @foreach ($errors->all() as $error) 
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
