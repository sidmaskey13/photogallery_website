<?php

namespace App\Http\Controllers;

use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TermController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:change-terms-superadmin', ['only' => [
            'show',
            'update'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms=Term::findOrFail(1);
        return view('homepage.terms',compact('terms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $terms=Term::findOrFail($id);
        return view('super-admin.terms.edit',compact('terms'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $terms = Term::findOrFail($id);
$terms->body=request('info');
$terms->save();

        Session::flash('success', 'Terms and Conditions Edited');
        return redirect('/terms/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy(Term $term)
    {
        //
    }
}
