<?php

namespace App\Dashboard;

use App\Http\Requests\Dashboard\PublisherRequest;
use App\Models\Publisher;
use App\Services\DashboardResource\ColumnDashboard;
use App\Services\DashboardResource\ResourceService;
use App\Services\DashboardResource\TypeColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class PublisherResource extends ResourceService
{

    public function getModel(): Model
    {
        return new Publisher();
    }

    public function getTitleForOne(): string
    {
        return 'ناشر';
    }

    public function getNameRoute(): string
    {
        return 'publishers';
    }

    public function getTitleForMoreOne(): string
    {
        return 'مؤلفين';
    }

    public function getRequestValidationRules(): FormRequest
    {
        return new PublisherRequest;
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
        $columns[] = ColumnDashboard::setColumn('address')
            ->setTitle('العنوان')
            ->setTypeColumn(TypeColumn::TEXT)
            ->setShowInTable(true);
        $this->setColumns($columns);
    }
}
