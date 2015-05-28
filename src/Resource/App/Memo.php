<?php

namespace MyVendor\Weekday\Resource\App;

use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\RepositoryModule\Annotation\Refresh;
use BEAR\Resource\ResourceObject;
use Ray\AuraSqlModule\AuraSqlInject;

/**
 * @Cacheable
 */
class Memo extends ResourceObject
{
    use AuraSqlInject;

    public function onGet($todo_id)
    {
        $sql  = 'SELECT * FROM memo WHERE todo_id = :todo_id';
        $bind = ['todo_id' => $todo_id];
        $this->body = $this->pdo->fetchAll($sql, $bind);

        return $this;
    }

    /**
     * @Refresh(uri="app://self/todo?id={todo_id}")
     */
    public function onPost($todo_id, $body)
    {
        $this['todo_id'] = $todo_id;
        $sql = 'INSERT INTO memo (todo_id, body) VALUES(:todo_id, :body)';
        $statement = $this->pdo->prepare($sql);
        $bind = [
            'todo_id' => $todo_id,
            'body' => $body
        ];
        $statement->execute($bind);
        $id = $this->pdo->lastInsertId();

        $this->code = 201;
        $this->headers['Location'] = "/comment?id={$id}";

        return $this;
    }
}
