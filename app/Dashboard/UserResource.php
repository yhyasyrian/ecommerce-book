<?php

namespace App\Dashboard;

use App\Enums\RolesEnum;
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
        $columns[] = ColumnDashboard::setColumn('role')
            ->setTitle('الصلاحية')
            ->setTypeColumn(TypeColumn::SELECT)
            ->setSelects(RolesEnum::toArrayWithLabel())
            ->setShowInTable(true)
            ->setColumnAs('nameRole');
        $this->setColumns($columns);
    }
    protected function createHandel(FormRequest $request):void
    {
        \request()->validate([
            'email' => ['unique:users,email']
        ]);
        if (auth()->user()->role()->checkIfCan(\request()->get('role')))
            parent::createHandel($request);
        else abort(403,'عذراً لا تملك الصلاحيات');
    }
    protected function updateHandel(FormRequest $request,Model $model):void
    {
        \request()->validate([
            'email' => Rule::unique('users')->ignore($model->id),
        ]);
        if ($this->isCanEditUser($model))
            parent::updateHandel($request,$model);
        else abort(403,'عذراً لا تملك الصلاحيات');
    }
    private function isCanEditUser(Model $model):bool
    {
        if (auth()->id() === $model->id and \request()->get('role') === auth()->user()->role)
            return true;
        return auth()->user()->role()->checkIfCan(\request()->get('role')) and auth()->user()->role()->checkIfCan($model->role());
    }
}
