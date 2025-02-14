<?php

namespace App\View\Composers;

use App\Models\Customers;
use Illuminate\View\View;
use App\Http\Classes\CustomerStore;

class CustomerComposer
{
    /**
     * The user repository implementation.
     *
     * @var \BalajiDharma\LaravelMenu\Models\Menu
     */
    protected $user;
    protected $customerstore;

    /**
     * Create a new profile composer.
     *
     * @return void
     */
    public function __construct(CustomerStore $customerstore)
    {
       
        $this->user = auth()->user();
        $this->customerstore = $customerstore;
    }

    /**
     * Bind data to the view.
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('CustomerUsers', $this->user->CustomerUsers);

        $view->with('CurrentCustomer', $this->customerstore->getCurrentCustomer());
        $view->with('CurrentStore', $this->customerstore->getCurrentStore());
    }
}
