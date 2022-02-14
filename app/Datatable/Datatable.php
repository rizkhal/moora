<?php

namespace App\Datatable;

use App\Datatable\Column;
use App\Datatable\Traits\WithAppend;
use Illuminate\Http\Request;
use App\Datatable\Traits\WithFilter;
use App\Datatable\Traits\WithPerPage;
use App\Datatable\Traits\WithSorting;
use Illuminate\Database\Eloquent\Model;
use App\Datatable\Utils\Column as ColumnUtils;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class Datatable
{
    use WithAppend,
        WithFilter,
        WithPerPage,
        WithSorting;

    /**
     * Table Query
     *
     * @return object
     */
    abstract public function query();

    /**
     * Table Columns
     *
     * @return array
     */
    abstract public function columns(): array;

    /**
     * Get searhable columns
     *
     * @return array
     */
    public function getSearchableColumns(): array
    {
        return array_filter($this->columns(), fn (Column $column): bool => $column->isSearchable());
    }

    /**
     * Get column
     *
     * @param string|null $column
     * @return Column
     */
    public function getColumn(string|null $column): Column
    {
        return collect($this->columns())->where('column', $column)->first();
    }

    /**
     * Datatable
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function datatable(Request $request): LengthAwarePaginator
    {
        $query = $this->query();

        $query = $this->applySorting($request, $query);

        $query = $this->applySearchFilter($request, $query);

        return $query->paginate($this->perPage())->withQueryString()->through(fn ($model) => $this->through($model));
    }

    /**
     * Through
     *
     * @param Model $model
     * @return array
     */
    private function through(Model $model): array
    {
        $items = [];

        foreach ($this->columns() as $column) {
            if (ColumnUtils::hasRelation($column->column)) {
                if (ColumnUtils::hasMultipleRelation($column->column)) {
                    if ($this->getColumn($column->column)->hasFormatCallback()) {
                        $items[$column->column] = app()->call($this->getColumn($column->column)->getFormatCallback(), ['value' => $model->{$column->column}, 'row' => $model]);
                    } else {
                        [$relationName_1, $relationName_2, $relationAttribute_1] = explode('.', $column->column);
                        $items[$column->column] = $model->{$relationName_1}?->{$relationName_2}?->{$relationAttribute_1};
                    }
                } else {
                    if ($this->getColumn($column->column)->hasFormatCallback()) {
                        $items[$column->column] = app()->call($this->getColumn($column->column)->getFormatCallback(), ['value' => $model->{$column->column}, 'row' => $model]);
                    } else {
                        [$relationName, $relationAttribute] = explode('.', $column->column);
                        $items[$column->column] = $model->{$relationName}?->{$relationAttribute};
                    }
                }
            } else {
                if ($this->getColumn($column->column)->hasFormatCallback()) {
                    $items[$column->column] = app()->call($this->getColumn($column->column)->getFormatCallback(), ['value' => $model->{$column->column}, 'row' => $model]);
                } else {
                    $items[$column->column] = $model->{$column->column};
                }
            }
        }

        if ($this->hasAppends()) {
            foreach ($this->appends() as $append) {
                if (!$append->hasFormatCallback($append)) {
                    $items[$append->getKey()] = $append;
                } else {
                    $items[$append->getKey()] = app()->call($append->getFormatCallback(), ['row' => $model]);
                }
            }
        }

        return $items;
    }
}
