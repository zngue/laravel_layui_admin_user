<?php


namespace Zngue\User\Models;


use App\User as BaseUser;
use Spatie\Permission\Traits\HasRoles;
/**
 * @property int $id
 * @property string $name
 * @property string $phome
 * @property int $role_id
 *@property int $is_super
 * @property bool $status
 * @property string $user_desc
 * @property string $email
 * @property  $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property  $created_at
 * @property  $updated_at
 *
 */
class User extends BaseUser
{
    use HasRoles;
    protected $guard_name = 'web';
    protected $fillable=['name','email','phome','stauts','role_id','password','user_desc','is_super'];
}
