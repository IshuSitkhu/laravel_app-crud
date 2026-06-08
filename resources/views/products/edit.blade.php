@extends('layouts.app')

@section('content')

<div class="card-box">

    <h2 class="page-title">Edit Product</h2>

    <form method="POST" action="{{ route('product.update', $product) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text"
                   name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $product->name) }}">

            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number"
                   name="qty"
                   class="form-control @error('qty') is-invalid @enderror"
                   value="{{ old('qty', $product->qty) }}">

            @error('qty')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="text"
                   name="price"
                   class="form-control @error('price') is-invalid @enderror"
                   value="{{ old('price', $product->price) }}">

            @error('price')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                      class="form-control @error('description') is-invalid @enderror"
                      rows="3">{{ old('description', $product->description) }}</textarea>

            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                Update Product
            </button>

            <a href="{{ route('product.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </div>

    </form>

</div>

@endsection