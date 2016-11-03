<?php

namespace App\Helpers\Contracts;

Interface EventlogContract
{

    public function registro($nivel,$desc,$id);

}
