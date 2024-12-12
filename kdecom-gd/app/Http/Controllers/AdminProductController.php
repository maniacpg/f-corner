<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Collection;
use mysql_xdevapi\Exception;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $category;
    private $product;
    private $productImage;
    private $productTag;
    private $tag;

    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->productTag = $productTag;
        $this->tag = $tag;
        $this->productImage = $productImage;
        $this->product = $product;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $products = Product::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%"); // Tìm kiếm theo tên sản phẩm
        })->paginate(10); // Phân trang với 10 sản phẩm mỗi trang

        return view('admin.product.index', compact('products'));
    }

    public function getCate($parentId)
    {
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecursive($parentId);
        return $htmlOption;
    }

    public function create()
    {
        $optionSelect = $this->getCate($parentId = '');
        return view('admin.product.add', compact('optionSelect'));
    }

    public function store(ProductAddRequest $request)
    {

        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,

            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this->product->create($dataProductCreate);

            //Chen du lieu vao bang product_images
            if ($request->hasFile('image_path')) {

                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }
            //Chen tags cho product
            $tagIds = [];
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    // Chèn vào tags
                    $tagInstant = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstant->id;
                }
            }
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('product.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }

    }

    public function edit($id)
    {
        $product = $this->product->find($id);
        $optionSelect = $this->getCate($product->category_id);
        $tags = $this->tag->get();
        return view('admin.product.edit', compact('optionSelect', 'product', 'tags'));
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => Auth::id(),
                'category_id' => $request->category_id,
                'quantity' => $request->quantity,

            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product = $this->product->find($id);
            //Chen du lieu vao bang product_images
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');

                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]);
                }
            }
            //Chen tags cho product
            $tagIds = [];
            if (!empty($request->tags)) {

                foreach ($request->tags as $tagItem) {
                    // Chèn vào tags
                    $tagInstant = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstant->id;
                }
            }
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('product.index');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Message: ' . $e->getMessage() . 'Line: ' . $e->getLine());
        }
    }

    public function delete($id)
    {
        return $this->deleteModeltrait($id, $this->product);
    }
}
