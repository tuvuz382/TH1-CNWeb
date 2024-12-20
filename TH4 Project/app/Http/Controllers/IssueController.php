<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $issues = Issue::with('Computer')->paginate(10); // Lấy 5 bản ghi mỗi trang
        return view('issues.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $computers = Computer::all(); // Lấy danh sách máy tính để chọn
        return view('issues.create', compact('computers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|max:50',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        Issue::create($request->all());
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $issues = Issue::findOrFail($id);
        $computers = Computer::all(); // Lấy danh sách máy tính
        return view('issues.edit', compact('issues', 'computers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'computer_id' => 'required|exists:computers,id',
            'reported_by' => 'required|max:50',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required|in:Low,Medium,High',
            'status' => 'required|in:Open,In Progress,Resolved',
        ]);

        $issues = Issue::findOrFail($id);
        $issues->update($request->all());
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã được cập nhật!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $issues = Issue::findOrFail($id);
        $issues->delete();
        return redirect()->route('issues.index')->with('success', 'Vấn đề đã bị xóa!');
    }
}
