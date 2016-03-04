<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $table = "contest_info";
    protected $primaryKey = "contest_id";

    /*
     * @function getState
     * @input $this
     *
     * @return int
     * @description get the state of the contest
     *              1 for running 0 for pending ,-1
     *              for ended
     */
    public function getState()
    {
        $curTime = time();
        if($curTime < strtotime($this->begin_time))
            return env("CONTEST_PENDING", 0);
        if($curTime >= strtotime($this->begin_time) && $curTime <= strtotime($this->end_time))
            return env("CONTEST_RUNNING", 1);
        return env("CONTEST_ENDED", -1);
    }

    /*
     * @function isRunning
     * @input $this
     *
     * @return bool
     * @description judge if the contest is running
     */
    public function isRunning()
    {
        return $this->getState() == env("CONTEST_RUNNING", 1);
    }

    /*
     * @function isPending
     * @input $this
     *
     * @return bool
     * @description judge if the contest is pending
     */
    public function isPending()
    {
        return $this->getState() == env("CONTEST_PENDING", 0);
    }

    /*
     * @function isEnded
     * @input $this
     *
     * @return bool
     * @description judge if the contest ends
     */
    public function isEnded()
    {
        return $this->getState() == env("CONTEST_ENDED", -1);
    }

    /*
     * @function getContestItemsInPage
     * @input $itemsPerPage $page_id
     *
     * @return array
     * @description each time call this function, return
     *              an array that contain all the data needed
     *              for the pager
     */
    public static function getContestItemsInPage($itemsPerPage, $page_id)
    {
        $data = [];
        $contestObj = Contest::orderby('contest_id', 'desc')->get();
        $contestNum = $contestObj->count();

        for($count = 0, $i = ($page_id - 1) * $itemsPerPage; $i < $contestNum && $count < $itemsPerPage; $i++, $count++)
        {
            $data["contests"][$count] = $contestObj[$i];
            if($contestObj[$i]->isPending())
            {
                $data["contests"][$count]->status = "Pending";
            }
            else if($contestObj[$i]->isEnded())
            {
                $data["contests"][$count]->status = "Ended";
            }
            else if($contestObj[$i]->isRunning())
            {
                $data["contests"][$count]->status = "Running";
            }
        }
        if($i == $contestNum)
        {
            $data["last_page"] = 1;
        }
        if($page_id == 1)
        {
            $data["first_page"] = 1;
        }
        $data["page_id"] = $page_id;
        $data["page_num"] = (int)($contestNum / $itemsPerPage + ($contestNum % $itemsPerPage == 0 ? 0 : 1));
        return $data;
    }
}
