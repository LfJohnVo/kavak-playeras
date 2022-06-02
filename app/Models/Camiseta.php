<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Camiseta
 *
 * @property int $id
 * @property string $nombre
 * @property int $numero
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Camiseta extends Model
{
	protected $table = 'camisetas';

	protected $casts = [
		'numero' => 'int'
	];

	protected $fillable = [
		'nombre',
		'numero'
	];
}
