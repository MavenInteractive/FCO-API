<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Callout;
use App\Vote;
use DB;
use Input;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VoteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::only('user_id', 'callout_id', 'tally');

		try {
			$input['status'] = 'A';

			Vote::create($input);

			$callout = Callout::findOrFail($input['callout_id']);

			$callout->total_votes += $input['tally'];

			$callout->save();

			return response()->json(['success' => 'success_message']);
		} catch (\Exception $error) {
			return response()->json(['error' => 'failed_to_create'], Response::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function tally($callout_id)
	{
		$votes = DB::table('votes')
			->select('tally', DB::raw('count(*) as total'))
			->where('callout_id', $callout_id)
			->groupBy('tally');

		$tally = ['up' => 0, 'down' => 0];


		if ( ! $votes->count()) {
			return response()->json($tally);
		} else {
			foreach ($votes->get() as $vote) {
				if ($vote->tally > 0) {
					$tally['up'] = (int) $vote->total;
				} elseif ($vote->tally < 0) {
					$tally['down'] = (int) $vote->total;
				}
			}

			return response()->json($tally);
		}
	}

}
