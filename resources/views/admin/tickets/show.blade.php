@extends("admin.layouts.master")
@section("title", "Show Ticket")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Show Ticket</h1>
            <a href="{{ route("admin.tickets.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Tickets</a>
        </div>

    <!-- DataTales Example -->
        <div class="row">
            <div class="col-md-7">
                <div class="card position-relative">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Passenger</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Passenger Name</th>
                                <td>{{ $passenger->name }}</td>
                            </tr>
                            <tr>
                                <th>Email / Phone</th>
                                <td>{{ $passenger->email_or_phone }}</td>
                            </tr>
                            <tr>
                                <th>Profile Created</th>
                                <td>{{ date("Y-m-d h:i A", strtotime("created_at")) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card position-relative mt-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Trip</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tbody>
                            <tr>
                                <th>Bus Name / Model</th>
                                <td>{{ $trip->bus->bus_name }} / {{ $trip->bus->model }}</td>
                            </tr>
                            <tr>
                                <th>Route</th>
                                <td class="{{ empty($sub_route) ? "text-success" : "" }}">
                                    {{ $trip->route->origin }} - {{ $trip->route->destination }} <i>({{ number_format($trip->route->distance, 2) }} km)</i>
                                    <br>
                                    <small>{{ date("h:i A", strtotime($trip->route->departure_time)) }} - {{ date("h:i A", strtotime($trip->route->arrival_time)) }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Sub Route</th>
                                @if (empty($sub_route))
                                    <td>-</td>
                                @else
                                    <td class="text-success">
                                        {{ $sub_route->origin }} - {{ $sub_route->destination }} <i>({{ number_format($sub_route->distance, 2) }} km)</i>
                                        <br>
                                        <small>{{ date("h:i A", strtotime($sub_route->departure_time)) }} - {{ date("h:i A", strtotime($sub_route->arrival_time)) }}</small>
                                    </td>
                                @endif
                            </tr>
                            <tr>
                                <th>Booking Date</th>
                                <td>{{ date("d F Y", strtotime($booking_date)) }}</td>
                            </tr>

                            <tr>
                                <th>Ticket Price (tk)</th>
                                @if (empty($sub_route))
                                    <td>{{ $trip->price }} x {{ count($tickets) }} = {{ number_format($trip->price * count($tickets), 2) }} /-</td>
                                @else
                                    <td>{{ $sub_route->price }} x {{ count($tickets) }} = {{ number_format($sub_route->price * count($tickets), 2) }} /-</td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card position-relative">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tickets</h6>
                    </div>
                    <div class="card-body">
                        <div class="bus-layout">
                            @for($i = 1; $i <= $trip->bus->capacity; $i++)
                                @if (in_array($i, $tickets))
                                    <input type="checkbox" id="seat{{ $i }}" value="{{ $i }}" class="seat-checkbox" disabled>
                                    <label for="seat{{ $i }}" class="seat reserved">{{ $i }}</label>
                                @else
                                    <input type="checkbox" id="seat{{ $i }}" value="{{ $i }}" class="seat-checkbox" disabled>
                                    <label for="seat{{ $i }}" class="seat">{{ $i }}</label>
                                @endif
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push("styles")
    <link rel="stylesheet" href="{{ asset("css/custom.css") }}">
@endpush
