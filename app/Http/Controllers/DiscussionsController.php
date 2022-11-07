<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Http\Requests\CreateDiscussionRequest;
use App\Models\Reply;
use Illuminate\Support\Str;

class DiscussionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only('create', 'store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();
        return view('discussions.index', [
            'discussions' => Discussion::filterByChannels()->paginate(10),
            'channels' => $channels
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $channels = Channel::all();
        return view('discussions.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDiscussionRequest $request)
    {
        auth()->user()->discussions()->create([
            'title' => $request->title,
            'content' => $request->content,
            'channel_id' => $request->channel,
            'slug' => Str::slug($request->title),
            ]);

        session()->flash('success', 'Discussion posted successfully');
        return redirect(route('discussions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        $channels = Channel::all();
        return view('discussions.show',[
            'discussion' => $discussion,
            'channels' => $channels
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

        /**
     * Mark areply as best reply for the discussion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reply(Discussion $discussion, Reply $reply)
    {
        $discussion->markAsBestReply($reply);

        session()->flash('success', 'Marked as best reply.');

        return redirect()->back();
    }
}
