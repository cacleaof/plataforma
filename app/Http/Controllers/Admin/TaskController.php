<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{
	public function store(Request $request){
		$task = new Task();

		$task->task = $request->text;
		$task->date_ini = $request->start_date;
		$task->prevdias = $request->duration;
		$task->progresso = $request->has("progress") ? $request->progress : 0;
		$task->parente = $request->parent;
		$task->sortorder = Task::max("sortorder") + 1;;

		$task->save();

		return response()->json([
			"action"=> "inserted",
			"tid" => $task->id
		]);
	}

	public function update($id, Request $request){
		$task = Task::find($id);

		$task->task = $request->text;
		$task->date_ini = $request->start_date;
		$task->prevdias = $request->duration;
		$task->progresso = $request->has("progress") ? $request->progress : 0;
		$task->parente = $request->parent;

		if($request->has("target")){
			$this->updateOrder($id, $request->target);
		}

		$task->save();

		return response()->json([
			"action"=> "updated"
		]);
	}

	private function updateOrder($taskId, $target){
		$nextTask = false;
		$targetId = $target;

		if(strpos($target, "next:") === 0){
			$targetId = substr($target, strlen("next:"));
			$nextTask = true;
		}

		if($targetId == "null")
			return;

		$targetOrder = Task::find($targetId)->sortorder;
		if($nextTask)
			$targetOrder++;

		Task::where("sortorder", ">=", $targetOrder)->increment("sortorder");

		$updatedTask = Task::find($taskId);
		$updatedTask->sortorder = $targetOrder;
		$updatedTask->save();
	}


	public function destroy($id){
		$task = Task::find($id);
		$task->delete();

		return response()->json([
			"action"=> "deleted"
		]);
	}
}