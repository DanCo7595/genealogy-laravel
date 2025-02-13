<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Person extends Model {
    use HasFactory;

    protected $fillable = ['created_by', 'first_name', 'last_name', 'birth_name', 'middle_names', 'date_of_birth'];

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function parents() {
        return $this->belongsToMany(Person::class, 'relationships', 'child_id', 'parent_id');
    }

    public function children() {
        return $this->belongsToMany(Person::class, 'relationships', 'parent_id', 'child_id');
    }

    public function getDegreeWith($target_person_id)
    {
        $maxDepth = 25; // Limite le nombre de niveaux à 25

        $query = "WITH RECURSIVE family_tree AS (
                    SELECT parent_id, child_id, 0 AS degree
                    FROM relationships
                    WHERE parent_id = ? OR child_id = ?
                    
                    UNION
                    
                    SELECT r.parent_id, r.child_id, ft.degree + 1
                    FROM relationships r
                    INNER JOIN family_tree ft 
                    ON r.parent_id = ft.child_id OR r.child_id = ft.parent_id
                    WHERE ft.degree < ?
                )
                SELECT degree FROM family_tree WHERE parent_id = ? OR child_id = ? ORDER BY degree ASC LIMIT 1";

        $result = DB::select($query, [$this->id, $this->id, $maxDepth, $target_person_id, $target_person_id]);

        return $result ? $result[0]->degree : false;
    }


}
