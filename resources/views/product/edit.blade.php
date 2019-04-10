@extends('home')

@section('content')
<div class="card">
    <div class="card-header text-center">
       Edit product {{ $product->id ?? old('id') }}
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/product/modify') }}">
            {{-- crear dos campos ocultos para prevenir el ataque CSRF --}}
            {{-- https://es.wikipedia.org/wiki/Cross-site_request_forgery --}}
            {{ method_field('POST') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name *:</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') ?? $product->name }}" />
                <label for="name">Price *:</label>
                <input class="form-control" type="text" id="price" name="price" value="{{ old('price') ?? $product->price }}" />
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description">{{ old('description') ?? $product->description }}</textarea>
            </div>

            <div class="form-group">                
                <button class="btn btn-success" type="submit" name="action" value="update">Update</button>
                <button class="btn btn-danger" type="submit" name="action" value="delete">Delete</button>
                <button class="btn btn-warning" type="reset">Reset Form</button>
                <a class="btn btn-dark" href="{{ url('/product/edit/' . (old('id') ?? $product->id)) }}">Reload Page</a>
            </div>

            <label class="alert alert-light">* Required fields</label>
            <input type="hidden" id="id" name="id" value="{{ old('id') ?? $product->id }}">
        </form>
    </div>
</div>
@stop

@section('message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @isset($message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endisset
@stop