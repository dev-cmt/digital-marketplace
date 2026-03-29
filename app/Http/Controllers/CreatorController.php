<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;
use Spatie\Permission\Models\Role;

class CreatorController extends Controller
{
    /**
     * Display a listing of the creators (users with assets).
     */
    public function index()
    {
        // Define creator based on the user_type column
        $creators = User::where('user_type', 'creator')->withCount('assets')->latest()->paginate(20);
        return view('backend.creators.index', compact('creators'));
    }

    /**
     * Show the form for editing the creator.
     */
    public function edit($id)
    {
        $creator = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.creators.edit', compact('creator', 'roles'));
    }

    /**
     * Update the creator in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'user_type' => 'nullable|string|in:admin,creator,customer',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        $creator = User::findOrFail($id);
        if ($request->has('user_type')) {
            $creator->user_type = $request->user_type;
        }
        $creator->name = $request->name;
        $creator->email = $request->email;

        if ($request->hasFile('photo')) {
            // Using the requested public/uploads/creators location
            $creator->photo_path = ImageHelper::uploadImage($request->file('photo'), 'uploads/creators', $creator->photo_path);
        }

        $creator->save();

        return redirect()->route('creators.index')->with('success', 'Creator updated successfully.');
    }

    /**
     * Remove the creator from storage.
     */
    public function destroy($id)
    {
        $creator = User::findOrFail($id);
        
        // Don't delete creators with assets for safety
        if ($creator->assets()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete creator with active assets.');
        }

        ImageHelper::deleteImage($creator->photo_path);
        $creator->delete();

        return redirect()->back()->with('success', 'Creator deleted successfully.');
    }
}
