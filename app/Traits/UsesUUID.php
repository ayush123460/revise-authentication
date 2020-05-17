<?PHP

namespace App\Traits;

use Illuminate\Support\Str;

/**
 * Trait for applying UUIDs.
 */

trait UsesUuid
{
    /**
     * Hooks into the model's boot method.
     */
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{ $model->getKeyName() } = Str::uuid();
            }
        });
    }

    /**
     * Tell eloquent UUIDs can't auto increment
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Tell eloquent UUIDs are of type string
     */
    public function getKeyType()
    {
        return 'string';
    }
}