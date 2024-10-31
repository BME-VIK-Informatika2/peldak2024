<?php

namespace App\Models;
class Paginator
{
    private int $numberOfItems;
    private int $itemsPerPage;
    private int $currentPage;

    private array $resource;
    private int $numberOfPageItems;

    public function __construct(array $resource, int $itemsPerPage, int $currentPage, int $numberOfPageItems = 9)
    {
        $this->resource = $resource;
        $this->numberOfItems = count($resource);
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
        $this->numberOfPageItems = $numberOfPageItems;
    }

    public function isFirstPage():bool
    {
        return $this->currentPage() == $this->firstPage();
    }

    public function firstPage():int
    {
        return 1;
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage() > $this->firstPage();
    }

    public function previousPage(): int
    {
        return $this->currentPage() - 1;
    }

    public function start():int
    {
        $start = min($this->currentPage() - floor(($this->numberOfPageItems - 1) / 2), $this->lastPage() - ($this->numberOfPageItems - 1));
        return max($start, $this->firstPage());
    }

    public function end():int
    {
        return $this->start() + ($this->numberOfPageItems - 1);
    }

    public function currentPage(): int
    {
        return $this->currentPage;
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage() < $this->lastPage();
    }

    public function nextPage(): int
    {
        return $this->currentPage() + 1;
    }

    public function isLastPage(): bool
    {
        return $this->currentPage() == $this->lastPage();
    }

    public function lastPage(): float
    {
        return ceil($this->numberOfItems / $this->itemsPerPage);
    }

    public function paginate(): array
    {
        return array_slice($this->resource, ($this->currentPage - 1) * $this->itemsPerPage, $this->itemsPerPage);
    }
}