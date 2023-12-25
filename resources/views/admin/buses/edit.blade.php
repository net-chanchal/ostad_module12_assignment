@extends("admin.layouts.master")
@section("title", "Edit Bus")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Bus</h1>
            <a href="{{ route("admin.buses.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Buses</a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul class="m-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has("success"))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session("success") }}
            </div>
        @endif

        @if (session()->has("error"))
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session("error") }}
            </div>
    @endif

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route("admin.buses.update", $bus->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group row">
                        <label for="bus_name" class="col-sm-3 col-form-label text-right font-weight-bold">Bus Name *</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="bus_name" value="{{ $bus->bus_name }}" name="bus_name"
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="model" class="col-sm-3 col-form-label text-right font-weight-bold">Model *</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="model" value="{{ $bus->model }}"
                                   name="model">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="capacity"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Capacity *</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="capacity" value="{{ $bus->capacity }}"
                                   name="capacity">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label text-right font-weight-bold">Status</label>
                        <div class="col-sm-6">
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $bus->status === 1 ? "selected" : "" }}>Active</option>
                                <option value="0" {{ $bus->status === 0 ? "selected" : "" }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="offset-3 col-sm-6">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
