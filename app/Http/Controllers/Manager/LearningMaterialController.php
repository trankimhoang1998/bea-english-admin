<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\LearningMaterial;
use App\Models\MaterialCategory;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LearningMaterialController extends Controller
{
    public function index(Request $request): View
    {
        $query = LearningMaterial::with('uploader', 'students.user', 'teachers.user', 'category');

        if ($search = $request->input('search')) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($type = $request->input('type')) {
            if ($type === 'file') {
                $query->whereNotNull('file_path')->whereNull('material_link');
            } elseif ($type === 'link') {
                $query->whereNotNull('material_link')->whereNull('file_path');
            }
        }

        if ($studentId = $request->input('student_id')) {
            $query->whereHas('students', fn($q) => $q->where('students.id', $studentId));
        }

        if ($categoryId = $request->input('category_id')) {
            $query->where('material_category_id', $categoryId);
        }

        if ($teacherId = $request->input('teacher_id')) {
            $query->whereHas('teachers', fn($q) => $q->where('teachers.id', $teacherId));
        }

        $materials  = $query->latest()->paginate(10)->withQueryString();
        $students   = Student::with('user')->orderBy('id')->get();
        $teachers   = Teacher::with('user')->orderBy('id')->get();
        $categories = $this->flatCategoryOptions();

        return view('manager.materials.index', compact('materials', 'students', 'teachers', 'categories'));
    }

    public function create(): View
    {
        $students   = Student::with('user')->orderBy('id')->get();
        $teachers   = Teacher::with('user')->orderBy('id')->get();
        $categories = $this->flatCategoryOptions();

        return view('manager.materials.create', compact('students', 'teachers', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $materialType = $request->input('material_type', 'file');

        $rules = [
            'title'                => ['required', 'string', 'max:255'],
            'description'          => ['nullable', 'string', 'max:1000'],
            'material_category_id' => ['nullable', 'exists:material_categories,id'],
            'student_ids'          => ['nullable', 'array'],
            'student_ids.*'        => ['exists:students,id'],
            'teacher_ids'          => ['nullable', 'array'],
            'teacher_ids.*'        => ['exists:teachers,id'],
        ];

        if ($materialType === 'link') {
            $rules['material_link'] = ['required', 'url', 'max:2048'];
        } else {
            $rules['file'] = ['required', 'file', 'max:51200', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,gif,mp3,mp4,zip'];
        }

        $data = $request->validate($rules);

        $createData = [
            'title'                => $data['title'],
            'description'          => $data['description'] ?? null,
            'material_category_id' => $data['material_category_id'] ?? null,
            'uploaded_by'          => auth()->id(),
        ];

        if ($materialType === 'link') {
            $createData['material_link'] = $data['material_link'];
        } else {
            $createData['file_path'] = $request->file('file')->store('materials');
        }

        $material = LearningMaterial::create($createData);
        $material->students()->sync($data['student_ids'] ?? []);
        $material->teachers()->sync($data['teacher_ids'] ?? []);

        return redirect()->route('manager.materials.index')
            ->with('success', 'Material uploaded successfully.');
    }

    public function edit(LearningMaterial $material): View
    {
        $students           = Student::with('user')->orderBy('id')->get();
        $assignedStudentIds = $material->students->pluck('id')->toArray();
        $teachers           = Teacher::with('user')->orderBy('id')->get();
        $assignedTeacherIds = $material->teachers->pluck('id')->toArray();
        $categories         = $this->flatCategoryOptions();

        return view('manager.materials.edit', compact('material', 'students', 'assignedStudentIds', 'teachers', 'assignedTeacherIds', 'categories'));
    }

    public function update(Request $request, LearningMaterial $material): RedirectResponse
    {
        $materialType = $request->input('material_type', $material->material_link ? 'link' : 'file');

        $rules = [
            'title'                => ['required', 'string', 'max:255'],
            'description'          => ['nullable', 'string', 'max:1000'],
            'material_category_id' => ['nullable', 'exists:material_categories,id'],
            'student_ids'          => ['nullable', 'array'],
            'student_ids.*'        => ['exists:students,id'],
            'teacher_ids'          => ['nullable', 'array'],
            'teacher_ids.*'        => ['exists:teachers,id'],
        ];

        if ($materialType === 'link') {
            $rules['material_link'] = ['required', 'url', 'max:2048'];
        } else {
            $rules['file'] = ['nullable', 'file', 'max:51200', 'mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png,gif,mp3,mp4,zip'];
        }

        $data = $request->validate($rules);

        $updateData = [
            'title'                => $data['title'],
            'description'          => $data['description'] ?? null,
            'material_category_id' => $data['material_category_id'] ?? null,
        ];

        if ($materialType === 'link') {
            if ($material->file_path) {
                Storage::disk('local')->delete($material->file_path);
                $updateData['file_path'] = null;
            }
            $updateData['material_link'] = $data['material_link'];
        } else {
            $updateData['material_link'] = null;
            if ($request->hasFile('file')) {
                if ($material->file_path) {
                    Storage::disk('local')->delete($material->file_path);
                }
                $updateData['file_path'] = $request->file('file')->store('materials');
            }
        }

        $material->update($updateData);
        $material->students()->sync($data['student_ids'] ?? []);
        $material->teachers()->sync($data['teacher_ids'] ?? []);

        return redirect()->route('manager.materials.index')
            ->with('success', 'Material updated successfully.');
    }

    public function download(LearningMaterial $material)
    {
        if ($material->material_link) {
            return redirect($material->material_link);
        }

        if (!$material->file_path) {
            abort(404);
        }

        return Storage::disk('local')->download($material->file_path, $material->title);
    }

    private function flatCategoryOptions(): array
    {
        $all  = MaterialCategory::orderBy('sort_order')->orderBy('name')->get();
        $flat = $this->flattenCategoryTree($all);

        return array_map(fn($row) => [
            'id'    => $row['item']->id,
            'label' => str_repeat('└─ ', $row['depth']) . $row['item']->name,
        ], $flat);
    }

    private function flattenCategoryTree($categories, ?int $parentId = null, int $depth = 0): array
    {
        $result = [];
        foreach ($categories->where('parent_id', $parentId) as $cat) {
            $result[] = ['item' => $cat, 'depth' => $depth];
            $result   = array_merge($result, $this->flattenCategoryTree($categories, $cat->id, $depth + 1));
        }
        return $result;
    }

    public function destroy(LearningMaterial $material): RedirectResponse
    {
        if ($material->file_path) {
            Storage::disk('local')->delete($material->file_path);
        }
        $material->delete();

        return redirect()->route('manager.materials.index')
            ->with('success', 'Material deleted successfully.');
    }
}
