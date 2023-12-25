@extends("admin.layouts.master")
@section("title", "Edit Trip")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Trip</h1>
            <a href="{{ route("admin.trips.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Trips</a>
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
                <form action="{{ route("admin.trips.update", $trip->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="form-group row">
                        <label for="bus_id" class="col-sm-3 col-form-label text-right font-weight-bold">Bus *</label>
                        <div class="col-sm-6">
                            <select name="bus_id" id="bus_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach($buses as $bus)
                                    <option value="{{ $bus->id }}" {{ $bus->id == $trip->bus_id ? "selected" : "" }}>{{ $bus->bus_name . " (" . $bus->model . ")" }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="route_id" class="col-sm-3 col-form-label text-right font-weight-bold">Route *</label>
                        <div class="col-sm-6">
                            <select name="route_id" id="route_id" class="form-control">
                                <option value="">Choose...</option>
                                @foreach($routes as $route)
                                    <option value="{{ $route->id }}" {{ $route->id == $trip->route_id ? "selected" : "" }}>{{ $route->origin . " - " . $route->destination }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="departure_time" class="col-sm-3 col-form-label text-right font-weight-bold">Departure Time *</label>
                        <div class="col-sm-6">
                            <input type="time" class="form-control" id="departure_time" value="{{ $trip->departure_time }}" name="departure_time"
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="arrival_time" class="col-sm-3 col-form-label text-right font-weight-bold">Arrival Time *</label>
                        <div class="col-sm-6">
                            <input type="time" class="form-control" id="arrival_time" value="{{ $trip->arrival_time }}"
                                   name="arrival_time">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="days" class="col-sm-3 col-form-label text-right font-weight-bold">Days *</label>
                        <div class="col-sm-6">
                            <select name="days[]" id="days" class="form-control" multiple>
                                <option value="">Choose...</option>
                                @php
                                    /**
                                     * @var $trip
                                     */
                                    $days = explode(",", $trip->days);
                                @endphp
                                <option value="Sunday" {{ in_array("Sunday", $days) ? "selected" : "" }}>Sunday</option>
                                <option value="Monday" {{ in_array("Monday", $days) ? "selected" : "" }}>Monday</option>
                                <option value="Tuesday" {{ in_array("Tuesday", $days) ? "selected" : "" }}>Tuesday</option>
                                <option value="Wednesday" {{ in_array("Wednesday", $days) ? "selected" : "" }}>Wednesday</option>
                                <option value="Thursday" {{ in_array("Thursday", $days) ? "selected" : "" }}>Thursday</option>
                                <option value="Friday" {{ in_array("Friday", $days) ? "selected" : "" }}>Friday</option>
                                <option value="Saturday" {{ in_array("Saturday", $days) ? "selected" : "" }}>Saturday</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price"
                               class="col-sm-3 col-form-label text-right font-weight-bold">Price (tk)</label>
                        <div class="col-sm-6">
                            <input type="number" step="any" class="form-control" id="price" value="{{ $trip->price }}"
                                   name="price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label text-right font-weight-bold">Status</label>
                        <div class="col-sm-6">
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ $trip->status === 1 ? "selected" : "" }}>Active</option>
                                <option value="0" {{ $trip->status === 0 ? "selected" : "" }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label text-right font-weight-bold">Sub
                            Routes</label>
                        <div class="col-sm-9">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th>Origin *</th>
                                    <th>Destination *</th>
                                    <th>Distance (km)</th>
                                    <th>Departure Time</th>
                                    <th>Arrival Time</th>
                                    <th>Price (tk)</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($subRoutes as $i => $subRoute)
                                    <tr>

                                        <td><label><input type="hidden" name="exist_sub_routes[{{ $i }}][id]" value="{{ $subRoute->id }}"></label><label><input type="text" name="exist_sub_routes[{{ $i }}][origin]" value="{{ $subRoute->origin }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="text" name="exist_sub_routes[{{ $i }}][destination]" value="{{ $subRoute->destination }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="number" step="any" name="exist_sub_routes[{{ $i }}][distance]" value="{{ $subRoute->distance }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="time" name="exist_sub_routes[{{ $i }}][departure_time]" value="{{ $subRoute->departure_time }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="time" name="exist_sub_routes[{{ $i }}][arrival_time]" value="{{ $subRoute->arrival_time }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="number" step="any" name="exist_sub_routes[{{ $i }}][price]" value="{{ $subRoute->price }}" class="form-control form-control-sm"></label></td>
                                    </tr>
                                @endforeach

                                @for($i = count($subRoutes); $i < 5; $i++)
                                    <tr>
                                        <td><label><input type="text" name="sub_routes[{{ $i }}][origin]" value="{{ old("sub_routes.$i.origin") }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="text" name="sub_routes[{{ $i }}][destination]" value="{{ old("sub_routes.$i.destination") }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="number" step="any" name="sub_routes[{{ $i }}][distance]" value="{{ old("sub_routes.$i.distance") }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="time" name="sub_routes[{{ $i }}][departure_time]" value="{{ old("sub_routes.$i.departure_time") }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="time" name="sub_routes[{{ $i }}][arrival_time]" value="{{ old("sub_routes.$i.arrival_time") }}" class="form-control form-control-sm"></label></td>
                                        <td><label><input type="number" step="any" name="sub_routes[{{ $i }}][price]" value="{{ old("sub_routes.$i.price") }}" class="form-control form-control-sm"></label></td>
                                    </tr>
                                @endfor
                                </tbody>
                            </table>

                            <div class="alert alert-info" role="alert">
                                <strong>Note: </strong>A maximum of five sub routes are allowed. If you remove the Origin and Destination it will delete the sub route from the database.
                            </div>
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
