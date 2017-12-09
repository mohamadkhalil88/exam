@extends('layouts.app')

<template id="form-domain-template">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">@{{ parsed_domain.domain_name }}</div>

                    <div class="panel-body">

                        <form v-bind:action="'/domains/'+parsed_domain.id" method="post" id="frmDomain">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="domain_name">Domain Name</label>
                                <input type="text" class="form-control" name="domain_name" id="domain_name" placeholder="Enter Domain Name" v-bind:value="parsed_domain.domain_name">
                            </div>
                            <div class="form-group">
                                <label for="domain_link">Link</label>
                                <input type="text" class="form-control" name="domain_link" id="domain_link" placeholder="Enter Domain Link" v-bind:value="parsed_domain.domain_link">
                            </div>
                            <div class="form-group">
                                <label for="domain_lang	">Language</label>
                                <input type="text" class="form-control" name="domain_lang" id="domain_lang" placeholder="Enter Language Code" v-bind:value="parsed_domain.domain_lang">
                            </div>
                            <div class="form-group">
                                <label for="domain_location	">Location</label>
                                <input type="text" class="form-control" name="domain_location" id="domain_location" placeholder="Enter Location" v-bind:value="parsed_domain.domain_location">
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
    <form-domain-component domain="{{json_encode($domain)}}"></form-domain-component>
@endsection