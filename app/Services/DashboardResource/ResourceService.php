<?php

namespace App\Services\DashboardResource;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

abstract class ResourceService
{
    private array $columns = [];
    abstract public function getModel(): Model;

    abstract public function getTitleForOne(): string;

    abstract public function getNameRoute(): string;

    abstract public function getTitleForMoreOne(): string;

    abstract public function getRequestValidationRules(): FormRequest;

    abstract public function getRequestValidationRulesUpdate(): FormRequest;

    protected function createHandel(FormRequest $request): void
    {
        $array = [];
        \request()->validate($this->getRequestValidationRules()->rules());
        foreach ($this->columns as $value) {
            $key = $value->getColumn();
            if (\request()->hasFile($key))
                $array[$key] = \request()->file($key)->storeAs($this->getNameRoute(), uniqid(date(now()->format('Y-m-d'))).'.'.request()->file($key)->getClientOriginalExtension(),'public');
        else if ($value->getTypeColumn()->name === TypeColumn::PASSWORD->name)
            $array[$key] = Hash::make(\request()->get($key, ''));
        else
            $array[$key] = \request()->get($key, '');
        }
        $this->getModel()->create($array);
    }

    protected function updateHandel(FormRequest $request, Model $model): void
    {
        \request()->validate($this->getRequestValidationRulesUpdate()->rules());
        foreach ($this->columns as $value) {
            $key = $value->getColumn();
            if (\request()->hasFile($key)) {
                Storage::disk('public')->delete($model->{$key});
                $model->{$key} = \request()->file($key)->storeAs($this->getNameRoute(), uniqid(date(now()->format('Y-m-d'))).'.'.request()->file($key)->getClientOriginalExtension(),'public');
            } else if ($value->getTypeColumn()->name === TypeColumn::PASSWORD->name)
                $model->{$key} = Hash::make(\request()->get($key, ''));
            else $model->{$key} = \request()->get($key, '');
        }
        $model->save();
    }

    public function setColumns(array $columns): void
    {
        $this->columns = $columns;
    }

    abstract public function __construct();

    private function getInformationBlade(): array
    {
        return [
            'title' => $this->getTitleForOne(),
            'titlePage' => $this->getTitleForMoreOne(),
            'columns' => $this->columns,
            'nameRoute' => $this->getNameRoute(),
            'paramRoute' => $this->getNameParamRoute(),
        ];
    }
    private function getNameParamRoute():string
    {
        if (str_ends_with($this->getNameRoute(),'ies'))
            return substr($this->getNameRoute(), 0, -3).'y';
        return substr($this->getNameRoute(), 0, -1);
    }
    public function index(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $data = $this->getModel()->paginate(10);
        $columnsTable = array_filter($this->columns, fn(ColumnDashboard $columnDashboard) => $columnDashboard->isShowInTable());
        return viewDashboard('resources.index', ['data' => $data, ...$this->getInformationBlade(), 'columnsTable' => $columnsTable]);
    }

    public function create(): Factory|View|\Illuminate\Foundation\Application
    {
        $method = 'post';
        return viewDashboard('resources.create', [...$this->getInformationBlade(), ...compact('method')]);
    }

    public function store(Request $request): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $request->validate($this->getRequestValidationRules()->rules());
        $this->createHandel($this->getRequestValidationRules());
        session()->flash('success', 'تم الحفظ بنجاح');
        return $this->index();
    }

    public function show(int $id): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $data = $this->getModel()->where('id', $id)->firstOrFail();
        return viewdashboard('resources.show', [...$this->getInformationBlade(), ...compact('data')]);
    }

    public function edit(int $id): \Illuminate\Foundation\Application|View|Factory
    {
        $data = $this->getModel()->where('id', $id)->firstOrFail();
        $method = 'patch';
        return viewdashboard('resources.edit', [...$this->getInformationBlade(), ...compact('data', 'method')]);
    }

    public function update(Request $request, int $id): Factory|View|\Illuminate\Foundation\Application|Application
    {
        $request->validate($this->getRequestValidationRulesUpdate()->rules());
        $model = $this->getModel()->where('id', $id)->firstOrFail();
        $this->updateHandel($this->getRequestValidationRules(), $model);
        session()->flash('success', 'تم الحفظ بنجاح');
        return $this->show($id);
    }

    protected function destroyHandel(Model $model): void
    {
        $model->delete();
    }

    public function destroy(int $id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $data = $this->getModel()->where('id', $id)->firstOrFail();
        $this->destroyHandel($data);
        session()->flash('success', 'تم الحذف بنجاح');
        return redirect(routeDashboard($this->getNameRoute().'.index'));
    }
}
