<?php
namespace App\Console\Commands;

use Config;
use Illuminate\Console\Command;
use Vendor\Teamtnt\Teamsearch\Src\TNTSearch;


class indexUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index the users table';

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
        $indexer = TNTSearch::createIndex('users.index');
        $indexer->query('SELECT id, fname, lname, cnum, username, user_type FROM users;');
        $indexer->run();
    }
}
