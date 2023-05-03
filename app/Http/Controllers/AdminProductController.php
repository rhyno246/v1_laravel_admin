<?php

namespace App\Http\Controllers;

use App\Components\CategoryRecusive;
use App\Http\Requests\RequestProducts;
use App\Models\Category;
use App\Models\Products;
use App\Models\ProductsImage;
use App\Models\ProductTags;
use App\Traits\ChangeStatusTrait;
use App\Traits\DeleteModelTrait;
use App\Traits\DeleteSelectedTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    use StorageImageTrait , ChangeStatusTrait , DeleteModelTrait , DeleteSelectedTrait;
    private $products;
    private $category;
    private $product_tag;
    private $productImage;
    public function __construct(Products $products , Category $category , ProductTags $product_tag , ProductsImage $productImage)
    {
        $this->products = $products;
        $this->category = $category;
        $this->product_tag = $product_tag;
        $this->productImage = $productImage;
    }


    public function getCategory ($parentId) {
        $data = $this->category->all();
        $recusive = new CategoryRecusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }


    public function index () {
        $data = $this->products->latest()->get();
        return view('backend.pages.products.index' , compact('data'));
    }
    public function create () {
        $htmlOption = $this->getCategory($parentId = '');
        $product_tag = $this->product_tag->latest()->get();
        return view('backend.pages.products.create', compact('htmlOption' , 'product_tag'));
    }

    public function store (RequestProducts $request) {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'categories_id' => $request->categories_id,
                'stock' => $request->stock,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'slug' => Str::slug($request->name),
                'choose_sale' => $request->choose_sale,
                'sale' => $request->sale
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request ,'feature_image_path' , 'products');
            if(!empty($dataUploadFeatureImage)){
                $data['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $data['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            if($data['choose_sale'] == ""){
                $data['sale_price'] = $request->price;
            }

            if($data['choose_sale'] == "sale_persent"){
                $persent = $request->sale / 100;
                $data['sale_price'] = $request->price - $persent * $request->price;
            }

            if($data['choose_sale'] == "sale_price"){
                $data['sale_price'] = $request->price - $request->sale;
            }


            $product = $this->products->create($data);

            if($request-> hasFile('image_path')){
                foreach($request->image_path as $fileItem){
                    $img = $this->storageTraitUploadMutiple($fileItem , 'products');
                    $product->images()->create([
                        'src'=>$img['file_path'],
                        'image_name'=>$img['file_name']
                    ]);
                }
            }

            $tagsIds = [];
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    $tagsIds[] = $tagItem;
                }
            }
            $product->tags()->attach($tagsIds);

            DB::commit();
            return redirect()->route('products.index')->with('message' , 'Tạo sản phẩm thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }


    public function edit ($id){
        $data = $this->products->find($id);
        $htmlOption = $this->getCategory($data->categories_id);
        $product_tag = $this->product_tag->latest()->get();
        return view('backend.pages.products.edit', compact('data', 'htmlOption','product_tag'));
    }


    public function update (RequestProducts $request , $id) {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'categories_id' => $request->categories_id,
                'stock' => $request->stock,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'slug' => Str::slug($request->name),
                'choose_sale' => $request->choose_sale,
                'sale' => $request->sale
            ];
            
            $dataUploadFeatureImage = $this->storageTraitUpload($request ,'feature_image_path' , 'products');
            if(!empty($dataUploadFeatureImage)){
                $data['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $data['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            if($data['choose_sale'] == ""){
                $data['sale_price'] = $request->price;
            }

            if($data['choose_sale'] == "sale_persent"){
                $persent = $request->sale / 100;
                $data['sale_price'] = $request->price - $persent * $request->price ;
            }

            if($data['choose_sale'] == "sale_price"){
                $data['sale_price'] = $request->price - $request->sale;
            }
           
            $this->products->find($id)->update($data);
            
            $product = $this->products->find($id);

            if($request-> hasFile('image_path')){
                foreach($request->image_path as $fileItem) {
                    $imageDetail = $this->storageTraitUploadMutiple($fileItem, 'products');
                    $product->images()->firstOrCreate([
                        'src'=>$imageDetail['file_path'],
                        'image_name'=>$imageDetail['file_name']
                    ]);
                }
            }
            $tagsIds = [];
            if(!empty($request->tags)){
                foreach($request->tags as $tagItem){
                    $tagsIds[] = $tagItem;
                }
            }
            $product->tags()->sync($tagsIds);
            DB::commit();
            return redirect()->route('products.index')->with('message' ,'Cập nhật bài viết thành công');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message : ' . $exception->getMessage() . '-----------------Line : ' . $exception->getLine());
        }
    }


    public function deleteThumbnail ( Request $request , $id){
        if($request->ajax()){
            return $this->deleteModelTrait($id, $this->productImage);
        } 
    } 



    public function delete ($id){
        $data = $this->products->find($id);
        $tagsIds = $data->tags;
        $data->images()->delete();
        $data->tags()->detach($tagsIds);
        return $this->deleteModelTrait($id, $this->products);
    }

    public function deleteSelected ( Request $request ) {
        if($request->ajax()){
            $data = $this->products->find($request->ids);

            foreach ( $data as $item){
                $tagsIds = $item->tags;
                $item->images()->delete();
                $item->tags()->detach($tagsIds);
            }
            return $this->deleteSelectedTrait($request->ids , $this->products);
        }
    }


    public function changeStatusShow (Request $request ,$id){
        if($request->ajax()){
            return $this->changeStatusTrait($this->products , $id , 'status' , $request->status );
        }
    }
    public function changeStatusHome (Request $request ,  $id) {
        if($request->ajax()){
            return $this->changeStatusTrait($this->products , $id , 'is_show_home' , $request->status );
        }
    }
}
