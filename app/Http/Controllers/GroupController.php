<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\User;
use App\Models\Post;


class GroupController extends Controller
{
    use HasFactory;

    public function indexAll(Request $request)
    {

        $title = 'Összes csoport';

        $searchTerm = $request->input('search');

        $groups = Group::searchByName($searchTerm)
        ->simplePaginate(16);

        return view('group.index', compact('groups','title'));
    }

    public function indexInGroups(Request $request)
    {
        $title='Csoportok amikben bent vagy';

        $searchTerm = $request->input('search');

        $groups = Group::whereHas('members', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->searchByName($searchTerm)
        ->simplePaginate(16);

        return view('group.index', compact('groups','title'));
    }
    public function indexMyGroups(Request $request)
    {

        $title = 'Saját csoportok';

        $searchTerm = $request->input('search');

        $groups = Group::searchByName($searchTerm)
        ->where('author_id', Auth::id())
        ->simplePaginate(16);
        return view('group.index', compact('groups','title'));
    }

    public function show(Group $group)
    {
        $group = Group::with('posts.comments.user')
        ->where('id', $group->id)
        ->orderBy('created_at', 'desc')
        ->firstOrFail();
        return view('group.show', compact('group'));
    }

    public function list(Group $group){

        $title = $group->name.' csoport tagjai';

        $users = $group->members()->simplePaginate(16);

        return view('follow', compact('users', 'title'));
    }

    public function create()
    {
        return view('group.create');
    }

    public function store(Request $request)
    {
        $groupCount = Group::where('author_id', Auth::id())->count();

        if ($groupCount >= 5) {
            return back()->withErrors(['message' => 'Már 5 csoportod van. Nem hozhatsz létre újabbat.']);
        }

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

        $group->users()->attach(Auth::id());

        return redirect('/groups/'.$group->id);
    }

    public function edit(Group $group)
    {
        if(Auth::User()->id !== $group->author_id){
            abort(403);
        }
        return view('group.edit', compact('group'));
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


    public function join(Group $group)
    {
        $user = User::findorfail(Auth::id());

        if (!$user->groups->contains($group->id)) {
            $user->groups()->attach($group->id);
            return redirect()->back()->with('success', 'Csatlakoztál a csoporthoz!');
        }

        return redirect()->back()->with('error', 'Már tagja vagy a csoportnak.');
    }

    public function leave(Group $group)
    {
        $user = User::findorfail(Auth::id());

        if ($user->groups->contains($group->id)) {
            $user->groups()->detach($group->id);
            return redirect()->back()->with('success', 'Kiléptél a csoportból.');
        }

        return redirect()->back()->with('error', 'Nem vagy tagja a csoportnak.');
    }
}
