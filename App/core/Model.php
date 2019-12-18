<?php

namespace core;

class Model
{
    public function connect()
    {
        return DataBase::db_connect();
    }
}