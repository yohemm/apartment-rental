<?php function Order_date($date1, $date2)//La date1 doit etre moins recente que la 2
	{
		$decalage = 0;
		foreach ([4,2,2] as $key) {
			if ((int)substr($date1,$decalage,$key) == (int)substr($date2,$decalage,$key)) {
				$decalage += $key +1;
			}elseif ((int)substr($date1,$decalage,$key)< (int)substr($date2,$decalage,$key)) {
				break;
			}else{
				return False;
			}
		}
		return True;
	} ?>