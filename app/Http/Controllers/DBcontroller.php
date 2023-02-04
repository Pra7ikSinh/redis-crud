<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataValidation;
use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class DBcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        Redis::del('empData');

        $request->session()->invalidate();
        $request->session()->forget('key');
                $request->session()->regenerateToken();

        return redirect()->route('datatable');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataValidation $request)
    {

        if (is_null($request['id_for_update'])) {
            $input = $request->all();
            // dd($input);

            $input['languages'] = implode(',', $request['languages']);
            $target_dir = "images";
            // $profile_rename = date('d-m-y H:i:s') . "." . $request['profile_photo']->getClientOriginalExtension();
            $request['profile_photo']->move($target_dir, $request['profile_photo']->getClientOriginalName());
            $input['profile_photo'] = "/" . $target_dir . "/" . $request['profile_photo']->getClientOriginalName();

            $emp = employee::create($input);
            // $e = Event::dispatch(new sendmail(50));
            if ($emp) {
                // dd($emp);
                $old_redis = json_decode(Redis::get('empData'));
                array_push($old_redis, $emp->toArray());
                Redis::set('empData', json_encode($old_redis));
                return response()->json([
                    'status' => 200,
                ]);
            }
        } else {
            // $input = $request->except(['_token']);
            $id_for_update = $request['id_for_update'];

            $input = $request->except(['id_for_update', '_token', 'submit']);

            $input['languages'] = implode(',', $request['languages']);
            if (!is_null($request['profile_photo'])) {
                $target_dir = "images";
                // $profile_rename = date('d-m-y H:i:s') . "." . $request['profile_photo']->getClientOriginalExtension();
                $request['profile_photo']->move($target_dir, $request['profile_photo']->getClientOriginalName());
                $input['profile_photo'] = "/" . $target_dir . "/" . $request['profile_photo']->getClientOriginalName();
            }
            $emp = employee::where('id', $request['id_for_update'])->update($input);
            $redis = json_decode(Redis::get('empData'), true);
            Arr::where($redis, function ($key, $value) use ($id_for_update, $redis, $emp, $input) {
                if ($key['id'] == $id_for_update) {
                    // print_r($redis[$value]); print array !!!
                    // echo $input['profile_photo'] ?? "aa";
                    $input['id'] = $id_for_update;
                    if (!array_key_exists('profile_photo', $input)) {
                        $input['profile_photo'] = $key['profile_photo'];
                    }
                    unset($redis[$value]);
                    array_push($redis, $input);
                    Redis::set('empData', json_encode($redis));

                }

            });
            // $e = Event::dispatch(new sendmail(50));
            if ($emp) {
                return response()->json([
                    'status' => 200,
                    'success' => "employee data updated successfully",
                ]);
            }
        }

        // return redirect()->route('candidate.database');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $empData = Redis::get('empData');
        if ($empData) {
            // print_r('p');
            return response()->json(json_decode($empData), 202);
        }
        $empData = employee::all();
        if (!Auth::check()) {
            Redis::del('empData');
        } else {

            Redis::set('empData', json_encode(($empData)));
        }

        return response()->json($empData, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(request $request)
    {
        $id = $request->id;
        $editEmpData = employee::find($id);
        return response()->json($editEmpData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(request $request)
    {
        // print_r($request->all());
        $ID = $request->id;

        $obj_of_redis = json_decode(Redis::get('empData'), true);

        $new_obj = Arr::where($obj_of_redis, function ($key, $value) use ($ID, $obj_of_redis) {
            if ($key['id'] == $ID) {
                // print_r($key->id);
                // print_r($obj_of_redis[$value]);
                // echo "<pre>";
                unset($obj_of_redis[$value]);
                // echo "<pre>";
                // print_r($obj_of_redis);
                Redis::set('empData', json_encode($obj_of_redis));

                // print_r('redis set');
            }

        });
        // print_r($id);
        // $emp = employee::find($id);
        // print_r($emp);
        $emp = employee::findOrfail($ID)->delete();

        if ($emp) {

            return response()->json(
                [
                    'status' => '200',
                    'success' => 'User Deleted Successfully!',
                ]
            );
        }
    }
}
