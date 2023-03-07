<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\Provideds;
use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Properties;
use App\Models\Totalproperty;
use App\Models\Category;
use App\Models\Batchprice;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentURL = \Route::current()->uri();
        return view('admin.product.showproduct',[
            'currentURL'=> $currentURL,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.addproduct');
    }

    public function batch($id)
    {
        return view('admin.product.addbatch',[
            'id'=> $id,
        ]);
    }
    public function batchinside(Request $request)
    {
//        dd($request);
        $request->validate([
            'prd_cost_price' => 'required',
            'prd_size' => 'required|max:20',
            'prd_color' => 'required|max:20',
            'prd_amount' => 'required',
        ]);

        $batch = DB::table('batch_price')
            ->where('prdid','=',$request->get('prd_id'))
            ->latest('created_at')
            ->first();
        $batch_amuont = 0;
        $amount = $request->get('prd_amount');
        foreach ($amount as $i) {
            $batch_amuont+= $i;
        }

        $bt = Batchprice::create([
            'prdid'=> $request->get('prd_id'),
            'batch' => ($batch->batch+1),
            'batch_amount' => $batch_amuont,
            'cost' => $request->get('prd_cost_price'),
        ]);

        $size = $request->get('prd_size');
        $color = $request->get('prd_color');
        $amount = $request->get('prd_amount');
        $flag = 0;

        foreach ($size as $p){
            $Properties = Properties::create([
                'itemsid'=> $request->get('prd_id'),
                'size' => strtoupper($p),
                'color' => $color[$flag],
                'batch'=> ($batch->batch+1),
                'amount' => $amount[$flag]
            ]);
            $flag++;
        }

        $sizes = [];
        $colors = [];
        $first = DB::table('properties')
            ->where('itemsid','=', $request->get('prd_id'))
            ->get();
        foreach ($first as $f){
            array_push($sizes, $f->size);
            array_push($colors, $f->color);
        }

        $sizeonly = array_unique($sizes);
        $sizecolap = "";
        foreach ($sizeonly as $i){
            $sizecolap.=strtoupper($i);
            $sizecolap.=" ";
        }
        $coloronly = array_unique($colors);
        $colorcolap = "";
        foreach ($coloronly as $i){
            $colorcolap.=$i;
            $colorcolap.=" ";
        }

        $affected1 = DB::table('total_property')
            ->where('itemsid','=', $request->get('prd_id'))
            ->update(['sizes' => $sizecolap]);
        $affected2 = DB::table('total_property')
            ->where('itemsid','=', $request->get('prd_id'))
            ->update(['colors' => $colorcolap]);


        return redirect('admin/product/'.$request->get('prd_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'prd_name' => 'required|unique:items,name|max:200',
            'prd_cost_price' => 'required',
            'prd_price' => 'required',
            'prd_category' => 'required',
            'prd_tag' => 'required',
            'prd_brand'=> 'required|max:200',
            'provided_name'=> 'required',
            'provided_phone'=> 'required',
            'provided_address'=> 'required',
            'prd_size' => 'required|max:20',
            'prd_color' => 'required|max:20',
            'prd_amount' => 'required',
            'prd_description' => 'required'
        ]);

        $provided = DB::table('provideds')
            ->where('provided_phone','=',$request->get('provided_phone'))
            ->first();
        if ($provided == null){
            Provideds::create([
                'provided_name'=> $request->get('provided_name'),
                'provided_phone'=> $request->get('provided_phone'),
                'provided_address'=> $request->get('provided_address')
            ]);
        }

        $provided = DB::table('provideds')
            ->where('provided_phone','=',$request->get('provided_phone'))
            ->first();
//        dd($request->prd_image->getClientOriginalName());
        $items = Items::create([
            'demoimage'=> $request->prd_image->getClientOriginalName(),
            'name' => $request->get('prd_name'),
            'description' => $request->get('prd_description'),
            'price' => $request->get('prd_price'),
            'tag' => $request->get('prd_tag'),
            'brand' => $request->get('prd_brand'),
            'provided' => $provided->id
        ]);
        $id = DB::table('items')
            ->where('name',$request->get('prd_name'))
            ->latest('created_at')->first();


        foreach ($request->prd_images as $i){
            $images = Images::create([
                'itemsid'=> $id->prd_id,
                'url'=> $i->getClientOriginalName()
            ]);
        }
        $file = $request->prd_images;
        foreach ($file as $f) {
            $f->move('images', $f->getClientOriginalName());
        }
        $file2 = $request->prd_image->move('images', $request->prd_image->getClientOriginalName());


        $size = $request->get('prd_size');
        $color = $request->get('prd_color');
        $amount = $request->get('prd_amount');
        $flag = 0;

        foreach ($size as $p){
            $Properties = Properties::create([
                'itemsid'=> $id->prd_id,
                'size' => strtoupper($p),
                'color' => $color[$flag],
                'batch'=> 1,
                'amount' => $amount[$flag]
            ]);
            $flag++;
        }

        $sizeonly = array_unique($size);
        $sizecolap = "";
        foreach ($sizeonly as $i){
            $sizecolap.=strtoupper($i);
            $sizecolap.=" ";
        }
        $coloronly = array_unique($color);
        $colorcolap = "";
        foreach ($coloronly as $i){
            $colorcolap.=$i;
            $colorcolap.=" ";
        }

        $Totalproperty = Totalproperty::create([
            'itemsid'=> $id->prd_id,
            'sizes' => $sizecolap,
            'colors' => $colorcolap
        ]);

        // categories(1=men,2=women,3=kid,4=accessories)
        $category = Category::create([
            'prdid' => $id->prd_id,
            'categories' => $request->get('prd_category')
        ]);

        $batch_amuont = 0;
        $amount = $request->get('prd_amount');
        foreach ($amount as $i) {
            $batch_amuont+= $i;
        }
        $batchprice = Batchprice::create([
            'prdid' => $id->prd_id,
            'batch' => 1,
            'batch_amount' => $batch_amuont,
            'cost' => $request->get('prd_cost_price')
        ]);

        return redirect('/admin');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.product.product',[
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.product.editproduct',[
            'id'=> $id,
        ]);

    }
    public function editInside(Request $request)
    {

        if ($request->get('prd_name') != null){
            $request->validate([
                'prd_name' => 'required|unique:items,name|max:200',
            ]);
        }
        if ($request->get('prd_brand') != null){
            $request->validate([
                'prd_brand'=> 'required|max:200',
            ]);
        }
        if ($request->get('prd_size') != null){
            $request->validate([
                'prd_size' => 'required|max:20',
            ]);
        }
        if ($request->get('prd_color') != null){
            $request->validate([
                'prd_color' => 'required|max:20',
            ]);
        }
//        dd($request);
        if ($request->get('prd_name') != null){
            $affected = DB::table('items')
                ->where('prd_id','=', $request->get('prd_id'))
                ->update(['name' => $request->get('prd_name')]);
        }
        if ($request->get('prd_price') != null){
            $affected = DB::table('items')
                ->where('prd_id','=', $request->get('prd_id'))
                ->update(['price' => $request->get('prd_price')]);
        }
        if ($request->get('prd_category') != null){
            $affected = DB::table('category')
                ->where('prdid','=', $request->get('prd_id'))
                ->update(['categories' => $request->get('prd_category')]);
        }
        if ($request->get('prd_tag') != null){
            $affected = DB::table('items')
                ->where('prd_id','=', $request->get('prd_id'))
                ->update(['tag' => $request->get('prd_tag')]);
        }
        if ($request->get('prd_brand') != null){
            $affected = DB::table('items')
                ->where('prd_id','=', $request->get('prd_id'))
                ->update(['brand' => $request->get('prd_brand')]);
        }
        if ($request->get('prd_description') != null){
            $affected = DB::table('items')
                ->where('prd_id','=', $request->get('prd_id'))
                ->update(['description' => $request->get('prd_description')]);
        }
        if ($request->prd_image != null){
            $affected = DB::table('items')
                ->where('prd_id','=', $request->get('prd_id'))
                ->update(['demoimage' => $request->prd_image->getClientOriginalName()]);
        }
//        dd($request->prd_image != null);
        if ($request->prd_images != null){
            $deleted = DB::table('images')->where('itemsid','=', $request->get('prd_id'))->delete();

            foreach ($request->prd_images as $i){
                $images = Images::create([
                    'itemsid'=> $request->get('prd_id'),
                    'url'=> $i->getClientOriginalName()
                ]);
            }
            $file = $request->prd_images;
            foreach ($file as $f) {
                $f->move('images', $f->getClientOriginalName());
            }
        }

        $deletedp = DB::table('properties')
            ->where('batch','=', $request->get('prd_batch'))
            ->where('itemsid','=', $request->get('prd_id'))
            ->delete();

        $size = $request->get('prd_size');
        $color = $request->get('prd_color');
        $amount = $request->get('prd_amount');
        $flag = 0;

        foreach ($size as $p){
            $Properties = Properties::create([
                'itemsid'=> $request->get('prd_id'),
                'size' => strtoupper($p),
                'color' => $color[$flag],
                'batch'=> $request->get('prd_batch'),
                'amount' => $amount[$flag]
            ]);
            $flag++;
        }
        $sizes = [];
        $colors = [];
        $first = DB::table('properties')
            ->where('itemsid','=', $request->get('prd_id'))
            ->get();
        foreach ($first as $f){
            array_push($sizes, $f->size);
            array_push($colors, $f->color);
        }

        $sizeonly = array_unique($sizes);
        $sizecolap = "";
        foreach ($sizeonly as $i){
            $sizecolap.=strtoupper($i);
            $sizecolap.=" ";
        }
        $coloronly = array_unique($colors);
        $colorcolap = "";
        foreach ($coloronly as $i){
            $colorcolap.=$i;
            $colorcolap.=" ";
        }

        $affected1 = DB::table('total_property')
            ->where('itemsid','=', $request->get('prd_id'))
            ->update(['sizes' => $sizecolap]);
        $affected2 = DB::table('total_property')
            ->where('itemsid','=', $request->get('prd_id'))
            ->update(['colors' => $colorcolap]);

        $batch_amuont = 0;
        $amount = $request->get('prd_amount');
        foreach ($amount as $i) {
            $batch_amuont+= $i;
        }

        $affected3 = DB::table('batch_price')
            ->where('prdid','=', $request->get('prd_id'))
            ->where('batch','=', $request->get('prd_batch'))
            ->update(['batch_amount' => $batch_amuont]);


        if ($request->get('prd_cost') != null){
            $affected = DB::table('batch_price')
                ->where('prdid','=', $request->get('prd_id'))
                ->where('batch','=', $request->get('prd_batch'))
                ->update(['cost' => $request->get('prd_cost')]);
        }


        if ($request->get('provided_phone') != null){
            $provided = DB::table('provideds')
                ->where('provided_phone','=',$request->get('provided_phone'))
                ->first();
            if ($provided == null){
                Provideds::create([
                    'provided_name'=> $request->get('provided_name'),
                    'provided_phone'=> $request->get('provided_phone'),
                    'provided_address'=> $request->get('provided_address')
                ]);
            }

            $provided = DB::table('provideds')
                ->where('provided_phone','=',$request->get('provided_phone'))
                ->first();
            $affected = DB::table('items')
                ->where('prd_id','=', $request->get('prd_id'))
                ->update(['provided' => $provided->id]);
        }

        return redirect('admin/product/'.$request->get('prd_id'));
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
}
