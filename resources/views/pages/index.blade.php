@extends('layouts.app')

<template id="pages-template">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">List all pages
                <a href="/pages/create" class="pull-right">Add new page</a>
            </div>

            <div class="panel-body">
                <table class="table table-striped table-responsive">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Link</th>
                    <th scope="col">Domain</th>
                    <th scope="col">Lang</th>
                    <th scope="col">Location</th>
                    <th scope="col">Location Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Area</th>
                    <th scope="col">Freq</th>
                    <th scope="col">Next visited</th>
                    <th scope="col">Last visited</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    <tr v-for="page in parsed_pages">
                        <td>@{{ page.page_link }}</td>
                        <td>@{{ page.domain_name }}</td>
                        <td>@{{ page.page_lang }}</td>
                        <td>@{{ page.page_location }}</td>
                        <td>@{{ page.page_location_name }}</td>
                        <td>@{{ page.page_category }}</td>
                        <td>@{{ page.page_area }}</td>
                        <td>@{{ page.page_freq }}</td>
                        <td>@{{ page.page_next_time }}</td>
                        <td>@{{ page.page_last_time }}</td>
                        <td><a class="btn btn-primary btn-sm" v-bind:href="'/pages/'+page.id+'/edit'" role="button">Edit</a></td>
                        <td><a class="btn btn-danger btn-sm" href="#" role="button" @click="deletePage(page , page.id)">Delete</a></td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
</template>


@section('content')
    <pages-component pages="{{json_encode($pages)}}"></pages-component>
@endsection