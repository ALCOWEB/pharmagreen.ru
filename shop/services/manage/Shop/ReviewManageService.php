<?php
namespace shop\services\manage\shop;
use shop\forms\manage\Shop\Product\ReviewEditForm;
use shop\repositories\Shop\ProductRepository;
use shop\forms\Shop\ReviewForm;
class ReviewManageService
{
    private $products;
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function create($id, $userId, ReviewForm $form)    {
        $product = $this->products->get($id);
        $product->addReview($userId, $form->vote, $form->text);
        $this->products->save($product);
    }

    public function edit($product_id, $review_id, ReviewEditForm $form): void
    {
        $product = $this->products->get($product_id);
        $product->editReview(
            $review_id,
            $form->vote,
            $form->text
         );
        $this->products->save($product);
    }
    public function activate($product_id, $review_id): void
    {
        $product = $this->products->get($product_id);
        $product->activateReview($review_id);
        $this->products->save($product);
    }
    public function draft($product_id, $review_id): void
    {
        $product = $this->products->get($product_id);
        $product->draftReview($review_id);
        $this->products->save($product);
    }
    public function remove($product_id, $review_id): void
    {
        $product = $this->products->get($product_id);
        $product->removeReview($review_id);
        $this->products->save($product);
    }
}