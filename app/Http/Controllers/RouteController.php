<?php

namespace App\Http\Controllers;

use App\Route;

class RouteController extends Controller
{
    private $route_pagination = 20;

    // List api
    public function index($api_id){
        $routes = Route::where('api_id', '=', $api_id)->paginate($this->route_pagination);

        return View('routes.index')
            ->with('api_id', $api_id)
            ->with('routes', $routes);
    }

    // Create route form
    public function create($api_id){
        return View('routes.add')
            ->with('api_id', $api_id);
    }

    // Edit api form
    public function edit(Route $route_id){
        $route = $route_id;

        return View('routes.edit')
            ->with('route', $route);
    }

    // Store route in DB
    public function store(){
        request()->validate([
            'api_id' => 'required|min:1',
            'route_method' => 'required|min:3|max:255',
            'route_route' => 'required|max:255',
            'route_query' => 'required|max:255'
        ]);

        $route = new Route();
        $route->api_id =  request('api_id');
        $route->method = request('route_method');
        $route->route = request('route_route');
        $route->query = request('route_query');
        $route->active = true;
        $route->save();

        return redirect('/routes/' . request('api_id'));
    }

    // Update api
    public function update(Route $route_id){
        request()->validate([
            'route_method' => 'required|min:3|max:255',
            'route_route' => 'required|max:255',
            'route_query' => 'required|max:255',
        ]);

        $route = $route_id;

        $route->method = request('route_method');
        $route->route = request('route_route');
        $route->query = request('route_query');
        $route->active = request('route_active') ? true : false;
        $route->save();

        return redirect('/routes/' . $route->api_id);
    }

    // Delete api
    public function delete(Route $route_id){
        $route = $route_id;
        $api_id = $route->api_id;
        $route->delete();

        return redirect('/routes/' . $api_id);
    }
}