@extends('layouts.master')

@section('title', $product->name)

@section('content')
    <div class="mb-8">
        <x-product-detail :product="$product" :relatedProducts="$relatedProducts" />
    </div>
@endsection
