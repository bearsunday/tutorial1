<?php
namespace MyVendor\Weekday\Resource\App;

use BEAR\Package\Annotation\ReturnCreatedResource;
use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\ResourceObject;
use Ray\CakeDbModule\Annotation\Transactional;
use Ray\CakeDbModule\DatabaseInject;

/**
 * @Cacheable
 */
class Todos extends ResourceObject
{
    use DatabaseInject;

    public function onGet(int $id) : ResourceObject
    {
        $this->body = $this
            ->db
            ->newQuery()
            ->select('*')
            ->from('todo')
            ->where(['id' => $id])
            ->execute()
            ->fetch('assoc');

        return $this;
    }

    /**
     * @Transactional
     * @ReturnCreatedResource
     */
    public function onPost(string $todo) : ResourceObject
    {
        $statement = $this->db->insert(
            'todo',
            ['todo' => $todo, 'created_at' => new \DateTime('now')],
            ['created_at' => 'datetime']
        );
        // created
        $this->code = 201;
        // hyperlink
        $id = $statement->lastInsertId();
        $this->headers['Location'] = '/todos?id=' . $id;

        return $this;
    }

    /**
     * @Transactional
     */
    public function onPut(int $id, string $todo) : ResourceObject
    {
        $this->db->update(
            'todo',
            ['todo' => $todo],
            ['id' => $id]
        );
        // no content
        $this->code = 204;

        return $this;
    }
}
