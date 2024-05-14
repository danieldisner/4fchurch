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


        Member::create([
            'name' => $request->name,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'email' => $request->email,
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'address_zipcode' => $request->address_zipcode,
            'address_street' => $request->address_street,
            'address_number' => $request->address_number,
            'address_neighborhood' => $request->address_neighborhood,
            'city' => $request->city,
            'uf' => $request->uf,
            'birthdate' => $request->birthdate,
            'joined_at' => $request->joined_at,
            'status_id' => $request->status_id,
            'photo' => $photoPath,
        ]);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
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
            $photoName = uniqid() . '_' . $request->file('photo')->getClientOriginalName();
            $photoPath = $request->file('photo')->storeAs('members', $photoName, 'public');
            $data['photo'] = $photoPath;
        }

        $member->update($data);

        return redirect()->route('members.show', $member)->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
