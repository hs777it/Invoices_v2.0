<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{

    public function index()
    {
        $data = 'Hussein';
        $data2 = '<h2 style="color:red">Hussein</h2>';
        $data3 = '';
        return view('photos.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request->all()); //dd = Dump and Die
        // dd($request->only(['name','email']));
        // dd($request->except(['name','email']));
        // dd($request->has('name'));
        // dd($request->hasAny(['name','email']));
        // dd($request->collect());
        // dd($request->input("email"));
        dd($request->input("title.0"));
        // dd($request->email);
        // dd($request->ip());
        // dd($request->url());
        // dd($request->path());
        // dd($request->is("store"));
        // dd($request->routeIs("photos.store"));
        // dd($request->methodIs());
        // dd($request->methodIs("post"));
        // dd($request->header("nmae"));
        // dd($request->hasHeader("name"));

        // $value = $request->input("age", "22");
        // dd($value);

        // dd($request->boolean('check'));
    }

    public function show(Photo $photo)
    {
        //
    }

    public function edit(Photo $photo)
    {
        //
    }

    public function update(Request $request, Photo $photo)
    {
        //
    }

    public function destroy(Photo $photo)
    {
        //
    }
}
