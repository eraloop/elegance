<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class ManageOrders extends Component
{
    use WithPagination;

    public $search = '';
    public $filterStatus = '';
    public $viewOrderId;
    public $viewOrder;
    public $isOpen = false;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $query = Order::query();

        if ($this->search) {
            $query->where('order_number', 'like', '%' . $this->search . '%')
                ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                ->orWhere('customer_email', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        return view('livewire.admin.orders.manage-orders', [
            'orders' => $query->latest()->paginate(10)
        ]);
    }

    public function view($id)
    {
        $this->viewOrder = Order::with(['items.product'])->findOrFail($id);
        $this->viewOrderId = $id;
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->viewOrder = null;
        $this->viewOrderId = null;
    }

    public function updateStatus($status)
    {
        if ($this->viewOrder) {
            $this->viewOrder->update(['status' => $status]);
            session()->flash('success', 'Order status updated successfully.');

            // Refresh the view order
            $this->viewOrder->refresh();
        }
    }
}
