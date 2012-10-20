<?php
function getTeam($teamNum)
{
	switch ($teamNum)
	{
		case 	-5	: $outputTeam = "No Team"; break;
		case	0	: $outputTeam = "The Management"; break;
		case	1	: $outputTeam = "Art/Layout"; break;
		case	2	: $outputTeam = "Community Events"; break;
		case	3	: $outputTeam = "Dancer Relations"; break;
		case	4	: $outputTeam = "Entertainment"; break;
		case	5	: $outputTeam = "Family Relations"; break;
		case	6	: $outputTeam = "Finance"; break;
		case	7	: $outputTeam = "Hospitality"; break;
		case	8	: $outputTeam = "Marketing"; break;
		case	9	: $outputTeam = "Morale"; break;
		case	10	: $outputTeam = "Operations"; break;
		case	11	: $outputTeam = "Public Relations"; break;
		case	12	: $outputTeam = "Recruitment"; break;
		case	13	: $outputTeam = "Technology"; break;
		case	-1	: $outputTeam = "Admin"; break;		
	}
	return $outputTeam;
}


?>