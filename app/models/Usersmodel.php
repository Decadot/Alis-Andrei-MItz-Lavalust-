<?php

class UsersModel extends Model
{
    protected $table = 'user_accounts';
    protected $fillable = ['name', 'username', 'password'];
    protected $timestamps = true;
    private $crudDatabase;

    public function __construct()
    {
        parent::__construct();
        $this->crudDatabase = lava_instance()->call->database('user_crud');
    }

    // Keep this model on its named connection without changing the default one.
    public function __get($key)
    {
        if ($key === 'db') {
            return $this->crudDatabase;
        }

        return parent::__get($key);
    }
}
