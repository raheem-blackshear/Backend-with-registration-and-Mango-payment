@extends('admin.layouts.app')



@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Category</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('update-category') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if(session()->has('message'))
                                    <div class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group bmd-form-group">
                                    <label class="bmd-label-floating">Nome</label>
                                    <input type="text" class="form-control" name="category" value="{{ $category->nome}}" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="cat_id" value="{{ $category->id }}">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection