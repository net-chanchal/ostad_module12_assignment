<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Route;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class RouteController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $routes = Route::all();

        return view("admin.routes.index", compact("routes"));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view("admin.routes.create");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "origin" => "required",
            "destination" => "required",
            "distance" => "nullable|numeric",
            "status" => "required|digits_between:0,1",
        ]);

        try {
            $route = new Route();
            $route->fill([
                "origin" => $request->input("origin"),
                "destination" => $request->input("destination"),
                "distance" => $request->input("distance"),
                "status" => $request->input("status")
            ]);
            $route->save();
        } catch (QueryException $exception) {
            return redirect()->back()->with("error", "QueryException code: " . $exception->getCode());
        }

        return redirect()->back()->with("success", "Route has been inserted successfully.");
    }

    /**
     * @param Route $route
     * @return View
     */
    public function show(Route $route): View
    {
        return view("admin.routes.show", compact("route"));
    }

    /**
     * @param Route $route
     * @return View
     */
    public function edit(Route $route): View
    {
        return view("admin.routes.edit", compact("route"));
    }

    /**
     * @param Request $request
     * @param Route $route
     * @return RedirectResponse
     */
    public function update(Request $request, Route $route): RedirectResponse
    {
        // Form Validation
        $request->validate([
            "origin" => "required",
            "destination" => "required",
            "distance" => "nullable|numeric",
            "status" => "required|digits_between:0,1",
        ]);

        try {
            $route->fill([
                "origin" => $request->input("origin"),
                "destination" => $request->input("destination"),
                "distance" => $request->input("distance"),
                "status" => $request->input("status")
            ]);
            $route->save();
        } catch (QueryException $exception) {
            return redirect()->back()->with("error", "QueryException code: " . $exception->getCode());
        }

        return redirect()->back()->with("success", "Route has been updated successfully.");
    }

    /**
     * @param Route $route
     * @return RedirectResponse
     */
    public function destroy(Route $route): RedirectResponse
    {
        try {
            $route->deleteOrFail();
        } catch (Throwable $exception) {
            return redirect()->back()->with("error", $exception->getMessage());
        }

        return redirect()->back()->with("success", "Bus has been deleted successfully.");
    }
}
