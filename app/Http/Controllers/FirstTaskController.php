<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Friend;
use \DB;

class FirstTaskController extends Controller
{
    public function index() {
        $friendsId = Friend::select('contact_id', DB::raw('COUNT(*) as fr_count'))
            ->groupBy('contact_id')
            ->having('fr_count', '>', 5);

        $contacts = Contact::joinSub($friendsId, 'friends', function ($join) {
                $join->on('contacts.id', '=', 'contact_id');
            })->get();

        $coupleFriends = DB::select('SELECT con1.name AS name1, con2.name AS name2 FROM (contacts con1, contacts con2)
        JOIN
        (SELECT t2.contact_id, t2.friend_id, IF(t1.contact_id > t1.friend_id, t1.contact_id, t1.friend_id) couple_id
          FROM friends t1, friends t2
          WHERE t1.contact_id=t2.friend_id AND t1.friend_id=t2.contact_id
          GROUP BY couple_id) tab
        ON con1.id=tab.contact_id AND con2.id=tab.friend_id');

        return view('task1')->withContacts($contacts)->withCouple($coupleFriends);
    }
}
