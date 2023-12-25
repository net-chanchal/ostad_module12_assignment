@extends("admin.layouts.master")
@section("title", "Show Route")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Show Route</h1>
            <a href="{{ route("admin.routes.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Routes</a>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="origin" class="col-sm-3 col-form-label text-right font-weight-bold">Origin *</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="origin" value="{{ $route->origin }}" name="origin"
                                   disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="destination" class="col-sm-3 col-form-label text-right font-weight-bold">Destination *</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="destination" value="{{ $route->destination }}"
                                   name="destination" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="distance"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Distance (km)</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="distance" value="{{ $route->distance }}"
                                   name="distance" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label text-right font-weight-bold">Status</label>
                        <div class="col-sm-6">
                            <select name="status" id="status" class="form-control" disabled>
                                <option value="1" {{ $route->status === 1 ? "selected" : "" }}>Active</option>
                                <option value="0" {{ $route->status === 0 ? "selected" : "" }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
