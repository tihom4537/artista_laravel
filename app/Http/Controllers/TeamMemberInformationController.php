<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamMemberInformation;
use App\Http\Requests\StoreTeamMemberInformation;

class TeamMemberInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member=TeamMemberInformation::all();

        return ($member);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->all();
    // var_dump($data);

    $infos = [];
    foreach ($data as $item) {
        $info = TeamMemberInformation::create([
            'team_id' => $item['team_id'],
            'member_name' => $item['member_name'],
            'email' => $item['email'],
            'role' => $item['role'],
            // 'profile_photo' => $item['profile_photo']
        ]);

        $infos[] = $info;
    }

    return $infos;
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $info= TeamMemberInformation::where('id',$id)->first();

        return ($info);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $info=TeamMemberInformation::where('id',$id)->first();

        $info->update($request->all());

        return($info);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $info= TeamMemberInformation::where('id',$id)->first();

        $info->delete();

        return response(null,204);
    }
}
