<?php namespace App\Models\Observers;

/* ----------------------------------------------------------------------
 * Event:
 * ---------------------------------------------------------------------- */

class PurchaseObserver 
{
	public function saving($model)
	{
		dd('true');
		return false;
	}
}
