<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Link;
 
class GanttController extends Controller
{
    public function get(){
        $tasks = new Task();
        $links = new Link();
 
        return response()->json([
            "data" => $tasks->all(),
            "links" => $links->all()
        ]);
    }
}