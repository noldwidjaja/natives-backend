<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('table {table_name}' , function ($table_name) {
    mkdir("src/Acme/Module/{$table_name}");
    mkdir("src/Acme/Module/{$table_name}/Command");
    mkdir("src/Acme/Module/{$table_name}/Model");
    mkdir("src/Acme/Module/{$table_name}/Relationship");
    mkdir("src/Acme/Module/{$table_name}/Resources");
    mkdir("src/Acme/Module/{$table_name}/Resources/rules");
    mkdir("src/Acme/Module/{$table_name}/Repository");
    mkdir("src/Acme/Module/{$table_name}/Specification");
    file_put_contents("src/Acme/Module/{$table_name}/Repository/{$table_name}Repository.php","<?php
declare(strict_types=1);

namespace Acme\Module\\{$table_name}\Repository;

use Pandawa\Component\Ddd\Repository\Repository;

/**
 * @author Arnold Widjaja <noldwidjaja@gmail.com>
 */
final class {$table_name}Repository extends Repository
{
}");
    file_put_contents("src/Acme/Module/{$table_name}/Model/{$table_name}.php","<?php
declare(strict_types=1);

namespace Acme\Module\\{$table_name}\Model;

use Pandawa\Component\Ddd\AbstractModel;

/**
 * @author Arnold Widjaja <noldwidjaja@gmail.com>
 */
final class {$table_name} extends AbstractModel
{
}");
    file_put_contents("src/Acme/Module/{$table_name}/Acme{$table_name}Module.php","<?php
declare(strict_types=1);

namespace Acme\Module\\{$table_name};

use Pandawa\Component\Module\AbstractModule;

/**
 * @author Arnold Widjaja <noldwidjaja@gmail.com>
 */
final class Acme{$table_name}Module extends AbstractModule
{
}");
    file_put_contents("app/acme/Api/Resources/routes/_{$table_name}.yaml","{$table_name}:
type: resource
path: {$table_name}s");
    $this->info("{$table_name} model and repository has been created successfully");
})->describe('Make Model and Repository folders and files');

Artisan::command('seeder {table_name}', function ($table_name) {
    file_put_contents("database/seeds/{$table_name}TableSeeder.php","<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class {$table_name}TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \$faker = Faker::create();
        DB::table('{$table_name}')->insert([ 
            'id' => \$faker->uuid(),
            'created_at' => date(\"Y-m-d H:i:s\"),
            'updated_at' => date(\"Y-m-d H:i:s\")
            ]);
    }
}");
    $this->info("{$table_name} seeder created successfully");
});