@extends('layouts.app')

<template id="domain-template">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">List all domains
                        <a href="/domains/create" class="pull-right">Add new domain</a>
                    </div>

                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item" v-for="domain in parsed_domains">
                                @{{ domain.domain_name }}
                                <a class="btn btn-danger btn-sm pull-right" href="#" role="button" @click="deleteDomain(domain , domain.id)">Delete</a>
                                <a  class="btn btn-primary btn-sm pull-right" v-bind:href="'/domains/'+domain.id+'/edit'" role="button" style="margin-right: 5px;">Edit</a>
                                <a  class="btn btn-success btn-sm pull-right" v-bind:href="'/domain/pages/'+domain.id" role="button" style="margin-right: 5px;">Pages</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>


@section('content')
    <domains-component domains="{{json_encode($domains)}}"></domains-component>
@endsection