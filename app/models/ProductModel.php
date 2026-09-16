<?php

class ProductModel extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_name', 'description', 'price', 'quantity'];
    protected $timestamps = false;
    private $aivenDatabase;

    public function __construct()
    {
        parent::__construct();
        $this->aivenDatabase = lava_instance()->call->database('aiven');
    }

    public function __get($key)
    {
        if ($key === 'db') {
            return $this->aivenDatabase;
        }

        return parent::__get($key);
    }
}
