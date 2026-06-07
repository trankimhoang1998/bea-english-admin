<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\TeachingHistory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TeachingHistoryManagerController extends Controller
{
    public function index(): View
    {
        $histories = TeachingHistory::with('teacher.user', 'student.user')
            ->latest('taught_at')
            ->paginate(25);

        return view('manager.histories.index', compact('histories'));
    }

    public function show(TeachingHistory $history): View
    {
        $history->load('teacher.user', 'student.user');

        return view('manager.histories.show', compact('history'));
    }

    public function destroy(TeachingHistory $history): RedirectResponse
    {
        if ($history->video_path) {
            Storage::disk('local')->delete($history->video_path);
        }

        $history->delete();

        return redirect()->route('manager.histories.index')
            ->with('success', 'History record deleted successfully.');
    }
}
