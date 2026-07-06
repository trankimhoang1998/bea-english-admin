<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $query = Registration::with('contactedBy')->latest();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('phone', 'like', '%' . $search . '%');
            });
        }

        $registrations = $query->paginate(20)->withQueryString();

        $counts = [
            'all'         => Registration::count(),
            'pending'     => Registration::where('status', 'pending')->count(),
            'contacted'   => Registration::where('status', 'contacted')->count(),
            'not_reached' => Registration::where('status', 'not_reached')->count(),
        ];

        return view('manager.registrations.index', compact('registrations', 'counts'));
    }

    public function show(Registration $registration): View
    {
        return view('manager.registrations.show', compact('registration'));
    }

    public function updateStatus(Request $request, Registration $registration): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,contacted,not_reached'],
            'notes'  => ['nullable', 'string', 'max:2000'],
        ]);

        $data = [
            'status' => $validated['status'],
            'notes'  => $validated['notes'],
        ];

        if ($validated['status'] === 'contacted' && $registration->status !== 'contacted') {
            $data['contacted_at'] = now();
            $data['contacted_by'] = auth()->id();
        }

        $registration->update($data);

        return back()->with('success', 'Đã cập nhật.');
    }

    public function quickStatus(Request $request, Registration $registration): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,contacted,not_reached'],
        ]);

        $data = ['status' => $validated['status']];

        if ($validated['status'] === 'contacted' && $registration->status !== 'contacted') {
            $data['contacted_at'] = now();
            $data['contacted_by'] = auth()->id();
        }

        $registration->update($data);

        return response()->json($registration->fresh()->statusBadge());
    }

    public function destroy(Registration $registration): RedirectResponse
    {
        $registration->delete();

        return redirect()->route('manager.registrations.index')
            ->with('success', 'Đã xóa đăng ký.');
    }
}
