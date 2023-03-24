@extends('layouts.home')

@section('content')
<div class="container pt-5">
    <h2>Cart</h2>
    <div class="card">
      <div class="card-body">
          <table class="table" id="datatable">
              <thead class="bg-primary text-white">
                  <tr>
                      <td width="80px">No</td>
                      <td width="300px">Product</td>
                      <td width="250px">Qty</td>
                      <td width="250px">Total</td>
                      <td width="250px">#</td>
                  </tr>
              </thead>
              <tbody>
                  @if (count($carts))
                      @foreach ($carts as $item)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>
                                <div class="d-flex">
                                  <img src="{{ asset($item->product->photo) }}" alt="" width="100px" class="me-3">
                                  <div class="flex-1">
                                    {{ $item->product->name }} <br> <small class="text-muted">{{ $item->product->category->name }}</small> <br> <span class="text-danger">Rp. {{ $item->product->price }}</span>
                                  </div>
                                </div>
                              </td>
                              <td>
                                <form action="{{ route('cart.update',$item->id) }}" method="post" class="d-flex flex-column">
                                  @csrf
                                  @method('put')
                                  <div class="row">
                                    <div class="col-md-8">
                                      <input type="number" name="qty" class="form-control form-control-sm" placeholder="" value="{{ $item->qty }}">
                                      <div class="d-flex mt-2">
                                        <button type="submit" class="btn btn-primary btn-sm ms-auto">Save</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </td>
                              <td>
                                Rp. {{ $item->product->price*$item->qty }}
                              </td>
                              <td>
                                <form action="{{ route('cart.destroy',$item->id) }}" method="post">
                                  @csrf
                                  @method('delete')
                                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                              </td>
                          </tr>
                      @endforeach
                  @else
                  <tr>
                    <td colspan="4" align="center">Cart Empty</td>
                  </tr>
                  @endif
              </tbody>
          </table>
      </div>
    </div>
</div>
@endsection