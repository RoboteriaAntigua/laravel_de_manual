<?php

namespace App\Http\Controllers;

use App\Models\nombre;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class nombres extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos= nombre::all();
        return view('index', ['todos'=>$todos]);
    }

    public function indexChunk(){
        $paginas = nombre::paginate(2);
        return view('show')->with('pagina', $paginas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nuevo = new nombre();
        $nuevo->nombre= $request->nombre;
        $nuevo->email = $request->email;
        $nuevo->edad = $request->edad;
        $nuevo->save();
        //$nuevo= nombre::create($request->all());
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
