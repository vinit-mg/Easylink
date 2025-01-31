<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManageSubscriptionsController extends Controller
{
    protected $entities = [
        'packages' => \App\Models\Packages::class,
        'subscriptions' => \App\Models\Subscriptions::class,
        'payments' => \App\Models\Payments::class,
        'add-ons' => \App\Models\AddOns::class,
        'add-on-purchases' => \App\Models\AddOnPurchase::class,
    ];

    public function index($entity)
    {
        $model = $this->entities[$entity];
        $records = $model::all();
        return view('admin.manage.index', compact('records', 'entity'));
    }

    public function create($entity)
    {
        return view('admin.manage.create', compact('entity'));
    }

    public function store(Request $request, $entity)
    {
        $model = $this->entities[$entity];
        $model::create($request->all());
        return redirect()->route('admin.manage.index', $entity);
    }

    public function edit($entity, $id)
    {
        $model = $this->entities[$entity];
        $record = $model::findOrFail($id);
        return view('admin.manage.edit', compact('record', 'entity'));
    }

    public function update(Request $request, $entity, $id)
    {
        $model = $this->entities[$entity];
        $record = $model::findOrFail($id);
        $record->update($request->all());
        return redirect()->route('admin.manage.index', $entity);
    }

    public function destroy($entity, $id)
    {
        $model = $this->entities[$entity];
        $record = $model::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.manage.index', $entity);
    }
}
