<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function profileImage()
    {
        return ($this->image) ? '/storage/' . $this->image : 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
    }

    public function user() // This naming convention of having this func be the same name as the model (it can be overridden)
    {
        return $this->belongsTo(User::class); // Shows 1-1 relationship between Profile+User
        // You can visit belongsTo func to see that 2nd and 3rd param allow for different naming conventions if needed
    }
}
