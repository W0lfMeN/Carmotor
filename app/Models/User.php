<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'direccion',
        'rol'
    ];

    public $sortable = ['id', 'name', 'rol', 'email'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /* Funciones */


    /**
     * Get the URL to the user's profile photo.
     *
     * Funcion que ha sido sobrescrita que aunque hace exactamente lo mismo, esta puede ser llamada por la variable $user para poder mostrarse la imagen
     * por defecto en caso de que dicho usuario no la tenga
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
            return $this->profile_photo_path ? Storage::url($this->profile_photo_path) : $this->defaultProfilePhotoUrl();
    }

    /* Funcion que se relaciona con la tabla Products */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /* Relacion con la tabla UserProducts */
    public function userProducts()
    {
        return $this->hasMany(UserProduct::class);
    }
}
