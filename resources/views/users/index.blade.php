<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios - Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Inter', sans-serif;
        }
        .card { border: none; border-radius: 0.75rem; }
        .table thead { background-color: #f1f3f5; }
        .btn-action { padding: 0.25rem 0.5rem; font-size: 0.875rem; }
        
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
        .table-hover tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.03);
        }
        .pagination-container .flex.items-center.justify-between {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-12 mb-4">
                <h2 class="text-primary fw-bold mb-3">
                    <i class="bi bi-people-fill me-2"></i>Lista de Usuarios
                </h2>
                <div class="d-flex justify-content-center gap-2 mt-2">
                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                        <i class="bi bi-person-plus-fill me-1"></i> Nuevo Usuario
                    </a>
                    <form action="{{ route('logout') }}" method="post" class="mb-0">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm rounded-pill px-4">
                            <i class="bi bi-power me-1"></i> Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-xl-11">
                <div class="card shadow-sm border">
                    <div class="card-body p-0">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-4">ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Fecha Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="ps-4 fw-bold text-muted">#{{ $user->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                    <i class="bi bi-person text-primary"></i>
                                                </div>
                                                <div class="fw-medium">{{ $user->name }}</div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="text-muted small">
                                                <i class="bi bi-calendar3 me-1"></i>{{ $user->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-outline-info btn-action" title="Detalles">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-warning btn-action" title="Editar">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-action" title="Eliminar" onclick="return confirm('¿Eliminar este usuario?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="pagination-container py-4">
                            <div class="text-center">
                                <div class="pagination-info mb-4">
                                    Mostrando <strong>{{ $users->firstItem() ?? 0 }}</strong> a <strong>{{ $users->lastItem() ?? 0 }}</strong> de <strong>{{ $users->total() }}</strong> resultados
                                </div>
                                <div class="d-flex justify-content-center">
                                    {!! $users->links('pagination::bootstrap-5') !!}
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
