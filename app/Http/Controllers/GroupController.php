<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\User;


class GroupController extends Controller
{
    use HasFactory;

    public function indexAll(Request $request)
    {

        $title = 'Összes csoport';

        $searchTerm = $request->input('search');

            $groups = Group::when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'like', "%{$searchTerm}%");
            })
            ->simplePaginate(16);
        return view('group.index', compact('groups','title'));
    }

    public function indexInGroups(User $user, Request $request)
    {

        $title='Csoportok amikben bent vagy';

        $searchTerm = $request->input('search');

        $groups = Group::whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', "%{$searchTerm}%");
        })
        ->simplePaginate(16);

        return view('group.index', compact('groups','title'));
    }
    public function indexMyGroups(Request $request)
    {

        $title = 'Saját csoportok';

        $searchTerm = $request->input('search');

        $groups = Group::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', "%{$searchTerm}%");
        })
        ->where('author_id', Auth::id())
        ->simplePaginate(16);
        return view('group.index', compact('groups','title'));
    }

    public function show(Group $group)
    {
        return view('group.show', compact('group'));
    }

    public function create()
    {
        return view('group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:5120',
            'description' => 'required',
        ]);

        $imagePath = 'group-logo/default.jpg';

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('group-logo', 'public');
        }

        $group = Group::create([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
            'author_id' => Auth::id(),
        ]);

        return redirect('/groups/'.$group->id);
    }

    public function edit(Group $group)
    {
        if(Auth::User()->id !== $group->author_id){
            abort(403);
        }
        return view('group.edit');
    }

    public function update(Request $request, Group $group)
    {
        if(Auth::User()->id !== $group->author_id){
            abort(403);
        }

        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:5120',
            'description' => 'required',
        ]);

        if($request->hasFile('image')) {
            if($group->image && $group->image!='group-logo/default.jpg' && file_exists(storage_path('app/public/' . $group->image))) {
                unlink(storage_path('app/public/' . $group->image));
            }
            $imagePath = $request->file('image')->store('group-logo', 'public');
            $group->image = $imagePath;
        }

        $group->name = $request->name;
        $group->description = $request->description;
        $group->save();
        return redirect('/groups/'.$group->id);
    }

    public function destroy(Group $group)
    {
        if(Auth::User()->id !== $group->author_id){
            abort(403);
        }
        $group->delete();
        return redirect('/groups');
    }
}
