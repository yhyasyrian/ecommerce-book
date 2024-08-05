<?php

namespace App\Dashboard;

use App\Http\Requests\Dashboard\UserRequest;
use App\Models\User;
use App\Services\DashboardResource\ColumnDashboard;
use App\Services\DashboardResource\ResourceService;
use App\Services\DashboardResource\TypeColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserResource extends ResourceService
{

    public function getModel(): Model
    {
        return new User();
    }

    public function getTitleForOne(): string
    {
        return 'مستخدم';
    }

    public function getNameRoute(): string
    {
        return 'users';
    }

    public function getTitleForMoreOne(): string
    {
        return 'مستخدمين';
    }

    public function getRequestValidationRules(): FormRequest
    {
        return new UserRequest;
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
        $columns[] = ColumnDashboard::setColumn('email')
            ->setTitle('الايميل')
            ->setTypeColumn(TypeColumn::TEXT)
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('password')
            ->setTitle('كلمة السر')
            ->setTypeColumn(TypeColumn::PASSWORD)
            ->setShowInTable(false);
        $this->setColumns($columns);
    }
    protected function createHandel(FormRequest $request):void
    {
        \request()->validate([
            'email' => ['unique:users,email']
        ]);
        parent::createHandel($request);
    }
    protected function updateHandel(FormRequest $request,Model $model):void
    {
        \request()->validate([
            'email' => Rule::unique('users')->ignore($model->id),
        ]);
        parent::updateHandel($request,$model);
    }
}
