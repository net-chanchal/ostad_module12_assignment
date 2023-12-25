<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use App\Models\Route;
use App\Models\SubRoute;
use App\Models\Ticket;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Throwable;

class TicketController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $tickets = Ticket::with(["passenger", "trip", "subRoute"]);
        $tickets->selectRaw("ticket_number, passenger_id, trip_id, sub_route_id, booking_date, GROUP_CONCAT(seat_number ORDER BY seat_number ASC) AS seat_numbers");
        $tickets->groupBy("ticket_number");

        if (!empty($request->input("route_id"))) {
            $tickets->whereHas("trip", function ($query) use ($request) {
                $query->where("route_id", $request->input("route_id"));
            });
        }

        if (!empty($request->input("booking_date"))) {
            $tickets->where("booking_date", $request->input("booking_date"));
        }


        $tickets = $tickets->get()->toArray();
        $routes = Route::all();

        return view("admin.tickets.index", compact("tickets", "routes"));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        $trips = Trip::query()
            ->where("status", 1)
            ->get();

        return view("admin.tickets.create", compact("trips"));
    }


    public function show(string $ticketNumber): View
    {
        $ticketQuery = Ticket::query()->where("ticket_number", $ticketNumber);
        $tickets = $ticketQuery->pluck("seat_number")->toArray();

        $identity = $ticketQuery->first();

        if (empty($identity)) {
            abort(404);
        }

        $passenger_id = $identity->passenger_id;
        $trip_id = $identity->trip_id;
        $sub_route_id = $identity->sub_route_id;
        $booking_date = $identity->booking_date;

        $passenger = Passenger::query()->find($passenger_id);
        $trip = Trip::with(["bus", "route"])->find($trip_id);
        $sub_route = SubRoute::query()->find($sub_route_id);

        return view("admin.tickets.show", compact("passenger", "trip", "sub_route", "tickets", "booking_date"));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function subRouteAjax(Request $request): JsonResponse
    {
        $trip = Trip::with(["bus", "route"])->find($request->input("trip_id"));

         $subRoutes = SubRoute::query()
             ->where("trip_id", $request->input("trip_id"))
             ->get();

        sleep(1);
         if ($trip->count()) {
             return response()->json([
                 "success" => true,
                 "data" => [
                     "trip" => $trip,
                     "subRoutes" => $subRoutes,
                 ],
             ]);
         } else {
             return response()->json([
                 "success" => false,
                 "data" => null,
             ]);
         }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ticketAjax(Request $request): JsonResponse
    {
        $trip_id = $request->input("trip_id");
//        $sub_route_id = $request->input("sub_route_id");
        $booking_time = empty($request->input("booking_time")) ? now()->toDateString() : $request->input("booking_time");
        $day = empty($request->input("day")) ? now()->day : $request->input("day");

        $tripIsAvailable = Trip::query()
            ->where("id", $trip_id)
            ->whereRaw("FIND_IN_SET(?, days) > 0", $day)
            ->count();

        $tickets = Ticket::query();
        $tickets->where("trip_id", $trip_id);
        $tickets->where("booking_date", $booking_time);
//        if (!empty($sub_route_id)) {
//            $tickets->where("sub_route_id", $sub_route_id);
//        }

        sleep(1);
        if ($tripIsAvailable > 0) {
            return response()->json([
                "success" => true,
                "data" => $tickets->get(),
            ]);
        } else {
            return response()->json([
                "success" => false,
                "data" => null,
            ]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function ticketCreateAjax(Request $request): JsonResponse
    {
        // Passengers
        $name = $request->input("name");
        $email_or_phone = $request->input("email_or_phone");

        // Ticket
        $trip_id = $request->input("trip_id");
        $sub_route_id = $request->input("sub_route_id");
        $seat_numbers = $request->input("seat_numbers");
        $booking_date = $request->input("booking_date");

        try {
            DB::beginTransaction();

            $ticket_number = time();

            $passenger = Passenger::query()
                ->updateOrCreate(
                    ["name" => $name, "email_or_phone" => $email_or_phone],
                    ["name" => $name, "email_or_phone" => $email_or_phone]
                );

            foreach ($seat_numbers as $seat_number) {
                Ticket::query()->create([
                        "passenger_id" => $passenger->__get("id"),
                        "trip_id" => $trip_id,
                        "sub_route_id" => $sub_route_id,
                        "ticket_number" => $ticket_number,
                        "seat_number" => $seat_number,
                        "booking_date" => $booking_date,
                    ]);
            }

            $response = [
                "success" => true,
                "message" => "Ticket has been reserved successfully",
                "error" => null,
            ];

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            $response = [
                "success" => true,
                "message" => "Ticket has been reserved successfully",
                "error" => [
                    "code" => $exception->getCode(),
                    "message" => $exception->getMessage(),
                ],
            ];
        }

        sleep(1);
        return response()->json($response);
    }
}
