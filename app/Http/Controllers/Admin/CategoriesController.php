<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
        return view('admin.categories.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'blurb' => 'max:250',
            'slug' => 'required:max:100'
        ]);
        $category = new Category;
        $category->id = (int)$request->input('id');
        $category->parent_id = (int)$request->input('parent_id')??0;
        $category->title = $request->input('title');
        $category->slug = makeSlug($request->input('slug'));
        $category->blurb = $request->input('blurb');
        dd($category);
        $category->save();
        return redirect('/admin/categories')->with('success', 'Category added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::orderBy('title', 'asc')->pluck('title', 'id');
       // $categories = Category::with('childrenRecursive')->where('parent_id', 0)->pluck('title', 'id');
        return view('admin.categories.edit')->with(compact('category', $category, 'categories', $categories));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:100',
            'blurb' => 'max:250',
            'slug' => 'required:max:100'
        ]);
        $category = Category::find($id);
        $category->id = (int)$request->input('id');
        $category->parent_id = (int)$request->input('parent_id');
        $category->title = $request->input('title');
        $category->slug = makeSlug($request->input('slug'));
        $category->blurb = $request->input('blurb');

        $category->save();
        return redirect('/admin/categories')->with('success', 'Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Categories CSV import
     */
    public function csvform()
    {
        return view('admin.categories.csv-form');
    }

    /**
     * Post process the csv file
     */
    public function csvStore(Request $request)
    {
        $this->validate($request,[
            'file' => 'required|mimes:csv,txt'
        ]);
        if($request->hasFile('file'))
        {
            //get the file extension
            $ext = $request->file('file')->getClientOriginalExtension();
            $filename_save = 'cats.'.$ext;
            $file = $request->file('file')->storeAs('public/categories', $filename_save); 

            Category::truncate();
        }

        $file = $request->file('file');
        $handle = fopen($file, 'r');

        $i = 0;
        while (($data = fgetcsv($handle, 0, ',')) !== FALSE){

            if($i === 0){

            }else{
                $cat = new Category;
                
                $cat->id = (int)$data[0];
                $cat->parent_id = (int)$data[1];
                $cat->title = $data[2];
                $cat->slug = makeSlug($data[2]);
                
                $cat->save();
            }
            $i++;
        }
        fclose($handle);
        return redirect('/admin/categories')->with('success', 'Categories successfully imported');
    }
}
