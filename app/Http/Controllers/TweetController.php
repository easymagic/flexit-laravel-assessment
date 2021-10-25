<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return [
            'data'=>Tweet::query()->get()
        ];
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
    public function store(Request $request)
    {
        //
        try {

            $data = request()->validate([
                'user_id'=>'required',
                'tweet'=>'required'
            ]);

            $new = Tweet::create($data);

            return [
                'message'=>'New tweet posted successfully.',
                'error'=>false
            ];

        } catch (ValidationException $th) {
          return $this->getValidationErrors($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show(Tweet $tweet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {

            $data = request()->validate([
                'user_id'=>'required',
                'tweet'=>'required'
            ]);

            $old = Tweet::query()->find($id);

            if ($old->user_id != $data['user_id']){
               return [
                   'message'=>'Failed to update (Tweet not created by you)',
                   'error'=>true
               ];
            }

            $old->update($data);

            return [
                'message'=>'Tweet updated successfully.',
                'error'=>false
            ];

        } catch (ValidationException $th) {
          return $this->getValidationErrors($th);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $data = request()->validate([
                'user_id'=>'required'
            ]);

            $old = Tweet::query()->find($id);

            if ($old->user_id != $data['user_id']){
                return [
                    'message'=>'Failed to remove, not created by you!',
                    'error'=>true
                ];
            }

            $old->delete();

            return [
                'message'=>'Tweet removed successfully.',
                'error'=>false
            ];


        } catch (\Throwable $th) {
            return $this->getValidationErrors($th);
        }

    }

}
