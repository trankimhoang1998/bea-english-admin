<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LearningMaterialController extends Controller
{
    public function index(): View
    {
        $materials = LearningMaterial::with('uploader')->latest()->paginate(10);

        return view('manager.materials.index', compact('materials'));
    }

    public function create(): View
    {
        return view('manager.materials.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'file'        => ['required', 'file', 'max:51200', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,gif,mp3,mp4,zip'],
        ]);

        $path = $request->file('file')->store('materials');

        LearningMaterial::create([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path'   => $path,
            'uploaded_by' => auth()->id(),
        ]);

        return redirect()->route('manager.materials.index')
            ->with('success', 'Material uploaded successfully.');
    }

    public function edit(LearningMaterial $material): View
    {
        return view('manager.materials.edit', compact('material'));
    }

    public function update(Request $request, LearningMaterial $material): RedirectResponse
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'file'        => ['nullable', 'file', 'max:51200', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,gif,mp3,mp4,zip'],
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('local')->delete($material->file_path);
            $data['file_path'] = $request->file('file')->store('materials');
        }

        $material->update([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path'   => $data['file_path'] ?? $material->file_path,
        ]);

        return redirect()->route('manager.materials.index')
            ->with('success', 'Material updated successfully.');
    }

    public function download(LearningMaterial $material)
    {
        return Storage::disk('local')->download($material->file_path, $material->title);
    }

    public function destroy(LearningMaterial $material): RedirectResponse
    {
        Storage::disk('local')->delete($material->file_path);
        $material->delete();

        return redirect()->route('manager.materials.index')
            ->with('success', 'Material deleted successfully.');
    }
}
