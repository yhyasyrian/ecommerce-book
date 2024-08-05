<?php

namespace App\Dashboard;

use App\Http\Requests\Dashboard\CreateBookRequest;
use App\Http\Requests\Dashboard\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Services\CreateBookService;
use App\Services\DashboardResource\ColumnDashboard;
use App\Services\DashboardResource\ResourceService;
use App\Services\DashboardResource\TypeColumn;
use App\Services\UpdateBookService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

/**
 * بين 30-60
 */
class BookResource extends ResourceService
{
    public function getModel(): Model
    {
        return new Book;
    }

    public function getTitleForOne(): string
    {
        return 'كتاب';
    }

    public function getNameRoute(): string
    {
        return 'books';
    }

    public function getTitleForMoreOne(): string
    {
        return 'الكتب';
    }

    public function getRequestValidationRules(): FormRequest
    {
        return new CreateBookRequest;
    }

    public function getRequestValidationRulesUpdate(): FormRequest
    {
        return new UpdateBookRequest();
    }

    public function __construct()
    {
        $columns = [];
        $columns[] = ColumnDashboard::setColumn('title')
            ->setTitle('العنوان')
            ->setTypeColumn(TypeColumn::TEXT)
            ->setShowInTable(true)
            ->setIsClickableShow(true);
        $columns[] = ColumnDashboard::setColumn('isbn')
            ->setTitle('الرقم التسلسلي')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setShowInTable(true);
        $columns[] = ColumnDashboard::setColumn('category_id')
            ->setTitle('التصنيف')
            ->setTypeColumn(TypeColumn::SELECT)
            ->setShowInTable(true)
            ->setSelects(Category::all(['id', 'name']))
            ->setColumnAs('categoryName');
        $columns[] = ColumnDashboard::setColumn('authors')
            ->setTitle('المؤلفون')
            ->setTypeColumn(TypeColumn::SELECT)
            ->setShowInTable(true)
            ->setSelects(Author::all(['id', 'name']))
            ->setColumnAs('authorsName')
            ->setAttributes(['multiple' => true]);
        $columns[] = ColumnDashboard::setColumn('publisher_id')
            ->setTitle('الناشرون')
            ->setTypeColumn(TypeColumn::SELECT)
            ->setSelects(Publisher::all(['id', 'name']))
            ->setColumnAs('publisherName')
        ;
        $columns[] = ColumnDashboard::setColumn('description')
            ->setTitle('الوصف')
            ->setTypeColumn(TypeColumn::TEXTAREA);
        $columns[] = ColumnDashboard::setColumn('thumbnail')
            ->setTitle('الصورة')
            ->setTypeColumn(TypeColumn::PHOTO)
            ->setAttributes(['onchange' => 'previewImage(this)']);
        $columns[] = ColumnDashboard::setColumn('date_publish')
            ->setTitle('سنة النشر')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setAttributes(['min' => 1970]);
        $columns[] = ColumnDashboard::setColumn('pages')
            ->setTitle('عدد الصفحات')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setShowInTable(true)
            ->setAttributes(['min' => 0]);
        $columns[] = ColumnDashboard::setColumn('copies')
            ->setTitle('عدد النسخ')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setShowInTable(false)
            ->setAttributes(['min' => 0]);
        $columns[] = ColumnDashboard::setColumn('price')
            ->setTitle('السعر')
            ->setTypeColumn(TypeColumn::NUMBER)
            ->setShowInTable(true)
            ->setPrefix('$')
            ->setAttributes(['min' => 0]);
        $this->setColumns($columns);
    }

    public function createHandel(FormRequest $request): void
    {
        $createBookService = new CreateBookService($request);
        $createBookService->create();
    }

    public function updateHandel(FormRequest $request,Book|Model $book): void
    {
        $createBookService = new UpdateBookService($request,$book);
        $createBookService->update();
    }
    protected function destroyHandel(Model $model):void
    {
        Storage::disk('public')->delete($model->thumbnail);
        $model->delete();
    }
}
