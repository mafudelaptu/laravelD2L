<?php

class CronjobMatchmakingController extends BaseController {

	public function doMatchmaking(){
// 		//error_reporting(E_ALL);
// p(DEBUG);
// var_dump(strpos(dirname(__FILE__), ":\\"));
// $DB = new DB();
// $con = $DB->conDB();

// $ourFileName = dirname(__FILE__)."/../klogs/matchmaking/log_".date("Y-m-d").".txt";
// p($ourFileName);
// $ourFileHandle = fopen($ourFileName, 'a') or die("can't open file");
// fclose($ourFileHandle);

// $log = new KLogger ( $ourFileName , KLogger::INFO );
// //$log->LogInfo("Player already in MatchTeams:".$steamID." MatchID raussuchen...");        //Prints to the log file

// /*
//  * Check if someone left site without leaving the Queue
// */
// $timePossible = time()-30; // 2 min
// $sql = "SELECT SteamID, CheckTimestamp
//                 FROM `Queue`
//                 WHERE CheckTimestamp < ".$timePossible."
//                 GROUP BY SteamID
//                 ";
// $data = $DB->multiSelect($sql);

// if(is_array($data) && count($data) > 0){
//         foreach($data as $k =>$v){
//                 $steamID = $v['SteamID'];
//                 $checkTimestamp = $v['CheckTimestamp'];

//                 $sql = "DELETE FROM `Queue`
//                 WHERE SteamID = ".secureNumber($steamID)."
//                 ";
                
//                 if(strpos(dirname(__FILE__), ":\\") === false AND strpos(dirname(__FILE__), "/dctest/") === false){
//                         p($sql);
//                         p("KICKED!");
//                         $retDel = $DB->delete($sql);
//                         $log->LogInfo("Player: ".$steamID." Kicked from Queue. His Timestamp:".$checkTimestamp." looked up Timestamp:".$timePossible);        //Prints to the log file
//                 }
//         }
// }

// $timePossible = time()-30; // 2 min
// $sql = "SELECT GroupID
//                 FROM `QueueGroupMembers`
//                 WHERE CheckTimestamp < ".$timePossible."
//                                 ";
// $data = $DB->multiSelect($sql);

// if(is_array($data) && count($data) > 0){
//         foreach($data as $k =>$v){
//                 $groupID = $v['GroupID'];
//                 $steamID = $v['SteamID'];
//                 $checkTimestamp = $v['CheckTimestamp'];

//                 $sql = "DELETE FROM `QueueGroup`
//                                 WHERE GroupID = ".(int) $groupID."
//                                 ";
//                 p($sql);
//                 $retDel = $DB->delete($sql);
//                 $sql = "DELETE FROM `QueueGroupMembers`
//                                         WHERE GroupID = ".(int) $groupID."
//                                 ";
//                 p($sql);
//                 $retDel = $DB->delete($sql);
//                 $log->LogInfo("Group kicked (".$groupID.")! Player: ".$steamID." Kicked from QueueGroupMembers. His Timestamp:".$checkTimestamp." looked up Timestamp:".$timePossible);        //Prints to the log file
//         }
// }

// /*
//  * MATCHMAKING
// */

// // Zeit auslesen und gucken ob es ungef�hr zur vollen stunde ist
// $minuten = date("i");
// p("Minuten:".$minuten);
// p("MATCHMAKING-TIMING:".MATCHMAKINGTIMING);
// // wenn volle Stunde, dann mach matchmaking so oft wie geht, bis alle zugeteilt wurden

// // alle vorhandenen MatchTypes auslesen
// $sql = "SELECT DISTINCT MatchTypeID
//                                 FROM Queue
//                                 ";
// $data = $DB->multiSelect($sql);
// $matchTypes = array();
// if(is_array($data) && count($data)>0){

//         foreach($data as $k => $v){
//                 $matchTypes[] = $v['MatchTypeID'];
//         }
//         shuffle($matchTypes);
// }

// // alle vorhandenen Matchmodes auslesen
// $sql = "SELECT DISTINCT MatchModeID
//                                 FROM Queue
//                                 ";
// $data = $DB->multiSelect($sql);
// $matchModes = array();
// if(is_array($data) && count($data)>0){

//         foreach($data as $k => $v){
//                 $matchModes[] = $v['MatchModeID'];
//         }
//         shuffle($matchModes);
// }

// // alle vorhandenen Regions auslesen
// $sql = "SELECT DISTINCT Region
//                 FROM Queue
//                 ";
// $data = $DB->multiSelect($sql);
// $regions = array();
// if(is_array($data) && count($data)>0){

//         foreach($data as $k => $v){
//                 $regions[] = $v['Region'];
//         }
//         shuffle($regions);
// }

// // Jeden Spieler ausw�hlen und Elo auslesen
// $sql = "SELECT DISTINCT Elo, MatchTypeID, MatchModeID
//                         FROM Queue
//                         ";
// $data = $DB->multiSelect($sql);
// $playerData = array();
// if(is_array($data) && count($data)>0){

//         foreach($data as $k => $v){
//                 $playerData[$v['MatchTypeID']][$v['MatchModeID']] = $v['Elo'];
//         }
// }
// unset($data);
// p($matchTypes);
// p($matchModes);
// p($regions);
// p($playerData);

// //for($delta =0; $delta<= 200; $delta=$delta+10){
// if(is_array($matchTypes) && count($matchTypes)>0){
//         foreach($matchTypes as $k => $matchType){
//                 if(is_array($matchModes) && count($matchModes)>0){
//                         foreach($matchModes as $k => $modus){

//                                 $elo = $playerData[$matchType][$modus];

//                                 // Elo range bestimmen
//                                 $untere_grenze = $elo - $delta;
//                                 $obere_grenze = $elo + $delta;

//                                 if(is_array($regions) && count($regions)>0){

//                                         foreach($regions as $k => $region){

//                                                 switch($matchType){
//                                                         case "8":
//                                                                 // 1vs1 Queue
//                                                                 p("UG:".$untere_grenze." OG:".$obere_grenze." MT:".$matchType." MM:".$modus." R:".$region." DELTA:".$delta);
//                                                                 $count = 0;
//                                                                 $data2 = array();
//                                                                 $data = array();
//                                                                 $nochWelcheInQueue = true;
//                                                                 while($nochWelcheInQueue){
//                                                                         $found = array();
//                                                                         if(POINTSMATCHMAKING){
// //                                                                                 $sql = "SELECT DISTINCT SteamID, Elo, MatchModeID, Region, MatchTypeID
// //                                 FROM Queue
// //                                 WHERE (((Elo >= ".(int)$untere_grenze." AND Elo <= ".(int)$obere_grenze.")
// //                                                 AND Region = ".(int)$region." ))
// //                                                 AND MatchModeID = ".(int) $modus."
// //                                                 AND MatchTypeID = ".(int)$matchType."
// //                                                         ORDER BY Timestamp ASC
// //                                                         LIMIT 10
// //                                                         ";
//                                                                         }
//                                                                         else{
//                                                                                 //                                                                                         $sql = "SELECT DISTINCT SteamID, Elo, MatchModeID, Region, MatchTypeID, Timestamp
//                                                                                 //                                                                                         FROM Queue
//                                                                                 //                                                                                         WHERE  Region = ".(int)$region."
//                                                                                 //                                                                                         AND MatchModeID = ".(int) $modus."
//                                                                                 //                                                                                         AND MatchTypeID = ".(int)$matchType."
//                                                                                 //                                                                                         ORDER BY Timestamp ASC
//                                                                                 //                                                                                         LIMIT 2
//                                                                                 //                                                                                         ";
//                                                                                 for($z=0; $z<2; $z++){

//                                                                                         for($i=0; $i<3; $i++){
//                                                                                                         $retCount = getCountInQueueSkillBracket1vs1($z, $i, $region, $modus, $matchType);
//                                                                                                         p($retCount);
//                                                                                                         $data = $retCount['data'];
//                                                                                                         $count = $retCount['count'];
//                                                                                                         p("COUNT: ".$count);
//                                                                                                         if($count == 2){
//                                                                                                                 $found[] = true;
//                                                                                                                 $log->LogInfo("2 gefunden!");        //Prints to the log file
//                                                                                                                 $log->LogInfo("SQL:".$sql);        //Prints to the log file
//                                                                                                                 p("gefunden!");
//                                                                                                                 p("data:".print_r($data,1));
//                                                                                                                 $ret['debug'] .= "#########++++++++++++++++######## TEST recusive Suche nach MIR: ID1:".p($inData,1);
//                                                                                                                 $foundArray = $data;
//                                                                                                                 $log->LogInfo("Array:".p($foundArray,1));        //Prints to the log file
//                                                                                                                 // hier dann stuff machen
//                                                                                                                 $Queue = new Queue();
//                                                                                                                 $retKick = $Queue->kickPlayersOutOfQueueIf10PlayersFound2($foundArray);
//                                                                                                                 p("alle aus Queue gekicked");
//                                                                                                                 //p($retKick);
//                                                                                                                 // die 2 gefundenen spieler in MatchTeams eintragen
//                                                                                                                 $MatchTeams = new MatchTeams();
//                                                                                                                 $retHandleFound = $MatchTeams->insertPlayersIntoMatchTeamsAfterFoundMatchmaking2($foundArray);
//                                                                                                                 p($retHandleFound);
                                                                                                        
//                                                                                                                 // und am ende schleife abbrechen
//                                                                                                                 //exit();
//                                                                                                         }
//                                                                                                         else{
//                                                                                                                 $found[] = false;
//                                                                                                         }
//                                                                                         }
//                                                                                 }
                                                                                
//                                                                                 if(in_array(true, $found, true)){
//                                                                                         $nochWelcheInQueue = true;
//                                                                                 }
//                                                                                 else{
//                                                                                         $nochWelcheInQueue = false;
//                                                                                 }
                                                                                        
//                                                                         }
//                                                                 }
//                                                                 break;
//                                                         case "9":
//                                                                 //$minuten = "00";
//                                                                 if($minuten == "00" OR $minuten == "01" OR $minuten == "02" OR $minuten == "03" OR $minuten == "04" OR $minuten == "05" OR !MATCHMAKINGTIMING){
//                                                                         // 3vs3 Queue
//                                                                         p("UG:".$untere_grenze." OG:".$obere_grenze." MT:".$matchType." MM:".$modus." R:".$region." DELTA:".$delta);
//                                                                         $count = 0;
//                                                                         $data2 = array();
//                                                                         $nochWelcheInQueue = true;
//                                                                         while($nochWelcheInQueue){

//                                                                                 if(POINTSMATCHMAKING){
//                                                                                         $sql = "SELECT DISTINCT SteamID, Elo, MatchModeID, Region, MatchTypeID, Timestamp
//                                                                                                 FROM Queue
//                                                                                                 WHERE (((Elo >= ".(int)$untere_grenze." AND Elo <= ".(int)$obere_grenze.")
//                                                                                 AND Region = ".(int)$region." ))
//                                                                                 AND MatchModeID = ".(int) $modus."
//                                                                                 AND MatchTypeID = ".(int)$matchType."
//                                                                                 ORDER BY Timestamp ASC
//                                                                                 LIMIT 10
//                                                                                 ";
//                                                                                 }
//                                                                                 else{
//                                                                                         $sql = "SELECT DISTINCT SteamID, Elo, MatchModeID, Region, MatchTypeID, Timestamp
//                                                                                         FROM Queue
//                                                                                         WHERE  Region = ".(int)$region."
//                                                                                         AND MatchModeID = ".(int) $modus."
//                                                                                                 AND MatchTypeID = ".(int)$matchType."
//                                                                                                         ORDER BY Timestamp ASC
//                                                                                                         LIMIT 6
//                                                                                                         ";
//                                                                                 }

//                                                                                 $data = $DB->multiSelect($sql);
//                                                                                 $ret['debug'] .= p($sql,1);

//                                                                                 $count = count($data);
//                                                                                 p("COUNT: ".$count);

//                                                                                 if($count == 6){
//                                                                                         $log->LogInfo("6 gefunden!");        //Prints to the log file
//                                                                                         $log->LogInfo("SQL:".$sql);        //Prints to the log file
//                                                                                         p("gefunden!");
//                                                                                         p("data:".print_r($data,1));
//                                                                                         $ret['debug'] .= "#########++++++++++++++++######## TEST recusive Suche nach MIR: ID1:".p($inData,1);
//                                                                                         $foundArray = $data;
//                                                                                         $log->LogInfo("Array:".p($foundArray,1));        //Prints to the log file
//                                                                                         // hier dann stuff machen
//                                                                                         $Queue = new Queue();
//                                                                                         $retKick = $Queue->kickPlayersOutOfQueueIf10PlayersFound2($foundArray);
//                                                                                         p("alle aus Queue gekicked");
//                                                                                         //p($retKick);
//                                                                                         // die 2 gefundenen spieler in MatchTeams eintragen
//                                                                                         $MatchTeams = new MatchTeams();
//                                                                                         $retHandleFound = $MatchTeams->insertPlayersIntoMatchTeamsAfterFoundMatchmaking2($foundArray);
//                                                                                         p($retHandleFound);

//                                                                                         // und am ende schleife abbrechen
//                                                                                         //exit();
//                                                                                 }
//                                                                                 else{
//                                                                                         $nochWelcheInQueue = false;
//                                                                                 }
//                                                                         }
//                                                                 }
//                                                                 break;
//                                                         default:
//                                                                 //$minuten = "00";
//                                                                 if($minuten == "00" OR $minuten == "01" OR $minuten == "02" OR $minuten == "03" OR $minuten == "04" OR $minuten == "05" OR !MATCHMAKINGTIMING){
//                                                                         p("UG:".$untere_grenze." OG:".$obere_grenze." MT:".$matchType." MM:".$modus." R:".$region." DELTA:".$delta);
//                                                                         $count = 0;
//                                                                         $data2 = array();
//                                                                         $data = array();
//                                                                         $nochWelcheInQueue = true;
//                                                                         while($nochWelcheInQueue){
//                                                                                 if(POINTSMATCHMAKING){
//                                                                                         $sql = "SELECT DISTINCT SteamID, Elo, MatchModeID, Region, MatchTypeID, Timestamp
//                                                                                                         FROM Queue
//                                                                                                         WHERE (((Elo >= ".(int)$untere_grenze." AND Elo <= ".(int)$obere_grenze.")
//                                                                                 AND Region = ".(int)$region." ))
//                                                                                 AND MatchModeID = ".(int) $modus."
//                                                                                 AND MatchTypeID = ".(int)$matchType."
//                                                                                 ORDER BY Timestamp ASC
//                                                                                 LIMIT 10
//                                                                                 ";
//                                                                                         switch($count){
//                                                                                                 case 0:
//                                                                                                         $limit = 8;
//                                                                                                         break;
//                                                                                                 case 1:
//                                                                                                         $limit = 8;
//                                                                                                         break;
//                                                                                                 case 2:
//                                                                                                         $limit = 8;
//                                                                                                         break;
//                                                                                                 case 3:
//                                                                                                         $limit = 6;
//                                                                                                         break;
//                                                                                                 case 4:
//                                                                                                         $limit = 6;
//                                                                                                         break;
//                                                                                                 case 5:
//                                                                                                         $limit = 4;
//                                                                                                         break;
//                                                                                                 case 6:
//                                                                                                         $limit = 4;
//                                                                                                         break;
//                                                                                                 case 7:
//                                                                                                         $limit = 2;
//                                                                                                         break;
//                                                                                                 case 8:
//                                                                                                         $limit = 2;
//                                                                                                         break;
//                                                                                                 case 9:
//                                                                                                         $limit = 0;
//                                                                                                         break;
//                                                                                                 case 10:
//                                                                                                         $limit = 0;
//                                                                                                         break;
//                                                                                         }
//                                                                                         $data2 = array();
//                                                                                         if($limit > 0 && $matchType != 8 && $matchType != 9){
//                                                                                                 if(POINTSMATCHMAKING){
//                                                                                                         // Nach Gruppen suchen
//                                                                                                         $sql2 = "SELECT DISTINCT SteamID, Elo, qg.MatchModeID, Region, qg.MatchTypeID, qg.GroupID
//                                                                                                                 FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                                                                                                 ON qg.GroupID = qgm.GroupID AND
//                                                                                                                 qg.MatchTypeID = qgm.MatchTypeID AND
//                                                                                                                 qg.MatchModeID = qgm.MatchModeID
//                                                                                                                 WHERE (((Elo >= ".(int)$untere_grenze." AND Elo <= ".(int)$obere_grenze.")
//                                                                                                                         AND Region = ".(int)$region."))
//                                                                                                                         AND qg.MatchModeID =  ".(int) $modus."
//                                                                                                         AND qg.MatchTypeID = ".(int) $matchType."
//                                                                                                         ORDER BY Timestamp ASC
//                                                                                                         LIMIT ".$limit."
//                                                                                                                 ";
//                                                                                                 }
//                                                                                                 else{
//                                                                                                         $sql2 = "SELECT DISTINCT SteamID, Elo, qg.MatchModeID, Region, qg.MatchTypeID, qg.GroupID, Timestamp
//                                                                                                                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                                                                                                         ON qg.GroupID = qgm.GroupID AND
//                                                                                                                         qg.MatchTypeID = qgm.MatchTypeID AND
//                                                                                                                         qg.MatchModeID = qgm.MatchModeID
//                                                                                                                         WHERE Region = ".(int)$region."
//                                                                                                                                 AND qg.MatchModeID =  ".(int) $modus."
//                                                                                                                                         AND qg.MatchTypeID = ".(int) $matchType."
//                                                                                                                                         ORDER BY Timestamp ASC
//                                                                                                                                         LIMIT ".$limit."
//                                                                                                                         ";
//                                                                                                 }

//                                                                                                 $ret['debug'] .= p($sql2,1);
//                                                                                                 $data2 = $DB->multiSelect($sql2);
//                                                                                                 p("C1:".$count." C2:".count($data2)." limit:".$limit);
//                                                                                                 $count = $count + count($data2);
//                                                                                         }
//                                                                                         if($count == 10){
//                                                                                                 $log->LogInfo("10 gefunden!");        //Prints to the log file
//                                                                                                 $log->LogInfo("SQL:".$sql." SQL2:".$sql2);        //Prints to the log file
//                                                                                                 p("gefunden!");
//                                                                                                 p("data:".print_r($data,1));
//                                                                                                 p("data2:".print_r($data2,1));
//                                                                                                 $ret['debug'] .= "#########++++++++++++++++######## TEST recusive Suche nach MIR: ID1:".p($inData,1)." ID2:".p($inData2,1);

//                                                                                                 $foundArray =  array_merge($data, $data2);
//                                                                                                 $log->LogInfo("Array:".p($foundArray,1));        //Prints to the log file
//                                                                                                 // hier dann stuff machen
//                                                                                                 $Queue = new Queue();
//                                                                                                 $retKick = $Queue->kickPlayersOutOfQueueIf10PlayersFound2($foundArray);

//                                                                                                 p("alle aus Queue gekicked");
//                                                                                                 //p($retKick);
//                                                                                                 // die 10 gefundenen spieler in MatchTeams eintragen
//                                                                                                 $MatchTeams = new MatchTeams();
//                                                                                                 $retHandleFound = $MatchTeams->insertPlayersIntoMatchTeamsAfterFoundMatchmaking2($foundArray);
//                                                                                                 p($retHandleFound);
//                                                                                                 $log->LogInfo(p("insertPlayersIntoMatchTeamsAfterFoundMatchmaking2",1));        //Prints to the log file
//                                                                                                 $log->LogInfo(p($retHandleFound,1));        //Prints to the log file
//                                                                                                 // und am ende schleife abbrechen
//                                                                                                 //exit();
//                                                                                         }
//                                                                                         else{
//                                                                                                 $nochWelcheInQueue = false;
//                                                                                         }
//                                                                                 }
//                                                                                 else{
//                                                                                         //                                                                                                                                                                                         $sql = "SELECT DISTINCT SteamID, Elo, MatchModeID, Region, MatchTypeID, Timestamp
//                                                                                         //                                                                                                                                                                                                         FROM Queue
//                                                                                         //                                                                                                                                                                                                         WHERE  Region = ".(int)$region."
//                                                                                         //                                                                                                                                                                                                         AND MatchModeID = ".(int) $modus."
//                                                                                         //                                                                                                                                                                                                         AND MatchTypeID = ".(int)$matchType."
//                                                                                         //                                                                                                                                                                                                         ORDER BY Timestamp ASC
//                                                                                         //                                                                                                                                                                                                         LIMIT 10
//                                                                                         //                                                 ";
//                                                                                         for($z=0; $z<2; $z++){

//                                                                                                 for($i=0; $i<3; $i++){
//                                                                                                         $retQueueCount = getCountInQueueSkillBracket($z, $i, $region, $modus, $matchType);
//                                                                                                         $count = $retQueueCount['count'];
//                                                                                                         $data = $retQueueCount['data'];
//                                                                                                         $data2 = $retQueueCount['data2'];
//                                                                                                         if($count == 10){
//                                                                                                                 $log->LogInfo("10 gefunden!");        //Prints to the log file
//                                                                                                                 $log->LogInfo("SQL:".$sql." SQL2:".$sql2);        //Prints to the log file
//                                                                                                                 p("gefunden!");
//                                                                                                                 p("data:".print_r($data,1));
//                                                                                                                 p("data2:".print_r($data2,1));
//                                                                                                                 $ret['debug'] .= "#########++++++++++++++++######## TEST recusive Suche nach MIR: ID1:".p($inData,1)." ID2:".p($inData2,1);

//                                                                                                                 $foundArray =  array_merge($data, $data2);
//                                                                                                                 $log->LogInfo("Array:".p($foundArray,1));        //Prints to the log file
//                                                                                                                 // hier dann stuff machen
//                                                                                                                 $Queue = new Queue();
//                                                                                                                 $retKick = $Queue->kickPlayersOutOfQueueIf10PlayersFound2($foundArray);

//                                                                                                                 p("alle aus Queue gekicked");
//                                                                                                                 //p($retKick);
//                                                                                                                 // die 10 gefundenen spieler in MatchTeams eintragen
//                                                                                                                 $MatchTeams = new MatchTeams();
//                                                                                                                 $retHandleFound = $MatchTeams->insertPlayersIntoMatchTeamsAfterFoundMatchmaking2($foundArray);
//                                                                                                                 p($retHandleFound);
//                                                                                                                 $log->LogInfo(p("insertPlayersIntoMatchTeamsAfterFoundMatchmaking2",1));        //Prints to the log file
//                                                                                                                 $log->LogInfo(p($retHandleFound,1));        //Prints to the log file
//                                                                                                                 // und am ende schleife abbrechen
//                                                                                                                 //exit();
//                                                                                                         }
//                                                                                                         else{
//                                                                                                                 $nochWelcheInQueue = false;
//                                                                                                         }
//                                                                                                 }
//                                                                                         }


//                                                                                 }
//                                                                         }
//                                                                 }
//                                                 }
//                                         }
//                                 }
//                         }
//                 }
//         }
// }
// //}


// // QueueLock clearen
// p("QueueLock clearen");
// $sql = "DELETE FROM `QueueLock` WHERE Timestamp <= ".time()."
//                                                                                                                                 ";
// $data = $DB->delete($sql);
// p($sql);
// p(mysql_affected_rows());

// p("QueueLock clearen END");

// function getCountInQueue($z, $i, $force, $forceSearch, $region, $modus, $matchType){

//         $DB = new DB();
//         $con = $DB->conDB();

//         if($z==1){
//                 $force = true;
//                 $forceSearch = " AND q.ForceSearch = 1";
//                 $forceSearchGroup = " AND qg.ForceSearch = 1";
//         }
//         else{
//                 $force = false;
//                 $forceSearch = " AND q.ForceSearch = 0";
//                 $forceSearchGroup = " AND qg.ForceSearch = 0";
//         }

//         if(!$force){
//                 if($i==1){
//                         $leagueModifier = "AND ul.LeagueTypeID < 3";
//                 }
//                 else{
//                         $leagueModifier = "AND ul.LeagueTypeID >= 3";
//                 }
//         }
//         else{
//                 $leagueModifier = "";
//         }

//         $sql = "SELECT DISTINCT q.SteamID, Elo, MatchModeID, Region, MatchTypeID, Timestamp
//                                                                                                                                                 FROM Queue q LEFT JOIN UserLeague ul ON q.SteamID = ul.SteamID
//                                                                                                                                                 WHERE  Region = ".(int)$region."
//                         AND MatchModeID = ".(int) $modus."
//                                 AND MatchTypeID = ".(int)$matchType."
//                                 ".$leagueModifier."
//                                 ".$forceSearch."
//                                 ORDER BY Timestamp ASC
//                                 LIMIT 10
//                                 ";
//         $data = $DB->multiSelect($sql);

//         $ret['debug'] .= p($sql,1);
//         //p($sql);
//         $count = count($data);
//         p("COUNT: ".$count);
//         $limit = 0;
//         switch($count){
//                 case 0:
//                         $limit = 8;
//                         break;
//                 case 1:
//                         $limit = 8;
//                         break;
//                 case 2:
//                         $limit = 8;
//                         break;
//                 case 3:
//                         $limit = 6;
//                         break;
//                 case 4:
//                         $limit = 6;
//                         break;
//                 case 5:
//                         $limit = 4;
//                         break;
//                 case 6:
//                         $limit = 4;
//                         break;
//                 case 7:
//                         $limit = 2;
//                         break;
//                 case 8:
//                         $limit = 2;
//                         break;
//                 case 9:
//                         $limit = 0;
//                         break;
//                 case 10:
//                         $limit = 0;
//                         break;
//         }
//         $data2 = array();
//         if($limit > 0 && $matchType != 8 && $matchType != 9){
//                 if(POINTSMATCHMAKING){
//                         // Nach Gruppen suchen
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, Elo, qg.MatchModeID, Region, qg.MatchTypeID, qg.GroupID
//                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                         ON qg.GroupID = qgm.GroupID AND
//                         qg.MatchTypeID = qgm.MatchTypeID AND
//                         qg.MatchModeID = qgm.MatchModeID
//                         LEFT JOIN UserLeague ul ON qgm.SteamID = ul.SteamID
//                         WHERE (((Elo >= ".(int)$untere_grenze." AND Elo <= ".(int)$obere_grenze.")
//                                 AND Region = ".(int)$region."))
//                                 AND qg.MatchModeID =  ".(int) $modus."
//                                 AND qg.MatchTypeID = ".(int) $matchType."
//                                         ".$forceSearchGroup."
//                         ".$leagueModifier."
//                         ORDER BY Timestamp ASC
//                         LIMIT ".$limit."
//                         ";
//                 }
//                 else{
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, Elo, qg.MatchModeID, Region, qg.MatchTypeID, qg.GroupID, Timestamp
//                                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                         ON qg.GroupID = qgm.GroupID AND
//                                         qg.MatchTypeID = qgm.MatchTypeID AND
//                                         qg.MatchModeID = qgm.MatchModeID
//                                         LEFT JOIN UserLeague ul ON qgm.SteamID = ul.SteamID
//                                         WHERE Region = ".(int)$region."
//                                         AND qg.MatchModeID =  ".(int) $modus."
//                                         AND qg.MatchTypeID = ".(int) $matchType."
//                                                 ".$forceSearchGroup."
//                                                 ".$leagueModifier."
//                                                 ORDER BY Timestamp ASC
//                                                 LIMIT ".$limit."
//                                                         ";
//                 }

//                 $ret['debug'] .= p($sql2,1);
//                 $data2 = $DB->multiSelect($sql2);
//                 p("C1:".$count." C2:".count($data2)." limit:".$limit);
//                 $count = $count + count($data2);
//         }

//         // nochmal andersrum checken
//         // zuerst teams, dann single
//         if($count != 10){
//                 if(POINTSMATCHMAKING){
//                         // Nach Gruppen suchen
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, Elo, qg.MatchModeID, Region, qg.MatchTypeID, qg.GroupID
//                                                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                                         ON qg.GroupID = qgm.GroupID AND
//                                                         qg.MatchTypeID = qgm.MatchTypeID AND
//                                                         qg.MatchModeID = qgm.MatchModeID
//                                                         LEFT JOIN UserLeague ul ON qgm.SteamID = ul.SteamID
//                                                         WHERE (((Elo >= ".(int)$untere_grenze." AND Elo <= ".(int)$obere_grenze.")
//                                 AND Region = ".(int)$region."))
//                                 AND qg.MatchModeID =  ".(int) $modus."
//                                 AND qg.MatchTypeID = ".(int) $matchType."
//                                 ".$forceSearchGroup."
//                         ".$leagueModifier."
//                         ORDER BY Timestamp ASC
//                         LIMIT 8
//                         ";
//                 }
//                 else{
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, Elo, qg.MatchModeID, Region, qg.MatchTypeID, qg.GroupID, Timestamp
//                                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                         ON qg.GroupID = qgm.GroupID AND
//                                         qg.MatchTypeID = qgm.MatchTypeID AND
//                                         qg.MatchModeID = qgm.MatchModeID
//                                         LEFT JOIN UserLeague ul ON qgm.SteamID = ul.SteamID
//                                         WHERE Region = ".(int)$region."
//                                                                         AND qg.MatchModeID =  ".(int) $modus."
//                                                                         AND qg.MatchTypeID = ".(int) $matchType."
//                                                 ".$forceSearchGroup."
//                                                 ".$leagueModifier."
//                                                 ORDER BY Timestamp ASC
//                                                 LIMIT 8
//                                                 ";
//                 }

//                 $ret['debug'] .= p($sql2,1);
//                 $data2 = $DB->multiSelect($sql2);
//                 p("C1:".$count." C2:".count($data2)." limit:".$limit);
//                 $count = count($data2);

//                 switch($count){
//                         case 0:
//                                 $limit = 10;
//                                 break;
//                         case 2:
//                                 $limit = 8;
//                                 break;
//                         case 4:
//                                 $limit = 6;
//                                 break;
//                         case 6:
//                                 $limit = 4;
//                                 break;
//                         case 8:
//                                 $limit = 2;
//                                 break;
//                         default:
//                                 $limit = 0;
//                 }
//                 if($limit > 0 && $matchType != 8 && $matchType != 9){
//                         $sql = "SELECT DISTINCT q.SteamID, Elo, MatchModeID, Region, MatchTypeID, Timestamp
//                                                                                         FROM Queue q LEFT JOIN UserLeague ul ON q.SteamID = ul.SteamID
//                                                                                         WHERE  Region = ".(int)$region."
//                 AND MatchModeID = ".(int) $modus."
//                                 AND MatchTypeID = ".(int)$matchType."
//                                 ".$leagueModifier."
//                                 ".$forceSearch."
//                                 ORDER BY Timestamp ASC
//                                 LIMIT ".$limit."
//                                         ";
//                         $data = $DB->multiSelect($sql);

//                         $ret['debug'] .= p($sql,1);
//                         //p($sql);
//                         $count = $count + count($data);
//                 }
//         }

//         $ret['count'] = $count;
//         $ret['data'] = $data;
//         $ret['data2'] = $data2;


//         return $ret;
// }

// function getCountInQueueSkillBracket($z, $i, $region, $modus, $matchType){

//         $DB = new DB();
//         $con = $DB->conDB();

//         if($z==1){
//                 $force = true;
//                 $forceSearch = " AND q.ForceSearch = 1";
//                 $forceSearchGroup = " AND qg.ForceSearch = 1";
//         }
//         else{
//                 $force = false;
//                 $forceSearch = " AND q.ForceSearch = 0";
//                 $forceSearchGroup = " AND qg.ForceSearch = 0";
//         }

//         if(!$force){
//                 switch($i){
//                         case 0:
//                                 $leagueModifier = "AND usb.SkillBracketTypeID >= 3";
//                                 break;
//                         case 1:
//                                 $leagueModifier = "AND usb.SkillBracketTypeID = 2";
//                                 break;
//                         case 2:
//                                 $leagueModifier = "AND usb.SkillBracketTypeID = 1";
//                                 break;

//                 }
//         }
//         else{
//                 $leagueModifier = "";
//         }

//         $sql = "SELECT DISTINCT q.SteamID, q.Elo, q.MatchModeID, q.Region, q.MatchTypeID, q.Timestamp
//                 FROM Queue q LEFT JOIN UserSkillBracket usb ON q.SteamID = usb.SteamID AND usb.MatchTypeID = ".(int) $matchType."
//                 WHERE  q.Region = ".(int)$region."
//                                 AND q.MatchModeID = ".(int) $modus."
//                         AND q.MatchTypeID = ".(int)$matchType."
//                                 ".$leagueModifier."
//                                 ".$forceSearch."
//                                 ORDER BY q.Timestamp ASC
//                                 LIMIT 10
//                                 ";
//         $data = $DB->multiSelect($sql);

//         $ret['debug'] .= p($sql,1);
//         p($sql);
//         $count = count($data);
//         p("COUNT: ".$count);
//         $limit = 0;
//         switch($count){
//                 case 0:
//                         $limit = 8;
//                         break;
//                 case 1:
//                         $limit = 8;
//                         break;
//                 case 2:
//                         $limit = 8;
//                         break;
//                 case 3:
//                         $limit = 6;
//                         break;
//                 case 4:
//                         $limit = 6;
//                         break;
//                 case 5:
//                         $limit = 4;
//                         break;
//                 case 6:
//                         $limit = 4;
//                         break;
//                 case 7:
//                         $limit = 2;
//                         break;
//                 case 8:
//                         $limit = 2;
//                         break;
//                 case 9:
//                         $limit = 0;
//                         break;
//                 case 10:
//                         $limit = 0;
//                         break;
//         }
//         $data2 = array();
//         if($limit > 0 && $matchType != 8 && $matchType != 9){
//                 if(POINTSMATCHMAKING){
//                         // Nach Gruppen suchen
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, qgm.Elo, qg.MatchModeID, qg.Region, qg.MatchTypeID, qg.GroupID
//                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                         ON qg.GroupID = qgm.GroupID AND
//                         qg.MatchTypeID = qgm.MatchTypeID AND
//                         qg.MatchModeID = qgm.MatchModeID
//                         LEFT JOIN UserSkillBracket usb ON qgm.SteamID = usb.SteamID AND usb.MatchTypeID = ".(int) $matchType."
//                         WHERE (((qg.Elo >= ".(int)$untere_grenze." AND qg.Elo <= ".(int)$obere_grenze.")
//                                         AND qg.Region = ".(int)$region."))
//                                         AND qg.MatchModeID =  ".(int) $modus."
//                                         AND qg.MatchTypeID = ".(int) $matchType."
//                                         ".$forceSearchGroup."
//                         ".$leagueModifier."
//                         ORDER BY qg.Timestamp ASC
//                         LIMIT ".$limit."
//                                 ";
//                 }
//                 else{
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, qgm.Elo, qg.MatchModeID, qg.Region, qg.MatchTypeID, qg.GroupID, qg.Timestamp
//                                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                         ON qg.GroupID = qgm.GroupID AND
//                                         qg.MatchTypeID = qgm.MatchTypeID AND
//                                         qg.MatchModeID = qgm.MatchModeID
//                                         LEFT JOIN UserSkillBracket usb ON qgm.SteamID = usb.SteamID AND usb.MatchTypeID = ".(int) $matchType."
//                                         WHERE qg.Region = ".(int)$region."
//                                         AND qg.MatchModeID =  ".(int) $modus."
//                                                         AND qg.MatchTypeID = ".(int) $matchType."
//                                                         ".$forceSearchGroup."
//                                                         ".$leagueModifier."
//                                                         ORDER BY qg.Timestamp ASC
//                                                         LIMIT ".$limit."
//                                         ";
//                 }

//                 p($sql2);
//                 $data2 = $DB->multiSelect($sql2);
//                 p("C1:".$count." C2:".count($data2)." limit:".$limit);
//                 $count = $count + count($data2);
//         }

//         // nochmal andersrum checken
//         // zuerst teams, dann single
//         if($count != 10){
//                 if(POINTSMATCHMAKING){
//                         // Nach Gruppen suchen
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, qgm.Elo, qg.MatchModeID, qg.Region, qg.MatchTypeID, qg.GroupID
//                                                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                                         ON qg.GroupID = qgm.GroupID AND
//                                                         qg.MatchTypeID = qgm.MatchTypeID AND
//                                                         qg.MatchModeID = qgm.MatchModeID
//                                                         LEFT JOIN UserSkillBracket usb ON qgm.SteamID = usb.SteamID AND usb.MatchTypeID = ".(int) $matchType."
//                                                         WHERE (((Elo >= ".(int)$untere_grenze." AND Elo <= ".(int)$obere_grenze.")
//                                 AND qg.Region = ".(int)$region."))
//                                 AND qg.MatchModeID =  ".(int) $modus."
//                                 AND qg.MatchTypeID = ".(int) $matchType."
//                         ".$forceSearchGroup."
//                         ".$leagueModifier."
//                         ORDER BY qg.Timestamp ASC
//                         LIMIT 8
//                         ";
//                 }
//                 else{
//                         $sql2 = "SELECT DISTINCT qgm.SteamID, qgm.Elo, qg.MatchModeID, qg.Region, qg.MatchTypeID, qg.GroupID, qg.Timestamp
//                                         FROM QueueGroup qg JOIN QueueGroupMembers qgm
//                                         ON qg.GroupID = qgm.GroupID AND
//                                         qg.MatchTypeID = qgm.MatchTypeID AND
//                                         qg.MatchModeID = qgm.MatchModeID
//                                         LEFT JOIN UserSkillBracket usb ON qgm.SteamID = usb.SteamID AND usb.MatchTypeID = ".(int) $matchType."
//                                         WHERE qg.Region = ".(int)$region."
//                                                                         AND qg.MatchModeID =  ".(int) $modus."
//                                                                         AND qg.MatchTypeID = ".(int) $matchType."
//                                                 ".$forceSearchGroup."
//                                                 ".$leagueModifier."
//                                                 ORDER BY qg.Timestamp ASC
//                                                 LIMIT 8
//                                                 ";
//                 }

//                 $ret['debug'] .= p($sql2,1);
//                 $data2 = $DB->multiSelect($sql2);
//                 p("C1:".$count." C2:".count($data2)." limit:".$limit);
//                 $count = count($data2);

//                 switch($count){
//                         case 0:
//                                 $limit = 10;
//                                 break;
//                         case 2:
//                                 $limit = 8;
//                                 break;
//                         case 4:
//                                 $limit = 6;
//                                 break;
//                         case 6:
//                                 $limit = 4;
//                                 break;
//                         case 8:
//                                 $limit = 2;
//                                 break;
//                         default:
//                                 $limit = 0;
//                 }
//                 if($limit > 0 && $matchType != 8 && $matchType != 9){
//                         $sql = "SELECT DISTINCT q.SteamID, q.Elo, q.MatchModeID, q.Region, q.MatchTypeID, q.Timestamp
//                                                                                         FROM Queue q LEFT JOIN UserSkillBracket usb ON q.SteamID = usb.SteamID AND usb.MatchTypeID = ".(int) $matchType."
//                                                                                         WHERE  q.Region = ".(int)$region."
//                                 AND q.MatchModeID = ".(int) $modus."
//                                 AND q.MatchTypeID = ".(int)$matchType."
//                                 ".$leagueModifier."
//                                 ".$forceSearch."
//                                 ORDER BY q.Timestamp ASC
//                                 LIMIT ".$limit."
//                                                 ";
//                         $data = $DB->multiSelect($sql);

//                         $ret['debug'] .= p($sql,1);
//                         //p($sql);
//                         $count = $count + count($data);
//                 }
//         }

//         $ret['count'] = $count;
//         $ret['data'] = $data;
//         $ret['data2'] = $data2;


//         return $ret;
// }

// function getCountInQueueSkillBracket1vs1($z, $i, $region, $modus, $matchType){
//         $DB = new DB();
//         $con = $DB->conDB();
//         $ret = array();
//         if($z==1){
//                 $force = true;
//                 $forceSearch = " AND q.ForceSearch = 1";
//                 $forceSearchGroup = " AND qg.ForceSearch = 1";
//         }
//         else{
//                 $force = false;
//                 $forceSearch = " AND q.ForceSearch = 0";
//                 $forceSearchGroup = " AND qg.ForceSearch = 0";
//         }
        
//         if(!$force){
//                 switch($i){
//                         case 0:
//                                 $leagueModifier = "AND usb.SkillBracketTypeID >= 3";
//                                 break;
//                         case 1:
//                                 $leagueModifier = "AND usb.SkillBracketTypeID = 2";
//                                 break;
//                         case 2:
//                                 $leagueModifier = "AND usb.SkillBracketTypeID = 1";
//                                 break;
        
//                 }
//         }
//         else{
//                 $leagueModifier = "";
//         }
        
//         $sql = "SELECT DISTINCT q.SteamID, q.Elo, q.MatchModeID, q.Region, q.MatchTypeID, q.Timestamp
//                 FROM Queue q LEFT JOIN UserSkillBracket usb ON q.SteamID = usb.SteamID AND usb.MatchTypeID = ".(int) $matchType."
//                 WHERE  q.Region = ".(int)$region."
//                                 AND q.MatchModeID = ".(int) $modus."
//                         AND q.MatchTypeID = ".(int)$matchType."
//                                 ".$leagueModifier."
//                                 ".$forceSearch."
//                                 ORDER BY q.Timestamp ASC
//                                 LIMIT 2
//                                 ";
//         $data = $DB->multiSelect($sql);
//         $ret['sql'] = p($sql,1);
//         $ret['count'] = count($data);
//         $ret['data'] = $data;
//         return $ret;
		return true;
	}

}
