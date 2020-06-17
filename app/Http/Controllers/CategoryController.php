<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories-superadmin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('super-admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        \request()->validate([
            'name.*' => 'required|string|distinct',
        ]);


        $category = $_POST['name'];
        $count = count($category);
        for ($i = 0; $i < $count; $i++) {
            $c = new Category;
            $c->name = $category[$i];
            $c->save();
        }
        Session::flash('success', 'Categories Added');
        return redirect('/category');

    }



    public function destroy($id)
    {

        $category = Category::findOrFail($id);
        if(!(($category->media()->count() > 0) || ($category->video()->count() > 0)) ) {
            $category->delete();
            Session::flash('success', 'Category Deleted');
        }
        return redirect('/category');
    }
}
