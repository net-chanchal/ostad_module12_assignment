@extends("admin.layouts.master")
@section("title", "Create Ticket")
@section("content")
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Ticket</h1>
            <a href="{{ route("admin.tickets.index") }}"
               class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-eye fa-sm text-white-50"></i> Tickets</a>
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

        <div id="message">
            {{-- For JS Response --}}
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="trip_id" class="col-form-label font-weight-bold">Trips</label>
                                <select name="trip_id" id="trip_id" class="form-control">
                                    <option value="">Choose...</option>
                                    @foreach($trips as $trip)
                                        <option
                                            value="{{ $trip->id }}">{{ $trip->route->origin . " - " . $trip->route->destination }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <table class="table table-sm" id="trip_detail">
                                    {{-- For JS Response --}}
                                </table>
                            </div>

                            <div class="form-group">
                                <label for="sub_route_id" class="col-form-label font-weight-bold w-100">
                                    Sub Routes
                                    <button type="button" id="reset_sub_routes_btn"
                                            class="btn btn-sm float-right text-danger" disabled>Reset
                                    </button>
                                </label>
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Origin</th>
                                        <th>Destination</th>
                                        <th>Distance</th>
                                        <th>Departure Time</th>
                                        <th>Arrival Time</th>
                                        <th>Price (tk)</th>
                                    </tr>
                                    </thead>
                                    <tbody id="sub_route_result">
                                    {{-- For JS Response --}}
                                    <tr>
                                        <td colspan="6" class="text-center">Select a Trip</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-borderless">
                                    <tbody>
                                    <tr>
                                        <td class="px-0" colspan="2">
                                            <label class="d-inline">
                                                <input type="date" value="{{ now()->toDateString() }}"
                                                       min="{{ now()->toDateString() }}" id="booking_time"
                                                       class="form-control form-control-sm w-100">
                                                <small id="day_name"
                                                       class="form-text text-muted">{{-- For JS Response --}}</small>
                                            </label>
                                        </td>
                                        <td class="float-right px-0">
                                            <button type="button" id="find_ticket_btn" class="btn btn-success btn-sm"
                                                    disabled>
                                                <i class="fa fa-search"></i>
                                                Find Tickets
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-0">
                                            <label class="d-inline">
                                                <input type="text" class="form-control form-control-sm w-100"
                                                       placeholder="Passenger Name *" id="passenger_name">
                                                <small id="error_passenger_name"
                                                       class="form-text text-danger">{{-- For JS Response --}}</small>
                                            </label>
                                        </td>
                                        <td class="pr-0">
                                            <label class="d-inline">
                                                <input type="text" class="form-control form-control-sm w-100"
                                                       placeholder="Email Address or Phone *"
                                                       id="passenger_email_or_phone">
                                                <small id="error_passenger_email_or_phone"
                                                       class="form-text text-danger">{{-- For JS Response --}}</small>
                                            </label>
                                        </td>
                                        <td class="float-right px-0">
                                            <button type="button" id="create_ticket_btn" class="btn btn-danger btn-sm"
                                                    disabled>
                                                <i class="fa fa-ticket-alt"></i>
                                                Create Ticket
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td><b>Total Price (tk):</b> <span id="subtotal">0.00</span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4">
                        <p class="font-weight-bold text-center">Seat Planning</p>
                        <div class="bus-layout" id="bus_seat">
                            {{-- For JS Response --}}
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

@push("scripts")
    <script>
        "use strict";

        function getDayName(inputDate) {
            const dateObject = new Date(inputDate);
            const dayOfWeek = dateObject.getDay();
            const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return daysOfWeek[dayOfWeek];
        }

        function convertToAMPM(time24) {
            const [hours, minutes, seconds] = time24.split(':');
            const dateObj = new Date(0, 0, 0, hours, minutes, seconds);
            return dateObj.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        }

        const create_ticket_btn_element = jQuery("#create_ticket_btn");
        const find_ticket_btn_element = jQuery("#find_ticket_btn");
        const booking_time_element = jQuery("#booking_time");
        const day_name_element = jQuery("#day_name");
        const trip_id_element = jQuery("#trip_id");
        const subtotal_element = jQuery("#subtotal");

        let day_name = getDayName(booking_time_element.val());

        let price = {
            root_price: null,
            sub_root_price: null,
            tickets: 0
        }

        window.price = price;

        booking_time_element.on("change", function () {
            day_name = getDayName(jQuery(this).val());
            day_name_element.text(day_name);
        });

        day_name_element.text(day_name);

        trip_id_element.on("change", function () {
            const sub_route_result_element = jQuery("#sub_route_result");
            const trip_detail_element = jQuery("#trip_detail");
            const bus_seat_element = jQuery("#bus_seat");
            const reset_sub_routes_btn_element = jQuery("#reset_sub_routes_btn");

            jQuery.ajax({
                method: "GET",
                url: "{{ route("admin.tickets.sub_route_ajax") }}",
                data: {trip_id: jQuery(this).val()},
                beforeSend: function () {
                    trip_detail_element.html("");
                    sub_route_result_element.html(`
                    <tr>
                        <td colspan="6" class="text-center text-danger">Please wait...</td>
                    </tr>`);
                    bus_seat_element.html("");
                    find_ticket_btn_element.prop("disabled", true);
                    reset_sub_routes_btn_element.prop("disabled", true);
                    subtotal_element.text("0.00");
                },
                success: function (response) {
                    if (response.success) {
                        const trip = response["data"]["trip"];

                        trip_detail_element.html(`
                            <tr>
                                <th>Origin</th>
                                <td>${trip["route"]["origin"]}</td>
                            </tr>
                            <tr>
                                <th>Destination</th>
                                <td>${trip["route"]["destination"]}</td>
                            </tr>
                           <tr>
                                <th>Distance</th>
                                <td>${trip["route"]["distance"] ?? "N/A"}</td>
                            </tr>
                            <tr>
                                <th>Arrival Time</th>
                                <td>${convertToAMPM(trip["arrival_time"]) ?? "N/A"}</td>
                            </tr>
                            <tr>
                                <th>Departure Time</th>
                                <td>${convertToAMPM(trip["departure_time"]) ?? "N/A"}</td>
                            </tr>
                            <tr>
                                <th>Days</th>
                                <td>${trip["days"]}</td>
                            </tr>
                            <tr>
                                <th>Bus Name</th>
                                <td>${trip["bus"]["bus_name"]}</td>
                            </tr>
                            <tr>
                                <th>Bus Model</th>
                                <td>${trip["bus"]["model"]}</td>
                            </tr>
                            <tr>
                                <th>Capacity</th>
                                <td>${trip["bus"]["capacity"]}</td>
                            </tr>
                            <tr>
                                <th>Price (tk)</th>
                                <td>${trip["price"]}</td>
                            </tr>
                        `);

                        price.root_price = trip["price"];
                        window.price = price;

                        let busSeatHtml = '';

                        for (let i = 1; i <= trip["bus"]["capacity"]; i++) {
                            busSeatHtml += `
                            <input type="checkbox" id="seat${i}" value="${i}" class="seat-checkbox" disabled>
                            <label for="seat${i}" class="seat">${i}</label>`;
                        }

                        const subRoutesHtml = response["data"]["subRoutes"].map((item) => {
                            return `<tr>
                                        <td><input type="radio" name="sub_route_id" data-price="${item["price"]}" class="sub-route-radio" value="${item["id"]}"></td>
                                        <td>${item["origin"]}</td>
                                        <td>${item["destination"]}</td>
                                        <td>${item["distance"] ?? "N/A"}</td>
                                        <td>${item["departure_time"] ?? "N/A"}</td>
                                        <td>${item["arrival_time"] ?? "N/A"}</td>
                                        <td>${item["price"] ?? "N/A"}</td>
                                    </tr>
                                    `;
                        });

                        if (subRoutesHtml) {
                            sub_route_result_element.html(subRoutesHtml);

                            // Reset Sub Routes Radio Button
                            reset_sub_routes_btn_element.prop("disabled", false);
                            reset_sub_routes_btn_element.on("click", function () {
                                jQuery(".sub-route-radio").each(function () {
                                    jQuery(this).prop("checked", false);
                                });

                                price.sub_root_price = null;
                                window.price = price;

                                findTicket();
                            })

                            jQuery(".sub-route-radio").on("change", function () {
                                findTicket();
                                if (jQuery(this).prop("checked")) {
                                    price.sub_root_price = jQuery(this).data("price");
                                    window.price = price;
                                }
                            });
                        } else {
                            sub_route_result_element.html(`
                            <tr>
                                <td colspan="6" class="text-center text-danger">Sub route not available</td>
                            </tr>`);

                            price.sub_root_price = null;
                            window.price = price;
                        }

                        bus_seat_element.html(busSeatHtml);

                        find_ticket_btn_element.prop("disabled", false);
                    }
                }
            })
        });

        // Find Ticket
        function findTicket() {
            const sub_route_radio_elements = jQuery(".sub-route-radio");

            let sub_route_id;
            let trip_id = trip_id_element.val();
            let booking_time = booking_time_element.val();


            if (sub_route_radio_elements.length) {
                for (let i = 0; i < sub_route_radio_elements.length; i++) {
                    if ($(sub_route_radio_elements[i]).prop("checked")) {
                        sub_route_id = $(sub_route_radio_elements[i]).val();
                        break;
                    }
                }
            }

            const seat_checkbox_element = jQuery(".seat-checkbox");

            jQuery.ajax({
                method: "GET",
                url: "{{ route("admin.tickets.tickets_ajax") }}",
                data: {trip_id: trip_id, sub_route_id: sub_route_id, booking_time: booking_time, day: day_name},
                beforeSend: function () {
                    find_ticket_btn_element.prop("disabled", true);
                    create_ticket_btn_element.prop("disabled", true);
                    find_ticket_btn_element.html(`<i class="fa fa-spinner fa-spin"></i> Find Tickets`);

                    seat_checkbox_element.each(function () {
                        jQuery(this).prop("disabled", true);
                        jQuery(this).prop("checked", false);
                    });

                    jQuery(".seat")
                        .removeClass("available")
                        .removeClass("reserved");

                    subtotal_element.text("0.00");
                },
                success: function (response) {
                    if (seat_checkbox_element.length) {
                        // Enable All Seats
                        seat_checkbox_element.each(function () {
                            jQuery(this).prop("disabled", false);
                        });

                        jQuery(".seat")
                            .addClass("available")
                            .removeClass("reserved");
                    }

                    if (response.success) {
                        if (response.data.length) {
                            // Active Reserved Seats
                            response.data.forEach((item) => {
                                jQuery(`#seat${item["seat_number"]}`)
                                    .prop("disabled", true);
                                jQuery(`label.seat[for="seat${item["seat_number"]}"]`)
                                    .removeClass("available")
                                    .addClass("reserved");
                            });
                        }
                    } else {
                        // Disable All Seats
                        seat_checkbox_element.each(function () {
                            jQuery(this).prop("disabled", true);
                        });

                        jQuery(".seat")
                            .removeClass("available")
                            .removeClass("reserved");
                    }

                    // 'Create Ticket Button' Active and Price Calculation
                    seat_checkbox_element.on("input", function () {
                        let totalSelectedSeat = 0;

                        seat_checkbox_element.each(function () {
                            if (jQuery(this).prop("checked")) {
                                totalSelectedSeat++;
                            }
                        });

                        if (totalSelectedSeat > 0) {
                            create_ticket_btn_element.prop("disabled", false);
                        } else {
                            create_ticket_btn_element.prop("disabled", true);
                        }

                        price.tickets = totalSelectedSeat;
                        window.price = price;

                        let subtotal = 0;
                        if (window.price.sub_root_price === null) {
                            subtotal = window.price.root_price * window.price.tickets;
                        } else {
                            subtotal = window.price.sub_root_price * window.price.tickets;
                        }

                        subtotal_element.text(subtotal.toFixed(2));
                    });
                },
                complete: function () {
                    find_ticket_btn_element.prop("disabled", false);
                    find_ticket_btn_element.html(`<i class="fa fa fa-search"></i> Find Tickets`);
                }
            })
        }

        find_ticket_btn_element.on("click", function () {
            findTicket();
        });

        // Create Ticket
        const passenger_name_element = jQuery("#passenger_name");
        const passenger_email_or_phone_element = jQuery("#passenger_email_or_phone");

        const error_passenger_name_element = jQuery("#error_passenger_name");
        const error_passenger_email_or_phone_element = jQuery("#error_passenger_email_or_phone");

        passenger_name_element.on("input", function () {
            if (passenger_name_element.val().trim() === "") {
                error_passenger_name_element.text("Passenger name is required");
            } else {
                error_passenger_name_element.text("");
            }
        });

        passenger_email_or_phone_element.on("input", function () {
            if (passenger_email_or_phone_element.val().trim() === "") {
                error_passenger_email_or_phone_element.text("Passenger Email or Phone is required");
            } else {
                error_passenger_email_or_phone_element.text("");
            }
        });

        create_ticket_btn_element.on("click", function () {
            let valid = true;

            if (passenger_name_element.val().trim() === "") {
                valid = false;
                error_passenger_name_element.text("Passenger name is required");
            } else {
                error_passenger_name_element.text("");
            }

            if (passenger_email_or_phone_element.val().trim() === "") {
                valid = false;
                error_passenger_email_or_phone_element.text("Passenger Email or Phone is required");
            } else {
                error_passenger_email_or_phone_element.text("");
            }

            if (valid) {
                const sub_route_radio_elements = jQuery(".sub-route-radio");
                let sub_route_id = null;

                // Find Sub Route ID
                if (sub_route_radio_elements.length) {
                    for (let i = 0; i < sub_route_radio_elements.length; i++) {
                        if ($(sub_route_radio_elements[i]).prop("checked")) {
                            sub_route_id = $(sub_route_radio_elements[i]).val();
                            break;
                        }
                    }
                }

                const seat_checkbox_element = jQuery(".seat-checkbox");
                let seat_numbers = [];

                // Selected Seats
                if (seat_checkbox_element.length) {
                    seat_checkbox_element.each(function () {
                        if (jQuery(this).prop("checked")) {
                            seat_numbers.push(jQuery(this).val());
                        }
                    });
                }

                const data = {
                    name: passenger_name_element.val().trim(),
                    email_or_phone: passenger_email_or_phone_element.val().trim(),
                    trip_id: trip_id_element.val(),
                    sub_route_id: sub_route_id,
                    seat_numbers: seat_numbers,
                    booking_date: booking_time_element.val(),
                    _token: "{{ csrf_token() }}",
                }

                jQuery.ajax({
                    method: "POST",
                    url: "{{ route("admin.tickets.tickets_create_ajax") }}",
                    data: data,
                    beforeSend: function () {
                        create_ticket_btn_element.prop("disabled", true);
                        create_ticket_btn_element.html(`<i class="fa fa-spinner fa-spin"></i> Create Ticket`);
                    },
                    success: function (response) {
                        if (response.success) {
                            jQuery("#sub_route_result").html("");
                            jQuery("#bus_seat").html("");
                            jQuery("#trip_detail").html("");
                            passenger_name_element.val("");
                            passenger_email_or_phone_element.val("");
                            trip_id_element.val("");
                            find_ticket_btn_element.prop("disabled", true);
                            create_ticket_btn_element.prop("disabled", true);
                            jQuery("#reset_sub_routes_btn").prop("disabled", true);

                            jQuery("#message").html(`
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    ${response.message}
                                </div>
                            `);
                        } else {
                            jQuery("#message").html(`
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    ${response.error.message}
                                </div>
                            `);
                        }
                    },
                    complete: function () {
                        create_ticket_btn_element.html(`<i class="fa fa-ticket-alt"></i> Create Ticket`);
                    }
                })
            }
        });
    </script>
@endpush
