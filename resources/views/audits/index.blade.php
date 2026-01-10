<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auditoría del Sistema - Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Inter', sans-serif;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
        }

        .table thead {
            background-color: #f1f3f5;
        }

        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
        }

        .json-viewer {
            background-color: #1e293b;
            color: #e2e8f0;
            padding: 1.25rem;
            border-radius: 0.75rem;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 0.85rem;
            max-height: 400px;
            overflow-y: auto;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .badge-event {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            padding: 0.4em 0.8em;
            letter-spacing: 0.025em;
        }

        .filter-section {
            background-color: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .modal-content {
            border: none;
            border-radius: 1rem;
        }

        .modal-header {
            border-bottom: 1px solid #f1f3f5;
            background-color: #f8f9fa;
            border-radius: 1rem 1rem 0 0;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.03);
        }

        .pagination-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
            border-top: 1px solid #f1f3f5;
        }

        .pagination-info {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .container-custom {
            max-width: 1200px;
        }

        .pagination-container .flex.items-center.justify-between {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="container container-custom py-5">
        <div class="row justify-content-center text-center">
            <div class="col-12 mb-4">
                <h2 class="text-primary fw-bold mb-3">
                    <i class="bi bi-journal-text me-2"></i>Auditoría del Sistema
                </h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12">
                <div class="filter-section border shadow-sm">
                    <form action="{{ route('audits.index') }}" method="GET"
                        class="row g-2 align-items-end justify-content-center">
                        <div class="col-md-1">
                            <label class="form-label small fw-bold text-muted text-uppercase text-center d-block">ID
                                Audit</label>
                            <input type="text" name="id" class="form-control form-control-sm text-center"
                                value="{{ request('id') }}" placeholder="ID">
                        </div>
                        <div class="col-md-2">
                            <label
                                class="form-label small fw-bold text-muted text-uppercase text-center d-block">Usuario</label>
                            <input type="text" name="user_name" class="form-control form-control-sm text-center"
                                value="{{ request('user_name') }}" placeholder="Nombre">
                        </div>
                        <div class="col-md-1">
                            <label
                                class="form-label small fw-bold text-muted text-uppercase text-center d-block">Evento</label>
                            <select name="event" class="form-select form-select-sm text-center">
                                <option value="">Todos</option>
                                <option value="created" {{ request('event') == 'created' ? 'selected' : '' }}>Creado
                                </option>
                                <option value="updated" {{ request('event') == 'updated' ? 'selected' : '' }}>Actualizado
                                </option>
                                <option value="deleted" {{ request('event') == 'deleted' ? 'selected' : '' }}>Eliminado
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label
                                class="form-label small fw-bold text-muted text-uppercase text-center d-block">Modelo</label>
                            <input type="text" name="auditable_type" class="form-control form-control-sm text-center"
                                value="{{ request('auditable_type') }}" placeholder="User">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label small fw-bold text-muted text-uppercase text-center d-block">ID
                                Mod.</label>
                            <input type="text" name="auditable_id" class="form-control form-control-sm text-center"
                                value="{{ request('auditable_id') }}" placeholder="ID">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold text-muted text-uppercase text-center d-block">IP
                                Address</label>
                            <input type="text" name="ip_address" class="form-control form-control-sm text-center"
                                value="{{ request('ip_address') }}" placeholder="IP">
                        </div>
                        <div class="col-md-2">
                            <div class="d-flex gap-1">
                                <button class="btn btn-primary btn-sm w-100 fw-bold" type="submit">Buscar</button>
                                <a href="{{ route('audits.index') }}" class="btn btn-outline-secondary btn-sm"
                                    style="width: 40px;" title="Limpiar">X</a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card shadow-sm border">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Usuario</th>
                                        <th>Evento</th>
                                        <th>Modelo</th>
                                        <th>Dirección IP</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($audits as $audit)
                                        <tr>
                                            <td class="ps-4">
                                                <span class="fw-bold text-muted">#{{ $audit->id }}</span>
                                            </td>
                                            <td>
                                                @if($audit->user)
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2"
                                                            style="width: 32px; height: 32px;">
                                                            <i class="bi bi-person text-primary"></i>
                                                        </div>
                                                        <div class="fw-semibold">{{ $audit->user->name }}</div>
                                                    </div>
                                                @else
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2"
                                                            style="width: 32px; height: 32px;">
                                                            <i class="bi bi-robot text-secondary"></i>
                                                        </div>
                                                        <span class="text-muted">Sistema</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $badgeClass = match ($audit->event) {
                                                        'created' => 'bg-success',
                                                        'updated' => 'bg-warning text-dark',
                                                        'deleted' => 'bg-danger',
                                                        default => 'bg-secondary',
                                                    };
                                                    $eventLabel = match ($audit->event) {
                                                        'created' => 'Creado',
                                                        'updated' => 'Actualizado',
                                                        'deleted' => 'Eliminado',
                                                        default => ucfirst($audit->event),
                                                    };
                                                @endphp
                                                <span class="badge {{ $badgeClass }} badge-event rounded-pill">
                                                    {{ $eventLabel }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="small fw-medium">{{ class_basename($audit->auditable_type) }}
                                                </div>
                                                <div class="text-muted small">ID: {{ $audit->auditable_id }}</div>
                                            </td>
                                            <td><span
                                                    class="badge bg-light text-dark border fw-normal">{{ $audit->ip_address }}</span>
                                            </td>
                                            <td>
                                                <span class="text-muted small">
                                                    <i
                                                        class="bi bi-calendar3 me-1"></i>{{ $audit->created_at->format('d/m/Y H:i') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <button type="button" class="btn btn-outline-info btn-action"
                                                        data-bs-toggle="modal" data-bs-target="#auditModal{{ $audit->id }}"
                                                        title="Detalles">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </div>

                                                <div class="modal fade" id="auditModal{{ $audit->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                                        <div class="modal-content shadow-lg text-start">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title fw-bold">Detalles de la Acción
                                                                    #{{ $audit->id }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body p-4">
                                                                <div class="row g-4">
                                                                    <div class="col-lg-6">
                                                                        <h6
                                                                            class="fw-bold mb-3 text-danger text-uppercase small">
                                                                            Datos Antiguos</h6>
                                                                        <div class="json-viewer">
                                                                            <pre
                                                                                class="mb-0">@json($audit->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)</pre>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <h6
                                                                            class="fw-bold mb-3 text-success text-uppercase small">
                                                                            Datos Nuevos</h6>
                                                                        <div class="json-viewer">
                                                                            <pre
                                                                                class="mb-0">@json($audit->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)</pre>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">No se encontraron resultados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination-container py-4">
                            <div class="text-center">
                                <div class="pagination-info mb-4">
                                    Mostrando <strong>{{ $audits->firstItem() ?? 0 }}</strong> a
                                    <strong>{{ $audits->lastItem() ?? 0 }}</strong> de
                                    <strong>{{ $audits->total() }}</strong> resultados
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $audits->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>