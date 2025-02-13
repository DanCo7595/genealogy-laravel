<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Person;
use Illuminate\Support\Facades\DB;

class TestDegreeCommand extends Command
{
    protected $signature = 'test:degree {person1_id} {person2_id}';
    protected $description = 'Test du degré de parenté entre deux personnes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Récupère les IDs des personnes depuis les arguments de la commande
        $person1_id = $this->argument('person1_id');
        $person2_id = $this->argument('person2_id');

        // Active le suivi des requêtes SQL
        DB::enableQueryLog();

        // Démarre le chronomètre
        $timestart = microtime(true);

        // Recherche la personne par ID
        $person = Person::findOrFail($person1_id);
        $degree = $person->getDegreeWith($person2_id); // Appel de la méthode

        // Affiche les résultats dans le terminal
        $this->info("Degré : $degree");
        $this->info("Temps d'exécution : " . (microtime(true) - $timestart) . " secondes");
        $this->info("Nombre de requêtes SQL : " . count(DB::getQueryLog()));
    }
}
