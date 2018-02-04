<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;
use Auth;

class CreateRoomsController extends Controller {

    public function index() {
        return view('/create');
    }

    public function add(Request $request) {
        $rooms = new Room;
        $rooms->name = $request->name;
        $rooms->description = $request->description;
        $rooms->publish = $request->publish;
        $rooms->password = bcrypt($request->password);
        $rooms->creator = Auth::user()->user_id;
        $rooms->room_id = hash('adler32', Auth::user()->user_id . srand());
        $rooms->save();

        return redirect('/');
    }
}
