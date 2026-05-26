<?php

namespace App\Actions\Patients;

use App\Models\Patient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListPatientsAction
{
    public function execute(array $filters = []): LengthAwarePaginator
    {
        $query = Patient::query()
            ->when($filters['global_filter'] ?? null, function ($q, $search) {
                $q->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('cpf', 'like', "%{$search}%")
                        ->orWhere('rg', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone_number', 'like', "%{$search}%")
                        ->orWhere('friendly_id', 'like', "%{$search}%");
                });
            })
            ->when(
                $filters['name'] ?? null,
                fn($q, $name) =>
                $q->where('name', 'like', "%{$name}%")
            )
            ->when(
                $filters['email'] ?? null,
                fn($q, $email) =>
                $q->where('email', $email)
            )
            ->when(
                $filters['cpf'] ?? null,
                fn($q, $cpf) =>
                $q->where('cpf', 'like', "%{$cpf}%")
            )
            ->when(
                $filters['created_from'] ?? null,
                fn($q, $date) =>
                $q->whereDate('created_at', '>=', $date)
            )
            ->when(
                $filters['created_to'] ?? null,
                fn($q, $date) =>
                $q->whereDate('created_at', '<=', $date)
            );

        // 🔄 Ordenação (default: mais recentes)
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortDirection = $filters['sort_direction'] ?? 'desc';

        $query->orderBy($sortBy, $sortDirection);

        // 📄 Paginação
        $perPage = $filters['per_page'] ?? 15;
        $page = $filters['page'] ?? 1;

        return $query->paginate(
            $perPage,
            ['*'],
            'page',
            $page
        );
    }
}
