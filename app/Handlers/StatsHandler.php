<?php
namespace App\Handlers;


use App\Models\Stats;

class StatsHandler
{
    protected $stats;
    public function __construct()
    {
        $this->stats = (new Stats)->first();
    }

    public function increaseMessageCount()
    {
        if(isset($this->stats->message_c) && $this->stats->message_c !== null){
            $this->stats->message_c++;
        }else{
            $this->stats->message_c = 0;
        }
        $this->stats->save();
    }

    public function increaseSeenCount()
    {
        if(isset($this->stats->seen_c) && $this->stats->seen_c !== null){
            $this->stats->seen_c++;
        }else{
            $this->stats->seen_c = 0;
        }
        $this->stats->save();
    }

    public function increaseUnsuccessConservationCount()
    {
        if(isset($this->stats->unsuccess_c) && $this->stats->unsuccess_c !== null){
            $this->stats->unsuccess_c++;
        }else{
            $this->stats->unsuccess_c = 0;
        }
        $this->stats->save();
    }
}