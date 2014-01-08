<?php

class LadderController extends BaseController {

	protected $layout = "master";
	protected $title = "Ladder";

	public function showLadder($user_id){
		$this->layout->title = $this->title;

		$contentData = array(
			"heading" => $this->title,
			"matchtypes" => Matchtype::getAllActiveMatchtypes()->get(),
			);

		$this->layout->nest("content", 'ladder.index', $contentData);

	}

	public function getLadderData(){
		if(Auth::check()){
			if (Request::ajax()){
				$matchtype_id = Input::get("matchtype_id");
				$user_id = Input::get("user_id");
				$matchmode_id = Input::get("matchmode_id");

				$aColumns = array (
					'#',
					'Leaguename',
					'Rank',
					'name',
					'PointsEarned',
					'Wins',
					'Loses',
					'WinRate',
					'Leaves'
					);

		/*
		 * Paging
		*/
		$sLimit = "";
		if (isset ( $_GET ['iDisplayStart'] ) && $_GET ['iDisplayLength'] != '-1') {
			$sLimit = "LIMIT " . intval ( $_GET ['iDisplayStart'] ) . ", " . intval ( $_GET ['iDisplayLength'] );
		}

		$sWhere = "";
		if (isset ( $_GET ['sSearch'] ) && $_GET ['sSearch'] != "") {

			$sWhere = "WHERE (";

				$sWhere .= "u.name LIKE '%".mysql_real_escape_string ($_GET['sSearch'])."%' OR u.id LIKE '%".mysql_real_escape_string ($_GET['sSearch'])."%'";
				$sWhere .= ')';
}


$whereMatchMode = "";
if ($matchmode_id > 0) {
	$whereMatchMode = " AND matchmode_id = " . ( int ) $matchmode_id . " OR matchmode_id = 0)";
}

$whereMatchType = "";
$whereMatchType = " AND matchtype_id = " . ( int ) $matchtype_id . "";
$joinUSBMatchType = " AND usb.matchtype_id = ".(int)$matchtype_id."";
$joinUPMatchType = " AND up.matchtype_id = ".(int)$matchtype_id."";


$sqlWins = "SELECT COUNT(*)
FROM `userpoints`
WHERE user_id = u.id AND pointtype_id = 1
" . $whereMatchMode . "
" . $whereMatchType . "
";
$sqlLosses = "SELECT COUNT(*)
FROM `userpoints`
WHERE user_id = u.id AND pointtype_id = 2
" . $whereMatchMode . "
" . $whereMatchType . "
";
$sqlLeaves = "SELECT COUNT(*)
FROM `userpoints`
WHERE user_id = u.id AND pointtype_id = 5
" . $whereMatchMode . "
" . $whereMatchType . "
";
$sqlCredits = "
SELECT SUM(Vote) as Credits
FROM `usercredits`
WHERE user_id = u.id
";
$sqlWinRate = "
IF((" . $sqlWins . ")+(" . $sqlLosses . ") > 0,
	ROUND(((" . $sqlWins . ")/((" . $sqlWins . ")+(" . $sqlLosses . ")))*100,2)
	,0)
";
$sqlPoints = "
SELECT SUM(pointschange)
FROM `userpoints`
WHERE user_id = u.id ".$whereMatchType."
";

$sQuery = "SELECT u.name, u.avatar, u.id,
sbt.name as SkillBracketname, usb.skillbrackettype_id,
(" . $sqlWins . ") as Wins,
(" . $sqlLosses . ") as Loses,
(" . $sqlLeaves . ") as Leaves,
(" . $sqlCredits . ") as Credits,
" . $sqlWinRate . " as WinRate,
(".$sqlPoints.") as PointsEarned, u.basePoints

FROM users u
LEFT JOIN userskillbrackets usb ON u.id = usb.user_id ".$joinUSBMatchType."
LEFT JOIN skillbrackettypes sbt ON sbt.id = usb.skillbrackettype_id
" . $whereMatchMode . "
" . $whereMatchType . "
" . $sWhere . "

GROUP BY u.id
HAVING PointsEarned+u.basePoints > 0
ORDER BY usb.skillbrackettype_id DESC, PointsEarned DESC, Wins DESC

";
// die($sQuery);
$rResult = DB::select(DB::raw($sQuery.$sLimit));
$rResultWithoutLimit = DB::select(DB::raw($sQuery));
		//p($sQuery);
/* Data set length after filtering */
$sQuery2 = "
SELECT FOUND_ROWS() as count
";
$rResultFilterTotal =  DB::select(DB::raw($sQuery2));
$iFilteredTotal = (String)$rResultFilterTotal [0]->count;
$iTotal = (String) count($rResultWithoutLimit);

		/*
		 * Output
		*/
		$output = array (
			"sEcho" => intval ( $_GET ['sEcho'] ),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iTotal,
			"aaData" => array (),
			"debug" => $sQuery,
			);
		$j = $_GET['iDisplayStart']+1;
		foreach ($rResult as $key => $aRow) {
			$row = array();
			for($i = 0; $i < count ( $aColumns ); $i ++) {
				if ($aColumns [$i] == "#") {
					$row [] = "<strong>".$j.".<strong>";
				}
				elseif ($aColumns [$i] == "Leaguename"){
					$html = View::make('icons/skillbracket')->with("skillbracket", $aRow->SkillBracketname)->with("skillbracket_id", $aRow->skillbrackettype_id)->render();
					$row [] = $html;
				}
				elseif ($aColumns [$i] == "Rank"){
					$row [] = "<strong>".($aRow->PointsEarned+$aRow->basePoints)."</strong>";
				}

				elseif ($aColumns [$i] == "name"){
					if($aRow->id == $user_id){
						$row["DT_RowClass"] ="success";
					}
					$row [] = '<a href="'.URL::to('profile/'.$aRow->id).'"><img src="'.$aRow->avatar.'" alt="'.$aRow->name.'\'s Avatar"> '.$aRow->name.'</a>';
				}
				elseif ($aColumns [$i] == "Wins"){
					$row [] = "<span class='text-success'>".$aRow->Wins."</span>";
				}
				elseif ($aColumns [$i] == "Loses"){
					$row [] = "<span class='text-danger'>".$aRow->Loses."</span>";
				}
				elseif ($aColumns [$i] == "WinRate"){
					$row [] = "<span class='text-warning'>".$aRow->WinRate."%</span>";
				}
				else{
					/* General output */
					$row [] = $aRow->$aColumns [$i];
				}
			}
			$output ['aaData'] [] = $row;
			$j++;
		}

		return $output;


	}
}
}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('ladders.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ladders.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('ladders.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('ladders.edit');
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

}
