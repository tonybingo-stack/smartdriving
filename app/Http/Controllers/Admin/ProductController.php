<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
class ProductController extends TemplateController
{
    public function __construct(Product $product)
    {
        parent::__construct($product, 'Admin/Product/IndexProducts', 'name');
    }
}
