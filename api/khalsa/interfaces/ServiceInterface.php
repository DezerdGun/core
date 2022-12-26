<?php

namespace api\khalsa\interfaces;

interface ServiceInterface
{
    public function create();

    public function delete($id);

    public function update($id);
}
