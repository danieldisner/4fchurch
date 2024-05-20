<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Status;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::with('status')->paginate(10);
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::orderBy('name')->get();

        $active = $statuses->where('name', 'Ativo');
        $otherStatuses = $statuses->where('name', '!=', 'Ativo');

        $statuses = $active->merge($otherStatuses);

        return view('members.create', compact('statuses'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberRequest  $request)
    {
        if ($request->hasFile('photo')) {
            $photoName = uniqid() . '_' . $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs('members', $photoName, 'public');
        } else {
            $photoPath = null;
        }
        $validatedData = $request->validated();

        Member::create([
            'name' => $request->name,
            'cpf' => $validatedData['cpf'],
            'rg' => $validatedData['rg'],
            'email' => $request->email,
            'phone' => $validatedData['phone'],
            'whatsapp' => $validatedData['whatsapp'],
            'address_zipcode' => $validatedData['address_zipcode'],
            'address_street' => $request->address_street,
            'address_number' => $request->address_number,
            'address_neighborhood' => $request->address_neighborhood,
            'city' => $request->city,
            'uf' => $request->uf,
            'birthdate' => $request->birthdate,
            'joined_at' => $request->joined_at,
            'status_id' => $request->status_id,
            'photo' => $photoPath,
            'baptism_date' => $request->baptism_date,
            'profession' => $request->profession,
        ]);

        return redirect()->route('members.index')->with('success', 'Membro criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        $statuses = Status::all();
        return view('members.edit', compact('member', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberRequest $request, Member $member)
    {
        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($member->photo !== 'members/default.png' || $member->photo !== null) {
                $oldPhotoPath = public_path('storage/' . $member->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            $photoName = uniqid() . '_' . $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs('members', $photoName, 'public');
            $data['photo'] = $photoPath;
        }

        $member->update($data);

        return redirect()->route('members.show', $member)->with('success', 'Membro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Membro apagado com sucesso.');
    }

    /**
     * Display a listing of the soft deleted members.
     */
    public function trash()
    {
        $deletedMembers = Member::onlyTrashed()->paginate(10);
        return view('members.trash', compact('deletedMembers'));
    }

    /**
     * Restore the specified soft deleted member.
     */
    public function restore($id)
    {
        $member = Member::onlyTrashed()->findOrFail($id);
        $member->restore();

        return redirect()->route('members.trash')->with('success', 'Restaurado com sucesso.');
    }

    /**
     * Permanently delete the specified soft deleted member.
     */
    public function forceDestroy($id)
    {
        $member = Member::onlyTrashed()->findOrFail($id);
        $member->forceDelete();

        if ($member->photo && $member->photo !== 'members/default.png') {
            $photoPath = public_path('storage/' . $member->photo);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        return redirect()->route('members.trash')->with('success', 'Deletado permanentemente.');
    }

    /**
     * Search for members based on the provided query string.
     *
     * @param Request $request The HTTP request containing the query string.
     * @return Some_Return_Value Response in JSON format containing the members found.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $members = Member::with('status') // Ensure status relationship is loaded
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('profession', 'like', '%' . $query . '%')
            ->orWhere('whatsapp', 'like', '%' . $query . '%')
            ->orWhereHas('status', function($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->take(10)
            ->get();

        return response()->json(['members' => $members]);
    }
}
