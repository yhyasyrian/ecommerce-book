<?php

namespace App\Livewire;

use App\Models\Book;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

abstract class ViewUtilities extends Component
{
    private const NAME_VIEW = 'livewire.view-utilities';
    protected static string $TABLE = Book::TABLE;
    public string $search = '';

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        $results = $this->getResults();
        return view(self::NAME_VIEW, compact('results'));
    }

    private function getResults()
    {
        return $this->getModel()
            ->whereAny(
                array_map(fn($column) => $this->getTable() . '.' . $column, $this->getArrayWhere())
                , 'like', '%' . $this->search . '%')
            ->select([
                ...array_map(fn($column) => $this->getTable() . '.' . $column, $this->getArraySelect()),
                DB::raw('COUNT(`' . static::$TABLE . '`.`id`) as `books_count`')
            ])
            ->leftJoin(static::$TABLE, static::$TABLE . '.' . $this->getColumnRelation() . '_id', '=', $this->getTable() . '.id')
            ->groupBy($this->getTable() . '.id')
            ->get();
    }

    abstract protected function getModel(): Model;

    abstract protected function getArrayWhere(): array;

    abstract protected function getArraySelect(): array; // [as slug,as name]

    abstract public function getRouteUtilityProperty(): string;

    abstract public function getTitleUtilityProperty(): string;

    private function getTable(): string
    {
        $table = $this->getModel()::class;
        $table = str_replace('App\\Models\\', '', $table);
        if (str_ends_with($table, 'y'))
            $table = preg_replace('/(\S+)y$/', '$1ies', $table);
        else $table .= 's';
        return strtolower($table);
    }

    private function getColumnRelation(): string
    {
        $table = $this->getTable();
        if (str_ends_with($table, 'ies'))
            return preg_replace('/(\S+)ies$/', '$1y', $table);
        return preg_replace('/(\S+)s$/', '$1', $table);
    }
}
