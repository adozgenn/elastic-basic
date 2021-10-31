<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class ElasticUsersQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:users {--type=eloquent}';

    public function handle()
    {
        //Yeni bir kaydı elasticsearch’e eklemek
        //User::find(70)->searchable();

        //Mevcut kaydı elasticsearch’ten silmek
        //User::find(70)->unsearchable();


//        $type = $this->option('type');
//        $usersQuery = User::search('joanny');
//        if ($type === 'elastic'){
//            $usersQuery = $usersQuery->raw();
//        }else {
//            $usersQuery = $usersQuery->get()->toArray();
//        }
//        dd($usersQuery);

//        $result=User::boolSearch()->must('match', ['name' => ['query' => 'Agnes Nicolas II', 'fuzziness'=>'auto']])->highlight('name')->execute();
        $result=User::searchForm()->name('Agnes Nicolas II')->execute();
        $result = $result->matches()->first();
        dd($result);

    }
}
