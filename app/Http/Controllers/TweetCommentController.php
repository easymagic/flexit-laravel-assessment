<?php

namespace App\Http\Controllers;

use App\Models\TweetComment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TweetCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // ['tweet_id','user_id','comment'];
        $tweet_id = '';
        if (request()->filled('tweet_id')){
          $tweet_id = request('tweet_id');
        }
        if (empty($tweet_id)){
            return [
                'data'=>[]
            ];
        }
        return [
            'data'=>TweetComment::query()->where('tweet_id',$tweet_id)->get()
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
            //['tweet_id','user_id','comment'];
            $data = request()->validate([
               'tweet_id'=>'required',
               'user_id'=>'required',
               'comment'=>'required'
            ]);

            $new = TweetComment::create($data);

            return [
                'message'=>'Comment replied successfully',
                'error'=>false
            ];
        } catch (ValidationException $th) {
            return $this->getValidationErrors($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TweetComment  $tweetComment
     * @return \Illuminate\Http\Response
     */
    public function show(TweetComment $tweetComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TweetComment  $tweetComment
     * @return \Illuminate\Http\Response
     */
    public function edit(TweetComment $tweetComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TweetComment  $tweetComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            //['tweet_id','user_id','comment'];
            $data = request()->validate([
            //    'tweet_id'=>'required',
               'user_id'=>'required',
               'comment'=>'required'
            ]);

            $old = TweetComment::query()->find($id); // create($data);

            if ($old->user_id != $data['user_id']){
              return [
                  'message'=>'Failed to update (Reply not posted by you)',
                  'error'=>true
              ];
            }

            $old->update($data);

            return [
                'message'=>'Comment updated successfully',
                'error'=>false
            ];

        } catch (ValidationException $th) {
            return $this->getValidationErrors($th);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TweetComment  $tweetComment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        try {
            //['tweet_id','user_id','comment'];
            $data = request()->validate([
            //    'tweet_id'=>'required',
               'user_id'=>'required'
            //    'comment'=>'required'
            ]);

            $old = TweetComment::query()->find($id); // create($data);

            if ($old->user_id != $data['user_id']){
              return [
                  'message'=>'Failed to remove (Reply not posted by you)',
                  'error'=>true
              ];
            }

            $old->delete();

            return [
                'message'=>'Comment removed successfully',
                'error'=>false
            ];

        } catch (ValidationException $th) {
            return $this->getValidationErrors($th);
        }

    }
}
