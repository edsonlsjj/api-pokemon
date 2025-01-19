<?php

namespace App\Domain\Traits;

trait Paginatable
{
    private int $total;
    private int $perPage;
    private int $currentPage;
    private int $lastPage;

    public function setPagination(int $total, int $perPage, int $currentPage): void
    {
        $this->total = $total;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->lastPage = (int) ceil($total / $perPage);
    }

    public function getPaginationData(): array
    {
        return [
            'total' => $this->total,
            'per_page' => $this->perPage,
            'current_page' => $this->currentPage,
            'last_page' => $this->lastPage,
        ];
    }

    public function paginateToArray(array $data): array
    {
        return array_merge(
            $this->getPaginationData(),
            ['data' => $data]
        );
    }
}
