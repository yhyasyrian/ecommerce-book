<?php

namespace App\Dashboard;

use App\Http\Requests\Dashboard\AuthorRequest;
use App\Models\Author;
use App\Services\DashboardResource\ColumnDashboard;
use App\Services\DashboardResource\ResourceService;
use App\Services\DashboardResource\TypeColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

class AuthorResource extends ResourceService
{

    public function getModel(): Model
    {
        return new Author;
    }

    public function getTitleForOne(): string
    {
        return 'مؤلف';
    }

    public function getNameRoute(): string
    {
        return 'authors';
    }

    public function getTitleForMoreOne(): string
    {
        return 'مؤلفون';
    }

    public function getRequestValidationRules(): FormRequest
    {
        return new AuthorRequest;
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
        $columns[] = ColumnDashboard::setColumn('image')
            ->setTitle('الصورة')
            ->setTypeColumn(TypeColumn::PHOTO)
            ->setAttributes(['onchange' => 'previewImage(this)']);
        ;
        $this->setColumns($columns);
    }
}
