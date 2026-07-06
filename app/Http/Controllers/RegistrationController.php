<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'phone'    => ['required', 'string', 'regex:/^(0[3-9]\d{8})$/'],
            'audience' => ['nullable', 'string', 'in:hoc-sinh-tieu-hoc,hoc-sinh-thcs,hoc-sinh-thpt,sinh-vien,nguoi-di-lam,ielts,khac'],
        ], [
            'name.required'  => 'Vui lòng nhập họ tên.',
            'name.max'       => 'Họ tên không được quá 100 ký tự.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex'    => 'Số điện thoại không hợp lệ (10 số, bắt đầu bằng 03–09).',
        ]);

        Registration::create($request->only('name', 'phone', 'audience'));

        return response()->json(['message' => 'OK']);
    }
}
