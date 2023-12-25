<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bus;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class BusController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $buses = Bus::all();

        return view("admin.buses.index", compact("buses"));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view("admin.buses.create");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "bus_name" => "required",
            "model" => "required",
            "capacity" => "required|integer",
            "status" => "required|digits_between:0,1",
        ]);

        try {
            $bus = new Bus();
            $bus->fill([
                "bus_name" => $request->input("bus_name"),
                "model" => $request->input("model"),
                "capacity" => $request->input("capacity"),
                "status" => $request->input("status")
            ]);
            $bus->save();
        } catch (QueryException $exception) {
            return redirect()->back()->with("error", "QueryException code: " . $exception->getCode());
        }

        return redirect()->back()->with("success", "Bus has been inserted successfully.");
    }

    /**
     * @param Bus $bus
     * @return View
     */
    public function show(Bus $bus): View
    {
        return view("admin.buses.show", compact("bus"));
    }

    /**
     * @param Bus $bus
     * @return View
     */
    public function edit(Bus $bus): View
    {
        return view("admin.buses.edit", compact("bus"));
    }

    /**
     * @param Request $request
     * @param Bus $bus
     * @return RedirectResponse
     */
    public function update(Request $request, Bus $bus): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "bus_name" => "required",
            "model" => "required",
            "capacity" => "required|integer",
            "status" => "required|digits_between:0,1",
        ]);

        try {
            $bus->fill([
                "bus_name" => $request->input("bus_name"),
                "model" => $request->input("model"),
                "capacity" => $request->input("capacity"),
                "status" => $request->input("status")
            ]);
            $bus->save();
        } catch (QueryException $exception) {
            return redirect()->back()->with("error", "QueryException code: " . $exception->getCode());
        }

        return redirect()->back()->with("success", "Bus has been updated successfully.");
    }

    /**
     * @param Bus $bus
     * @return RedirectResponse
     */
    public function destroy(Bus $bus): RedirectResponse
    {
        try {
            $bus->deleteOrFail();
        } catch (Throwable $exception) {
            return redirect()->back()->with("error", $exception->getMessage());
        }

        return redirect()->back()->with("success", "Bus has been deleted successfully.");
    }
}
