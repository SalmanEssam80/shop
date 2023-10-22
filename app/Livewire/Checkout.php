<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderDetails;
use Livewire\Component;

class Checkout extends Component
{
    public $total_price;

    public $address;
    public $products;

    public function place_order()
    {
        $this->validate([
            'card_number' => 'required',
            'card_cvc' => 'required',
            'card_expiry' => 'required',
        ]);

        $productsInCart = cart::where('user_id',auth()->id())->get();

        foreach($productsInCart as $product){
            $order = Order::create([
                'user_id' => auth()->id(),
                'amount' => $product->product->price,
                'shipping_address' => auth()->user()->default_shipping_address,
                'order_address' => $this->address,
                'order_email' => auth()->user()->email,
                'order_status' => 'processing',
            ]);
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $product->product_id,
                'price' => $product->product->price,
                'sku' => 'sku',
                'quantity' => '1',
            ]);

        }
        cart::where('user_id',auth()->id())->delete();

        session()->flash('message', 'Order Placed Successfully.');

        unset($this->card_number);
        unset($this->card_expiry);
        unset($this->card_cvc);

    }

    public function removePrduct($id)
    {
        cart::where('id',$id)->delete();
        return $this->products = cart::where('user_id',auth()->id())->get();
    }

    public function apply_coupon_code()
    {
        dd('applied');
    }

    public function mount()
    {
        $this->address = auth()->user()->default_shipping_address;
    }

    public function render()
    {
        return view('livewire.checkout',[
            'products' => cart::where('user_id',auth()->id())->get()
        ]);
    }
}
