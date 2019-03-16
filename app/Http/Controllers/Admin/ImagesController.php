<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\ProductImage;
use App\Product;
use App\ProductImageLink;

class ImagesController extends Controller
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
        $merchant = null;
        $images = ProductImageLink::where('is_downloaded', '0')->paginate(10);
        if(Request()->get('mId')){
            $mId = Request()->get('mId');
            $merchant = $mId;
            $images = ProductImageLink::where('merchant_id', $mId)->paginate(10);
        }
        return view('admin.images.index')->with(compact('images', 'merchant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($listing_id)
    {
        $listing = Listing::find($listing_id);

        return view('admin.images.create')->with('listing',$listing);
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
            'image' => 'image|required|max:1999'
        ]);
        //Handle image upload
        if($request->hasFile('image')){
            //Get image extension
            $ext = $request->file('image')->getClientOriginalExtension();

            $filename_save = 'property_'.$request->listing.'_'.time().'.'.$ext;

            $file = $request->file('image')->storeAs('public/listing_images', $filename_save);

        }else{
            $filename_save = 'noimage.png';
        }

        if($file){
            $image = new Image;
            $image->listing_id = $request->input('listing');
            $image->path = $filename_save;
            $image->is_default = $request->input('is_default');
            $image->save();
        
        }

        return redirect('/admin/images/'.$image->listing_id.'/create')->with('success', 'Image uploaded successfully');
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
        //
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
        //
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
     * Download images one by one
     */
    public function download($id)
    {
        ini_set('max_execution_time', 0); //No limit
        $image = ProductImageLink::find($id);

        $local_path = 'storage/products/images/'.$image->product_id.'/';
        $download_path = $image->download_path;
       // dd($download_path);
        $ext = pathinfo($download_path, PATHINFO_EXTENSION);
        $dest = $local_path.$id.'.'.$ext;
      
        if(!is_dir($local_path)){
            mkdir($local_path, 0777, $download_path);
        }

        if(isset($download_path)){
            @copy($download_path, $dest);
        }
        
        $new_image = new ProductImage;
        $new_image->product_id = $image->product_id;
        $new_image->path = $dest;
        $new_image->save();

        $image->is_downloaded = '1';
        $image->save();

        return redirect()->back()->with('success', 'Product image has been downloaded');
    }

    /**
     * Download all the new images
     */
    public function downloadAll()
    {
        ini_set('max_execution_time', 0); //No limit
       $links = ProductImageLink::where('is_downloaded', '0')->get();
        
       if(Request()->get('mId')){
           $mId = Request()->get('mId');
           $links = ProductImageLink::where('merchant_id', $mId)->get();
       }

       foreach($links as $link){
            $this->download($link->id);
       }

        return redirect()->back()->with('success', 'Product images have been downloaded');
    }
}