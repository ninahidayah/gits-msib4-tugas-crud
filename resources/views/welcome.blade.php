@extends('layouts.home')

@section('content')
<div class="container pt-5">
    <h2>Product</h2>
    <div class="row">
      @if(count($products))
      @foreach ($products as $item)
        <div class="col-md-3">
          <div class="card" style="width: 18rem;">
            <img src="{{ asset($item->photo) }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $item->name }}</h5>
              <span class="text-muted d-block">{{ $item->category->name }}</span>
              <p class="card-text">{{ $item->description }}</p>
              <form action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="product" value="{{ $item->id }}">
                <button type="submit" class="btn btn-primary btn-sm">Add To Cart</button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
      @else
      <div class="col-md-12 text-center">
        <span>Empty Product</span>
      </div>
      @endif
    </div>
</div>
@endsection