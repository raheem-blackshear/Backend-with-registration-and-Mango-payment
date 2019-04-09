@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Grazie!</div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">

                            @if(session()->has('message'))

                                <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>

                            @endif

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
