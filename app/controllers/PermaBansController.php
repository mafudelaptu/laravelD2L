<?php

class PermaBansController extends BaseController {

	/**
	 * PermaBan Repository
	 *
	 * @var PermaBan
	 */
	protected $permaBan;

	public function __construct(PermaBan $permaBan)
	{
		$this->permaBan = $permaBan;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$permaBans = $this->permaBan->all();

		return View::make('permaBans.index', compact('permaBans'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('permaBans.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, PermaBan::$rules);

		if ($validation->passes())
		{
			$this->permaBan->create($input);

			return Redirect::route('permaBans.index');
		}

		return Redirect::route('permaBans.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$permaBan = $this->permaBan->findOrFail($id);

		return View::make('permaBans.show', compact('permaBan'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$permaBan = $this->permaBan->find($id);

		if (is_null($permaBan))
		{
			return Redirect::route('permaBans.index');
		}

		return View::make('permaBans.edit', compact('permaBan'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, PermaBan::$rules);

		if ($validation->passes())
		{
			$permaBan = $this->permaBan->find($id);
			$permaBan->update($input);

			return Redirect::route('permaBans.show', $id);
		}

		return Redirect::route('permaBans.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->permaBan->find($id)->delete();

		return Redirect::route('permaBans.index');
	}

}
