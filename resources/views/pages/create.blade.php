@extends('layouts.app')

<template id="form-page-create-template">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">New Page</div>

                    <div class="panel-body">

                        <form action="/pages" method="post" id="frmPage">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group">
                                <label for="domain_name">Domain Name</label>
                                <select class="form-control" name="domain_id" id="domain_id">
                                    <option v-for="domain in parsed_domains" v-bind:value="domain.id">@{{ domain.domain_name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="page_link">Link</label>
                                <input type="text" class="form-control" name="page_link" id="page_link" placeholder="Enter Link" v-bind:value="parsed_page.page_link">
                            </div>
                            <div class="form-group">
                                <label for="page_lang">Language</label>
                                <input type="text" class="form-control" name="page_lang" id="page_lang" placeholder="Enter Language Code" v-bind:value="parsed_page.page_lang">
                            </div>
                            <div class="form-group">
                                <label for="page_location">Location</label>
                                <input type="text" class="form-control" name="page_location" id="page_location" placeholder="Enter Location" v-bind:value="parsed_page.page_location">
                            </div>
                            <div class="form-group">
                                <label for="page_location_name">Location Name</label>
                                <input type="text" class="form-control" name="page_location_name" id="page_location_name" placeholder="Enter Location Name" v-bind:value="parsed_page.page_location_name">
                            </div>
                            <div class="form-group">
                                <label for="page_category">Category</label>
                                <input type="text" class="form-control" name="page_category" id="page_category" placeholder="Enter Category" v-bind:value="parsed_page.page_category">
                            </div>
                            <div class="form-group">
                                <label for="page_area">Area</label>
                                <input type="text" class="form-control" name="page_area" id="page_area" placeholder="Enter Area" v-bind:value="parsed_page.page_area">
                            </div>
                            <div class="form-group">
                                <label for="page_freq">Frequency </label>
                                <input type="text" class="form-control" name="page_freq" id="page_freq" placeholder="Enter Frequency" v-bind:value="parsed_page.page_freq">
                                <small>(Cron Format : * * * * * *)</small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


@section('content')
    <form-page-create-component page="{{ json_encode($page) }}" domains="{{ json_encode($domains) }}"></form-page-create-component>
@endsection