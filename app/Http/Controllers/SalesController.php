<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalesItems;
use DataTables;

class SalesController extends Controller
{

    /**
     * DT = Datatables
     */

    public function proposals(){
        return $this->_renderpage('sales.proposals' , 'Sales | Proposals');
    }

    public function estimates(){
        return $this->_renderpage('sales.estimates' , 'Sales | Estimates');
    }

    public function invoices(){
        return $this->_renderpage('sales.invoices' , 'Sales | Invoices');
    }

    /** ITEMS */

    public function items(){
        $data['items'] = SalesItems::all();
        return $this->_renderpage('sales.items' , 'Sales | Items' , $data);
    }

    public function itemsDT(){

        $items = SalesItems::all();

        return Datatables::of($items)
            ->addColumn('action', function ($item) {
                return '<div class="btn-group" role="group" aria-label="Basic example">
                            <a href="'.$item->sales_item_id.'" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit Item"><i class="ion-md-create"></i></a>
                            <a href="'.$item->sales_item_id.'" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Remove Item"><i class="ion-md-remove"></i></a>
                        </div>';
            })
            ->make(true);

    }

    public function createItem(Request $request){

        $item = new SalesItems();

        $item->sales_item_name = $request->input('item_name');
        $item->sales_item_price = $request->input('item_price');
        $item->sales_active = 'Y';
        $item->sales_item_description = $request->input('item_desc');

        $save = $item->save();
        if($save){
            \Session::flash('success','Sales item added');
            return redirect('/sales/items');
        }

    }

}
