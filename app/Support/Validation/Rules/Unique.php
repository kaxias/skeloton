<?php

namespace App\Support\Validation\Rules;

use Illuminate\Database\Connection;
use Rakit\Validation\MissingRequiredParameterException;
use Rakit\Validation\Rule;

class Unique extends Rule
{
    /** @var string $message */
    protected $message = 'The :attribute :value has been taken.';
    /** @var array $fillableParams */
    protected $fillableParams = ['table', 'column'];
    protected Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /** @throws MissingRequiredParameterException */
    public function check($value): bool
    {
        $this->requireParameters(['table', 'column']);
        $data = $this->connection->table($this->parameter('table'))->where($this->parameter('column'), $value);

        return intval($data->count() === 0);
    }
}
