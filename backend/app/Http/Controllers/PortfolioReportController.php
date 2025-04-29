<?php

namespace App\Http\Controllers;

use App\Models\PortfolioReport;
use App\Models\Portfolio;
use Illuminate\Http\Request;


class PortfolioReportController extends Controller
{
    // Show a list of reports
    public function index()
    {
        $reports = PortfolioReport::with('portfolio')->get();
        return view('reports.index', compact('reports')); // Adjust view name as needed
    }

    // Show the form to create a new report
    public function create()
    {
        $portfolios = Portfolio::all(); // Retrieve all portfolios
        return view('reports.create', compact('portfolios')); // Adjust view name as needed
    }

    // Store a new report
    public function store(Request $request)
    {
        $request->validate([
            'portfolio_id' => 'required|exists:portfolios,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,submitted,reviewed',
        ]);

        PortfolioReport::create($request->all());

        return redirect()->route('reports.index')->with('success', 'Report created successfully!');
    }

    // Show a single report (view or details page)
    public function show(PortfolioReport $report)
    {
        return view('reports.show', compact('report')); // Adjust view name as needed
    }

    // Show the form to edit an existing report
    public function edit(PortfolioReport $report)
    {
        $portfolios = Portfolio::all();
        return view('reports.edit', compact('report', 'portfolios')); // Adjust view name as needed
    }

    // Update an existing report
    public function update(Request $request, PortfolioReport $report)
    {
        $request->validate([
            'portfolio_id' => 'required|exists:portfolios,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,submitted,reviewed',
        ]);

        $report->update($request->all());

        return redirect()->route('reports.index')->with('success', 'Report updated successfully!');
    }

    // Delete a report
    public function destroy(PortfolioReport $report)
    {
        $report->delete();

        return redirect()->route('reports.index')->with('success', 'Report deleted successfully!');
    }
}
