<?php

namespace App\Console\Commands;

use App\Models\Photo;
use App\Models\User\User;
use App\Models\Location\City;
use App\Models\Location\State;
use App\Models\Location\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class UpdateCountriesLeaderboards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'olm:update-countries-leaderboards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Leaderboards for each Country.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where([
            ['has_uploaded', 1],
            ['show_name', 1],
        ])->orWhere([
            ['has_uploaded', 1],
            ['show_username', 1]
        ])->get();

        foreach($users as $user) {
            $photos = Photo::where('user_id', $user->id)->get();
            foreach($photos as $photo) {
                $country = Country::find($photo->country_id);
                Redis::zadd($country->country.':Leaderboard', $user->xp, $user->id);
            }
        }
    }
}
