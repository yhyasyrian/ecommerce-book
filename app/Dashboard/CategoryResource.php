<?php

namespace App\Dashboard;

use App\Http\Requests\Dashboard\AuthorRequest;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Author;
use App\Models\Category;
use App\Services\DashboardResource\ColumnDashboard;
use App\Services\DashboardResource\ResourceService;
use App\Services\DashboardResource\TypeColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryResource extends ResourceService
{

    public function getModel(): Model
    {
        return new Category;
    }

    public function getTitleForOne(): string
    {
        return 'قسم';
    }

    public function getNameRoute(): string
    {
        return 'categories';
    }

    public function getTitleForMoreOne(): string
    {
        return 'أصناف';
    }

    public function getRequestValidationRules(): FormRequest
    {
        return new CategoryRequest;
    }

    public function getRequestValidationRulesUpdate(): FormRequest
    {
        return $this->getRequestValidationRules();
    }

    public function __construct()
    {
        $columns = [];
        $columns[] = ColumnDashboard::setColumn('name')
            ->setTitle('الاسم')
            ->setTypeColumn(TypeColumn::TEXT)
            ->setShowInTable(true)
            ->setIsClickableShow(true);
        $columns[] = ColumnDashboard::setColumn('description')
            ->setTitle('الوصف')
            ->setTypeColumn(TypeColumn::TEXTAREA)
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('slug')
            ->setTitle('الرابط اللطيف')
            ->setTypeColumn(TypeColumn::TEXT)
            ;
        ;
        $this->setColumns($columns);
    }
    protected function createHandel(FormRequest $request):void
    {
        \request()->validate([
            'slug'=> 'unique:categories,slug'
        ]);
        parent::createHandel($request);
    }
    protected function updateHandel(FormRequest $request,Model $model):void
    {
        \request()->validate([
            'slug'=> Rule::unique('categories')->ignore($model->id),
        ]);
        parent::updateHandel($request,$model);
    }
}
