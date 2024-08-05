<?php

namespace App\Services\DashboardResource;

use Illuminate\Database\Eloquent\Collection;
use Mockery\Exception;

class ColumnDashboard
{
    private string $column;
    private string $columnAs = '';
    private string $title;
    private bool $isClickableShow = false;
    private string $prefix = '';
    private bool $showInTable = false;
    private TypeColumn $typeColumn;
    private array $attributes = [];
    private array|Collection $selects;

    public function getColumn(): string
    {
        return $this->column;
    }

    static public function setColumn(string $column): self
    {
        $object = new self();
        $object->column = $column;
        return $object;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getPrefix(): string
    {
        return $this->prefix;
    }

    public function setPrefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function isShowInTable(): bool
    {
        return $this->showInTable;
    }

    public function setShowInTable(bool $showInTable): self
    {
        $this->showInTable = $showInTable;
        return $this;
    }

    public function getTypeColumn(): TypeColumn
    {
        return $this->typeColumn;
    }

    public function setTypeColumn(TypeColumn $typeColumn): self
    {
        $this->typeColumn = $typeColumn;
        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setAttributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function getSelects(): Collection|array
    {
        return $this->selects;
    }

    public function setSelects(Collection|array $selects): self
    {
        if ($this->typeColumn !== TypeColumn::SELECT)
            throw new Exception("Sorry the columns isn't select");
        $this->selects = $selects;
        return $this;
    }
    public function getColumnAs(): string
    {
        return $this->columnAs;
    }

    public function setColumnAs(string $columnAs): self
    {
        $this->columnAs = $columnAs;
        return $this;
    }
    public function isClickableShow(): bool
    {
        return $this->isClickableShow;
    }

    public function setIsClickableShow(bool $isClickableShow): self
    {
        $this->isClickableShow = $isClickableShow;
        return $this;
    }
}
