<?php

namespace Skydrop\ShippingRate\Rule;

class ProductsWithTag
{
    public $items;
    public $tag;
    public $rule;
    public $shop;

    public function __construct($items = [], $options = array())
    {
        $this->items = $items;
        $this->tag   = $options['tag'];
        $this->rule  = $options['rule'];
        $this->shop  = $options['shop'];
    }

    public function call()
    {
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
