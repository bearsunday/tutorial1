<?php

namespace MyVendor\Weekday\Resource\App;

use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\Annotation\Embed;
use BEAR\Resource\Annotation\Link;
use BEAR\Resource\ResourceObject;
use Ray\CakeDbModule\Annotation\Transactional;
use Ray\CakeDbModule\DatabaseInject;

/**
 * @Cacheable
 */
class Todo extends ResourceObject
{
    use DatabaseInject;

    /**
     * @Embed(rel="memo", src="/memo?todo_id={id}")
     * @Link(rel="memo", href="/memo?todo_id={id}")
     */
    public function onGet($id)
    {
        $this['todo'] = $this
            ->db
            ->newQuery()
            ->select('*')
            ->from('todo')
            ->where(['id' => $id])
            ->execute()
            ->fetchAll('assoc');

        return $this;
    }

    public function onPost($todo)
    {
        $statement = $this->db->insert(
            'todo',
            ['todo' => $todo, 'created' => new \DateTime('now')],
            ['created' => 'datetime']
        );
        // hyper link
        $this->headers['Location'] = '/todo/?id=' . $statement->lastInsertId();
        // status code
        $this->code = 201;

        return $this;
    }


    public function onPut($id, $todo)
    {
        $this->db->update(
            'todo',
            ['todo' => $todo],
            ['id' => (int) $id]
        );
        $this->headers['location'] = '/todo/?id=' . $id;

        return $this;
    }
}
