@extends('layouts.manage')
@section('content')
<div class="container pt-5">
    <div class="clearfix mb-3">
        <h1 class="float-start d-inline-block">Category</h1>
        <button class="btn btn-success btn-sm float-end" data-bs-toggle="modal" data-bs-target="#ModalAdd">Add New</button>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table" id="datatable">
                <thead class="bg-primary text-white">
                    <tr>
                        <td>No</td>
                        <td>Name</td>
                        <td width="250px">Action</td>
                    </tr>
                </thead>
                <tbody>
                    @if (count($categories))
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#ModalEdit-{{ $item->id }}">Edit</button>
                                    <form action="{{ route('manage.category.destroy',$item->id) }}" method="post" class="d-inline-block">
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
                                    <form action="{{ route('manage.category.update',$item->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="">Name</label>
                                                <input type="text" class="form-control" name="name" placeholder="Input Name" required value="{{ $item->name }}">
                                            </div>                
                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
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
        <form action="{{ route('manage.category.store') }}" method="post">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Input Name" required>
                </div>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
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