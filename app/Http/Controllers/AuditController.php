<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditController extends Controller
{
    public function index(Request $request)
    {
        $query = Audit::with('user')->orderBy('id', 'asc');

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('user_name')) {
            $name = $request->user_name;
            $query->whereHas('user', function ($q) use ($name) {
                $q->where('name', 'like', '%' . $name . '%');
            });
        }

        if ($request->filled('auditable_type')) {
            $query->where('auditable_type', 'like', '%' . $request->auditable_type . '%');
        }

        if ($request->filled('auditable_id')) {
            $query->where('auditable_id', $request->auditable_id);
        }

        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        if ($request->filled('ip_address')) {
            $query->where('ip_address', 'like', '%' . $request->ip_address . '%');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', '%' . $search . '%')
                    ->orWhere('event', 'like', '%' . $search . '%')
                    ->orWhere('auditable_type', 'like', '%' . $search . '%')
                    ->orWhere('ip_address', 'like', '%' . $search . '%')
                    ->orWhere('old_values', 'like', '%' . $search . '%')
                    ->orWhere('new_values', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($qu) use ($search) {
                        $qu->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $audits = $query->paginate(15)->withQueryString();

        return view('audits.index', compact('audits'));
    }

    public function show($id)
    {
        $audit = Audit::findOrFail($id);
        return view('audits.show', compact('audit'));
    }
}
