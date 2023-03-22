<?php

namespace shop\services\manage\Shop;

use shop\entities\Meta;
use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Product\Value;
use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\Product\QuantityForm;
use shop\forms\manage\Shop\Product\CategoriesForm;
use shop\forms\manage\Shop\Product\ModificationForm;
use shop\forms\manage\Shop\Product\PhotosForm;
use shop\forms\manage\Shop\Product\PriceForm;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\forms\manage\Shop\Product\ProductEditForm;
use shop\repositories\Shop\BrandRepository;
use shop\repositories\Shop\CategoryRepository;
use shop\repositories\Shop\ProductRepository;
use shop\repositories\Shop\TagRepository;
use shop\services\TransactionManager;
use shop\entities\Shop\Materials;
use shop\entities\Shop\Product\Photo;
use shop\forms\manage\Shop\Product\ProductDescriptionBatch;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;
    private $tags;
    private $transaction;
    public $materials;

    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories,
        TagRepository $tags,
        TransactionManager $transaction
    )
    {
        $this->materials = Materials::find()->where(['status' => Materials::ACTIVE])->one();
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->transaction = $transaction;
    }

   

    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product = Product::create(
            $brand->id,
            $category->id,
            $form->code,
            $form->name,
            $form->application_methods,
            $form->description,
            $form->short_desc,
            $form->weight,
            $form->quantity->quantity,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );


        $product->setPrice($form->price->new, $form->price->old);

        foreach ($form->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        foreach ($form->values as $value) {
            if($value->value != null){
                $product->setValue($value->id, $value->value);
            }
     
        }

        foreach ($form->photos->files as $file) {
            $product->addPhoto($file);
        }

        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->get($tagId);
            $product->assignTag($tag->id);
        }

        $this->transaction->wrap(function () use ($product, $form) {
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }
            $this->products->save($product);
        });

        return $product;
    }

  

    public function createFromList($panel)
    {
        $brand = $this->brands->getByName($panel['brand']);
        $category = $this->categories->getByName($panel['category']);
        if ($product = $this->products->getByCode($panel['code'])){

            $product->edit(
                $brand->id,
                $panel['code'],
                $panel['name'],
                $panel['application methods'],
                $panel['description'],
                $panel['short-desc'],
                $panel['weight'],
                new Meta(
                    $panel['SEO']['title'],
                    $panel['SEO']['description'],
                    ''
                )
            );
        
            if($modifications = $product->modifications){
                foreach ($modifications as $modification){
                    $product->editModification(
                        $modification->id,
                        $panel['modification']['code'],
                        $panel['modification']['name'],
                        $panel['modification']['price'],
                        $panel['modification']['qty']
                    );
                    $this->products->save($product);  
                }
            } elseif ($panel['characteristics']['Количество сторон'] == 'Двухсторонняя'){
                $product->addModification(
                    $panel['modification']['code'],
                    $panel['modification']['name'],
                    $panel['modification']['price'],
                    $panel['modification']['qty']
                );
                $this->products->save($product);  
            }
            
                        
        } else {
            $product = Product::create(
                $brand->id,
                $category->id,
                $panel['code'],
                $panel['name'],
                $panel['application methods'],
                $panel['description'],
                $panel['short-desc'],
                $panel['weight'],
                $panel['qty'],
                new Meta(
                    $panel['SEO']['title'],
                    $panel['SEO']['description'],
                    ''
                )
            );

            if($panel['characteristics']['Количество сторон'] == 'Двухсторонняя'){

                    $product->addModification(
                        $panel['modification']['code'],
                        $panel['modification']['name'],
                        $panel['modification']['price'],
                        $panel['modification']['qty']
                   
                    );
                    $this->products->save($product);  
                }
            }
        
    


        $product->setPrice($panel['price-new'], $panel['price-old']);

        foreach ($panel['characteristics'] as $key => $value) {
            $characteristic = Characteristic::find()->where(['name' => $key])->one();
            if($characteristic != null){
                $id =  $characteristic->id;
                $product->setValue($id, $value);     
            }
        }

        
        $this->transaction->wrap(function () use ($product, $panel) {

            $product->revokeTags();
            $this->products->save($product);

            foreach ($panel['tags'] as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }
            $this->products->save($product);
        });


        $this->products->save($product);

      
    }

    public function editDescBatch(Product $product, ProductDescriptionBatch $form): void
    {

        $product->edit(
            $product->brand->id,
            $product->code,
            $product->name,
            $product->application_methods,
            $form->description,
            $form->short_desc,
            $product->weight,
            new Meta(
                $product->meta->title,
                $product->meta->description,
                $product->meta->keywords
            )
        );
        $product->save();
    }

    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product->edit(
            $brand->id,
            $form->code,
            $form->name,
            $form->application_methods,
            $form->description,
            $form->short_desc,
            $form->weight,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            )
        );

        $product->changeMainCategory($category->id);

        $this->transaction->wrap(function () use ($product, $form) {

            $product->revokeCategories();
            $product->revokeTags();
            $this->products->save($product);

            foreach ($form->categories->others as $otherId) {
                $category = $this->categories->get($otherId);
                $product->assignCategory($category->id);
            }

            foreach ($form->values as $value) {
                if($value->value != null){
                    $product->setValue($value->id, $value->value);
                }
            }

            foreach ($form->tags->existing as $tagId) {
                $tag = $this->tags->get($tagId);
                $product->assignTag($tag->id);
            }
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }
            $this->products->save($product);
        });
    }

    public function changePrice($id, PriceForm $form): void
    {
        $product = $this->products->get($id);
        $product->setPrice($form->new, $form->old);
        $this->products->save($product);
    }

    public function changeQuantity($id, QuantityForm $form): void
    {
        $product = $this->products->get($id);
        $product->setQuantity($form->quantity);
        $this->products->save($product);
    }

    public function activate($id): void
    {
        $product = $this->products->get($id);
        $product->activate();
        $this->products->save($product);
    }

    public function new($id): void
    {
        $product = $this->products->get($id);
        $product->new();
        $this->products->save($product);
    }

    public function notNew($id): void
    {
        $product = $this->products->get($id);
        $product->notNew();
        $this->products->save($product);
    }

    public function sale($id): void
    {
        $product = $this->products->get($id);
        $product->sale();
        $this->products->save($product);
    }

    public function notSale($id): void
    {
        $product = $this->products->get($id);
        $product->notSale();
        $this->products->save($product);
    }

    public function draft($id): void
    {
        $product = $this->products->get($id);
        $product->draft();
        $this->products->save($product);
    }

    public function addPhotos($id, PhotosForm $form): void
    {
        $product = $this->products->get($id);
        foreach ($form->files as $file) {
            $product->addPhoto($file);
        }
        $this->products->save($product);
    }

    public function addPhotosBatch(Product $product, PhotosForm $form, $deleteTempFile = true): void
    {
        foreach ($form->files as $file) {
            $product->addPhoto($file, $deleteTempFile);
        }
        $this->products->save($product);
    }

    public function movePhotoUp($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoUp($photoId);
        $this->products->save($product);
    }

    public function movePhotoDown($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoDown($photoId);
        $this->products->save($product);
    }

    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }

    public function addRelatedProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->assignRelatedProduct($other->id);
        $this->products->save($product);
    }

    public function removeRelatedProduct($id, $otherId): void
    {
        $product = $this->products->get($id);
        $other = $this->products->get($otherId);
        $product->revokeRelatedProduct($other->id);
        $this->products->save($product);
    }

    public function addModification($id, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        $product->addModification(
            $form->code,
            $form->name,
            $form->price,
            $form->quantity
        );
        $this->products->save($product);
    }

    public function editModification($id, $modificationId, ModificationForm $form): void
    {
        $product = $this->products->get($id);
        $product->editModification(
            $modificationId,
            $form->code,
            $form->name,
            $form->price,
            $form->quantity
        );
        $this->products->save($product);
    }

    public function removeModification($id, $modificationId): void
    {
        $product = $this->products->get($id);
        $product->removeModification($modificationId);
        $this->products->save($product);
    }

    public function remove($id): void
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }
}