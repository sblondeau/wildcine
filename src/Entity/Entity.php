<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 17/01/19
 * Time: 22:28
 */

namespace App\Entity;


class Entity
{
    public function __construct(?array $data = null)
    {
        if ($data) {
            $this->hydrate($data);
        }
    }


    private function hydrate($data)  :void
    {
        foreach($data as $key=>$value) {
            if (method_exists($this, 'set'.$key)) {
                $this->{'set'.$key}($value);
            }
        }
    }

}