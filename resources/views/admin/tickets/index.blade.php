@extends("admin.layouts.master")
@section("title", "Tickets")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tickets</h1>
            <a href="{{ route("admin.tickets.create") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-plus fa-sm text-white-50"></i> Create Ticket</a>
        </div>

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

        <div class="row">
            <div class="col-md-4">
                <label for="route_id" class="d-block mb-4">
                    <select name="route_id" id="route_id" class="form-control w-100">
                        <option value="">Select a Route</option>
                        @foreach($routes as $route)
                            <option
                                value="{{ $route->id }}" {{ request()->input("route_id") == $route->id ? "selected" : "" }}>{{ $route->origin . " - " . $route->destination }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="col-md-4">
                <label for="booking_date" class="d-block mb-4">
                    <input type="date" name="booking_date" value="{{ request()->input("booking_date") }}" id="booking_date" class="form-control">
                </label>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="dataTable">
                        <thead>
                        <tr>
                            <th>Ticket Number</th>
                            <th>Name</th>
                            <th>Email / Phone</th>
                            <th>Seat Number</th>
                            <th>Booking Date</th>
                            <th>Route</th>
                            <th>Bus</th>
                            <th>Price (tk)</th>
                            <th style="width: 100px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tickets as $ticket)
                            @php
                                /**
                                 * @var $ticket
                                 */
                                $seats = explode(",", $ticket["seat_numbers"]);
                            @endphp
                            <tr>
                                <td>{{ $ticket["ticket_number"] }}</td>
                                <td>{{ $ticket["passenger"]["name"] }}</td>
                                <td>{{ $ticket["passenger"]["email_or_phone"] }}</td>
                                <td>
                                    @foreach($seats as $seat)
                                        <span class="badge badge-info badge-counter">{{ $seat }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $ticket["booking_date"] }}</td>

                                @if (empty($ticket["sub_route"]))
                                    <td>
                                        <span class="badge badge-secondary">{{ $ticket["trip"]["route"]["origin"] }} to {{ $ticket["trip"]["route"]["destination"] }}</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge badge-secondary">{{ $ticket["sub_route"]["origin"] }} to {{ $ticket["sub_route"]["destination"] }}</span>
                                    </td>
                                @endif

                                <td>{{ $ticket["trip"]["bus"]["bus_name"] }}</td>

                                @if (empty($ticket["sub_route"]))
                                    <td>
                                        {{ number_format($ticket["trip"]["price"] * count($seats), 2) }}
                                    </td>
                                @else
                                    <td>
                                        {{ number_format($ticket["sub_route"]["price"] * count($seats), 2) }}
                                    </td>
                                @endif
                                <td>
                                    <a href="{{ route("admin.tickets.show", $ticket["ticket_number"]) }}" class="btn btn-sm"><i class="fa fa-eye"></i></a>
                                    <a href="" class="btn btn-sm disabled"><i class="fa fa-print"></i></a>
                                    <a href="" class="btn btn-sm disabled"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("scripts")
    <script>
        "use strict";

        jQuery("#route_id, #booking_date").on("change", function() {
            let routeId = jQuery("#route_id").val();
            let bookingDate = jQuery("#booking_date").val();

            let url = "{{ route('admin.tickets.index') }}";

            if (routeId) {
                url += "?route_id=" + routeId;
            }

            if (bookingDate) {
                url += (routeId ? "&" : "?") + "booking_date=" + bookingDate;
            }

            window.location.href = url;
        });
    </script>
@endpush
