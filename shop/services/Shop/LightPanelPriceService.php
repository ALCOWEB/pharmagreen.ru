<?php
namespace shop\services\Shop;
use shop\entities\Shop\Product\Product;
use shop\repositories\Shop\ProductRepository;
class LightPanelPriceService{

    private $products;
    private $materials;

    public function __construct(ProductRepository $products, MaterialsRepository $materials)
    {
       $this->products = $products;
       $this->materials = $materials;

    }

    public function calculatePrice($id){
        $product = $this->products->get($id);
        $realSize = $this->getRealSize($product);
        $materials = $this->getMaterials($realSize, $product);
        $materialCost = 0;
        foreach($materials as $material){
            $materialCost = $material[0]->getPrice()*$material['volume'];
        } 
        return $materialCost;

    }










}

