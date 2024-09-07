<?php

namespace App\Dashboard;

use App\Models\Shopping;
use App\Services\DashboardResource\ColumnDashboard;
use App\Services\DashboardResource\ResourceService;
use App\Services\DashboardResource\TypeColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class ShoppingResource extends ResourceService
{

    public function getModel(): Model|\Illuminate\Database\Eloquent\Builder
    {
        return (new Shopping())->with([
            'user:name,id',
            'book:title,id,price'
        ]);
    }

    public function getTitleForOne(): string
    {
        return 'كتاب مباع';
    }

    public function getNameRoute(): string
    {
        return 'shoppings';
    }

    public function getTitleForMoreOne(): string
    {
        return 'كتب مباعة';
    }

    public function getRequestValidationRules(): FormRequest
    {
        return new FormRequest;
    }

    public function getRequestValidationRulesUpdate(): FormRequest
    {
        return $this->getRequestValidationRules();
    }

    public function __construct()
    {
        $columns = [];
        $columns[] = ColumnDashboard::setColumn('userName')
            ->setTitle('العضو')
            ->setTypeColumn(TypeColumn::TEXT)
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('bookTitle')
            ->setTitle('كتاب')
            ->setTypeColumn(TypeColumn::TEXT)
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('copies')
            ->setTitle('عدد النسخ')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('price')
            ->setTitle('بسعر')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setPrefix('$')
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('totalPrice')
            ->setTitle('إجمالي السعر')
            ->setPrefix('$')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('boughtAtDiff')
            ->setTitle('تم الشراء')
            ->setTypeColumn(TypeColumn::DATE)
            ->setShowInTable(true);
        $this->setColumns($columns);
    }
}
