<?php

function discounts($discount, $ratio, $discountedItems = array())
{
    $t = &get_instance();
    $itemsList = array();
    $total = 0;

    foreach ($discountedItems as $discountedItem) {
        $total += $discountedItem['subTotal'];
    }

    if ($total > $discount) {
        $totalDiscount = ($total * $ratio) / 100;
        $total = $total - $totalDiscount;
    }
    
    
    $itemsList['subTotal'] = $total;
    $itemsList['discountReason'] = "10_PERCENT_OVER_1000";
    $itemsList['discountAmount'] = $totalDiscount;

    $discountedItems[] = $itemsList;
    $discountedItems['total'] = $total;
    return $discountedItems;
}

function category($category_id, $items = array())
{
    $t = &get_instance();

    $t->load->model("discounts_model");

    $itemsList = array();

    foreach ($items as $item) {
        if ($item['quantity'] == 6) {
            $itemResult = $t->discounts_model->get_category_by_products(
                array(
                    "id"       => $item['productId'],
                    "category" => $category_id
                )
            );

            if ($itemResult) {
                $item['discountReason'] = "BUY_5_GET_1";
                $item['discountAmount'] = $item['unitPrice'];
                $item['subTotal'] = $item['unitPrice'] * ($item['quantity'] - 1); 
                $itemsList[] = $item;
            } 
        } else {
            $item['subTotal'] = $item['unitPrice'] * $item['quantity']; 
            $itemsList[] = $item;
        } 
    }

    return $itemsList;
}

function two_product($category_id, $items = array())
{
    $t = &get_instance();

    $t->load->model("discounts_model");

    $itemsList = array();

    usort($items, function ($a, $b) {
        return $a['unitPrice'] - $b['unitPrice'];
    });

    $discountApplied = false;

    foreach ($items as $item) {
        if ($item['quantity'] <= 2) {
            $itemResult = $t->discounts_model->get_category_by_product(
                array(
                    "id"       => $item['productId'],
                    "category" => $category_id
                )
            );

            if ($itemResult) {
                $item['subTotal'] = $item['unitPrice'] * $item['quantity'];
                if (!$discountApplied) {
                    $discountTotal =($item['unitPrice'] / 100) * 20;
                    $item['discountReason'] = "TWO_PRDCT_DSCNT";
                    $item['discountAmount'] = $discountTotal;
                    $item['subTotal'] = $item['subTotal'] - $discountTotal;
                    $discountApplied = true;
                }
            }
        }

        $itemsList[] = $item;
    }
    return $itemsList;
}