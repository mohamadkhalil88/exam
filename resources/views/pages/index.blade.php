@extends('layouts.app')

<template id="pages-template">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List all pages
                        <a href="/pages/create" class="pull-right">Add new page</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Link</th>
                            <th scope="col">Lang</th>
                            <th scope="col">Location</th>
                            <th scope="col">Location Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Area</th>
                            <th scope="col">Freq</th>
                            <th scope="col">Next visited</th>
                            <th scope="col">Last visited</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="page in parsed_pages">
                                <th scope="row">1</th>
                                <td>@{{ page.page_link }}</td>
                                <td>@{{ page.page_lang }}</td>
                                <td>@{{ page.page_location }}</td>
                                <td>@{{ page.page_location_name }}</td>
                                <td>@{{ page.page_category }}</td>
                                <td>@{{ page.page_area }}</td>
                                <td>@{{ page.page_freq }}</td>
                                <td>@{{ page.page_next_time }}</td>
                                <td>@{{ page.page_last_time }}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


@section('content')
    <pages-component pages="{{json_encode($pages)}}"></pages-component>
@endsection