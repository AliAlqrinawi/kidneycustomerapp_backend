<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VisitorMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'text',
        'read_at',
        'mobile',
        'code_country',
        'slug_country'
    ];


    public function scopeFilter($q, $search)
    {
        return $q->where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('subject', 'like', '%' . $search . '%')
            ->orWhere('text', 'like', '%' . $search . '%');
    }



    public function markAsRead()
    {
        return $this->update(['read_at' => Carbon::now()]);
    }

    public function scopeUnReadMessages($query)
    {
        return $query->whereNull('read_at');
    }

    public function replays()
    {
        return $this->hasMany(VisitorMessageReplays::class, 'message_id', 'id');
    }

    public function replay(Request $request)
    {
        return VisitorMessageReplays::create([
            'admin_id' => getAdmin()->id,
            'message_id' => $this->id,
            'text' => $request->text
        ]);
    }

    public function hasReplay()
    {
        return ($this->replays()->count() > 0);
    }


}