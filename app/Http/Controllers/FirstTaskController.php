<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use \DB;

class FirstTaskController extends Controller
{
    public function index() {
        // $contacts = Contact::all();
        // $contacts = new Contact;
        // $contacts->select('name')
        // ->join();

        $friendsId = DB::table('friends')
            ->select('contact_id', DB::raw('COUNT(*) as fr_count'))
            ->groupBy('contact_id')
            ->having('fr_count', '>', 5);
            // ->get();

        $contacts = DB::table('contacts')
            ->joinSub($friendsId, 'friends', function ($join) {
                $join->on('contacts.id', '=', 'contact_id');
            })->get();
            // dd($friendsId);

        // dd($contacts);
        // $friends = new Contact;
        // $friends = DB::table('friends')
        //     ->select('contact_id', 'friend_id')
        //     ->whereNotIn('friend_id', function($query){
        //         $query->select('contact_id')->from('friends');
        //     });
            // ->get();

        //--------------------------
        //    $coupleFriends = DB::select('SELECT con1.name AS name1, con2.name AS name2 FROM contacts con1, contacts con2 WHERE
        //    (con1.id, con2.id) IN
        //    (SELECT contact_id, friend_id FROM friends)');
        //--------------------------

        //-----|------------|-----------
        // $coupleFriends = DB::select('SELECT con1.name AS name1, con2.name AS name2 FROM (contacts con1, contacts con2)
        // JOIN
        // (SELECT t3.contact_id, t3.friend_id, couple_id FROM
        // (SELECT t2.contact_id, t2.friend_id,
        //   CASE
        //   WHEN t1.friend_id=t2.contact_id AND t1.contact_id=t2.friend_id THEN
        //      IF(t1.contact_id > t1.friend_id, t1.contact_id, t1.friend_id)
        //         ELSE -1
        //   END couple_id
        //  FROM (friends t1, friends t2)) t3
        //     WHERE couple_id <> -1
        //     GROUP BY couple_id) tab
        // ON con1.id=tab.contact_id AND con2.id=tab.friend_id');
        //-----^------------^-----------





//if strict = false
        $coupleFriends = DB::select('SELECT con1.name AS name1, con2.name AS name2 FROM (contacts con1, contacts con2)
        JOIN
        (SELECT t2.contact_id, t2.friend_id, IF(t1.contact_id > t1.friend_id, t1.contact_id, t1.friend_id) couple_id
          FROM friends t1, friends t2
          WHERE t1.contact_id=t2.friend_id AND t1.friend_id=t2.contact_id
          GROUP BY couple_id) tab
        ON con1.id=tab.contact_id AND con2.id=tab.friend_id');

        // $coupleFriends = DB::select('SELECT t3.contact_id, t3.friend_id, couple_id FROM
        // (SELECT t2.contact_id, t2.friend_id,
        //   CASE
        //   WHEN t1.friend_id=t2.contact_id AND t1.contact_id=t2.friend_id THEN
        //      IF(t1.contact_id > t1.friend_id, t1.contact_id, t1.friend_id)
        //         ELSE -1
        //   END couple_id
        //  FROM (friends t1, friends t2)) t3
        //     WHERE couple_id <> -1
        //     GROUP BY couple_id');

        // dd($coupleFriends);

        //-----------------
        // return view('task1', ['data' => $contacts]);
        //-----------------
        return view('task1')->withContacts($contacts)->withCouple($coupleFriends);
        // return view('task1', ['data' => [$a]]);
    }
}
