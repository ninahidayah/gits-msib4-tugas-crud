@extends('layouts.manage')
@section('content')
<div class="container pt-5">
    <div class="clearfix mb-3">
        <h1 class="float-start d-inline-block">Product</h1>
        <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#ModalAdd">Add New</button>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table" id="datatable">
                <thead class="bg-primary text-white">
                    <tr>
                        <td>No</td>
                        <td>Photo</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Description</td>
                        <td width="250px">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products))
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><img src="{{ asset($item->photo) }}" alt="Photo" width="150px"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEdit-{{ $item->id }}">Edit</button>
                                    <form action="{{ route('manage.product.destroy',$item->id) }}" method="post" class="d-inline-block">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" tabindex="-1" id="ModalEdit-{{ $item->id }}">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Edit</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('manage.product.update',$item->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="">Category</label>
                                                <select name="category" id="" class="form-control" required>
                                                    <option value="">-- Select Category --</option>
                                                @foreach ($categories as $key)
                                                    <option value="{{ $key->id }}"{{ $key->id == $item->category_id? ' selected' : '' }}>{{ $key->name }}</option>
                                                @endforeach
                                                </select>
                                                @error('category')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="form-photo" class="form-label">Choose Photo (Optional)</label>
                                                <input class="form-control" type="file" id="form-photo" name="photo" accept="image/png,image/jpg">
                                                @error('photo')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </div>               
                                            <div class="mb-3">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Input Name" required value="{{ $item->name }}">
                                                @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </div>                
                                            <div class="mb-3">
                                                <label for="">Price</label>
                                                <input type="number" class="form-control" name="price" placeholder="Input Price" required value="{{ $item->price }}">
                                                @error('price')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </div>                
                                            <div class="mb-3">
                                                <label for="">Description</label>
                                                <textarea name="description" id="" rows="2" class="form-control" placeholder="Input Description" required>{{ $item->description }}</textarea>
                                                @error('description')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            </div>              
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id=ModalAdd>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('manage.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Category</label>
                    <select name="category" id="" class="form-control" required>
                        <option value="">-- Select Category --</option>
                    @foreach ($categories as $key)
                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                    @endforeach
                    </select>
                    @error('category')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>
                <div class="mb-3">
                    <label for="form-photo" class="form-label">Choose Photo</label>
                    <input class="form-control" type="file" id="form-photo" name="photo" accept="image/png,image/jpg" required>
                    @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>               
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Input Name" required>
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>                
                <div class="mb-3">
                    <label for="">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Input Price" required>
                    @error('price')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>                
                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea name="description" id="" rows="2" class="form-control" placeholder="Input Description" required></textarea>
                    @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script>
    $('#datatable').DataTable()
</script>
@endpush