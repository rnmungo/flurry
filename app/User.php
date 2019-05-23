<?php

namespace Flurry;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;


    /*****          Funciones          *****/

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'random_id';
    }

    /* Determina si el usuario realmente tiene un avatar asociado. */
    public function hasAvatar(){
        return boolval($this->getAttributes() && $this->getAttributes()['avatar']);
    }

    /* Nombre amigable del avatar elegido por el usuario */
    public function getAvatarName(){
        if ($this->hasAvatar()) {
            if ($this->own_avatar)
                return 'Personalizado';
            else
                return ucfirst(str_replace('.png', '', $this->avatar));
        }
        return 'Ninguno';
    }

    public function getAvatarFullPath(){
        if ($this->own_avatar)
            $path = '/imagenes/avatares/usuarios/';
        else
            $path = '/imagenes/avatares/';
        $path .= $this->avatar;
        return $path;
    }

    public function hasAnyRole($roles){
        if (is_array($roles)){
            foreach ($roles as $role) {
                if ($this->hasRole($role))
                    return true;                
            }
        }
        else
            return $this->hasRole($roles);
    }

    public function hasRole($role_name){
        return $this->role->name == $role_name;
    }


    /*****          Accesores          *****/
    public function getAvatarAttribute($value){
        if (!$value){
            return config('ourconfig.users.default_avatar');
        }
        return $value;
    }
    

    /*****          Propiedades          *****/
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'own_avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /*****          Relaciones          *****/
    public function role(){
        return $this->belongsTo('Flurry\Role');
    }
}
