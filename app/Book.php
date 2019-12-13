<?php

namespace App;

use App\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Book extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/books/' . $this->id . '-' . Str::slug($this->title);
    }

    public function checkout($user)
    {
        $this->reservations()->create([
            'user_id' => $user->id,
            'checked_out_at' => now(),
        ]);
    }

    public function checkin($user)
    {
        $reservation = $this->reservations()->where('user_id', $user->id)
            ->whereNotNull('checked_out_at')
            ->whereNull('checked_in_at')
            ->first();

        if(is_null($reservation)){
            throw new \Exception();
        }

        $reservation->update([
            'checked_in_at' => now()
        ]);

    }

    public function setAuthorIdAttribute($auhtor)
    {
        $this->attributes['author_id'] = (Author::firstOrCreate([
            'name' => $auhtor,
        ]))->id;
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
