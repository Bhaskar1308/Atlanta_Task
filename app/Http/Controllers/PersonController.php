<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Yajra\DataTables\DataTables;

class PersonController extends Controller
{
    public function index()
    {
        return view('people.index');
    }

    public function getPeople(Request $request)
    {
        if ($request->ajax()) {
            $data = Person::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '
                        <button class="btn btn-sm btn-primary editBtn" data-id="' . $row->id . '">✏️</button>
                        <button class="btn btn-sm btn-danger deleteBtn" data-id="' . $row->id . '">🗑️</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:ADMIN,DESIGNER,DEVELOPER',
            'designation' => 'required|in:ADMIN,Developer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Active',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $filename);
            $data['photo'] = $filename;
        }

        Person::create($data);

        return response()->json(['success' => 'Person created successfully.']);
    }


    public function edit($id)
    {
        $person = Person::findOrFail($id);
        return response()->json($person);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:ADMIN,DESIGNER,DEVELOPER',
            'designation' => 'required|in:ADMIN,Developer',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:Active',
        ]);

        $person = Person::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads'), $filename);
            $data['photo'] = $filename;
        }

        $person->update($data);

        return response()->json(['success' => 'Person updated successfully.']);
    }


    public function destroy($id)
    {
        Person::findOrFail($id)->delete();
        return response()->json(['success' => 'Person deleted successfully.']);
    }
}
