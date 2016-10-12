<?php

namespace Skydrop\ShippingRate\Rule;

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class ProductsWithTag
{
    use \Skydrop\Validations\ValidationTrait;

    public $items;
    public $tag;
    public $rule;
    public $shop;

    public function __construct($items = [], $options = array())
    {
        $this->validator = v::attribute('items', v::arrayType()->length(1, null))
            ->attribute('openingTime', v::arrayType()->length(1, null));

        $this->items = $items;
        $this->tag   = $options['tag'];
        $this->rule  = $options['rule'];
        $this->shop  = $options['shop'];
    }

    public function call()
    {
        $this->validate();

        switch ($this->rule) {
        case 'every':
            return $this->every();
        case 'once':
            return $this->once();
        default:
            return false;
        }
    }

    private function every()
    {
        tags_by_product.all? { |tags| tags.include?(tag) }
    }

    private function once()
    {
        tags_by_product.any? { |tags| tags.include?(tag) }
    }

    private function tags_by_product()
    {
        @tags_by_product ||= products.collect { |p| p.tags.split(',').collect(&:squish) }
    }

    private function products()
    {
        @products ||= shop.shopify_session {
        ShopifyAPI::Product.find(:all, params: { ids: products_ids })
    }
    }

    private function products_ids()
    {
        @products_ids ||= items.collect { |i| i['product_id'] }.join(',')
    }
}
