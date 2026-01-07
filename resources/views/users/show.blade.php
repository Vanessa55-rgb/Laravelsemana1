<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Usuario - Admin</title>
    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 0.75rem; }
        .info-label { color: #6c757d; font-size: 0.875rem; font-weight: 600; }
        .info-value { color: #212529; font-size: 1.1rem; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalles del Usuario</li>
                    </ol>
                </nav>

                <div class="card shadow-sm">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary fw-bold">
                            <i class="bi bi-person-badge me-2"></i>Detalles del Usuario
                        </h5>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil me-1"></i> Editar
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                <i class="bi bi-person-fill text-primary display-4"></i>
                            </div>
                            <h4 class="mb-0 fw-bold">{{ $user->name }}</h4>
                            <p class="text-muted">Usuario Registrado</p>
                        </div>

                        <hr class="text-secondary opacity-25">

                        <div class="row g-3">
                            <div class="col-12">
                                <label class="info-label">Nombre</label>
                                <div class="info-value">{{ $user->name }}</div>
                            </div>
                            <div class="col-12">
                                <label class="info-label">Email</label>
                                <div class="info-value">{{ $user->email }}</div>
                            </div>
                        </div>

                        <div class="mt-5 d-flex justify-content-center">
                            <a href="{{ route('users.index') }}" class="btn btn-primary px-5 rounded-pill">
                                <i class="bi bi-arrow-left me-2"></i>Volver a la Lista
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>